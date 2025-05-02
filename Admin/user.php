<?php
require_once("connectdb_login.php");

function checkuser($user, $pass){
    $conn = connect();
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :user AND password = :pass");
    $stmt->bindParam(':user', $user);
    $stmt->bindParam(':pass', $pass);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $user_info = $stmt->fetch(); // Lấy thông tin của người dùng
    if($user_info) { // Nếu có thông tin người dùng
        if($user_info['role'] == 1) { // Nếu vai trò của người dùng là admin
            return 1; // Trả về 1 để chỉ định là admin
        } else {
            return 0; // Trả về 0 để chỉ định là user
        }
    } else {
        return -1;
    }
}
function getUserFullName($username) {
    // Kết nối đến cơ sở dữ liệu
    include "connect.php";

    // Xây dựng truy vấn SQL để lấy tên người dùng dựa trên username
    $sql = "SELECT TenUser FROM users WHERE id = '$id_user'";

    // Thực thi truy vấn
    $result = mysqli_query($conn, $sql);

    // Kiểm tra kết quả và trả về tên người dùng nếu có
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['TenUser'];
    } else {
        return null;
    }
}

?>
