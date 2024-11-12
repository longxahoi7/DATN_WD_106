import React, { useState } from "react";
import "../../../style/auth.css";
import { useNavigate } from "react-router-dom";
import api from "../../../config/axios";

const Login: React.FC = () => {
    const navigate = useNavigate();
    const [remember, setRemember] = useState(false); // Thêm state để theo dõi trạng thái checkbox
    const [loading, setLoading] = useState(false);
    const [formData, setFormData] = useState({
        email: "",
        password: "",
    });
    const [errors, setErrors] = useState({
        email: "",
        password: "",
        general: "",
    });

    const validateInput = (id: string, value: string) => {
        let errorMessage = "";

        if (id === "email" && value.trim() === "") {
            errorMessage = "Email không được để trống.";
        } else if (
            id === "email" &&
            !/^[\w-.]+@([\w-]+\.)+[\w-]{2,4}$/.test(value)
        ) {
            errorMessage = "Email không hợp lệ.";
        }

        if (id === "password" && value.length < 6) {
            errorMessage = "Mật khẩu phải có ít nhất 6 ký tự.";
        }

        setErrors((prevErrors) => ({
            ...prevErrors,
            [id]: errorMessage,
        }));
    };

    const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        const { id, value } = e.target;
        setFormData({ ...formData, [id]: value });
        validateInput(id, value);
    };

    const handleLogin = async (e: React.FormEvent) => {
        setLoading(true);
        e.preventDefault();

        if (!isFormValid()) {
            setLoading(false);
            return;
        }

        try {
            const response = await api.post("login", {
                email: formData.email,
                password: formData.password,
            });

            if (response.status === 200 && response.data.token) {
                if (remember) {
                    localStorage.setItem("token", response.data.token); // Lưu token vào localStorage nếu chọn "Ghi nhớ"
                } else {
                    sessionStorage.setItem("token", response.data.token); // Nếu không, lưu token vào sessionStorage
                }

                alert("Đăng nhập thành công!");
                navigate("/"); // Chuyển hướng đến trang chủ
            }
        } catch (error: any) {
            setErrors({
                ...errors,
                general: "Đăng nhập thất bại. Vui lòng thử lại.",
            });
        } finally {
            setLoading(false);
        }
    };

    const isFormValid = () => {
        return (
            /^[\w-.]+@([\w-]+\.)+[\w-]{2,4}$/.test(formData.email) &&
            formData.password.length >= 6
        );
    };

    return (
        <div className="container-fluid h-100">
            <div className="row h-100">
                <div className="col-md-8 p-3 flex-column justify-content-center align-items-center">
                    <div className="logo mb-4">
                        <img
                            src="/image/logo/logo-remove.png"
                            alt="Gentlemanor Logo"
                            style={{ width: 100 }}
                        />
                    </div>
                    <div className="custom-form">
                        <h5>Chào mừng bạn đến với GENTLEMANOR</h5>
                        <p className="text-muted mb-4">
                            Vui lòng nhập đầy đủ thông tin để sử dụng.
                        </p>
                        <form onSubmit={handleLogin}>
                            <div>
                                <input
                                    type="text"
                                    className={`form-control ${
                                        errors.email ? "is-invalid" : ""
                                    }`}
                                    id="email"
                                    placeholder="Email"
                                    value={formData.email}
                                    onChange={handleChange}
                                    required
                                    autoComplete="username"
                                />
                            </div>
                            <div>
                                <input
                                    type="password"
                                    className={`form-control ${
                                        errors.password ? "is-invalid" : ""
                                    }`}
                                    id="password"
                                    placeholder="Mật khẩu"
                                    value={formData.password}
                                    onChange={handleChange}
                                    required
                                    autoComplete="current-password"
                                />
                            </div>
                            <div
                                className="form-check mb-3"
                                style={{ textAlign: "left" }}
                            >
                                <input
                                    type="checkbox"
                                    className="form-check-input"
                                    id="remember"
                                    checked={remember}
                                    onChange={(e) =>
                                        setRemember(e.target.checked)
                                    }
                                />
                                <label
                                    className="form-check-label"
                                    htmlFor="remember"
                                >
                                    Ghi nhớ
                                </label>
                            </div>
                            <button
                                type="submit"
                                className="btn btn-success"
                                style={{
                                    backgroundColor: "#0f6d5e",
                                    width: "70%",
                                }}
                                disabled={!isFormValid() || loading}
                            >
                                {loading ? "Đang đăng nhập..." : "Đăng nhập"}
                            </button>
                        </form>

                        {errors.general && (
                            <div
                                className="alert alert-danger mt-3"
                                role="alert"
                            >
                                {errors.general}
                            </div>
                        )}
                    </div>
                    <div className="mt-4">
                        <div className="or-divider">
                            <span>hoặc</span>
                        </div>
                        <div className="d-flex justify-content-center mt-3">
                            <img
                                src="/icon/google-logo.png"
                                alt="Google"
                                className="mx-2"
                                style={{ width: 30, height: 30 }}
                            />
                            <img
                                src="/icon/facebook-logo.png"
                                alt="Facebook"
                                className="mx-2"
                                style={{ width: 30, height: 30 }}
                            />
                        </div>
                    </div>
                    <div className="mt-3 text-center">
                        <p>
                            Bạn chưa có tài khoản?{" "}
                            <a href="/register" className="register-link">
                                Đăng ký ngay
                            </a>
                        </p>
                        <p>
                            Quay về{" "}
                            <a href="/" className="register-link">
                                trang chủ
                            </a>
                        </p>
                    </div>
                </div>

                <div className="col-md-4 p-0">
                    <div className="carousel-container relative">
                        <div className="carousel-slide">
                            <img
                                src="/image/login/imageAuthLogin.png"
                                alt="Slide"
                                className="carousel-image"
                            />
                            <div className="carousel-content absolute z-5">
                                <h2 className="carousel-title text-white">
                                    Tăng cường tin cậy & minh bạch
                                </h2>
                                <p className="carousel-description text-white">
                                    Khi người tiêu dùng có thể xác định nguồn
                                    gốc sản phẩm, yên tâm hơn về chất lượng và
                                    an toàn thực phẩm, sẵn sàng chi trả mức chi
                                    phí cao hơn, góp phần tăng niềm tin vào
                                    thương hiệu
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Login;
