import React, { useEffect } from "react";

import Footer from "../Footer/footer";
import Header from "../Header/header";
import { IProduct } from "../../interface/IProduct";
import { Link, useParams } from "react-router-dom";
import { GetProductByID } from "../../service/Product";

import axios from "axios";
type Props = {};
const { useState } = React;
const ProductDetail = (props: any) => {
    const [price, setPrice] = useState(1290000);
    const [size, setSize] = useState("M");
    const [quantity, setQuantity] = useState(1);
    const [color, setColor] = useState("Đen");
    const [products, setProducts] = useState<IProduct[]>([]);
    const sizePrices = {
        S: 129000,
        M: 129000,
        L: 139000,
        XL: 149000,
    };
    const colorPrices = {
        Đen: 129000,
        Xanh: 139000,
        Đỏ: 149000,
        Trắng: 159000,
    };
    const { id } = useParams<{ id: string }>();
    const handleSizeChange = (newSize: keyof typeof sizePrices) => {
        setSize(newSize);
        setPrice(sizePrices[newSize]);
    };
    const handleColorChange = (newColor: keyof typeof colorPrices) => {
        setColor(newColor);
        setPrice(colorPrices[newColor]);
    };

    const handleQuantityChange = (change: number) => {
        setQuantity((prevQuantity) => Math.max(1, prevQuantity + change));
    };

    const { category } = useParams<{ category: string }>(); //lấy từ URL

    console.log(category);
    // const [products, setProducts] = useState<IProduct[]>([]);
    // useEffect(() => {
    //     const fetchProducts = async () => {
    //         try {
    //             const response = await fetch(`http://localhost:3000/products`);
    //             const data = await response.json();
    //             console.log(data);
    //             setProducts(data);
    //         } catch (error) {
    //             console.error("Failed to fetch products", error);
    //         }
    //     };

    //     fetchProducts();
    // }, [category]);
    const param = useParams();
    //sp tuong tự
    const [relatedProducts, setRelatedProducts] = useState<IProduct[]>([]);
    const instance = axios.create({
        baseURL: "http://localhost:3000/products",
    });

    useEffect(() => {
        if (id) {
            (async () => {
                try {
                    const data = await GetProductByID(id);
                    setProducts(data);
                    setPrice(data.price); // Cập nhật giá dựa trên sản phẩm
                } catch (error) {
                    console.error("Failed to fetch product:", error);
                }
            })();
        }
    }, [id]);
    // sp tương tự
    useEffect(() => {
        const fetchRelatedProducts = async () => {
            try {
                const response = await instance.get("/"); // Lấy tất cả sản phẩm
                const products: IProduct[] = response.data; // Giả sử response.data trả về mảng sản phẩm
                console.log(products);

                // Kiểm tra nếu sản phẩm hiện tại đã được tải
                if (products.length > 0) {
                    const currentProduct = products.find(
                        (p: IProduct) => p.id.toString() === id
                    ); // Tìm sản phẩm hiện tại theo ID
                    console.log("Current product ID:", typeof id);
                    console.log("Current product ", currentProduct);
                    if (currentProduct) {
                        // Kiểm tra nếu category của sản phẩm hiện tại là hợp lệ
                        const relatedProducts = products.filter(
                            (p: IProduct) =>
                                p.category === currentProduct.category && // So sánh category
                                p.id !== currentProduct.id // Đảm bảo không lấy sản phẩm hiện tại
                        );
                        console.log(relatedProducts);
                        console.log("category product ", currentProduct);
                        // Kiểm tra xem có sản phẩm liên quan không
                        if (relatedProducts.length > 0) {
                            setRelatedProducts(relatedProducts);
                        } else {
                            console.warn("No related products found.");
                        }
                    } else {
                        console.warn("Current product not found.");
                    }
                } else {
                    console.warn("No products available.");
                }
            } catch (error) {
                console.error("Error fetching related products:", error);
            }
        };

        // Gọi hàm fetchRelatedProducts khi id thay đổi
        fetchRelatedProducts();
    }, [id]);

    return (
        <>
            <Header />
            <div className=" p-4 mt-40" style={{ width: "100vw" }}>
                <div className="flex ml-6">
                    <div
                        className="w-1/2 flex bg-pink "
                        style={{ marginRight: "-300px" }}
                    >
                        <img
                            src={products.image}
                            alt={products.name}
                            className=" main-image"
                            style={{
                                width: "500px",
                                height: "550px",
                                marginLeft: "80px",
                            }}
                        />
                    </div>

                    <div className=" flex flex-col items-start">
                        {/* Ảnh nhỏ xếp dọc */}
                        <img
                            src={products.image} // Thay đổi tên biến tương ứng với ảnh nhỏ
                            alt="Ảnh nhỏ 1"
                            className="small-image mb-2 "
                            style={{ width: "100px", height: "100px" }}
                        />
                        <img
                            src={products.image} // Thay đổi tên biến tương ứng với ảnh nhỏ
                            alt="Ảnh nhỏ 2"
                            className="small-image mb-2 mt-5"
                            style={{
                                width: "100px",
                                height: "100px",
                                marginTop: "5px",
                            }}
                        />
                        <img
                            src={products.image} // Thay đổi tên biến tương ứng với ảnh nhỏ
                            alt="Ảnh nhỏ 3"
                            className="small-image mb-2 mt-5"
                            style={{
                                width: "100px",
                                height: "100px",
                                marginTop: "5px",
                            }}
                        />
                        <img
                            src={products.image} // Thay đổi tên biến tương ứng với ảnh nhỏ
                            alt="Ảnh nhỏ 4"
                            className="small-image mb-2 mt-5"
                            style={{ width: "100px", height: "100px" }}
                        />
                    </div>
                    <div
                        className="w-1/2 items-start ml-4"
                        style={{ marginLeft: "100px" }}
                    >
                        <h1 className="text-2xl font-bold mb-2">
                            {products.name}
                        </h1>

                        <div className="flex items-center mb-2">
                            <div className="text-yellow-500">
                                <i className="fas fa-star"></i>
                                <i className="fas fa-star"></i>
                                <i className="fas fa-star"></i>
                                <i className="fas fa-star"></i>
                                <i className="fas fa-star"></i>
                            </div>
                            <span className="ml-2 text-gray-500">
                                (0 đánh giá)
                            </span>
                        </div>
                        <p className="text-gray-500 mb-4">Màu sắc: {color}</p>
                        <p className="text-2xl font-bold mb-4">
                            {price.toLocaleString()}₫
                        </p>
                        <div className="flex space-x-2 mb-4">
                            <button
                                className={`border border-gray-300 p-2 ${
                                    color === "Đen" ? "bg-gray-200" : ""
                                }`}
                                onClick={() => handleColorChange("Đen")}
                            >
                                Đen
                            </button>
                            <button
                                className={`border border-gray-300 p-2 ${
                                    color === "Trắng" ? "bg-gray-200" : ""
                                }`}
                                onClick={() => handleColorChange("Trắng")}
                            >
                                Trắng
                            </button>
                            <button
                                className={`border border-gray-300 p-2 ${
                                    color === "Xanh" ? "bg-gray-200" : ""
                                }`}
                                onClick={() => handleColorChange("Xanh")}
                            >
                                Xanh
                            </button>
                            <button
                                className={`border border-gray-300 p-2 ${
                                    color === "Đỏ" ? "bg-gray-200" : ""
                                }`}
                                onClick={() => handleColorChange("Đỏ")}
                            >
                                Đỏ
                            </button>
                        </div>
                        <div className="flex space-x-2 mb-4">
                            <button
                                className={`border border-gray-300 p-2 ${
                                    size === "S" ? "bg-gray-200" : ""
                                }`}
                                onClick={() => handleSizeChange("S")}
                            >
                                S
                            </button>
                            <button
                                className={`border border-gray-300 p-2 ${
                                    size === "M" ? "bg-gray-200" : ""
                                }`}
                                onClick={() => handleSizeChange("M")}
                            >
                                M
                            </button>
                            <button
                                className={`border border-gray-300 p-2 ${
                                    size === "L" ? "bg-gray-200" : ""
                                }`}
                                onClick={() => handleSizeChange("L")}
                            >
                                L
                            </button>
                            <button
                                className={`border border-gray-300 p-2 ${
                                    size === "XL" ? "bg-gray-200" : ""
                                }`}
                                onClick={() => handleSizeChange("XL")}
                            >
                                XL
                            </button>
                        </div>

                        <div className="flex items-center mb-4">
                            <button
                                className="border border-gray-300 p-2"
                                onClick={() => handleQuantityChange(-1)}
                            >
                                -
                            </button>
                            <input
                                type="text"
                                value={quantity}
                                readOnly
                                className="w-12 text-center border border-gray-300"
                            />
                            <button
                                className="border border-gray-300 p-2"
                                onClick={() => handleQuantityChange(1)}
                            >
                                +
                            </button>
                        </div>
                        <div className="flex space-x-4 mb-4">
                            <button className="bg-black text-white px-4 py-2">
                                THÊM VÀO GIỎ
                            </button>
                            <button className="border border-black px-4 py-2">
                                MUA HÀNG
                            </button>
                        </div>
                        <div className="max-w-lg">
                            <p className="text-lg font-semibold mb-1">Mô tả</p>
                            <hr className="border-t border-gray-700 mb-2" />
                            <p className="mb-2 break-words">{products.mota}</p>
                        </div>
                    </div>
                </div>

                <h2 className="text-xl font-bold mb-4 text-center mt-20">
                    Sản phẩm tương tự
                </h2>
                <span className="block h-1 bg-gray-400 mx-auto w-1/6"></span>
                {/* <div className="grid grid-cols-4 gap-4 mt-4">
                    {products.slice(3, 7).map((item) => (
                        <div className="text-center product-cart border mb-28">
                            <img
                                src={`${item.image}`}
                                alt={`${item.name}`}
                                className="w-full h-full object-cover"
                            />
                            <p className="mt-4 text-lg font-semibold text-center">
                                {`${item.name}`}
                            </p>
                            <span className="block text-gray-500 text-center">
                                100% Cotton
                            </span>
                            <div className="hot-product-item-price text-center mt-2">
                                <p className="text-red-500 font-bold">
                                    {`${item.price}`} <sup>đ</sup>{" "}
                                    <span className="text-gray-400 line-through">
                                        743,000 <sup>đ</sup>
                                    </span>
                                </p>
                            </div>
                            <button className="add-to-cart-btn">
                                {" "}
                                Add to Cart
                            </button>
                        </div>
                    ))}
                </div> */}
                {/* lọc sp */}
                <div className="grid grid-cols-4 gap-4 mt-4">
                    {relatedProducts.map((relatedProduct) => (
                        <div
                            key={relatedProduct._id}
                            className="text-center product-cart border mb-20 p-4"
                        >
                            <Link to={`/product-detail/${relatedProduct.id}`}>
                                <img
                                    src={relatedProduct.image}
                                    alt={relatedProduct.name}
                                    className="w-150 h-80 object-cover ml-10"
                                />
                            </Link>
                            <p className="mt-4 text-lg font-semibold text-center">
                                {relatedProduct.name}
                            </p>
                            <span className="block text-gray-500 text-center">
                                100% Cotton
                            </span>
                            <div className="hot-product-item-price text-center mt-2">
                                <p className="text-red-500 font-bold">
                                    {relatedProduct.price} <sup>đ</sup>{" "}
                                    <span className="text-gray-400 line-through">
                                        443,000 <sup>đ</sup>
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
            <Footer />
        </>
    );
};

export default ProductDetail;
