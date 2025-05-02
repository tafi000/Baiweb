<?php
session_start();
// Xử lý thêm sản phẩm vào giỏ hàng
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['productId'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $quantity = $_POST['quantity'];

    // Nếu giỏ hàng chưa tồn tại, khởi tạo giỏ hàng
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Nếu sản phẩm đã tồn tại trong giỏ hàng, tăng số lượng
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity'] += $quantity;
    } else {
        // Thêm sản phẩm mới vào giỏ hàng
        $_SESSION['cart'][$productId] = [
            'name' =>
$name, 'price' => $price, 'image' => $image, 'quantity' => $quantity, ]; } 
 header('Location: cart.php'); exit(); } ?>

<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="assets/css/User/style.css" />
  </head>
  <body>
  <div class="cart-container">
    <h1>Giỏ hàng của bạn</h1>
    <?php if (!empty($_SESSION['cart'])): ?>
        <table>
            <thead>
                <tr>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                    <tr>
                        <td><img src="Admin/uploads/<?= $item['image'] ?>" alt="<?= $item['name'] ?>"></td>
                        <td><?= $item['name'] ?></td>
                        <td><?= number_format($item['price'], 0, ',', '.') ?> VND</td>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?> VND</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="cart-total">
            Tổng cộng: <?= number_format(array_sum(array_map(function($item) {
                return $item['price'] * $item['quantity'];
            }, $_SESSION['cart'])), 0, ',', '.') ?> VND
        </div>
        <a href="checkout.php" class="checkout-btn">Thanh toán</a>
    <?php else: ?>
        <p>Giỏ hàng trống.</p>
    <?php endif; ?>
</div>
  </body>
</html>
