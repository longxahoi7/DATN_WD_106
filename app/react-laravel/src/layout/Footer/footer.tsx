import React from "react";
import "./footer.css";
import { Link } from "react-router-dom";
type Props = {};

const Footer = (props: Props) => {
    return (
        <>
            <div className="footer">
                <div className="container">
                    <div className="row-grid">
                        <div className="footer-item">
                            <p>GENTLEMANOR</p>
                            <p>
                                <Link
                                    to="/huong-dan-mua-hang"
                                    style={{ color: "gray" }}
                                >
                                    Hướng dẫn mua hàng
                                </Link>
                            </p>
                            <p>
                                <Link
                                    to="/huong-dan-bao-quan"
                                    style={{ color: "gray" }}
                                >
                                    Hướng dẫn bảo quản
                                </Link>
                            </p>
                        </div>
                        <div className="footer-item">
                            <p>CHÍNH SÁCH</p>
                            <p>Chính sách đổi trả trong ngày</p>
                            <p>Chính sách khuyến mại</p>
                            <p>Chính sách giao hàng</p>
                        </div>
                        <div className="footer-item">
                            <p>CHĂM SÓC KHÁCH HÀNG</p>
                            <p>Trải nghiệm mua sắm 100% hài lòng</p>
                            <p>Hỏi đáp 24/7</p>
                        </div>
                        <div className="footer-item">
                            <p>ĐỊA CHỈ LIÊN HỆ</p>
                            Tầng 8, tòa nhà Ford, số 315 Trường Chinh, quận
                            Thanh Xuân, Hà Nội
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
};

export default Footer;
