import React, { useEffect, useState } from "react";
import { Link, useParams } from "react-router-dom";
import { IProduct } from "../../../interface/IProduct";
import "../../../style/productList.css";

const Product = () => {
    const { category } = useParams<{ category: string }>(); // lấy từ URL
    console.log(category);

    const [products, setProducts] = useState<IProduct[]>([]);

    useEffect(() => {
        const fetchProducts = async () => {
            try {
                const response = await fetch(
                    `http://localhost:8000/api/users/products/list-product`
                );
                const data = await response.json();
                console.log(data);

                // Lọc sản phẩm nếu có danh mục (category)
                const filteredProducts = category
                    ? data.filter(
                          (product: IProduct) => product.category === category
                      )
                    : data;

                setProducts(filteredProducts); // Cập nhật danh sách sản phẩm
            } catch (error) {
                console.error("Failed to fetch products", error);
            }
        };

        fetchProducts();
    }, [category]); // Fetch lại dữ liệu khi category thay đổi

    return (
        <>
            <div className="button-header mt-5">
                <button>
                    Gentle Manor - Sản Phẩm<i className="fa fa-star"></i>
                </button>
                <hr />
            </div>
            <div className="product-list">
                {products.length > 0 ? (
                    products.map((item) => (
                        <figure className="snip1585" key={item.product_id}>
                            <img
                                src={`${item.image}`}
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
                            <a
                                href={`/product-detail/${item.product_id}`}
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

export default Product;
