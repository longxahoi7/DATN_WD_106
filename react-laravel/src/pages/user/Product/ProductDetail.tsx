import React, { useEffect } from "react";

import { Link, useParams } from "react-router-dom";

import axios from "axios";
import { IProduct } from "../../../interface/IProduct";
import { getProductByID } from "../../../service/Product";
import { formatPrice } from "../../../untils/formatMoney";
type Props = {};
const { useState } = React;
const ProductDetail = (props: any) => {
    const [price, setPrice] = useState();
    const [size, setSize] = useState("M");
    const [quantity, setQuantity] = useState(1);
    const [color, setColor] = useState("Đen");
    const [products, setProducts] = useState<IProduct | null>(null);
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
    };
    const handleColorChange = (newColor: keyof typeof colorPrices) => {
        setColor(newColor);
    };

    const handleQuantityChange = (change: number) => {
        setQuantity((prevQuantity) => Math.max(1, prevQuantity + change));
    };
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
                    const data = await getProductByID(id);
                    setProducts(data?.product);
                    // setPrice(data.price);
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
                const response = await instance.get("/");
                const products: IProduct[] = response.data;
                console.log(products);

                if (products.length > 0) {
                    const currentProduct = products.find(
                        (p: IProduct) => p.product_id.toString() === id
                    );
                    console.log("Current product ID:", typeof id);
                    console.log("Current product ", currentProduct);
                    if (currentProduct) {
                        const relatedProducts = products.filter(
                            (p: IProduct) =>
                                p.category === currentProduct.category &&
                                p.product_id !== currentProduct.product_id
                        );
                        console.log(relatedProducts);
                        console.log("category product ", currentProduct);
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

        fetchRelatedProducts();
    }, [id]);

    return (
        <>
            <div className="container" style={{ width: "100vw" }}>
                {products && (
                    <div className="product-container flex">
                        <div
                            className="w-1/2 flex bg-pink"
                            style={{ marginRight: "-300px" }}
                        >
                            <img
                                src={
                                    products?.main_image_url
                                        ? products?.main_image_url
                                        : "https://placehold.co/276x350?text=%22No%20Image%22"
                                }
                                alt={products.name}
                                className="main-image"
                                style={{
                                    width: "550px",
                                    marginLeft: "80px",
                                }}
                            />
                        </div>
                        <div
                            className="w-1/2 items-start"
                            style={{ marginLeft: "350px" }}
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
                            <p className="text-gray-500 mb-4">
                                <span className="font-semibold">Màu sắc:</span>
                                <div className="">
                                    {products.colors.map((color) => (
                                        <p
                                            key={color.name}
                                            className="w-7 h-8 px-3 py-2 border border-[#000]"
                                            onClick={() =>
                                                setPrice(color.pivot.price)
                                            }
                                        >
                                            {color.name}
                                        </p>
                                    ))}
                                </div>
                            </p>

                            <p className="text-gray-500 mb-4">
                                <span>Kích thước:</span>
                                <div className="flex space-x-4 mt-2">
                                    {products.sizes.map((size) => (
                                        <p
                                            key={size.size_id} // Đảm bảo rằng mỗi phần tử có key duy nhất
                                            className="border border-[#000]"
                                            onClick={() =>
                                                setPrice(size.pivot.price)
                                            }
                                        >
                                            {size.name}
                                        </p>
                                    ))}
                                </div>
                            </p>
                            <div className="flex items-center mb-4">
                                <span className="mr-2">Số lượng:</span>
                                <button
                                    className="px-2 py-1 border border-gray-400 rounded hover:bg-gray-100 ml-20"
                                    onClick={() => handleQuantityChange(-1)}
                                >
                                    -
                                </button>
                                <span className="mx-4">{quantity}</span>
                                <button
                                    className="px-2 py-1 border border-gray-400 rounded hover:bg-gray-100"
                                    onClick={() => handleQuantityChange(1)}
                                >
                                    +
                                </button>
                            </div>
                            <p className="text-2xl font-bold mb-4">
                                {formatPrice(price)}
                            </p>
                            {/* Size and color selectors */}
                            <div className="flex space-x-4 mb-4">
                                <button className="bg-black text-white px-4 py-2">
                                    THÊM VÀO GIỎ
                                </button>
                                <button className="border border-black px-4 py-2 ml-10">
                                    MUA HÀNG
                                </button>
                            </div>
                            <div className="max-w-lg">
                                <p className="text-lg font-semibold mb-1">
                                    Mô tả
                                </p>
                                <hr className="border-t border-gray-700 mb-2" />
                                <p className="mb-2 break-words">
                                    {products.description}
                                </p>
                            </div>
                        </div>
                    </div>
                )}
                <hr />
                <h2 className="title-tuong-tu mb-4 text-center">
                    Sản phẩm tương tự
                </h2>
                <span className="block h-1 bg-gray-400 mx-auto w-1/6"></span>
                <div className="grid grid-cols-4 gap-4 mt-4">
                    {relatedProducts.map((relatedProduct) => (
                        <figure
                            className="snip1585"
                            key={relatedProduct.product_id}
                        >
                            <img
                                src={`${relatedProduct.image}`}
                                alt={relatedProduct.name}
                                className="w-full h-full object-cover"
                            />
                            <figcaption>
                                <h6>
                                    {relatedProduct.name} <br />
                                    <span className="pt-3">
                                        {relatedProduct.price} <sup>đ</sup>{" "}
                                    </span>
                                    <br />
                                </h6>
                                <button className="add-to-cart-button">
                                    <i className="fa fa-shopping-cart"></i> Thêm
                                    giỏ hàng
                                </button>
                            </figcaption>
                            <Link
                                to={`/product-detail/${relatedProduct.product_id}`}
                                className="product-detail-link"
                            />
                        </figure>
                    ))}
                </div>
            </div>
        </>
    );
};

export default ProductDetail;
