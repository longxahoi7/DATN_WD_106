import React, { useEffect } from "react";

import Footer from "../Footer/footer";
import Header from "../Header/header";
import { IProduct } from "../../interface/IProduct";
import { useParams } from "react-router-dom";
type Props = {};
const { useState } = React;
const ProductDetail = (props: Props) => {
  const [price, setPrice] = useState(1290000);
  const [size, setSize] = useState("M");
  const [quantity, setQuantity] = useState(1);
  const [color, setColor] = useState("Đen");
  const sizePrices = {
    S: 1290000,
    M: 1290000,
    L: 1390000,
    XL: 1490000,
  };
  const colorPrices = {
    Đen: 1290000,
    Xanh: 1390000,
    Đỏ: 1490000,
    Trắng: 1590000,
  };

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

  return (
    <>
      <Header />
      <div className="container mx-auto p-4">
        <div className="flex">
          <div className="w-1/2 flex">
            <img
              src=""
              alt="Main product image"
              className="w-full main-image"
            />
          </div>
          <div className="w-1/2 pl-8">
            <h1 className="text-2xl font-bold mb-2">
              QUẦN SUÔNG BLACK TUYTSI KHUY KIỂU
            </h1>
            <p className="text-gray-500 mb-2">SKU: 23420007</p>
            <div className="flex items-center mb-4">
              <div className="text-yellow-500">
                <i className="fas fa-star"></i>
                <i className="fas fa-star"></i>
                <i className="fas fa-star"></i>
                <i className="fas fa-star"></i>
                <i className="fas fa-star"></i>
              </div>
              <span className="ml-2 text-gray-500">(0 đánh giá)</span>
            </div>
            <p className="text-gray-500 mb-4">Màu sắc: {color}</p>
            <p className="text-2xl font-bold mb-4">{price.toLocaleString()}₫</p>
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
            <div className="border-t border-gray-300 pt-4">
              <button className="text-gray-500 hover:underline">
                Chi tiết
              </button>
              <button className="text-gray-500 hover:underline ml-4">
                Tính năng nổi bật
              </button>
              <button className="text-gray-500 hover:underline ml-4">
                Hướng dẫn
              </button>
            </div>
            <p className="text-gray-500 mt-4">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque
              nisl eros, pulvinar facilisis justo mollis, auctor consequat urna.
            </p>
          </div>
        </div>

        <h2 className="text-xl font-bold mb-4">Sản phẩm tương tự</h2>
        <div className="grid grid-cols-4 gap-4 mt-4">
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
              <button className="add-to-cart-btn"> Add to Cart</button>
            </div>
          ))}
        </div>
      </div>
      <Footer />
    </>
  );
};

export default ProductDetail;
