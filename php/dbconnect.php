<?php
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'xshop_ver4';

    $_conn = new mysqli($server, $username, $password, $database);

    if($_conn->connect_error) {
        die("Connection failed: ". $_conn->connect_error);
    }

?>