<?php
    if(!isset($_SESSION['username'])){
        header('Location: ../login_page.php');
    }
    
    if(time() - $_SESSION['start_time'] >= 60*60*3){
        session_unset();
        session_destroy();
        header('Location: ../login_page.php');
    }
?>