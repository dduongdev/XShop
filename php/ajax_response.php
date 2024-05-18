<?php
    require_once 'dbconnect.php';
    require_once 'dbcommands.php';
    require_once 'product_dao.php';

    $action = $_POST['action'] ?? '';
    switch($action){
        case 'product_detail_change':
            $product_id = $_POST['product_id'];
            $color_slug = $_POST['color_slug'];
            echo product_detail_change($product_id, $color_slug);
            break;
        case 'products_page_pagination':
            $start = $_POST['start'];
            $end = $_POST['end'];
            echo products_page_pagination($start, $end);
            break;
            
    }

    function product_detail_change($product_id, $color_slug){
        $images = getAllImagesOfProductColor($product_id, $color_slug);

        $result = ['main_image' => '', 'images' => '', 'sizes' => '', 'sizes_data'];
        $result['main_image'] = $images[0];
        $result['images'] = '<img class="product-detail__sub-image product-detail__sub-image--is-selected" src="'.$images[0].'">';
        for($i=1; $i<count($images); $i++){
                $result['images'] .= '<img class="product-detail__sub-image" src="'.$images[$i].'">';
        }
        
        $sizes = getAllSizesOfColor($product_id, $color_slug);

        foreach($sizes as $key => $value){
            $uid = uniqid('product-option_', true);
            $result['sizes'] .= '<label for="'.$uid.'" class="product-option__select-item product-option__select-item--size">';
            $result['sizes'] .= $value['size_name'];
            $result['sizes'] .= '<input type="radio" class="hidden_tag" name="size" value="'.$key.'" size-value="'.$value['size_name'].'" id="'.$uid.'">';
            $result['sizes'] .= '</label>';
        }  

        $result['sizes_data'] = $sizes;

        echo json_encode($result);
    }

    function products_page_pagination($sql, $start, $end){
        $data = queryPagination($sql, $start, $end);

        $html = '';

        while($row = $data->fetch_assoc()){
            $rating = getGeneralRatingOfProduct($row['id']);

            $unit_price = $row['unit_price'];
            $discount_percentage = $row['discount_percentage'];
            $sell_price = $unit_price * (1-$discount_percentage);


            $html .= '<div class="col l-2-4 m-6 c-6">';
            $html .= '<a class="product-card" href="../product_detail_page.php/'.$row['slug'].'-'.$row['id'].'">';
            $html .= '<div class="product-card__img" style="background-image: url('.$row['main_img'].');"></div>';
            $html .= '<div class="product-card__content">';

            $html .= '<p class="product-card__title">'.$row['product_name'].'</p>';

            $html .= '<div class="rating-score rating-score--product-card">';
            $html .= initRatingStars($rating['rating_score']);
            $html .= '<span class="product-detail__rating-score">('.$rating['rating_score'].')</span>';
            $html .= '</div>';

            $html .= '<div class="product-card__price">';
            if($discount_percentage > 0){
                $html .= '<span class="product-card__current-price">'.number_format($sell_price, 0, ',', '.').'đ</span>';
                $html .= '<span class="product-card__old-price">'.number_format($unit_price, 0, ',', '.').'đ</span>';
                $html .= '<span class="product-card__discount">-'.($discount_percentage * 100).'%</span>';
            }
            else {
                $html .= '<span class="product-card__current-price">'.number_format($unit_price, 0, ',', '.').'đ</span>';
            }
            $html .= '</div>';

            $html .= '</div>';
            $html .= '</a>';
            $html .= '</div>';
        }
        $data->close();

        return $html;
    }
?>