import React, { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import { IProduct } from "src/interface/IProduct";
import Footer from "../Footer/footer";
import Header from "../Header/header";

const Products: React.FC = () => {
  const { category } = useParams<{ category: string }>(); //lấy từ URL
  console.log(category);

  const [products, setProducts] = useState<IProduct[]>([]);
  useEffect(() => {
    const fetchProducts = async () => {
      try {
        const response = await fetch(
          `http://localhost:3000/products?category=${category}`
        );
        const data = await response.json();
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
      <section
        className="hot-product bg-gray-100 p-8"
        style={{ height: "3000px" }}
      >
        <div className="container mx-auto">
          <div className="row-grid text-center mb-8">
            <p className="heading-text text-2xl font-bold">San Pham Noi Bat</p>
          </div>
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            {products.map((item) => (
              <div className="text-center product-cart border mb-28">
                <img
                  src={item.image}
                  alt={item.name}
                  className="w-full h-full object-cover"
                />
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
                <button className="add-to-cart-btn"> Add to Cart</button>
              </div>
            ))}
          </div>
        </div>
      </section>
      <Footer />
    </>
  );
};

export default Products;
