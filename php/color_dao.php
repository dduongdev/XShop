<?php
    require_once 'dbcommands.php';
    require_once 'dbconnect.php';

    function getColorsOfProduct($product_id){
        global $_conn;
        global $COLOR_QUERY_GET_COLOR_OF_PRODUCT;

        $stmt = $_conn->prepare($COLOR_QUERY_GET_COLOR_OF_PRODUCT);
        $stmt->bind_param('s', $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }
?>