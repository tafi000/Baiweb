<?php
session_start(); // Bắt đầu session để truy cập giỏ hàng
$totalQuantity = 0; // Biến lưu tổng số lượng sản phẩm
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $totalQuantity += $item['quantity'];
    }
    $totalPrice = 0;
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $totalPrice += $item['price'] * $item['quantity'];
    }
}
}
?>
<header class="header fixed dashboard">
  <div class="main-content">
    <div class="header-container">
      <!-- Logo và nút menu mobile -->
      <div class="header-left">
        <label class="toggle-menu">
          <input type="checkbox" id="check-toggle" />
          <span class="menu-icon"><i class="fa-solid fa-bars"></i></span>
        </label>
        <a href="index.php" class="logo-link">
          <img src="./assets/images/logo.png" alt="Logo" class="logo" />
        </a>
      </div>

      <!-- Menu chính -->
      <nav class="main-nav">
        <ul class="nav-list">
          <li class="nav-item active">
            <a href="index.php" class="nav-link">
              <i class="fa-solid fa-house nav-icon"></i>
              <span>Trang Chủ</span>
            </a>
          </li>

          <li class="nav-item dropdown">
            <a href="./php/info_brand.php" class="nav-link">
              <i class="fa-solid fa-tags nav-icon"></i>
              <span>Thương Hiệu</span>
              <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
            </a>
            <div class="dropdown-menu brand-dropdown">
              <div class="dropdown-content">
                <div class="brand-grid">
                  <div class="brand-card">
                    <a href="https://www.vinamilk.com.vn/vi" class="brand-link">
                      <img
                        src="./assets/images/brand_vinamilk.png"
                        alt="Vinamilk"
                        class="brand-logo"
                      />
                      <div class="brand-info">
                        <h3 class="brand-name">Vinamilk</h3>
                        <p class="brand-slogan">"Vươn cao Việt Nam"</p>
                        <div class="brand-badge">
                          <i class="fa-solid fa-trophy"></i>
                          <span>Top 1 Việt Nam</span>
                        </div>
                      </div>
                    </a>
                  </div>
                  <!-- Các thương hiệu khác tương tự -->
                </div>
              </div>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a href="./php/all_product.php" class="nav-link">
              <i class="fa-solid fa-bottle-water nav-icon"></i>
              <span>Sản phẩm</span>
              <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
            </a>
            <div class="dropdown-menu">
              <div class="dropdown-content">
                <div class="menu-columns">
                  <div class="menu-column">
                    <h4 class="menu-category">Danh mục</h4>
                    <ul class="submenu-list">
                      <li>
                        <a href="./php/all_product.php"
                          ><i class="fa-solid fa-list"></i> Tất cả sản phẩm</a
                        >
                      </li>
                      <li>
                        <a href="#"><i class="fa-solid fa-box"></i> Sữa bột</a>
                      </li>
                      <li>
                        <a href="#"><i class="fa-solid fa-cube"></i> Sữa hộp</a>
                      </li>
                      <li>
                        <a href="#"
                          ><i class="fa-solid fa-blender"></i> Sữa chua</a
                        >
                      </li>
                      <li>
                        <a href="#"><i class="fa-solid fa-star"></i> Sữa non</a>
                      </li>
                      <li>
                        <a href="#"
                          ><i class="fa-solid fa-temperature-high"></i> Sữa tươi
                          tiệt trùng</a
                        >
                      </li>
                    </ul>
                  </div>
                  <div class="menu-column">
                    <h4 class="menu-category">Sản phẩm nổi bật</h4>
                    <div class="featured-products">
                      <!-- Các sản phẩm nổi bật -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </li>

          <li class="nav-item">
            <a href="./php/news.php" class="nav-link">
              <i class="fa-solid fa-newspaper nav-icon"></i>
              <span>Tin Tức</span>
            </a>
          </li>

          <li class="nav-item">
          <a href="/BaiCuoiKy_23CT_2/contact.php" class="nav-link">
              <i class="fa-solid fa-address-book nav-icon"></i>
              <span>Liên Hệ</span>
            </a>
          </li>
        </ul>
      </nav>

      <!-- Phần tác vụ người dùng -->
      <div class="header-actions">
        <div class="user-section">
          <?php if(isset($welcome_message) && ($welcome_message!="")): ?>
          <div class="welcome-message">
            <span><?php echo $welcome_message; ?></span>
            <?php echo $login_logout_link; ?>
          </div>
          <?php endif; ?>
        </div>

        <div class="cart-section">
          <div class="cart-icon" id="cart-toggle">
            <i class="fa-solid fa-cart-shopping"></i>
            <span class="cart-count"><?= $totalQuantity ?></span>
          </div>
          <div class="cart-dropdown">
            <div class="cart-header">
              <h3>Giỏ hàng của bạn</h3>
              <a href="/BaiCuoiKy_23CT_2/cart.php" class="view-all">Xem tất cả</a>
            </div>
            <div class="cart-items">
              <!-- Sản phẩm trong giỏ hàng -->
            </div>
            <div class="cart-footer">
            <div class="cart-total">
    <p>Tổng cộng: <span style="color: blue;"><?= number_format($totalPrice, 0, ',', '.') ?>đ</span></p>
</div>
            
              <a href="./php/checkout.php" class="checkout-btn">Thanh toán</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
