<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký - Gentlemanor</title>
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>

<body class="h-100">
    <div class="container-fluid h-100">
        <div class="row h-100">

            <div class="col-md-8 p-1 d-flex flex-column justify-content-center align-items-center">
                <div class="logo">
                    <img src="{{ asset('imagePro/image/logo/logo-remove.png') }}" alt="Gentlemanor Logo"
                        class="GentlemanorLogo" />
                </div>
                <div class="custom-form">
                    <h5>Chào mừng bạn đến với GENTLEMANOR</h5>
                    <p class="text-muted mb-4">Vui lòng nhập đầy đủ thông tin để sử dụng.</p>
                    <form class="custom-form-auth" onsubmit="return handleRegister(event)"
                    action="{{ route('register') }}" method="POST">
                        @csrf    
                         <div>
                            <input type="text" class="formControl" name="name" id="name" placeholder="Họ và Tên"
                                onchange="handleChange(event)" required>
                        </div>
                        <div>
                            <input type="email" class="formControl" name="email" id="email" placeholder="Email"
                                onchange="handleChange(event)" required>
                        </div>
                        <div class="password-input-wrapper">
                            <input id="password" class="formControl" type="password" placeholder="Mật khẩu"
                                onchange="handleChange(event)" required>
                            <div class="eye-icon" onclick="togglePasswordVisibility()"></div>
                        </div>
                        <div class="password-input-wrapper">
                            <input id="confirm-password" class="formControl" type="password"
                                placeholder="Xác nhận mật khẩu" onchange="handleChange(event)" required>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="formControl" name="phone" id="phone" placeholder="Số điện thoại"
                                    onchange="handleChange(event)" required>
                            </div>
                            <div class="col">
                                <input type="text" class="formControl" name="address" id="address" placeholder="Địa chỉ"
                                    onchange="handleChange(event)" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Đăng ký</button>
                    </form>
                </div>

                <div>
                    <div class="or-divider">
                        <span>hoặc</span>
                    </div>
                    <div class="d-flex justify-content-center align-items-center mt-3">
                        <img src="{{ asset('imagePro/icon/google-logo.png') }}" alt="Google" class="iconSocial">
                        <img src="{{ asset('imagePro/icon/facebook-logo.png') }}" alt="Facebook" class="iconSocial">
                    </div>
                </div>
                <div class="mt-3 text-center">
                    <p>
                        Bạn đã có tài khoản?
                        <a href="/login" class="register-link">Đăng nhập ngay</a>
                    </p>
                    <p>
                        Quay về
                        <a href="/" class="register-link">trang chủ</a>
                    </p>
                </div>
            </div>

            <div class="col-md-4 p-0">
                <div class="carousel-container position-relative">
                    <div class="carousel-slide">
                        <img src="{{ asset('imagePro/image/login/imageAuth.png') }}" alt="Slide" class="carousel-image">
                        <!-- <div class="carousel-content position-absolute" style="z-index: 5;">
                            <h2 class="carousel-title text-white">Tăng cường tin cậy & minh bạch</h2>
                            <p class="carousel-description text-white">
                                Khi người tiêu dùng có thể xác định nguồn gốc sản phẩm, yên tâm hơn về chất lượng và an
                                toàn thực phẩm,
                                sẵn sàng chi trả mức chi phí cao hơn, góp phần tăng niềm tin vào thương hiệu.
                            </p>
                        </div> -->
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById("password");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }
    </script>
</body>

</html>