<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $categoryId = $_POST['categoryId'];
    $brandId = $_POST['brandId'];
    $price = $_POST['price'];
    $promotionPrice = $_POST['promotionPrice'];
    $weight = $_POST['weight'];
    $describe = $_POST['describe'];
    $status = $_POST['status'];

    // Xử lý hình ảnh
    $image = $_FILES['image'];
    $imageName = time() . "_" . basename($image['name']); // Đặt tên file duy nhất
    $imageTmpName = $image['tmp_name'];
    $imageFolder = "../uploads/" . $imageName;

    if (move_uploaded_file($imageTmpName, $imageFolder)) {
        $sql = "INSERT INTO products (name, categoryId, brandId, price, promotionPrice, weight, `describe`, status, image) 
                VALUES ('$name', '$categoryId', '$brandId', '$price', '$promotionPrice', '$weight', '$describe', '$status', '$imageName')";
        if (mysqli_query($conn, $sql)) {
            echo "Thêm sản phẩm thành công!";
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    } else {
        echo "Lỗi khi tải lên hình ảnh.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
</head>
<body>
    <h1>Thêm sản phẩm mới</h1>
    <form action="add_product.php" method="POST">
        <label for="name">Tên sản phẩm:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="categoryId">Danh mục:</label>
        <select id="categoryId" name="categoryId" required>
            <?php
            $categorySql = "SELECT * FROM categories";
            $categoryResult = mysqli_query($conn, $categorySql);
            while ($category = mysqli_fetch_assoc($categoryResult)) {
                echo "<option value='{$category['categoryId']}'>{$category['name']}</option>";
            }
            ?>
        </select><br>

        <label for="brandId">Thương hiệu:</label>
        <select id="brandId" name="brandId" required>
            <?php
            $brandSql = "SELECT * FROM brands";
            $brandResult = mysqli_query($conn, $brandSql);
            while ($brand = mysqli_fetch_assoc($brandResult)) {
                echo "<option value='{$brand['brandId']}'>{$brand['name']}</option>";
            }
            ?>
        </select><br>

        <label for="price">Giá:</label>
        <input type="number" id="price" name="price" required><br>

        <label for="promotionPrice">Giá khuyến mãi:</label>
        <input type="number" id="promotionPrice" name="promotionPrice"><br>

        <label for="weight">Khối lượng:</label>
        <input type="number" id="weight" name="weight" required><br>

        <label for="describe">Mô tả:</label>
        <textarea id="describe" name="describe" required></textarea><br>

        <label for="status">Trạng thái:</label>
        <select id="status" name="status">
            <option value="0">Đang bán</option>
            <option value="1">Hết hàng</option>
            <option value="2">Dừng bán</option>
        </select><br>
        <label for="image">Hình ảnh:</label>
        <input type="file" id="image" name="image" accept="image/*" required><br>

        <button type="submit">Thêm sản phẩm</button>
    </form>
</body>
</html>