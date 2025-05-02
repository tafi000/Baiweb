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
     $limit = 8;
     $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
     $start = ($page - 1) * $limit;
    
     // Lấy danh sách sản phẩm
     $sql = "SELECT * FROM products LIMIT $start,$limit"; 
     $result = mysqli_query($conn, $sql);

    $total_products_query = "SELECT COUNT(*) AS total FROM products";
    $total_products_result = mysqli_query($conn, $total_products_query);
    $total_products_row = mysqli_fetch_assoc($total_products_result);
    $total_products = $total_products_row['total'];

// Tính tổng số trang
$total_pages = ceil($total_products / $limit);
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
    <div class="pagination">
        <?php if($page > 1): ?>
                <a href="?page=<?=$page - 1 ?>" class="btn"></a>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?= $i ?>" class="btn <?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
                <?php endfor; ?>

        <?php if ($page < $total_pages): ?>
                <a href="?page=<?= $page + 1 ?>" class="btn"></a>
                <?php endif; ?>
    </div>

    

     
</body>

</html>