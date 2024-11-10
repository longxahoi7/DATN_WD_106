import React, { useState } from "react";
import "../../style/auth.css";

const Login: React.FC = () => {
    const images: string[] = ["/image/login/imageAuthLogin.png"];

    const [currentIndex, setCurrentIndex] = useState(0);

    const nextSlide = () => {
        setCurrentIndex((prevIndex) => (prevIndex + 1) % images.length);
    };

    const prevSlide = () => {
        setCurrentIndex(
            (prevIndex) => (prevIndex - 1 + images.length) % images.length
        );
    };

    return (
        <div className="container-fluid h-100">
            <div className="row h-100">
                {/* Bên trái */}
                <div className="col-md-8 p-5 flex-column justify-content-center align-items-center">
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
                        <form>
                            <div>
                                <input
                                    type="text"
                                    className="form-control mb-4"
                                    id="username"
                                    placeholder="Tên tài khoản"
                                />
                            </div>
                            <div>
                                <input
                                    type="password"
                                    className="form-control mb-4"
                                    id="password"
                                    placeholder="Mật khẩu"
                                />
                            </div>
                            <div
                                className="form-check mb-3 "
                                style={{ textAlign: "left" }}
                            >
                                <input
                                    type="checkbox"
                                    className="form-check-input"
                                    id="remember"
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
                            >
                                Đăng nhập
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
                            Bạn chưa có tài khoản?{" "}
                            <a href="/register" className="register-link">
                                Đăng ký ngay
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
                            {/* <div className="gradient"></div> */}
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

                        {/* Nút điều khiển slide */}
                        {/* <button
                            className="carousel-control prev"
                            onClick={prevSlide}
                        >
                            &#10094;
                        </button>
                        <button
                            className="carousel-control next"
                            onClick={nextSlide}
                        >
                            &#10095;
                        </button> */}

                        {/* Chỉ báo slide */}
                        {/* <div className="carousel-indicators">
                            {images.map((_, index) => (
                                <span
                                    key={index}
                                    className={`indicator ${
                                        currentIndex === index ? "active" : ""
                                    }`}
                                    onClick={() => setCurrentIndex(index)}
                                ></span>
                            ))}
                        </div> */}
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Login;
