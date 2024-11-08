import { Footer, Header } from "antd/es/layout/layout";
import React, { useEffect, useState } from "react";
import { Link, useParams } from "react-router-dom";
import SlideShow from "../../../layout/slideShow/SlideShow";
import { IProduct } from "../../../interface/IProduct";

const Products: React.FC = () => {
    const { category } = useParams<{ category: string }>(); //lấy từ URL
    console.log(category);
    const [filteredProducts, setFilteredProducts] = useState<IProduct[]>([]);
    const { slug } = useParams<{ slug: string }>();
    const [products, setProducts] = useState<IProduct[]>([]);
    useEffect(() => {
        const fetchProducts = async () => {
            try {
                const response = await fetch(
                    `http://localhost:3000/products?category=${category}`
                );
                const data = await response.json();
                setProducts(data);
                // Lọc sản phẩm theo slug của danh mục
                const filtered = data.filter(
                    (product) => product.categorySlug === slug
                );
                setFilteredProducts(filtered);
            } catch (error) {
                console.error("Failed to fetch products", error);
            }
        };

        fetchProducts();
    }, [category]);

    return (
        <>
            <SlideShow />

            <section
                className="hot-product bg-gray-100 p-8"
                style={{ height: "3000px", width: "100vw" }}
            >
                <div className="container mx-auto">
                    <div className="row-grid text-center mb-8">
                        <p className="heading-text text-2xl font-bold">
                            San Pham Noi Bat :{slug}
                        </p>
                    </div>
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        {filteredProducts.length > 0 ? (
                            filteredProducts.map((item) => (
                                <div
                                    className="text-center product-cart border mb-28"
                                    key={item.id}
                                >
                                    <Link to={`/product-detail/${item.id}`}>
                                        <img
                                            src={item.image}
                                            alt={item.name}
                                            className="w-full h-80 object-cover"
                                        />
                                    </Link>
                                    <p className="mt-4 text-lg font-semibold text-center">
                                        {item.name}
                                    </p>
                                    <span className="block text-gray-500 text-center">
                                        100% Cotton
                                    </span>
                                    <div className="hot-product-item-price text-center mt-2">
                                        <p className="text-red-500 font-bold">
                                            {item.price} <sup>đ</sup>{" "}
                                            <span className="text-gray-400 line-through">
                                                743,000 <sup>đ</sup>
                                            </span>
                                        </p>
                                    </div>
                                    <div className="">
                                        <button className="add-to-cart-btn mt-4 bg-gray-700 flex items-center justify-center">
                                            Add to Cart
                                            <i className="fas fa-shopping-cart ml-2"></i>{" "}
                                            {/* Biểu tượng giỏ hàng bên phải */}
                                        </button>
                                    </div>
                                </div>
                            ))
                        ) : (
                            <p>Không có sản phẩm nào được tìm thấy.</p>
                        )}
                    </div>
                    <hr className="mt-20" />
                    {/* Our Shop Section */}
                    <div className="text-center my-8">
                        <h2 className="text-5xl font-bold">Our Shop</h2>
                        <p
                            className="text-gray-900"
                            style={{ fontSize: "1.5rem" }}
                        >
                            Shop for your favorite items at our store. Find the
                            best products, get in touch with our friendly staff,
                            and enjoy a great shopping experience.
                        </p>
                        <video
                            src="../../../public/video/yt1s.com - Britney Manson  FΛSHION Single 2023.mp4"
                            autoPlay
                            muted
                            loop
                            width={"2000px"}
                            style={{ marginTop: "10px" }}
                        ></video>
                    </div>
                </div>
            </section>
        </>
    );
};

export default Products;
