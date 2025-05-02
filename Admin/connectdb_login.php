<?php
function connect(){
    // Cấu hình kết nối đến CSDL và trả về kết nối
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_quanlybansua";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return null;
    }
    define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/BaiCuoiKy_23CT_2/');
}
?>
