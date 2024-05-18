<?php
    require_once 'dbconnect.php';

    function executeNonParamQuery($sql){
        global $_conn;

        $result = $_conn->query($sql);
        $data = $result->fetch_all();
        $result->close();

        return $data;
    }
?>