<?php
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'xshop';

    $_conn = new mysqli($server, $username, $password, $database);

    if($_conn->connect_error) {
        die("Connection failed: ". $_conn->connect_error);
    }

?>