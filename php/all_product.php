<?php
include('../connect.php'); // Kết nối cơ sở dữ liệu
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Lấy danh mục từ URL
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Tạo câu truy vấn SQL dựa trên danh mục
$sql = "SELECT * FROM products";
if ($category === 'sua-bot') {
    $sql .= " WHERE category = 'Sữa bột'";
} elseif ($category === 'sua-hop') {
    $sql .= " WHERE category = 'Sữa hộp'";
} elseif ($category === 'sua-chua') {
    $sql .= " WHERE category = 'Sữa chua'";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <link rel="stylesheet" href="../assets/css/User/style.css">
</head>
<body>
    <h1>Danh mục: <?= htmlspecialchars($category) ?></h1>
    <div class="product-list">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="product-item">
                <img src="../Admin/uploads/<?= $row['image'] ?>" alt="<?= $row['name'] ?>">
                <h3><?= $row['name'] ?></h3>
                <p>Giá: <?= number_format($row['price'], 0, ',', '.') ?> VND</p>
                <a href="../product_detail.php?id=<?= $row['productId'] ?>" class="btn">Xem chi tiết</a>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>