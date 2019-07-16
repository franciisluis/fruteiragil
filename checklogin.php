<?php
    session_start();
    if(!$_SESSION['login']){
        header('Location: inc.login.php');
        exit;
    }
?>