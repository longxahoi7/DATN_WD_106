import React, { useEffect, useState } from "react";
import "./header.css";
import { Link, NavLink } from "react-router-dom";
import { Category } from "../../interface/Category";
import { IProduct } from "../../interface/IProduct";

type Props = {};

const Header = (props: Props) => {
    const [categories, setCategories] = useState<Category[]>([]);

    useEffect(() => {
        const fetchCategories = async () => {
            try {
                const response = await fetch(
                    " http://localhost:3000/categories"
                );
                const data = await response.json();
                setCategories(data);
                console.log(data);
            } catch (error) {
                console.error("Failed to fetch categories", error);
            }
        };

        fetchCategories();
    }, []);
    // products
    const [products, setProducts] = useState<IProduct[]>([]);
    const [searchInput, setSearchInput] = useState("");
    useEffect(() => {
        const fetchProducts = async () => {
            try {
                const response = await fetch("http://localhost:3000/products");
                const data = await response.json();
                setProducts(data);
                console.log(data);
            } catch (error) {
                console.error("Failed to fetch products", error);
            }
        };

        fetchProducts();
    }, []);
    const filteredProducts = products.filter((item) =>
        item.name.toLowerCase().includes(searchInput.toLowerCase())
    );
    return (
        <>
            <div className="header">
                <div className="container">
                    <div className="row-flex">
                        <div className="header-logo">
                            <img src="../../../public/image/logo1.png" alt="" />
                        </div>
                        <div
                            className="header-nav"
                            style={{
                                display: "flex",
                                marginLeft: "10px",
                                color: "black",
                            }}
                        >
                            {categories.map((item) => (
                                <ul>
                                    <li
                                        className="dropdown"
                                        style={{
                                            marginLeft: "20px",
                                            color: "black",
                                        }}
                                    >
                                        <Link
                                            to={`/products/${item.slug}`}
                                            style={{ color: "black" }}
                                        >
                                            {item.name}
                                        </Link>
                                    </li>
                                </ul>
                            ))}
                            <li>
                                <Link
                                    to={`/lien-he`}
                                    style={{
                                        marginLeft: "20px",
                                        color: "black",
                                    }}
                                >
                                    Liên Hệ
                                </Link>
                            </li>
                            <li>
                                <Link
                                    to={`/gioi-thieu`}
                                    style={{
                                        marginLeft: "20px",
                                        color: "black",
                                    }}
                                >
                                    Giới Thiệu
                                </Link>
                            </li>
                            {/* <li>
                                <Link
                                    to={`/chi tiết sp`}
                                    style={{
                                        marginLeft: "20px",
                                        color: "black",
                                    }}
                                >
                                    chi tiet sp
                                </Link>
                            </li> */}
                        </div>
                        <div className="header-search">
                            <form action="" style={{ position: "relative" }}>
                                <input
                                    type="text"
                                    placeholder="Nhập tên sản phầm cần tìm"
                                    value={searchInput}
                                    onChange={(e) =>
                                        setSearchInput(e.target.value)
                                    }
                                    style={{ paddingLeft: "50px" }}
                                />
                                <i
                                    className="ri-search-line"
                                    style={{
                                        fontSize: "1.5rem",
                                        marginLeft: "10px",
                                        color: "gray",
                                    }}
                                ></i>
                                {searchInput && (
                                    <div
                                        className="search-container"
                                        style={{
                                            backgroundColor: "white",
                                            position: "absolute",
                                            width: "400px",
                                        }}
                                    >
                                        {filteredProducts.length > 0 ? (
                                            filteredProducts.map(
                                                (item, index) => (
                                                    <div
                                                        className="search-item"
                                                        key={index}
                                                        style={{
                                                            display: "flex",
                                                        }}
                                                    >
                                                        <img
                                                            src={item.image}
                                                            alt={item.name}
                                                            width={"50px"}
                                                            style={{
                                                                marginTop:
                                                                    "12px",
                                                                marginLeft:
                                                                    "10px",
                                                            }}
                                                        />
                                                        <div className="search-info  ">
                                                            <h5
                                                                style={{
                                                                    marginTop:
                                                                        "20px",
                                                                    marginLeft:
                                                                        "15px",
                                                                }}
                                                            >
                                                                {item.name}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                )
                                            )
                                        ) : (
                                            <p>Không tìm thấy sản phẩm nào.</p>
                                        )}
                                    </div>
                                )}
                            </form>
                        </div>
                        <div className="header-card">
                            <div
                                style={{
                                    position: "relative",
                                    display: "inline-block",
                                }}
                            >
                                <i
                                    className="ri-shopping-cart-line"
                                    style={{
                                        fontSize: "1.5rem",
                                    }}
                                ></i>
                                <span
                                    style={{
                                        position: "absolute",
                                        right: -10,
                                        top: -10,
                                        backgroundColor: "black",
                                        color: "white",
                                        borderRadius: "50%",
                                        padding: "2px 4px",
                                        fontSize: "12px",
                                    }}
                                >
                                    9
                                </span>
                            </div>
                        </div>
                        <div className="header-user mr-20">
                            <i
                                className="ri-user-3-fill"
                                style={{
                                    fontSize: "1.5rem",
                                }}
                            ></i>
                        </div>
                    </div>
                </div>
            </div>
            <div
                id="carouselExampleFade"
                className="carousel slide carousel-fade"
                data-bs-ride="carousel"
            >
                <div className="carousel-inner">
                    <div className="carousel-item active">
                        <img
                            src="../../../public/image/banner4.png"
                            className="d-block w-100"
                            alt="..."
                        />
                    </div>
                    <div className="carousel-item">
                        <img
                            src="../../../public/image/banner2.jpg!bw700"
                            className="d-block w-100"
                            alt="..."
                        />
                    </div>
                    <div className="carousel-item">
                        <img
                            src="../../../public/image/banner3.webp"
                            className="d-block w-100"
                            alt="..."
                        />
                    </div>
                </div>
                <button
                    className="carousel-control-prev"
                    type="button"
                    data-bs-target="#carouselExampleFade"
                    data-bs-slide="prev"
                >
                    <span
                        className="carousel-control-prev-icon"
                        aria-hidden="true"
                    ></span>
                    <span className="visually-hidden">Previous</span>
                </button>
                <button
                    className="carousel-control-next"
                    type="button"
                    data-bs-target="#carouselExampleFade"
                    data-bs-slide="next"
                >
                    <span
                        className="carousel-control-next-icon"
                        aria-hidden="true"
                    ></span>
                    <span className="visually-hidden">Next</span>
                </button>
            </div>
        </>
    );
};

export default Header;
