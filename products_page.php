<?php
    require_once 'php/dbconnect.php';
    require_once 'php/dbcommands.php';
    require_once 'php/functions.php';
    require_once 'php/product_dao.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X-Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="./css/grid.css">
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="app">
        <?php include "header.php" ?>
        
        <div class="container">
            <div class="grid wide">
                <h1 class="products-page__header">Tất cả sản phẩm</h1>
                <div class="row">
                    <div class="col l-2 m-0 c-0">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" 
                                class="product-filter"
                                method="get">
        
                            <div class="product-filter__item">
                                <p class="product-filter__title">
                                    Danh mục
                                </p>
        
                                <ul class="product-filter__clothing reset-ul">
                                    <li class="product-filter__clothing-item">
                                        <input type="checkbox" name="" id="product-filter--select-shirt">
                                        <label class="product-filter__clothing-title" for="product-filter--select-shirt">
                                            Áo
                                        </label>
                                    </li>
        
                                    <li class="product-filter__clothing-item">
                                        <input type="checkbox" name="" id="product-filter--select-trousers">
                                        <label class="product-filter__clothing-title" for="product-filter--select-trousers">
                                            Quần
                                        </label>
                                    </li>
        
                                    <li class="product-filter__clothing-item">
                                        <input type="checkbox" name="" id="product-filter--select-underwear">
                                        <label class="product-filter__clothing-title" for="product-filter--select-underwear">
                                            Đồ lót
                                        </label>
                                    </li>
                                </ul>
                            </div>
        
                            <div class="product-filter__item">
                                <p class="product-filter__title">
                                    Kích cỡ
                                </p>
        
                                <div class="product-filter__size">
                                    <?php
                                        $sql = $SIZE_QUERY_GET_ALL;
                                        $result = $_conn->query($sql);
                                        while($row = $result->fetch_assoc()){
                                            echo '<button class="product-filter__size-item product-filter__button" name="size" value="'.$row['size_name'].'">'.$row['size_name'].'</button>';
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
                                            echo '<button class="product-filter__color-item product-filter__button" name="color" value='.$row['color_name'].'>';
                                            echo '<div class="product-filter__color-img" style="background-image: url('.$row['img'].');"></div>';
                                            echo '<span class="product-filter__color-desc">'.$row['color_name'].'</span>';
                                            echo '</button>';
                                        }
                                        $result->close();
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
        
                            <button class="products-page__sort-type" value="new">Mới nhất</button>
                            <button class="products-page__sort-type" value="bestseller">Bán chạy</button>
        
                            <input type="radio" name="sort-price" id="products-page__sort-price-asc" value="price-asc">
                            <label class="products-page__sort-type" for="products-page__sort-price-asc">Giá thấp đến cao</label>
        
                            <input type="radio" name="sort-price" id="product-page__sort-price-desc" value="price-desc">
                            <label class="products-page__sort-type" for="products-page__sort-price-desc">Giá cao đến thấp</label>
                        </form>
        
                        <div class="row">
                            <?php 
                                $sql = $PRODUCT_QUERY_GET_PRODUCT_CARD_INFO;
                                $result = $_conn->query($sql);
                                while($row = $result->fetch_assoc()){
                                    $rating = getGeneralRatingOfProduct($row['id']);

                                    $unit_price = $row['unit_price'];
                                    $discount_percentage = $row['discount_percentage'];
                                    $sell_price = $unit_price * (1-$discount_percentage);


                                    echo '<div class="col l-2-4 m-6 c-6">';
                                    echo '<a class="product-card" href="product_detail_page.php?id='.$row['id'].'&product='.$row['slug'].'">';
                                    echo '<div class="product-card__img" style="background-image: url('.$row['main_img'].');"></div>';
                                    echo '<div class="product-card__content">';

                                    echo '<p class="product-card__title">'.$row['product_name'].'</p>';

                                    echo '<div class="rating-score rating-score--product-card">';
                                    initRatingStars($rating['rating_score']);
                                    echo '<span class="product-detail__rating-score">('.$rating['rating_score'].')</span>';
                                    echo '</div>';

                                    echo '<div class="product-card__price">';
                                    if($discount_percentage > 0){
                                        echo '<span class="product-card__current-price">'.number_format($sell_price, 0, ',', '.').'đ</span>';
                                        echo '<span class="product-card__old-price">'.number_format($unit_price, 0, ',', '.').'đ</span>';
                                        echo '<span class="product-card__discount">-'.($discount_percentage * 100).'%</span>';
                                    }
                                    else {
                                        echo '<span class="product-card__current-price">'.number_format($unit_price, 0, ',', '.').'đ</span>';
                                    }
                                    echo '</div>';

                                    echo '</div>';
                                    echo '</a>';
                                    echo '</div>';
                                }
                                $result->close();
                            ?>
                        </div>
        
                        <div class="loadmore">
                            <button class="loadmore-btn">
                                Xem thêm
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php include "footer.php" ?>
    </div>

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
</body>
</html>
