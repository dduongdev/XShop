<?php
    require_once './php/dbconnect.php';
    require_once './php/dbcommands.php';
    require_once './php/init_rating_stars.php';
    require_once './php/product_dao.php';
    require_once './php/random_dao.php';

    session_start();

    $product_query_get = '';

    $initial_sql = 'SELECT products.id, product_name, main_img, unit_price, discount_percentage, products.slug, calc_rating_score_of_product(products.id) AS rating_score
                FROM products'; 
    $join_part = 'JOIN category_product
                    ON products.id = category_product.product_id
                    JOIN products_color
                    ON products.id = products_color.product_id
                    JOIN colors
                    ON products_color.color_id = colors.id
                    JOIN products_size
                    ON products_size.product_color_id = products_color.id
                    JOIN sizes
                    ON products_size.size_id = sizes.id';   
    $group_by_part = 'GROUP BY products.id';
    $order_by_part = 'ORDER BY ';
    $where_conditions = [];
    $order_conditions = [];

    if(!isset($_GET['search'])){
        header("HTTP/1.0 404 Not Found");
        echo "Page not found";
        exit();
    }

    $url = $_SERVER['REQUEST_URI'];
    $url_parts = explode('?', $url);
    $each_param = [];
    if (count($url_parts) > 1 && $url_parts[1] !== '') {
        $params = explode('&', $url_parts[1]);
        foreach ($params as $value) {
            list($key, $param_value) = explode('=', $value);
            $each_param[$key] = explode('%25', $param_value);
        }

        foreach ($each_param as $key => $value) {
            if ($key !== 'orderby' && $key !== 'sortby' && $key !== 'search') {
                $escaped_values = array_map('htmlspecialchars', $value);
                $where_conditions[] = "$key IN ('" . implode("', '", $escaped_values) . "')";
            }
        }

        if(isset($each_param['search'])){
            $searchInput = explode('%20', $each_param['search'][0]);
            $searchInput = implode(' ', $searchInput);
            $searchInput = urldecode($searchInput);
            $searchInput = explode(' ', $searchInput);
            $searchInput = implode('%', $searchInput);
            $where_conditions[] = "product_name like N'%".$searchInput."%'";
        }

        if (isset($each_param['orderby'])) {
            $order_by_part .= 'unit_price * (1 - discount_percentage) ' . htmlspecialchars($each_param['orderby'][0]) . ' ';
        }
        if (isset($each_param['sortby'])) {
            if (isset($each_param['orderby'])) {
                $order_by_part .= ', ';
            }
            $order_by_part .= 'release_date desc ';
        }

        $filter_sql = $initial_sql;
        if(isset($each_param['colors.slug']) || isset($each_param['sizes.size_name']) || isset($each_param['category_id']) || isset($each_param['search'])){
            $filter_sql .= ' ' . $join_part;
            $filter_sql .= ' WHERE ' . implode(' AND ', $where_conditions);
            $filter_sql .= ' ' . $group_by_part;
        }

        if (isset($each_param['sortby']) || isset($each_param['orderby'])) {
            $filter_sql .= ' ' . $order_by_part;
        }

        $product_query_get = $filter_sql;
    } else {
        $product_query_get = $initial_sql;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X-Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="../css/grid.css">
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <div class="app">
        <?php include "header.php" ?>
        
        <div class="container">
            <div class="grid wide">
                <h1 class="products-page__header">Kết quả tìm kiếm</h1>
                <div class="row">
                    <div class="col l-2 m-0 c-0">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" 
                                class="product-filter"
                                method="get">
        
                            <div class="product-filter__item">
                                <p class="product-filter__title">
                                    Kích cỡ
                                </p>
        
                                <div class="product-filter__size">
                                    <?php
                                        $sql = $SIZE_QUERY_GET_ALL;
                                        $result = $_conn->query($sql);
                                        while($row = $result->fetch_assoc()){
                                            echo '<button class="product-filter__size-item product-filter__button js-product-filter__button '.((isset($each_param['sizes.size_name']) && in_array($row['size_name'], $each_param['sizes.size_name'])) ? 'products-page__function-button--is-selected' : ' ').'" name="sizes.size_name" value="'.$row['size_name'].'">'.$row['size_name'].'</button>';
                                        }
                                        $result->close();
                                    ?> 
                                </div>
                            </div>
        
                            <div class="product-filter__item">
                                <p class="product-filter__title">
                                    Màu sắc
                                </p>
        
                                <div class="product-filter__color">
                                    <?php
                                        $sql = $COLOR_QUERY_GET_ALL;
                                        $result = $_conn->query($sql);
                                    

                                        while($row = $result->fetch_assoc()){
                                            echo '<label for="product-filter--select-'.$row['slug'].'" class="product-filter__checkbox-item product-filter__color-item">';
                                            echo '<input type="checkbox" name="colors.slug" value="'.$row['slug'].'" id="product-filter--select-'.$row['slug'].'" class="product-filter__checkbox" '.((isset($each_param['colors.slug']) && in_array($row['slug'], $each_param['colors.slug'])) ? 'checked' : ' ').'>';
                                            echo '<span class="product-filter__checkbox-title">'.$row['color_name'].'</span>';
                                            echo '<div class="product-filter__color-img" style="background-image: url('.$row['img'].');"></div>';
                                            echo '</label>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </form>
                    </div>
        
                    <div class="col l-10">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" 
                            method="get"
                            class="products-page__sort-bar">
                            <span class="products-page__sort-title">
                                Sắp xếp theo
                            </span>
        
                            <button class="js-product-filter__button products-page__sort-type
                                <?php echo ((isset($each_param['sortby'])) ? 'products-page__function-button--is-selected': ' ') ?>
                            " name="sortby" value="latest">Mới nhất</button>
        
                            <button class="products-page__sort-type products-page__sort-type--price 
                                <?php echo ((isset($each_param['orderby']) && in_array('asc', $each_param['orderby'])) ? 'products-page__function-button--is-selected': ' ') ?>
                            " name="orderby" value="asc">Giá thấp đến cao</button>

                            <button class="products-page__sort-type products-page__sort-type--price 
                                <?php echo ((isset($each_param['orderby']) && in_array('desc', $each_param['orderby'])) ? 'products-page__function-button--is-selected': ' ') ?>
                            " name="orderby" value="desc">Giá cao đến thấp</button>
                        </form>
        
                        <div class="row products-page__product-container">
                            <span class="products-page__desc--no-product hidden_tag">Không có sản phẩm nào.</span>
                        </div>
        
                        <div class="loadmore loadmore--products_page">
                            <button class="loadmore-btn loadmore-btn--products_page">
                                Xem thêm
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php include "footer.php" ?>
    </div>

    <script src="../js/toogleParameterUrl.js"></script>

    <script>
        var colorButtons = document.querySelectorAll('.product-card__color');

        colorButtons.forEach(function(button){
            button.addEventListener('click', function(){
                var product_card = button.closest('.product-card');
                var product_card_img = product_card.querySelector('.product-card__img');
                var selectedImg = button.querySelector('img');
                product_card_img.style.backgroundImage = "url('" + selectedImg.src + "')";

                var productCard_colorInfo = product_card.querySelector('.product-card__color-info');
                productCard_colorInfo.innerText = selectedImg.alt;
            })
        })
    </script>

    <script>
        <?php
            echo 'var products_data = '.json_encode(executeNonParamQuery($product_query_get)).';';
        ?>
    </script>

    <script>
        let currentPage = 1
        var itemsPerPageCount = 15;
        let totalPage = (products_data.length % itemsPerPageCount == 0) ? products_data.length / itemsPerPageCount : Math.ceil(products_data.length / itemsPerPageCount);
        let itemsPerPage = products_data.slice((currentPage - 1) * itemsPerPageCount, (currentPage - 1) * itemsPerPageCount + itemsPerPageCount);
        renderProductData();
        
        if(totalPage <= 1){
            $('.loadmore--products_page').addClass('hidden_tag');
        }
        if(products_data == 0) {
            $('.products-page__desc--no-product').removeClass('hidden_tag');
        }

        function handlePagination(pageNumber) {
            currentPage = pageNumber;
            itemsPerPage = products_data.slice((currentPage - 1) * itemsPerPageCount, (currentPage - 1) * itemsPerPageCount + itemsPerPageCount);
            renderProductData();
        }

        function renderProductData() {
            let element = '';
            itemsPerPage.map(value => {
                element += `
                    <div class="col l-2-4">
                        <a class="product-card" href="../product_detail_page.php/${value[5]}-${value[0]}">
                            <div class="product-card__img" style="background-image: url(${value[2]});"></div>
                            <div class="product-card__content">
                                <p class="product-card__title">${value[1]}</p>
                                <div class="rating-score rating-score--product-card">
                                    ${renderRatingStars(parseFloat(value[6]))}
                                    <span class="product-detail__rating-score">(${value[6]})</span>
                                </div>
                                <div class="product-card__price">
                                    ${renderProductPrice(parseFloat(value[3]), parseFloat(value[4]))}
                                </div>
                            </div>
                        </a>
                    </div>
                `;
            });
            $('.products-page__product-container').html($('.products-page__product-container').html() + element);
        }

        function renderProductPrice(unit_price, discount_percentage) {
            let result = '';
            if (discount_percentage > 0.0) {
                var new_price = unit_price * (1 - discount_percentage);
                result += `<span class="product-card__current-price">${new_price.toLocaleString('de-DE')}đ</span>`;
                result += `<span class="product-card__old-price">${unit_price.toLocaleString('de-DE')}đ</span>`;
                result += `<span class="product-card__discount">-${Math.round(discount_percentage * 100, 1)}%</span>`;
            } else {
                result += `<span class="product-card__current-price">${unit_price.toLocaleString('de-DE')}đ</span>`;
            }
            return result;
        }

        function renderRatingStars(rating_score){
            let result = '';
            var i = 1;
            for(; i <= Math.floor(rating_score); i++){
                result += `<div class="rating-score__star is-active"></div>`;
            }

            if(rating_score > Math.floor(rating_score)){
                result += `<div class="rating-score__star is-half"></div>`;
                i++;
            }

            for(; i <= 5; i++){
                result += `<div class="rating-score__star is-neutral"></div>`;
            }

            return result;
        }
    </script>

    <script>
        $(document).ready(function(){
            $('.loadmore-btn--products_page').click(function(){
                if(currentPage < totalPage){
                    currentPage++;
                    handlePagination(currentPage);

                    if(currentPage == totalPage){
                        $('.loadmore--products_page').addClass('hidden_tag');
                    }
                }
            })

            $('.js-product-filter__button').click(function(e){
                e.preventDefault();

                toogleParameterUrl($(this).attr('name'), $(this).val());
            })

            $('.product-filter__checkbox').change(function(){
                toogleParameterUrl($(this).attr('name'), $(this).val());
            })

            $('.products-page__sort-type--price').click(function(e){
                e.preventDefault();
                
                const url = new URL(window.location.href);
                const params = new URLSearchParams(url.search);

                if(params.has('orderby')){
                    var oldValue = params.get('orderby');
                    console.log(oldValue);
                    params.delete('orderby');
                    if(oldValue !== $(this).val()){
                        params.set($(this).attr('name'), $(this).val());
                    }
                } else {
                    params.set($(this).attr('name'), $(this).val());
                }

                window.location.href = `${url.pathname}?${params}`;
            })
        })
    </script>
</body>
</html>
