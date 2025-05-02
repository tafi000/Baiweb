<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Hệ Thống Quản Lý Cửa Hàng Sữa</title>
    <?php include('head.php'); ?>
</head>
<body>
    <!-- Sidebar -->
    <?php include('side_bar.php'); ?>
    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <?php include('header.php'); ?>
        <!-- Content -->
        <?php
            require_once("../connect.php");
            $sql = "select * from products";
            $result = mysqli_query($conn,$sql);
            $countProducts = mysqli_num_rows($result);
        ?>
        <div class="content">
            <div class="page-title">
                <h2>Dashboard</h2>
                <ul class="breadcrumb">
                    <li>Trang chủ</li>
                    <li class="active">Dashboard</li>
                </ul>
            </div>

            <!-- Cards -->
            <div class="cards">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Tổng Doanh Thu</div>
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-value">25,840,000đ</div>
                    <div class="card-footer positive">
                        <i class="fas fa-arrow-up"></i> 12% so với tháng trước
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Tổng Đơn Hàng</div>
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="card-value">1,248</div>
                    <div class="card-footer positive">
                        <i class="fas fa-arrow-up"></i> 8% so với tháng trước
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Sản Phẩm</div>
                        <i class="fas fa-box-open"></i>
                    </div>
                    <div class="card-value"><?php echo $countProducts; ?></div>
                    <div class="card-footer positive">
                        <i class="fas fa-arrow-up"></i> 3 sản phẩm mới
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Khách Hàng</div>
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-value">2,156</div>
                    <div class="card-footer negative">
                        <i class="fas fa-arrow-down"></i> 2% so với tháng trước
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="charts">
                <div class="chart-container">
                    <div class="chart-header">
                        <div class="chart-title">Doanh Thu Theo Tháng</div>
                        <div class="chart-period">
                            <select>
                                <option>Năm 2023</option>
                                <option>Năm 2022</option>
                                <option>Năm 2021</option>
                            </select>
                        </div>
                    </div>
                    <div style="height: 300px; background-color: #f9f9f9; display: flex; align-items: center; justify-content: center;">
                        <p>Biểu đồ doanh thu sẽ được hiển thị tại đây</p>
                    </div>
                </div>
                <div class="chart-container">
                    <div class="chart-header">
                        <div class="chart-title">Loại Sản Phẩm Bán Chạy</div>
                    </div>
                    <div style="height: 300px; background-color: #f9f9f9; display: flex; align-items: center; justify-content: center;">
                        <p>Biểu đồ loại sản phẩm sẽ được hiển thị tại đây</p>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="table-container">
                <div class="table-header">
                    <div class="table-title">Đơn Hàng Gần Đây</div>
                    <button class="action-btn view-btn">Xem Tất Cả</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Mã ĐH</th>
                            <th>Khách Hàng</th>
                            <th>Ngày Đặt</th>
                            <th>Tổng Tiền</th>
                            <th>Trạng Thái</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#DH00123</td>
                            <td>Nguyễn Văn A</td>
                            <td>15/06/2023</td>
                            <td>450,000đ</td>
                            <td><span class="status active">Đã giao</span></td>
                            <td>
                                <button class="action-btn view-btn">Xem</button>
                                <button class="action-btn edit-btn">Sửa</button>
                            </td>
                        </tr>
                        <tr>
                            <td>#DH00122</td>
                            <td>Trần Thị B</td>
                            <td>14/06/2023</td>
                            <td>320,000đ</td>
                            <td><span class="status pending">Đang giao</span></td>
                            <td>
                                <button class="action-btn view-btn">Xem</button>
                                <button class="action-btn edit-btn">Sửa</button>
                            </td>
                        </tr>
                        <tr>
                            <td>#DH00121</td>
                            <td>Lê Văn C</td>
                            <td>14/06/2023</td>
                            <td>780,000đ</td>
                            <td><span class="status active">Đã giao</span></td>
                            <td>
                                <button class="action-btn view-btn">Xem</button>
                                <button class="action-btn edit-btn">Sửa</button>
                            </td>
                        </tr>
                        <tr>
                            <td>#DH00120</td>
                            <td>Phạm Thị D</td>
                            <td>13/06/2023</td>
                            <td>1,250,000đ</td>
                            <td><span class="status inactive">Đã hủy</span></td>
                            <td>
                                <button class="action-btn view-btn">Xem</button>
                                <button class="action-btn edit-btn">Sửa</button>
                            </td>
                        </tr>
                        <tr>
                            <td>#DH00119</td>
                            <td>Hoàng Văn E</td>
                            <td>12/06/2023</td>
                            <td>560,000đ</td>
                            <td><span class="status active">Đã giao</span></td>
                            <td>
                                <button class="action-btn view-btn">Xem</button>
                                <button class="action-btn edit-btn">Sửa</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Recent Activities -->
            <div class="table-container">
                <div class="table-header">
                    <div class="table-title">Hoạt Động Gần Đây</div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="activity-details">
                        <div class="activity-title">Đơn hàng mới #DH00123</div>
                        <div class="activity-time">10 phút trước</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="activity-details">
                        <div class="activity-title">Khách hàng mới: Nguyễn Thị F</div>
                        <div class="activity-time">1 giờ trước</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="activity-details">
                        <div class="activity-title">Sản phẩm mới: Sữa tươi Vinamilk 100%</div>
                        <div class="activity-time">3 giờ trước</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-truck"></i>
                    </div>
                    <div class="activity-details">
                        <div class="activity-title">Đơn hàng #DH00120 đã giao thành công</div>
                        <div class="activity-time">5 giờ trước</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>