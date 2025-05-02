<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sản Phẩm</title>
    <?php include('head.php'); ?>
    <style>
        
        .product-image {
            max-height: 100px;
            max-width: 100px;
            object-fit: contain;
        }
        
        .price {
            font-weight: bold;
            color: #c92127;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <?php include('side_bar.php'); ?>
    
    <!-- Main Content -->
    <div class="main-content">
        <?php include('header.php'); ?>
        
        <!-- Content -->
        <div class="content">
            <div class="page-title">
                <h2>Quản lý Sản Phẩm</h2>
                <ul class="breadcrumb">
                    <li>Trang chủ</li>
                    <li class="active">QL Sản phẩm</li>
                </ul>
            </div>
            
            <!-- Filter Section -->
            <div class="filter-section">
                <form method="GET" action="">
                    <div class="filter-row">
                        <div class="filter-group">
                            <label for="search">Tìm kiếm</label>
                            <input type="text" id="search" name="search" placeholder="Tên sản phẩm, mã SP..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                        </div>
                        <div class="filter-group">
                            <label for="category">Danh mục</label>
                            <select id="category" name="category">
                                <option value="">Tất cả</option>
                                <?php
                                require_once("../connect.php");
                                $categorySql = "SELECT * FROM categories";
                                $categoryResult = mysqli_query($conn, $categorySql);
                                while($category = mysqli_fetch_assoc($categoryResult)) {
                                    $selected = (isset($_GET['category']) && $_GET['category'] == $category['categoryId']) ? 'selected' : '';
                                    echo "<option value='{$category['categoryId']}' $selected>{$category['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="filter-row">
                        <div class="filter-group">
                            <label for="brand">Nhà sản xuất</label>
                            <select id="brand" name="brand">
                                <option value="">Tất cả</option>
                                <?php
                                $brandSql = "SELECT * FROM brands";
                                $brandResult = mysqli_query($conn, $brandSql);
                                while($brand = mysqli_fetch_assoc($brandResult)) {
                                    $selected = (isset($_GET['brand']) && $_GET['brand'] == $brand['brandId']) ? 'selected' : '';
                                    echo "<option value='{$brand['brandId']}' $selected>{$brand['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label for="status">Trạng thái</label>
                            <select id="status" name="status">
                                <option value="">Tất cả</option>
                                <option value="0" <?= (isset($_GET['status']) && $_GET['status'] == '0') ? 'selected' : '' ?>>Đang bán</option>
                                <option value="1" <?= (isset($_GET['status']) && $_GET['status'] == '1') ? 'selected' : '' ?>>Hết hàng</option>
                                <option value="2" <?= (isset($_GET['status']) && $_GET['status'] == '2') ? 'selected' : '' ?>>Dừng bán</option>
                            </select>
                        </div>
                    </div>
                    <div class="filter-row">
                        <div class="filter-group">
                            <label for="min_price">Giá từ</label>
                            <input type="number" id="min_price" name="min_price" placeholder="VNĐ" value="<?= isset($_GET['min_price']) ? htmlspecialchars($_GET['min_price']) : '' ?>">
                        </div>
                        <div class="filter-group">
                            <label for="max_price">Đến</label>
                            <input type="number" id="max_price" name="max_price" placeholder="VNĐ" value="<?= isset($_GET['max_price']) ? htmlspecialchars($_GET['max_price']) : '' ?>">
                        </div>
                    </div>
                    <div class="filter-actions">
                        <button type="button" class="btn btn-secondary" onclick="resetFilters()">Đặt lại</button>
                        <button type="submit" class="btn btn-primary">Áp dụng</button>
                    </div>
                </form>
            </div>
            
            <!-- Add New Product Button -->
            <div class="add-account-btn">
                <button class="btn btn-success" onclick="window.location.href='add_product.php'">
                    <i class="fas fa-plus"></i> Thêm sản phẩm mới
                </button>
                <span class="total-products" style="margin-left: 15px;">
                    <?php
                    $countSql = "SELECT COUNT(*) as total FROM products";
                    $countResult = mysqli_query($conn, $countSql);
                    $totalProducts = mysqli_fetch_assoc($countResult)['total'];
                    echo "Tổng: $totalProducts sản phẩm";
                    ?>
                </span>
            </div>
            
            <!-- Products Table -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Mã SP</th>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Loại SP</th>
                            <th>Nhà SX</th>
                            <th>Đơn giá</th> 
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    // Xây dựng câu truy vấn với bộ lọc
                    $sql = 'SELECT products.*, categories.name as tenDanhMuc, brands.name as tenNSX FROM products 
                            JOIN categories ON products.categoryId = categories.categoryId
                            JOIN brands ON products.brandId = brands.brandId
                            WHERE 1=1';
                    
                    if (isset($_GET['search']) && !empty($_GET['search'])) {
                        $search = mysqli_real_escape_string($conn, $_GET['search']);
                        $sql .= " AND (products.name LIKE '%$search%' OR products.productId LIKE '%$search%')";
                    }
                    
                    if (isset($_GET['category']) && !empty($_GET['category'])) {
                        $category = mysqli_real_escape_string($conn, $_GET['category']);
                        $sql .= " AND products.categoryId = '$category'";
                    }
                    
                    if (isset($_GET['brand']) && !empty($_GET['brand'])) {
                        $brand = mysqli_real_escape_string($conn, $_GET['brand']);
                        $sql .= " AND products.brandId = '$brand'";
                    }
                    if (isset($_GET['status']) && $_GET['status'] !== '') {
                        $status = mysqli_real_escape_string($conn, $_GET['status']);
                        $sql .= " AND products.status = '$status'";
                    }
                    
                    if (isset($_GET['min_price']) && !empty($_GET['min_price'])) {
                        $min_price = mysqli_real_escape_string($conn, $_GET['min_price']);
                        $sql .= " AND products.price >= $min_price";
                    }
                    
                    if (isset($_GET['max_price']) && !empty($_GET['max_price'])) {
                        $max_price = mysqli_real_escape_string($conn, $_GET['max_price']);
                        $sql .= " AND products.price <= $max_price";
                    }
                    
                    // Thêm phân trang
                    $itemsPerPage = 10;
                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $offset = ($page - 1) * $itemsPerPage;
                    
                    // Đếm tổng số bản ghi
                    $countSql = str_replace('SELECT products.*, categories.name as tenDanhMuc, brands.name as tenNSX', 'SELECT COUNT(*) as total', $sql);
                    $countResult = mysqli_query($conn, $countSql);
                    $totalItems = mysqli_fetch_assoc($countResult)['total'];
                    $totalPages = ceil($totalItems / $itemsPerPage);
                    
                    // Thêm phân trang vào câu truy vấn chính
                    $sql .= " LIMIT $offset, $itemsPerPage";
                    $result = mysqli_query($conn, $sql);
                    
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?= $row["productId"] ?></td>
                            <td>
                                <img src="<?= $row["image"] ?>" alt="<?= $row["name"] ?>" class="product-image">
                            </td>
                            <td><?= htmlspecialchars($row["name"]) ?></td>
                            <td><?= htmlspecialchars($row["tenDanhMuc"]) ?></td>
                            <td><?= htmlspecialchars($row["tenNSX"]) ?></td>
                            <td class="price"><?= number_format($row["price"], 0, ',', '.') ?> VNĐ</td>
                            <td>
                                <?php
                                if($row["status"] == 0){
                                    echo '<span class="account-status status-active">Đang bán</span>';
                                }else if($row["status"] == 1){
                                    echo '<span class="account-status status-out-of-stock">Hết hàng</span>';
                                }else if($row["status"] == 2){
                                    echo '<span class="account-status status-inactive">Dừng bán</span>';
                                }else{
                                    echo '<span class="account-status status-inactive">Không xác định</span>';
                                }
                                ?>
                            </td>
                            <td><?= date('d/m/Y', strtotime($row["created_at"])) ?></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn view-btn" title="Xem chi tiết" onclick="viewProduct(<?= $row['productId'] ?>)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn edit-btn" title="Chỉnh sửa" onclick="editProduct(<?= $row['productId'] ?>)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn delete-btn" title="Xóa" onclick="confirmDelete(<?= $row['productId'] ?>)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php
                        }
                    } else {
                    ?>
                        <tr>
                            <td colspan="9" style="text-align: center;">Không tìm thấy sản phẩm nào phù hợp</td>
                        </tr>
                    <?php
                    }
                    mysqli_close($conn);
                    ?>
                    </tbody>
                </table>
                
                <!-- Pagination -->
                <?php if ($totalPages > 1): ?>
                <div class="pagination">
                    <?php if ($page > 1): ?>
                        <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page-1])) ?>">&laquo;</a>
                    <?php endif; ?>
                    
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>" <?= $i == $page ? 'class="active"' : '' ?>>
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                    
                    <?php if ($page < $totalPages): ?>
                        <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page+1])) ?>">&raquo;</a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hàm đặt lại bộ lọc
            window.resetFilters = function() {
                window.location.href = window.location.pathname;
            }
            
            // Hàm xem chi tiết sản phẩm
            window.viewProduct = function(productId) {
                window.location.href = 'product_detail.php?id=' + productId;
            }
            
            // Hàm chỉnh sửa sản phẩm
            window.editProduct = function(productId) {
                window.location.href = 'edit_product.php?id=' + productId;
            }
            
            // Hàm xác nhận xóa sản phẩm
            window.confirmDelete = function(productId) {
                if(confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
                    // Gửi yêu cầu xóa bằng AJAX hoặc chuyển hướng
                    window.location.href = 'delete_product.php?id=' + productId;
                }
            }
        });
    </script>
</body>
</html>