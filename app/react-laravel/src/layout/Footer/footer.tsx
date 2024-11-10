import React from "react";
import { Link } from "react-router-dom";
import { FaFacebook, FaInstagram } from "react-icons/fa";
import { SiZalo } from "react-icons/si";
import "../../style/footer.css";

const Footer = () => {
    return (
        <>
            <hr className="mt-5" />
            <div className="container">
                <div className="header-title">
                    <div className="custom-logo">
                        <img
                            src="../../../public/image/logo/logo-remove.png"
                            alt="logo"
                        />
                    </div>
                    <div className="custom-description">
                        <p>
                            - GENTLEMANOR Thay đổi từ thời trang đến phong cách
                            sống
                        </p>
                    </div>
                </div>
                <hr />
                <div className="row">
                    <div className="col ml-6">
                        <h5>Hướng trợ khách hàng</h5>
                        <ul>
                            <li>
                                <Link to="">Hướng dẫn bảo quản</Link>
                            </li>
                            <li>
                                <Link to="">Hướng dẫn đổi hàng</Link>
                            </li>
                            <li>
                                <Link to="">Hướng dẫn mua hàng</Link>
                            </li>
                            <li>
                                <Link to="">Chính sách đổi trả</Link>
                            </li>
                            <li>
                                <Link to="">Phương thức vận chuyển</Link>
                            </li>
                        </ul>
                    </div>
                    <div className="col">
                        <h5>Về Gentle Manor</h5>
                        <ul>
                            <li>
                                <Link to="">Giới thiệu Tiki</Link>
                            </li>
                            <li>
                                <Link to="">Điều khoản sử dụng</Link>
                            </li>
                            <li>
                                <Link to="">Điều kiện vận chuyển</Link>
                            </li>
                        </ul>
                    </div>
                    <div className="col">
                        <h5>Hợp tác và liên kết</h5>
                        <ul>
                            <li>
                                <Link to="">Quy chế hoạt động Sàn GDTMĐT</Link>
                            </li>
                            <li>
                                <Link to="">Bán hàng cùng Tiki</Link>
                            </li>
                        </ul>
                        <h5>Chứng nhận bởi</h5>
                        <ul></ul>
                    </div>
                    <div className="col">
                        <h5>Kết nối với chúng tôi</h5>
                        <ul className="social-icons">
                            <li>
                                <Link to="#">
                                    <img
                                        src="../../../public/icon/iconfacebook.png"
                                        alt="facebook"
                                    />
                                </Link>
                            </li>
                            <li>
                                <Link to="#">
                                    <img
                                        src="../../../public/icon/icon instagram.png"
                                        alt="facebook"
                                    />
                                </Link>
                            </li>
                            <li>
                                <Link to="#">
                                    <img
                                        src="../../../public/icon/iconzalo.png"
                                        alt="facebook"
                                    />
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>
                <hr />
                <div className="footer-header ">
                    <h6>Gentle Manor</h6>
                    <p>13 P. Trịnh Văn Bô, Xuân Phương, Nam Từ Liêm, Hà Nội</p>
                    <p>Hotline: 0369312858</p>
                </div>
            </div>
        </>
    );
};

export default Footer;
