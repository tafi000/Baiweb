<!-- Header -->
<div class="header">
    <div class="header-left">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Tìm kiếm...">
        </div>
    </div>
    <!-- Thay thế phần header-right hiện tại bằng đoạn code này -->
    <div class="header-right">
        <div class="notification-icon">
            <i class="fas fa-bell"></i>
            <div class="notification-badge">3</div>
        </div>
        <div class="user-info dropdown">
            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User">
            <div class="user-details">
                <span class="user-name">Admin <?php echo $welcome_message_admin ?></span>
                <span class="user-role">Quản trị viên</span>
            </div>
            <div class="dropdown-menu">
                <a href="#"><i class="fas fa-user-cog"></i> Tài khoản</a>
                <a href="#"><i class="fas fa-cog"></i> Cài đặt</a>
                <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
            </div>
        </div>
    </div>
</div>
