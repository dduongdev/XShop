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
    }

    function product_detail_change($product_id, $color_slug){
        $images = getAllImagesOfProductColor($product_id, $color_slug);

        $result = ['main_image' => '', 'images' => '', 'sizes' => ''];
        $result['main_image'] = $images[0];
        $result['images'] = '<img class="product-detail__sub-image product-detail__sub-image--is-selected" src="'.$images[0].'">';
        for($i=1; $i<count($images); $i++){
                $result['images'] .= '<img class="product-detail__sub-image" src="'.$images[$i].'">';
        }
        
        $sizes = getAllSizesOfColor($product_id, $color_slug);

        foreach($sizes as $size){
            $result['sizes'] .= '<button class="product-option__select-item product-option__select-item--size" name="size" value="'.$size['size_name'].'">'.$size['size_name'].'</button>';
        }

        echo json_encode($result);
    }
?>