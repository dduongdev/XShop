<?php
    require_once 'dbconnect.php';
    require_once 'dbcommands.php';

    function checkExistCartItemOfUser($username, $product_id){
        global $_conn;
        global $CART_QUERY_CHECK_EXIST;

        $stmt = $_conn->prepare($CART_QUERY_CHECK_EXIST);
        $stmt->bind_param('ss', $username, $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $count = $result->fetch_assoc();
        $count = $count['count'];
        $result->close();

        return (bool)$count;
    }
?>