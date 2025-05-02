<?php
include('connect.php'); // Kết nối cơ sở dữ liệu

// Lấy thông tin sản phẩm theo ID
$productId = $_GET['id'];
$sql = "SELECT * FROM products WHERE productId = $productId";
$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chi tiết sản phẩm</title>
    <link rel="stylesheet" href="assets/css/product_detail.css" />
  </head>
  <body>
    <div class="product-detail ">
    <h1><?= $product['name'] ?></h1>
    <img
      src="Admin/uploads/<?= $product['image'] ?>"
      alt="<?= $product['name'] ?>"
    />
    <p>
      Giá:
      <?= number_format($product['price'], 0, ',', '.') ?>
      VND
    </p>
    <div class="quantity">
  <button class="quantity-btn minus">-</button>
  <input type="number" class="quantity-input" value="1" min="1" />
  <button class="quantity-btn plus">+</button>
</div>
<div class="btn">
  <form action="cart.php" method="POST">
    <input type="hidden" name="productId" value="<?= $product['productId'] ?>">
    <input type="hidden" name="name" value="<?= $product['name'] ?>">
    <input type="hidden" name="price" value="<?= $product['price'] ?>">
    <input type="hidden" name="image" value="<?= $product['image'] ?>">
    <input type="hidden" name="quantity" value="1">
    <button type="submit" class="btn">Đặt hàng</button>
  </form>
  <a href="index.php" class="btn">Quay lại</a>
</div>
<p>
      Mô tả:
      <?= $product['describe'] ?>
    </p>
</div>
<script src="assets/js/product_detail.js"></script>
  </body>
</html>
