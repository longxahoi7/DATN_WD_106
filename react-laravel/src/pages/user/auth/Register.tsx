import React, { useEffect, useState } from "react";
import { FaEye, FaEyeSlash } from "react-icons/fa";
import "../../../style/auth.css";
import api from "../../../config/axios";
import Swal from "sweetalert2";
import { useNavigate } from "react-router-dom";

const Register: React.FC = () => {
    const images: string[] = ["/image/login/imageAuth.png"];
    const navigate = useNavigate();
    const [passwordVisible, setPasswordVisible] = useState(false);
    const [loading, setLoading] = useState(false);
    const [currentIndex, setCurrentIndex] = useState(0);
    const [formData, setFormData] = useState({
        name: "",
        email: "",
        password: "",
        phone: "",
        address: "",
    });
    const [errors, setErrors] = useState({
        name: "",
        email: "",
        password: "",
        phone: "",
        address: "",
        general: "",
    });

    const validateInput = (id: string, value: string) => {
        let errorMessage = "";

        // Kiểm tra trường name
        if (id === "name" && value.trim() === "") {
            errorMessage = "Họ và Tên không được để trống.";
        }

        // Kiểm tra trường email
        if (id === "email" && value.trim() === "") {
            errorMessage = "Email không được để trống.";
        } else if (
            id === "email" &&
            !/^[\w-.]+@([\w-]+\.)+[\w-]{2,4}$/.test(value)
        ) {
            errorMessage = "Email không hợp lệ.";
        }

        // Kiểm tra trường password
        if (id === "password" && value.length < 6) {
            errorMessage = "Mật khẩu phải có ít nhất 6 ký tự.";
        }

        // Kiểm tra phone
        if (id === "phone" && value.trim() === "") {
            errorMessage = "Số điện thoại không được để trống.";
        }

        // Kiểm tra address
        if (id === "address" && value.trim() === "") {
            errorMessage = "Địa chỉ không được để trống.";
        }

        setErrors((prevErrors) => ({
            ...prevErrors,
            [id]: errorMessage,
            general: "Đăng ký thất bại. Vui lòng thử lại.",
        }));
    };

    const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        const { id, value } = e.target;
        setFormData({ ...formData, [id]: value });
        validateInput(id, value);
    };

    const handleRegister = async (e: React.FormEvent) => {
        setLoading(true);
        e.preventDefault();

        if (!isFormValid()) {
            setLoading(false);
            return;
        }

        try {
            const response = await api.post("register", {
                name: formData.name,
                email: formData.email,
                password: formData.password,
                phone: formData.phone,
                address: formData.address,
            });

            if (response.status === 200) {
                // Hiển thị SweetAlert và điều hướng sau khi nhấn OK
                Swal.fire({
                    icon: "success",
                    title: "Đăng ký thành công!",
                    text: "Bạn có thể đăng nhập ngay bây giờ.",
                    confirmButtonText: "Đồng ý",
                }).then(() => {
                    // Sau khi nhấn OK, điều hướng về trang login
                    navigate("/login");
                });
            }
        } catch (error: any) {
            if (error.response) {
                const { message } = error.response.data;
                let errorMessage = "Đăng ký thất bại. Email đã được đăng ký.";

                if (message === "Email already exists") {
                    errorMessage = "Email này đã được đăng ký.";
                } else if (message === "Account already exists") {
                    errorMessage = "Tài khoản này đã tồn tại.";
                }

                Swal.fire({
                    icon: "error",
                    title: "Lỗi đăng ký",
                    text: errorMessage,
                    confirmButtonText: "Đóng",
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Lỗi đăng ký",
                    text: "Đã xảy ra sự cố, vui lòng thử lại.",
                    confirmButtonText: "Đóng",
                });
            }
        }
    };

    useEffect(() => {
        // Kiểm tra xem đã có token trong localStorage hay chưa
        const token = localStorage.getItem("token");
        if (token) {
            // Nếu có token, chuyển hướng người dùng đến trang chủ hoặc một trang khác
            navigate("/", { replace: true });
        }
    }, [navigate]); // Chạy effect khi trang login được render

    const isFormValid = () => {
        return (
            formData.name.trim() !== "" &&
            /^[\w-.]+@([\w-]+\.)+[\w-]{2,4}$/.test(formData.email) &&
            formData.password.length >= 6 &&
            formData.phone.trim() !== "" &&
            formData.address.trim() !== ""
        );
    };

    const togglePasswordVisibility = () => {
        setPasswordVisible(!passwordVisible);
    };

    return (
        <div className="container-fluid h-100">
            <div className="row h-100">
                {/* bên trái */}
                <div className="col-md-8 p-1 flex-column justify-content-center align-items-center">
                    <div className="logo mt-5">
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
                        <form
                            className="custom-form-auth"
                            onSubmit={handleRegister}
                        >
                            <div>
                                <input
                                    type="text"
                                    className={`form-control  ${
                                        errors.name ? "is-invalid" : ""
                                    }`}
                                    id="name"
                                    placeholder="Họ và Tên"
                                    value={formData.name}
                                    onChange={handleChange}
                                    onBlur={(e) =>
                                        validateInput(
                                            e.target.id,
                                            e.target.value
                                        )
                                    }
                                    required
                                />
                            </div>
                            <div>
                                <input
                                    type="email"
                                    className={`form-control  ${
                                        errors.email ? "is-invalid" : ""
                                    }`}
                                    id="email"
                                    placeholder="Email"
                                    value={formData.email}
                                    onChange={handleChange}
                                    onBlur={(e) =>
                                        validateInput(
                                            e.target.id,
                                            e.target.value
                                        )
                                    }
                                    required
                                />
                            </div>
                            <div className="password-input-wrapper">
                                <input
                                    type={passwordVisible ? "text" : "password"}
                                    className={`form-control  ${
                                        errors.password ? "is-invalid" : ""
                                    }`}
                                    id="password"
                                    placeholder="Mật khẩu"
                                    value={formData.password}
                                    onChange={handleChange}
                                    onBlur={(e) =>
                                        validateInput(
                                            e.target.id,
                                            e.target.value
                                        )
                                    }
                                    required
                                />
                                <div
                                    className="eye-icon"
                                    onClick={togglePasswordVisibility}
                                    style={{ cursor: "pointer" }}
                                >
                                    {passwordVisible ? (
                                        <FaEye />
                                    ) : (
                                        <FaEyeSlash />
                                    )}
                                </div>
                            </div>
                            <div className="row">
                                <div className="col-md-6">
                                    <input
                                        type="text"
                                        className={`form-control  ${
                                            errors.phone ? "is-invalid" : ""
                                        }`}
                                        id="phone"
                                        placeholder="Số điện thoại"
                                        value={formData.phone}
                                        onChange={handleChange}
                                        onBlur={(e) =>
                                            validateInput(
                                                e.target.id,
                                                e.target.value
                                            )
                                        }
                                        required
                                    />
                                </div>
                                <div className="col-md-6">
                                    <input
                                        type="text"
                                        className={`form-control  ${
                                            errors.address ? "is-invalid" : ""
                                        }`}
                                        id="address"
                                        placeholder="Địa chỉ"
                                        value={formData.address}
                                        onChange={handleChange}
                                        onBlur={(e) =>
                                            validateInput(
                                                e.target.id,
                                                e.target.value
                                            )
                                        }
                                        required
                                    />
                                </div>
                            </div>
                            <button
                                type="submit"
                                className="btn btn-success"
                                style={{
                                    backgroundColor: "#0f6d5e",
                                    width: "100%",
                                }}
                                disabled={!isFormValid()}
                            >
                                {loading ? "Đang đăng ký..." : "Đăng ký"}
                            </button>
                        </form>
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
                            Bạn đã có tài khoản?{" "}
                            <a href="/login" className="register-link">
                                Đăng nhập ngay
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

                {/* Bên phải */}
                <div className="col-md-4 p-0">
                    <div className="carousel-container relative">
                        <div className="carousel-slide">
                            <img
                                src={images[currentIndex]}
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

export default Register;
