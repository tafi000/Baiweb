<?php
	$host = "localhost";
	$username = "root";
	$pass = "";
	$db = "db_quanlybansua";
	$conn = mysqli_connect($host, $username, $pass, $db) or die("Kết nối CSDL thất bại");
	mysqli_set_charset($conn, "utf8"); //thiết lập mã tiếng Việt khớp với thiết kế CSDL
	define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/BaiCuoiKy_23CT_2/');
?>