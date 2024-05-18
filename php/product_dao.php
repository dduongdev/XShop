<?php
    require_once 'dbconnect.php';
    require_once 'dbcommands.php';
    require_once 'init_rating_stars.php';

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
        global $PRODUCT_QUERY_GET_RATING_SCORE_OF_PRODUCT;

        $stmt = $_conn->prepare($PRODUCT_QUERY_GET_RATING_SCORE_OF_PRODUCT);
        $stmt->bind_param('s', $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $rating = $result->fetch_assoc();
        $rating['rating_score'] = (float)$rating['rating_score'];

        return $rating;
    }

    function getAllColorsOfProduct($product_id){
        global $_conn;
        global $PRODUCT_QUERY_GET_ALL_COLORS_OF_PRODUCT;

        $stmt = $_conn->prepare($PRODUCT_QUERY_GET_ALL_COLORS_OF_PRODUCT);
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
            $result[$size['product_id']] = ['size_name' => $size['size_name'], 'remaining_quantity' => $size['remaining_quantity'], 'sold_quantity' => $size['sold_quantity']];
        }

        return $result;
    }

    function isExistProduct($product_id){
        global $_conn;
        global $PRODUCT_QUERY_CHECK_EXIST;

        $stmt = $_conn->prepare($PRODUCT_QUERY_CHECK_EXIST);
        $stmt->bind_param('s', $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0)
            return true;
        return false;
    }

    function getAllRandomProductCards(){
        global $_conn;
        global $PRODUCT_QUERY_GET_ALL_RANDOM_PRODUCT_CARD_INFO;

        $result = $_conn->query($PRODUCT_QUERY_GET_ALL_RANDOM_PRODUCT_CARD_INFO);
        $data = $result->fetch_all();

        return json_encode($data);
    }

    function queryPagination($sql, $start, $end){
        global $_conn;

        $stmt = $_conn->prepare($sql);
        $stmt->bind_param('ss', $start, $end);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    function getProductCount(){
        global $_conn;
        global $PRODUCT_QUERY_GET_PRODUCT_COUNT;

        $result = $_conn->query($PRODUCT_QUERY_GET_PRODUCT_COUNT);
        $data = $result->fetch_assoc();
        $data = $data['product_count'];

        $result->close();

        return $data;
    }
?>