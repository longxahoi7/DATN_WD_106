import React, { useEffect, useState } from "react";
import {
    Container,
    Row,
    Col,
    Navbar,
    Nav,
    Form,
    FormControl,
} from "react-bootstrap";
import {
    FaHome,
    FaUser,
    FaShoppingCart,
    FaLocationArrow,
    FaPhoneAlt,
} from "react-icons/fa";
import { Category } from "../../interface/IProduct";
import "../../style/header.css";
import { Link, useNavigate } from "react-router-dom";

const Header = () => {
    const navigate = useNavigate();
    const [categories, setCategories] = useState<Category[]>([]);
    const [isLoggedIn, setIsLoggedIn] = useState(false);
    const [userName, setUserName] = useState("");

    useEffect(() => {
        // Kiểm tra token để xác định trạng thái đăng nhập
        const token = localStorage.getItem("token");
        if (token) {
            // Giả sử lấy tên người dùng từ localStorage hoặc gọi API
            const storedUserName =
                localStorage.getItem("userName") || "Tài Khoản";
            setUserName(storedUserName);
            setIsLoggedIn(true);
        }
    }, []);

    const handleLogout = () => {
        // Xóa token và tên tài khoản khỏi localStorage khi đăng xuất
        localStorage.removeItem("token");
        localStorage.removeItem("userName");
        setIsLoggedIn(false);
        setUserName("Tài Khoản");
        navigate("/login"); // Chuyển hướng tới trang đăng nhập
    };

    const handleCategoryClick = (slug: string) => {
        navigate(`/products/${slug}`);
    };

    const renderCategories = (categories: Category[]) => {
        return (
            <div className="header-nav" style={{ display: "flex" }}>
                {categories?.map((parent) => (
                    <ul key={parent.category_id}>
                        <li className="dropdown" style={{ color: "gray" }}>
                            <a
                                href="#"
                                onClick={() => handleCategoryClick(parent.slug)}
                                style={{
                                    color: "gray",
                                    textDecoration: "none",
                                }}
                            >
                                {parent.name}
                            </a>
                            {parent.children && parent.children.length > 0 && (
                                <ul className="dropdown-menu">
                                    {parent.children.map((child) => (
                                        <li key={child.category_id}>
                                            <Link
                                                to={`/products/${child.slug}`}
                                                style={{
                                                    color: "gray",
                                                    textDecoration: "none",
                                                }}
                                            >
                                                {child.name}
                                            </Link>
                                        </li>
                                    ))}
                                </ul>
                            )}
                        </li>
                    </ul>
                ))}
            </div>
        );
    };

    return (
        <>
            <Container fluid className="border-bottom">
                <Row className="g-0">
                    {/* Cột bên trái - Logo */}
                    <Col
                        xs={2}
                        md={2}
                        lg={1}
                        className="d-flex align-items-center"
                    >
                        <Navbar.Brand href="/">
                            <img
                                src="../../../public/image/logo/logo-remove.png"
                                alt="Gentle Manor"
                                style={{ width: "120px", marginLeft: "150px" }}
                            />
                        </Navbar.Brand>
                    </Col>
                    {/* Cột giữa - Tìm kiếm và danh mục */}
                    <Col xs={8} md={7} lg={7} className="mx-auto">
                        <Row>
                            <Col className="mb-2 pt-5">
                                <Form
                                    className="d-flex align-items-center"
                                    style={{
                                        height: "45px",
                                        marginRight: "50px",
                                        width: "100%",
                                    }}
                                >
                                    <FormControl
                                        type="search"
                                        placeholder="Tìm kiếm sản phẩm"
                                        className="me-2"
                                        aria-label="Search"
                                        style={{
                                            height: "40px",
                                        }}
                                    />
                                </Form>
                            </Col>
                        </Row>
                        <Row>
                            <Col>{renderCategories(categories)}</Col>
                        </Row>
                    </Col>
                    {/* Cột bên phải - Icon và địa chỉ */}
                    <Col xs={2} md={3} lg={3} className="ms-auto">
                        <Row className="d-flex justify-content-end mb-4 ml-5">
                            <Col className="mt-5">
                                <Nav>
                                    <Nav.Link href="/">
                                        <FaHome className="home-icon" /> Trang
                                        chủ
                                    </Nav.Link>
                                    <div className="dropdown">
                                        <Nav.Link className="custom-Navlink">
                                            <FaUser className="user-icon" />{" "}
                                            {isLoggedIn
                                                ? userName
                                                : "Tài Khoản"}
                                        </Nav.Link>
                                        <div className="dropdown-menu">
                                            {isLoggedIn ? (
                                                <>
                                                    <Link
                                                        to="/profile"
                                                        className="dropdown-item"
                                                    >
                                                        Thông tin chung
                                                    </Link>
                                                    <span
                                                        className="dropdown-item"
                                                        onClick={handleLogout}
                                                    >
                                                        Đăng xuất
                                                    </span>
                                                </>
                                            ) : (
                                                <>
                                                    <Link
                                                        to="/login"
                                                        className="dropdown-item"
                                                    >
                                                        Đăng nhập
                                                    </Link>
                                                    <Link
                                                        to="/register"
                                                        className="dropdown-item"
                                                    >
                                                        Đăng ký
                                                    </Link>
                                                </>
                                            )}
                                        </div>
                                    </div>
                                    <Nav.Link href="#">
                                        <FaShoppingCart className="shop-icon" />
                                    </Nav.Link>
                                </Nav>
                            </Col>
                        </Row>
                        <Row>
                            <Col className="text-start custom-text d-flex">
                                <a
                                    href="https://www.google.com/maps/search/13+P.+Trịnh+Văn+Bô,+Xuân+Phương,+Nam+Từ+Liêm,+Hà+Nội"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                    <small>
                                        <FaLocationArrow /> Địa chỉ: 13 Trịnh
                                        Văn Bô
                                    </small>
                                </a>
                                <p>
                                    <FaPhoneAlt /> Hotline: 0369312858
                                </p>
                            </Col>
                        </Row>
                    </Col>
                </Row>
            </Container>
        </>
    );
};

export default Header;
