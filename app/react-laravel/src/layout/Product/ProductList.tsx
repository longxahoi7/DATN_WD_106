import React, { useEffect, useState } from "react";
import Footer from "../Footer/footer";
import Header from "../Header/header";

import { Swiper, SwiperSlide } from "swiper/react";
import { Navigation, Pagination } from "swiper/modules";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import { FiChevronLeft, FiChevronRight } from "react-icons/fi";

import { Link, useParams } from "react-router-dom";
import { IProduct } from "../../interface/IProduct";
import SlideShow from "../slideShow/SlideShow";
type Props = {};

const ProductList = (props: Props) => {
    const testimonials = [
        {
            text: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.",
            author: "David",
            role: "Satisfied Customer",
        },
        {
            text: "Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris.",
            author: "Sarah",
            role: "Happy Client",
        },
        {
            text: "Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla.",
            author: "John",
            role: "Regular Customer",
        },
    ];
    const [testimonialIndex, setTestimonialIndex] = React.useState(0);

    const nextTestimonial = () => {
        setTestimonialIndex((testimonialIndex + 1) % testimonials.length);
    };

    const prevTestimonial = () => {
        setTestimonialIndex(
            (testimonialIndex - 1 + testimonials.length) % testimonials.length
        );
    };
    const { category } = useParams<{ category: string }>(); //lấy từ URL
    console.log(category);

    const [products, setProducts] = useState<IProduct[]>([]);
    useEffect(() => {
        const fetchProducts = async () => {
            try {
                const response = await fetch(`http://localhost:3000/products`);
                const data = await response.json();
                console.log(data);
                setProducts(data);
            } catch (error) {
                console.error("Failed to fetch products", error);
            }
        };

        fetchProducts();
    }, [category]);
    // bộ lọc
    const [selectedSize, setSelectedSize] = useState<string | null>(null);
    const [selectedColor, setSelectedColor] = useState<string | null>(null);
    const [price, setPrice] = useState(0);

    const sizes = ["S", "M", "L", "XL", "XXL"];
    const colors = [
        "#000000",
        "#FFFFFF",
        "#0000FF",
        "#FFFF00",
        "#FFC0CB",
        "#808080",
        "#D2B48C",
        "#A52A2A",
        "#008000",
        "#800080",
    ];

    return (
        <>
            <Header />
            <SlideShow />
            <div
                style={{
                    display: "flex",
                    marginRight: "30px",
                    marginLeft: "30px",
                }}
                className="p-4 w-1200 border border-gray-300 mt-50"
            >
                <div>
                    <div style={{ display: "flex" }}>
                        {/* bộ lọc */}

                        <div
                            className="p-4 w-64 border border-gray-300 mt-5 ml-5  "
                            style={{ minHeight: "450px", minWidth: "300px" }}
                        >
                            <div className="mb-4">
                                <h2 className="text-sm font-semibold mb-2">
                                    Size
                                </h2>
                                <div className="flex flex-wrap gap-2">
                                    {sizes.map((size) => (
                                        <button
                                            key={size}
                                            className={`border border-gray-300 rounded px-3 py-1 text-sm ${
                                                selectedSize === size
                                                    ? "bg-gray-300"
                                                    : ""
                                            }`}
                                            onClick={() =>
                                                setSelectedSize(size)
                                            }
                                        >
                                            {size}
                                        </button>
                                    ))}
                                </div>
                            </div>
                            <div className="mb-4">
                                <h2 className="text-sm font-semibold mb-2">
                                    Màu sắc
                                </h2>
                                <div className="grid grid-cols-5 gap-2">
                                    {colors.map((color) => (
                                        <div
                                            key={color}
                                            className={`w-6 h-6 rounded-full cursor-pointer ${
                                                selectedColor === color
                                                    ? "border-2 border-black"
                                                    : ""
                                            }`}
                                            style={{
                                                backgroundColor: color,
                                            }}
                                            onClick={() =>
                                                setSelectedColor(color)
                                            }
                                        ></div>
                                    ))}
                                </div>
                            </div>
                            <div className="mb-4">
                                <h2 className="text-sm font-semibold mb-2">
                                    Mức giá
                                </h2>
                                <div className="flex items-center">
                                    <input
                                        type="range"
                                        min="0"
                                        max="10000000"
                                        value={price}
                                        onChange={(e) =>
                                            setPrice(parseFloat(e.target.value))
                                        } // Chuyển đổi thành số
                                        className="w-full"
                                    />
                                </div>

                                <div className="flex justify-between text-sm mt-2">
                                    <span>0đ</span>
                                    <span>{price.toLocaleString()}đ</span>
                                </div>
                            </div>

                            <div className="flex justify-between">
                                <button className="border border-black rounded px-2 py-1">
                                    BỎ LỌC
                                </button>
                                <button className="bg-black text-white rounded px-4 py-2">
                                    LỌC
                                </button>
                            </div>
                        </div>
                        <div className="grid grid-cols-3 gap-4 my-8">
                            {products.slice(0, 3).map((item) => (
                                <div
                                    className="relative product-cart"
                                    key={item.id}
                                >
                                    <img
                                        src={`${item.image}`}
                                        alt={item.name}
                                        className="w-full h-full object-cover"
                                    />

                                    <div className="absolute bottom-4 w-full bg-white bg-opacity-75 text-center py-2">
                                        <span className="text-2xl font-semibold">
                                            {item.name}
                                        </span>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                    <hr className="mt-20" />
                    {/* Best Selling Section */}
                    <div className="container mx-auto px-4">
                        <h2 className="text-2xl font-bold">Best Selling</h2>
                        <p className="text-gray-600">
                            Discover our best-selling products. Popular among
                            our customers.
                        </p>
                        <div className="grid grid-cols-4 gap-4 mt-4">
                            {products.slice(3, 11).map((item) => (
                                <div
                                    key={item.id}
                                    className="text-center product-cart border mb-28"
                                >
                                    <Link to={`/product-detail/${item.id}`}>
                                        {" "}
                                        {/* Thêm Link vào ảnh sản phẩm */}
                                        <img
                                            src={`${item.image}`}
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
                            ))}
                        </div>
                    </div>

                    {/* Testimonial Section */}
                    <div className="bg-blue-50 my-8 py-8">
                        <div className="text-center relative">
                            <h2 className="text-2xl font-bold">Testimonial</h2>
                            <p className="text-gray-600">
                                {testimonials[testimonialIndex].text}
                            </p>
                            <p className="font-bold mt-4">
                                {testimonials[testimonialIndex].author}
                            </p>
                            <p className="text-gray-600">
                                {testimonials[testimonialIndex].role}
                            </p>
                            <button
                                onClick={prevTestimonial}
                                className="absolute left-0 top-1/2 transform -translate-y-1/2 bg-white p-2 rounded-full shadow-md"
                            >
                                <i className="fas fa-chevron-left"></i>
                            </button>
                            <button
                                onClick={nextTestimonial}
                                className="absolute right-0 top-1/2 transform -translate-y-1/2 bg-white p-2 rounded-full shadow-md"
                            >
                                <i className="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>

                    {/* Featured Products Section */}
                    <div className="container mx-auto px-4">
                        <div className="text-center my-8">
                            <h2 className="text-2xl font-bold">
                                Featured Products
                            </h2>
                            <div className="grid grid-cols-4 gap-4 mt-4">
                                {products.slice(7, 19).map((item) => (
                                    <div
                                        key={item.id}
                                        className="text-center product-cart border mb-28"
                                    >
                                        <Link to={`/product-detail/${item.id}`}>
                                            {" "}
                                            {/* Thêm Link vào ảnh sản phẩm */}
                                            <img
                                                src={`${item.image}`}
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
                                ))}
                            </div>
                        </div>
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
                            src="../../../public/video/Tainhanh.net_YouTube_saigon-sunday-fashion-film-BMPCC-6K-Cont_Media_yCBNYpMgDmE_002_720p.mp4"
                            autoPlay
                            muted
                            loop
                            width={"2000px"}
                            style={{ marginTop: "10px" }}
                        ></video>
                    </div>
                </div>
            </div>
            <Footer />
        </>
    );
};

export default ProductList;
