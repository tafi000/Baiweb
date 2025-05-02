<?php
    session_start();
    session_destroy();
    include "connect.php";
    header('location: '.BASE_URL . 'login.php');
?>