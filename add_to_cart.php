<?php
session_start();
include('connect.php');

// Lấy ID sản phẩm
$productId = $_GET['id'];

// Lấy thông tin sản phẩm từ cơ sở dữ liệu
$sql = "SELECT * FROM products WHERE productId = $productId";
$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);

// Thêm sản phẩm vào giỏ hàng
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_SESSION['cart'][$productId])) {
    $_SESSION['cart'][$productId]['quantity']++;
} else {
    $_SESSION['cart'][$productId] = [
        'name' => $product['name'],
        'price' => $product['price'],
        'quantity' => 1,
        'image' => $product['image']
    ];
}

header('Location: cart.php');
exit();