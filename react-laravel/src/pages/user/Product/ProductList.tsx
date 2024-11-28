import React, { useEffect, useState } from "react";
import { Link, useParams } from "react-router-dom";
import axios from "axios"; // Import axios
import { IProduct } from "../../../interface/IProduct"; // Import interface IProduct
import SlideShow from "../../../layout/slideShow/SlideShow";
import "../../../style/productList.css";

const ProductList = () => {
    const { category } = useParams<{ category: string }>(); // Lấy tham số category từ URL
    const [products, setProducts] = useState<IProduct[]>([]); // Khởi tạo với mảng rỗng

    useEffect(() => {
        const fetchProducts = async () => {
            try {
                const response = await axios.get("users/products/list-product"); // Dùng axios để fetch dữ liệu
                console.log(response.data.data, "data"); // In ra dữ liệu sản phẩm

                setProducts(response.data.data); // Cập nhật danh sách sản phẩm
            } catch (error) {
                console.error("Failed to fetch products", error);
            }
        };

        fetchProducts();
    }, [category]); // Fetch lại dữ liệu khi category thay đổi

    return (
        <>
            <SlideShow />
            <div className="button-header">
                <button>
                    Gentle Manor - Sản Phẩm<i className="fa fa-star"></i>
                </button>
                <hr />
            </div>
            <div className="product-list">
                {Array.isArray(products) && products.length > 0 ? (
                    products.map((item) => (
                        <figure className="snip1585" key={item.product_id}>
                            <img
                                src={
                                    item.image ||
                                    "https://placehold.co/276x350?text=Không%20có%20ảnh"
                                }
                                alt={item.name}
                                className="w-full h-full object-cover"
                            />
                            <figcaption>
                                <h6>
                                    {item.name} <br />
                                    <span className="pt-3">
                                        {item.price} <sup>đ</sup>{" "}
                                    </span>
                                    <br />
                                </h6>
                                <button className="add-to-cart-button">
                                    <i className="fa fa-shopping-cart"></i> Mua
                                    Ngay
                                </button>
                            </figcaption>
                            <Link
                                to={`/product-detail/${item.product_id}`}
                                className="product-detail-link"
                            />
                        </figure>
                    ))
                ) : (
                    <p>Không có sản phẩm nào trong danh mục này.</p>
                )}
            </div>
        </>
    );
};

export default ProductList;
