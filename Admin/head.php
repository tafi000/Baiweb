<?php
    session_start();
    if(!isset($_SESSION['username_admin']) && $_SESSION['username_admin'] == 0) {
        header('location: ./login.php');
    }
    $welcome_message_admin = isset($_SESSION['username_ten']) ? $_SESSION['username_ten'] : "Khách";
    include "connectdb_login.php";
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="../assets/css/Admin/style.css">
