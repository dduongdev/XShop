<?php
    require 'dbconnect.php';
    include 'dbcommands.php';

    function getProductInformation($product_id){
        global $_conn;
        global $PRODUCT_QUERY_GET_PRODUCT_INFORMATION;

        $stmt = $_conn->prepare($PRODUCT_QUERY_GET_PRODUCT_INFORMATION);
        $stmt->bind_param('s', $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product_info = $result->fetch_assoc();

        return $product_info;
    }

    function getGeneralRatingOfProduct($product_id){
        global $_conn;
        global $PRODUCT_QUERY_GET_RATING_SCORE;

        $stmt = $_conn->prepare($PRODUCT_QUERY_GET_RATING_SCORE);
        $stmt->bind_param('s', $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $rating = $result->fetch_assoc();
        $rating['rating_score'] = (float)$rating['rating_score'];

        return $rating;
    }

    function getAllColorsOfProduct($product_id){
        global $_conn;
        global $PRODUCT_QUERY_GET_ALL_COLORS;

        $stmt = $_conn->prepare($PRODUCT_QUERY_GET_ALL_COLORS);
        $stmt->bind_param('s', $product_id);
        $stmt->execute();
        $colors = $stmt->get_result();

        $result = [];

        while($color = $colors->fetch_assoc()){
            $result[$color['slug']] = ["color_name" => $color['color_name'], "img" => $color['img']]; 
            
        }

        return $result;
    }

    function getAllImagesOfProductColor($product_id, $color_slug){
        global $_conn;
        global $PRODUCT_QUERY_GET_ALL_IMAGES_OF_COLOR;

        $stmt = $_conn->prepare($PRODUCT_QUERY_GET_ALL_IMAGES_OF_COLOR);
        $stmt->bind_param('ss', $product_id, $color_slug);
        $stmt->execute();
        $images = $stmt->get_result();

        $result = [];

        while($image = $images->fetch_assoc()){
            $result[] = $image['product_color_img'];
        }

        return $result;
    }

    function getAllSizesOfColor($product_id, $color_slug){
        global $_conn;
        global $PRODUCT_QUERY_GET_ALL_SIZES_OF_COLOR;

        $stmt = $_conn->prepare($PRODUCT_QUERY_GET_ALL_SIZES_OF_COLOR);
        $stmt->bind_param('ss', $product_id, $color_slug);
        $stmt->execute();
        $sizes = $stmt->get_result();

        $result = [];

        while($size = $sizes->fetch_assoc()){
            $result[] = $size;
        }

        return $result;
    }
?>