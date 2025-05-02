<?php
    session_start();
    if(isset($_SESSION['username_user'])) {
        $welcome_message = "Xin chào, " . $_SESSION['username'];
        $login_logout_link = '<a href="logout.php" class="logout-btn"><i class="fa-solid fa-right-from-bracket"></i></a>';
    } else {
        $welcome_message = '<a href="login.php" class="btn__signin">Đăng Nhập</a>';
        $login_logout_link = '';
    }
    
?>
<!DOCTYPE php>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cửa hàng sữa</title>
    <?php include('User/head.php'); ?>
   
    <link rel="stylesheet" href="/BaiCuoiKy_23CT_2/assets/css/User/style.css"> 

    
</head>

<body  style="height: 10000px">
    <?php include 'User/header.php';
     include('connect.php'); // Kết nối cơ sở dữ liệu
    
     // Lấy danh sách sản phẩm
     $sql = "SELECT * FROM products LIMIT 30"; // Lấy 8 sản phẩm đầu tiên
     $result = mysqli_query($conn, $sql);
     ?>
     
    <div class="banner">
        <img src="/BaiCuoiKy_23CT_2/assets/images/backgroundcode.jpg" alt="Banner" alt="Banner" class="banner-image">
    </div>
    <style>
      
    </style>
    
    
    <div class="product-list">
        <h2>Sản phẩm nổi bật</h2>
        <div class="products">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="product-item">
                <img src="Admin/uploads/<?= $row['image'] ?>" alt="<?= $row['name'] ?>">
                    <h3><?= $row['name'] ?></h3>
                    <p>Giá: <?= number_format($row['price'], 0, ',', '.') ?> VND</p>
               
                    <a href="product_detail.php?id=<?= $row['productId'] ?>" class="btn">Xem chi tiết</a>
<form action="cart.php" method="POST" style="display: inline;">
    <input type="hidden" name="productId" value="<?= $row['productId'] ?>">
    <input type="hidden" name="name" value="<?= $row['name'] ?>">
    <input type="hidden" name="price" value="<?= $row['price'] ?>">
    <input type="hidden" name="image" value="<?= $row['image'] ?>">
    <input type="hidden" name="quantity" value="1">
    <button type="submit" class="btn">Đặt hàng</button>
</form>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    
    <style>
       
    </style>
     
</body>

</html>