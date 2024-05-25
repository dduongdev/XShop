<?php
    require_once 'dbconnect.php';
    require_once 'dbcommands.php';

    function getUserIdByUsername($username){
        global $_conn;
        global $USER_QUERY_GET_ID_BY_USERNAME;

        $stmt = $_conn->prepare($USER_QUERY_GET_ID_BY_USERNAME);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user_id = $result->fetch_assoc();
        $user_id = $user_id['id'];
        $result->close();

        return $user_id;
    }
?>