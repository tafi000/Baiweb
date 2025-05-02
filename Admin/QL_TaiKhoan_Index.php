<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý tài khoản</title>
    <?php include('head.php'); ?>
    <style>
        
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
                <h2>Quản lý tài khoản</h2>
                <ul class="breadcrumb">
                    <li>Trang chủ</li>
                    <li class="active">QL Tài khoản</li>
                </ul>
            </div>
            
            <!-- Filter Section -->
            <div class="filter-section">
                <div class="filter-row">
                    <div class="filter-group">
                        <label for="search">Tìm kiếm</label>
                        <input type="text" id="search" placeholder="Tên, email hoặc số điện thoại...">
                    </div>
                    <div class="filter-group">
                        <label for="role">Vai trò</label>
                        <select id="role">
                            <option value="">Tất cả</option>
                            <option value="admin">Quản trị viên</option>
                            <option value="staff">Nhân viên</option>
                            <option value="customer">Khách hàng</option>
                        </select>
                    </div>
                </div>
                <div class="filter-row">
                    <div class="filter-group">
                        <label for="status">Trạng thái</label>
                        <select id="status">
                            <option value="">Tất cả</option>
                            <option value="active">Hoạt động</option>
                            <option value="inactive">Không hoạt động</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="date">Ngày tạo</label>
                        <input type="date" id="date">
                    </div>
                </div>
                <div class="filter-actions">
                    <button class="btn btn-secondary">Đặt lại</button>
                    <button class="btn btn-primary">Áp dụng</button>
                </div>
            </div>
            
            <!-- Add New Account Button -->
            <div class="add-account-btn">
                <button class="btn btn-success">
                    <i class="fas fa-plus"></i> Thêm tài khoản mới
                </button>
            </div>
            
            <!-- Accounts Table -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID TK</th>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Vai trò</th>
                            <!--0 là hoạt động, 1 là không hoạt động -->
                            <th>Trạng thái</th> 
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        require_once("../connect.php");

                        // Xử lý các tham số lọc
                        $search = isset($_GET['search']) ? $_GET['search'] : '';
                        $role = isset($_GET['role']) ? $_GET['role'] : '';
                        $status = isset($_GET['status']) ? $_GET['status'] : '';
                        $date = isset($_GET['date']) ? $_GET['date'] : '';

                        // Xây dựng câu truy vấn SQL với các điều kiện lọc
                        $sql = "SELECT * FROM users WHERE 1=1";

                        if (!empty($search)) {
                            $sql .= " AND (name LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%')";
                        }

                        if (!empty($role)) {
                            if ($role == 'admin') {
                                $sql .= " AND role = 1";
                            } elseif ($role == 'staff') {
                                $sql .= " AND role = 2";
                            } elseif ($role == 'customer') {
                                $sql .= " AND role = 0";
                            }
                        }

                        if (!empty($status)) {
                            if ($status == 'active') {
                                $sql .= " AND status = 0";
                            } elseif ($status == 'inactive') {
                                $sql .= " AND status = 1";
                            }
                        }

                        if (!empty($date)) {
                            $sql .= " AND DATE(created_at) = '$date'";
                        }

                        $result = mysqli_query($conn, $sql);
                        ?>
                        <?php
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td>
                                <?php
                                    echo $row["userId"];
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo $row["name"];
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo $row["email"];
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo $row["phone"];
                                ?>
                            </td>
                            <td>
                                <?php
                                    if($row["role"] == 1){
                                        echo "Quản trị viên";
                                    }else if($row["role"] == 2){
                                        echo "Nhân viên";
                                    }else{
                                        echo "Khách hàng";
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if($row["status"] == 1){
                                        echo '<span class="account-status status-inactive">Không hoạt động</span>';
                                    }else{
                                        echo '<span class="account-status status-active">Hoạt động</span>';
                                    }   
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo $row["created_at"];
                                ?>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn view-btn" title="Xem chi tiết">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn edit-btn" title="Chỉnh sửa">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn delete-btn" title="Xóa">
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
                                <td colspan="8" style="text-align: center;">Không tìm thấy tài khoản nào phù hợp</td>
                            </tr>
                        <?php
                        }
                        mysqli_close($conn);
                        ?>
                    </tbody>
                </table>
                
                <!-- Pagination -->
                <div class="pagination">
                    <a href="#">&laquo;</a>
                    <a href="#" class="active">1</a>
                    <a href="#">&raquo;</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Add/Edit Account (hidden by default) -->
    <div id="accountModal" class="modal" style="display:none;">
        <!-- Modal content would go here -->
    </div>

    <script>
        // JavaScript for handling actions would go here
        document.addEventListener('DOMContentLoaded', function() {
            // Xử lý sự kiện cho các nút hành động
            document.querySelectorAll('.view-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    alert('Xem chi tiết tài khoản');
                });
            });
            
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    alert('Chỉnh sửa tài khoản');
                });
            });
            
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    if(confirm('Bạn có chắc chắn muốn xóa tài khoản này?')) {
                        alert('Đã xóa tài khoản');
                    }
                });
            });
            
            // Xử lý nút thêm mới
            document.querySelector('.btn-success').addEventListener('click', function() {
                alert('Mở form thêm tài khoản mới');
            });
            document.querySelector('.btn-primary').addEventListener('click', function() {
                applyFilters();
            });
            
            // Xử lý nút Đặt lại bộ lọc
            document.querySelector('.btn-secondary').addEventListener('click', function() {
                resetFilters();
            });
            
            // Hàm áp dụng bộ lọc
            function applyFilters() {
                const search = document.getElementById('search').value;
                const role = document.getElementById('role').value;
                const status = document.getElementById('status').value;
                const date = document.getElementById('date').value;
                
                // Tạo URL với các tham số lọc
                let url = window.location.pathname + '?';
                if (search) url += `search=${encodeURIComponent(search)}&`;
                if (role) url += `role=${role}&`;
                if (status) url += `status=${status}&`;
                if (date) url += `date=${date}&`;
                
                // Tải lại trang với các tham số lọc
                window.location.href = url;
            }
            
            // Hàm đặt lại bộ lọc
            function resetFilters() {
                document.getElementById('search').value = '';
                document.getElementById('role').value = '';
                document.getElementById('status').value = '';
                document.getElementById('date').value = '';
                
                // Tải lại trang không có tham số lọc
                window.location.href = window.location.pathname;
            }
        });
    </script>
</body>
</html>