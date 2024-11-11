import React, { useEffect, useState } from "react";
import {
    Container,
    Row,
    Col,
    Navbar,
    Nav,
    Form,
    FormControl,
    Button,
} from "react-bootstrap";
import {
    FaHome,
    FaUser,
    FaShoppingCart,
    FaLocationArrow,
    FaPhoneAlt,
    FaSearch,
} from "react-icons/fa";
import { Category } from "../../interface/IProduct";
import "../../style/header.css";
import { Link, useNavigate } from "react-router-dom";

const Header = () => {
    const navigate = useNavigate();

    const [categories, setCategories] = useState<Category[]>([]);
    useEffect(() => {
        const fetchCategories = async () => {
            try {
                const response = await fetch(
                    " http://localhost:3000/categories"
                );
                const data = await response.json();
                setCategories(data);
            } catch (error) {
                console.error("Failed to fetch categories", error);
            }
        };

        fetchCategories();
    }, []);

    const handleCategoryClick = (slug: string) => {
        navigate(`/products/${slug}`);
    };

    const renderCategories = (categories: Category[]) => {
        return (
            <div className="header-nav" style={{ display: "flex" }}>
                {categories?.map((parent) => (
                    <ul key={parent.id}>
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
                                        <li key={child.id}>
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
                        lg={2}
                        className="d-flex align-items-center"
                    >
                        <Navbar.Brand href="/home">
                            <img
                                src="../../../public/image/logo/logo-remove.png"
                                alt="Gentle Manor"
                                style={{ width: "120px", marginLeft: "50px" }}
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
                                        height: "35px",
                                        marginRight: "10px",
                                        width: "750px",
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
                        <Row className="d-flex justify-content-end mb-4">
                            <Col className="mt-5">
                                <Nav>
                                    <Nav.Link href="/home">
                                        <FaHome className="home-icon" /> Trang
                                        chủ
                                    </Nav.Link>
                                    <Nav.Link
                                        className="custom-Navlink"
                                        href="register"
                                    >
                                        <FaUser className="user-icon" /> Tài
                                        Khoản
                                    </Nav.Link>
                                    <Nav.Link href="#">
                                        <FaShoppingCart className="shop-icon" />
                                    </Nav.Link>
                                </Nav>
                            </Col>
                        </Row>
                        <Row>
                            <Col className="text-start custom-text d-flex">
                                {/* Địa chỉ có thể nhấn và mở Google Maps */}
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
