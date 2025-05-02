<?php
    require_once("connect.php");
    if(isset($_POST["btn-dangky"]))
    {
        $tk = $_POST["User-dangky"];
        $HoTen = $_POST["Hoten-dangky"];
        $Email = $_POST["Email-dangky"];
        $pass = md5($_POST['Pass-dangky']);
        $check_email_query = "select * from users where email='$Email'";
        $check_email_result = mysqli_query($conn, $check_email_query);
        if(mysqli_num_rows($check_email_result) > 0) {
            echo "<script>alert('Email đã tồn tại trên hệ thống');</script>";
        }else{
            $sql = "insert into users(email,name, username, password)
                    values('$Email','$HoTen', '$tk','$pass')";
            $result = mysqli_query($conn, $sql);
            if($result) {
                mysqli_close($conn);
                echo "<script language='javascript'>alert('Đăng ký thành công');";
                echo "location.href='login.php';</script>";
            }
            else{
                echo "Đăng ký thất bại: " . mysqli_error($conn);
                mysqli_close($conn);
            }
        }
    }
    // $sql = "select * from manage_brand";
    // $result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Tài Khoản</title>
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

        .register-container {
            display: flex;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .register-card {
            display: flex;
            width: 900px;
            background: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            position: relative;
        }

        .register-illustration {
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

        .register-illustration::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -100px;
            right: -100px;
        }

        .register-illustration::after {
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
            font-size: 1rem;
            opacity: 0.9;
            text-align: center;
            max-width: 80%;
        }

        .register-form-container {
            flex: 1;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .register-header {
            margin-bottom: 2.5rem;
            text-align: center;
        }

        .register-title {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .register-subtitle {
            color: #6c757d;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
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

        .btn-register {
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

        .btn-register:hover {
            background: linear-gradient(to right, var(--secondary-color), var(--primary-color));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }

        .register-footer {
            text-align: center;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .login-link {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
        }

        .login-link:hover {
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
            .register-card {
                flex-direction: column;
                width: 100%;
            }

            .register-illustration {
                padding: 2rem 1rem;
            }

            .illustration-img {
                max-width: 250px;
            }

            .register-form-container {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>

<body>
    <?php include "User/header.php"; ?>
    
    <main>
        <div class="register-container">
            <div class="register-card">
                <!-- Phần hình ảnh minh họa -->
                <div class="register-illustration">
                    <img src="https://cdni.iconscout.com/illustration/premium/thumb/login-3305943-2757111.png" alt="Register Illustration" class="illustration-img">
                    <h2 class="illustration-title">Chào mừng bạn!</h2>
                    <p class="illustration-text">Đăng ký tài khoản để bắt đầu trải nghiệm dịch vụ của chúng tôi</p>
                </div>

                <!-- Phần form đăng ký -->
                <div class="register-form-container">
                    <div class="register-header">
                        <h1 class="register-title">ĐĂNG KÝ TÀI KHOẢN</h1>
                        <p class="register-subtitle">Vui lòng nhập thông tin để tạo tài khoản</p>
                    </div>

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off" id="register-form">
                        <div class="form-group">
                            <label for="Hoten-dangky" class="form-label">Họ và tên</label>
                            <div class="input-group">
                                <i class="fas fa-user input-icon"></i>
                                <input type="text" id="Hoten-dangky" name="Hoten-dangky" class="form-control" placeholder="Nhập họ và tên" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Email-dangky" class="form-label">Email</label>
                            <div class="input-group">
                                <i class="fas fa-envelope input-icon"></i>
                                <input type="email" id="Email-dangky" name="Email-dangky" class="form-control" placeholder="Nhập email" required>
                            </div>
                            <p class="error-message">Vui lòng nhập email hợp lệ</p>
                        </div>

                        <div class="form-group">
                            <label for="User-dangky" class="form-label">Tên đăng nhập</label>
                            <div class="input-group">
                                <i class="fas fa-id-card input-icon"></i>
                                <input type="text" id="User-dangky" name="User-dangky" class="form-control" placeholder="Nhập tên đăng nhập" required>
                            </div>
                            <p class="error-message">Tên đăng nhập phải có ít nhất 4 ký tự</p>
                        </div>

                        <div class="form-group">
                            <label for="Pass-dangky" class="form-label">Mật khẩu</label>
                            <div class="input-group">
                                <i class="fas fa-lock input-icon"></i>
                                <input type="password" id="Pass-dangky" name="Pass-dangky" class="form-control" placeholder="Nhập mật khẩu" required minlength="6">
                                <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                            </div>
                            <p class="error-message">Mật khẩu phải có ít nhất 6 ký tự</p>
                        </div>

                        <button type="submit" class="btn-register" name="btn-dangky">Đăng ký</button>

                        <?php if(isset($txt_error) && ($txt_error!="")): ?>
                            <div style="color: var(--error-color); text-align: center; margin-bottom: 1rem;">
                                <?php echo $txt_error; ?>
                            </div>
                        <?php endif; ?>
                    </form>

                    <div class="register-footer">
                        <p>Đã có tài khoản? <a href="login.php" class="login-link">Đăng nhập ngay</a></p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Hiển thị/ẩn mật khẩu
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#Pass-dangky');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });

        // Validate form
        const formGroups = document.querySelectorAll('.form-group');
        const inputs = document.querySelectorAll('.form-control');
        const registerForm = document.getElementById('register-form');

        inputs.forEach(input => {
            input.addEventListener('input', () => {
                const formGroup = input.closest('.form-group');
                
                if (input.id === 'Email-dangky') {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(input.value)) {
                        formGroup.classList.add('invalid');
                    } else {
                        formGroup.classList.remove('invalid');
                    }
                } 
                else if (input.id === 'User-dangky') {
                    if (input.value.trim() === '' || input.value.length < 4) {
                        formGroup.classList.add('invalid');
                    } else {
                        formGroup.classList.remove('invalid');
                    }
                }
                else if (input.id === 'Pass-dangky') {
                    if (input.value.trim() === '' || input.value.length < 6) {
                        formGroup.classList.add('invalid');
                    } else {
                        formGroup.classList.remove('invalid');
                    }
                }
                else {
                    if (input.value.trim() === '') {
                        formGroup.classList.add('invalid');
                    } else {
                        formGroup.classList.remove('invalid');
                    }
                }
            });
        });

        // Form submission
        registerForm.addEventListener('submit', function(e) {
            let isValid = true;
            
            inputs.forEach(input => {
                const formGroup = input.closest('.form-group');
                
                if (input.id === 'Email-dangky') {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(input.value)) {
                        formGroup.classList.add('invalid');
                        isValid = false;
                    }
                } 
                else if (input.id === 'User-dangky') {
                    if (input.value.trim() === '' || input.value.length < 4) {
                        formGroup.classList.add('invalid');
                        isValid = false;
                    }
                }
                else if (input.id === 'Pass-dangky') {
                    if (input.value.trim() === '' || input.value.length < 6) {
                        formGroup.classList.add('invalid');
                        isValid = false;
                    }
                }
                else if (input.value.trim() === '') {
                    formGroup.classList.add('invalid');
                    isValid = false;
                }
            });
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    </script>
</body>

</html>