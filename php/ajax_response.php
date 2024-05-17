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
?>