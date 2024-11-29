<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Gentlemanor</title>
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
                    <h5>Chào mừng bạn trở lại với GENTLEMANOR</h5>
                    <p class="text-muted mb-4">Vui lòng đăng nhập để tiếp tục sử dụng dịch vụ.</p>
                    <form class="custom-form-auth" onsubmit="return handleLogin(event)">
                        <div>
                            <input type="email" class="formControl" id="email" placeholder="Email"
                                onchange="handleChange(event)" required>
                        </div>
                        <div class="password-input-wrapper">
                            <input id="password" class="formControl" type="password" placeholder="Mật khẩu"
                                onchange="handleChange(event)" required>
                            <div class="eye-icon" onclick="togglePasswordVisibility()"></div>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Đăng nhập</button>
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
                        Bạn chưa có tài khoản?
                        <a href="/register" class="register-link">Đăng ký ngay</a>
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
                        <img src="{{ asset('imagePro/image/login/imageAuthLogin.png') }}" alt="Slide"
                            class="carousel-image">
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