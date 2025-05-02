<?php
session_start();
ob_start();
include "connect.php";
include "./Admin/user.php";

if(!defined('BASE_URL')) {
    define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/BaiCuoiKy_23CT_2/');
}

if((isset($_POST['dangnhap'])) && ($_POST['dangnhap'])) {
    $user = $_POST['user'];
    $pass = md5($_POST['pass']);
    
    // Kiểm tra thông tin đăng nhập và lấy thông tin user
    $query = "SELECT name, status FROM users WHERE username='$user'";
    $result = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        // Kiểm tra trạng thái tài khoản TRƯỚC khi xác thực
        if($row['status'] == 1) {
            $_SESSION['error'] = "Tài khoản của bạn đã bị khóa! Vui lòng liên hệ với quản trị viên.";
            header('location: ' . BASE_URL . 'login.php');
            exit();
        }
        
        // Nếu tài khoản không bị khóa, tiếp tục xác thực
        $role = checkuser($user, $pass);
        
        if($role == 1) {
            $_SESSION['username_admin'] = $user;
            $_SESSION['username_ten'] = $row['name'];
            header('location: Admin/index.php');
            exit();
        } else if($role == 0) {
            $_SESSION['username_user'] = $user;
            $_SESSION['username'] = $row['name'];
            header('location: ' . BASE_URL . 'index.php');
            exit();
        } else {
            $_SESSION['error'] = "Tài khoản hoặc mật khẩu không đúng!";
            header('location: ' . BASE_URL . 'login.php');
            exit();
        }
    } else {
        $_SESSION['error'] = "Tài khoản không tồn tại!";
        header('location: ' . BASE_URL . 'login.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập Hệ Thống</title>
    <?php include "./User/head.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --success-color: #4cc9f0;
            --error-color: #f72585;
            --border-radius: 8px;
            --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7ff;
            color: var(--dark-color);
            line-height: 1.6;
        }

        .login-container {
            display: flex;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .login-card {
            display: flex;
            width: 900px;
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            position: relative;
        }

        .login-illustration {
            flex: 1;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .login-illustration::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -100px;
            right: -100px;
        }

        .login-illustration::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            bottom: -50px;
            left: -50px;
        }

        .illustration-img {
            width: 100%;
            max-width: 350px;
            margin-bottom: 2rem;
        }

        .illustration-title {
            font-size: 1.8rem;
            margin-bottom: 1rem;
            font-weight: 600;
            text-align: center;
        }

        .illustration-text {
            font-size: 1.4rem;
            opacity: 0.9;
            text-align: center;
            max-width: 80%;
        }

        .login-form-container {
            flex: 1;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-header {
            margin-bottom: 2.5rem;
            text-align: center;
        }

        .login-title {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .login-subtitle {
            color: #6c757d;
            font-size: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            font-size: 1.5rem;
            color: var(--dark-color);
        }

        .input-group {
            position: relative;
            display: flex;
            align-items: center;
        }

        .form-control {
            width: 100%;
            padding: 0.8rem 1rem 0.8rem 3rem;
            border: 1px solid #ced4da;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
            background-color: var(--light-color);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            color: #6c757d;
            font-size: 1rem;
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            cursor: pointer;
            color: #6c757d;
            font-size: 1rem;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-right: 1rem;
            accent-color: var(--primary-color);
        }

        .forgot-password a {
            color: var(--primary-color);
            text-decoration: none;
            transition: var(--transition);
            font-size: 1.5rem;
        }

        .forgot-password a:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            padding: 0.8rem;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: var(--border-radius);
            color: white;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            margin-bottom: 1.5rem;
        }

        .btn-login:hover {
            background: linear-gradient(to right, var(--secondary-color), var(--primary-color));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }

        .login-footer {
            text-align: center;
            font-size: 1.3rem;
            color: #6c757d;
        }

        .register-link {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
        }

        .register-link:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        .error-message {
            color: var(--error-color);
            font-size: 0.9rem;
            margin-top: 0.5rem;
            display: none;
        }

        .form-group.invalid .error-message {
            display: block;
        }

        .form-group.invalid .form-control {
            border-color: var(--error-color);
        }

        .form-group.invalid .input-icon {
            color: var(--error-color);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-card {
                flex-direction: column;
                width: 100%;
            }

            .login-illustration {
                padding: 2rem 1rem;
            }

            .illustration-img {
                max-width: 250px;
            }

            .login-form-container {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>

<body>
    <?php include "User/header.php"; ?>
    <main>
        <div class="login-container">
            <div class="login-card">
                <!-- Phần hình ảnh minh họa -->
                <div class="login-illustration">
                    <img src="https://cdni.iconscout.com/illustration/premium/thumb/login-3305943-2757111.png" alt="Login Illustration" class="illustration-img">
                    <h2 class="illustration-title">Chào mừng trở lại!</h2>
                    <p class="illustration-text">Đăng nhập để truy cập vào hệ thống và quản lý tài khoản của bạn</p>
                </div>
                <!-- Phần form đăng nhập -->
                <div class="login-form-container">
                    <?php
                        if(isset($_SESSION['error'])) {
                            echo '<div class="alert alert-danger" style="color: red; background: #ffeeee; padding: 10px; border-radius: 5px; margin-bottom: 20px; text-align: center;">' 
                                . $_SESSION['error'] . '</div>';
                            unset($_SESSION['error']);
                        }
                    ?>
                    <div class="login-header">
                        <h1 class="login-title">ĐĂNG NHẬP</h1>
                        <p class="login-subtitle">Vui lòng nhập thông tin tài khoản của bạn</p>
                    </div>

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="form-label">Tên đăng nhập</label>
                            <div class="input-group">
                                <i class="fas fa-user input-icon"></i>
                                <input type="text" id="username" name="user" class="form-control" placeholder="Nhập tên đăng nhập" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <div class="input-group">
                                <i class="fas fa-lock input-icon"></i>
                                <input type="password" id="password" name="pass" class="form-control" placeholder="Nhập mật khẩu" required minlength="4">
                                <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                            </div>
                            <p class="error-message">Mật khẩu phải có ít nhất 4 ký tự</p>
                        </div>

                        <div class="form-options">
                            <div class="remember-me">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember" style="font-size: 1.5rem">Ghi nhớ đăng nhập</label>
                            </div>
                            <div class="forgot-password">
                                <a href="forget_password.php">Quên mật khẩu?</a>
                            </div>
                        </div>

                        <div class="btn submit_btn">
                                <input type="submit" value="Đăng Nhập" name="dangnhap" class="btn-login">
                            </div>
                            <?php
                            if(isset($txt_error) && ($txt_error!="")){
                                echo "<font color='red'>".$txt_error."</font>";
                            }
                        ?>
                    </form>

                    <div class="login-footer">
                        <p>Chưa có tài khoản? <a href="./register.php" class="register-link">Đăng ký ngay</a></p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Hiển thị/ẩn mật khẩu
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#pass');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });

        // Validate form
        const formGroups = document.querySelectorAll('.form-group');
        const inputs = document.querySelectorAll('.form-control');

        inputs.forEach(input => {
            input.addEventListener('input', () => {
                const formGroup = input.closest('.form-group');
                if (input.value.trim() === '' || (input.type === 'password' && input.value.length < 4)) {
                    formGroup.classList.add('invalid');
                } else {
                    formGroup.classList.remove('invalid');
                }
            });
        });
    </script>
</body>

</html>