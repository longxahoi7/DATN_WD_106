import React, { useState } from 'react';
import '../../../style/chiTietGioHang.css';

type Product = {
  id: number;
  name: string;
  price: number;
  quantity: number;
  img: string;
};

const ChiTietGioHang = () => {
  const [products, setProducts] = useState<Product[]>([
    { id: 1, name: 'Diamond Exclusive Ornament', price: 295.0, quantity: 1, img: 'assets/img/product/product-1.jpg' },
    { id: 2, name: 'Perfect Diamond Jewelry', price: 275.0, quantity: 2, img: 'assets/img/product/product-2.jpg' },
    { id: 3, name: 'Handmade Golden Necklace', price: 295.0, quantity: 1, img: 'assets/img/product/product-3.jpg' },
    { id: 4, name: 'Diamond Exclusive Ornament', price: 110.0, quantity: 3, img: 'assets/img/product/product-4.jpg' },
  ]);

  const updateQuantity = (id: number, increment: boolean) => {
    setProducts((prevProducts) =>
      prevProducts.map((product) =>
        product.id === id
          ? { ...product, quantity: increment ? product.quantity + 1 : Math.max(1, product.quantity - 1) }
          : product
      )
    );
  };

  const removeProduct = (id: number) => {
    setProducts((prevProducts) => prevProducts.filter((product) => product.id !== id));
  };

  return (
    <div>
      <div className="cart-main-wrapper section-padding">
        <div className="container">
          <div className="section-bg-color">
            <div className="row">
              <div className="col-lg-12">
                {/* Cart Table Area */}
                <div className="cart-table table-responsive">
                  <table className="table table-bordered">
                    <thead>
                      <tr>
                        <th><input type="checkbox" /></th>
                        <th className="pro-thumbnail">Hình ảnh sản phẩm</th>
                        <th className="pro-title">Sản Phẩm</th>
                        <th className="pro-price">Giá</th>
                        <th className="pro-quantity">Số lượng</th>
                        <th className="pro-subtotal">Tổng</th>
                        <th className="pro-remove">Thao tác</th>
                      </tr>
                    </thead>
                    <tbody>
                      {products.map((product) => (
                        <tr key={product.id}>
                          <td><input type="checkbox" /></td>
                          <td className="pro-thumbnail">
                            <a href="#"><img className="img-fluid" src={product.img} alt="Product" /></a>
                          </td>
                          <td className="pro-title"><a href="#">{product.name}</a></td>
                          <td className="pro-price"><span>${product.price.toFixed(2)}</span></td>
                          <td className="pro-quantity">
                            <div className="quantity-control">
                              <button onClick={() => updateQuantity(product.id, false)}>-</button>
                              <input type="text" value={product.quantity} readOnly />
                              <button onClick={() => updateQuantity(product.id, true)}>+</button>
                            </div>
                          </td>
                          <td className="pro-subtotal"><span>${(product.price * product.quantity).toFixed(2)}</span></td>
                          <td className="pro-remove">
                            <button onClick={() => removeProduct(product.id)}>
                              <i className="fa fa-trash-o"></i>
                            </button>
                          </td>
                        </tr>
                      ))}
                    </tbody>
                  </table>
                </div>
                {/* Cart Update Option */}
                <div className="cart-update-option d-block d-md-flex justify-content-between">
                  <div className="apply-coupon-wrapper">
                    <form action="#" method="post" className="d-block d-md-flex">
                      <input type="text" placeholder="Vui lòng nhập mã giảm giá" required />
                      <button className="btn btn-sqr">Áp dụng mã giảm giá</button>
                    </form>
                  </div>
                  <div className="cart-update">
                    <a href="#" className="btn btn-sqr">Cập nhật giỏ hàng</a>
                  </div>
                </div>
              </div>
            </div>
            <div className="row">
              <div className="col-lg-5 ml-auto">
                {/* Cart Calculation Area */}
                <div className="cart-calculator-wrapper">
                  <div className="cart-calculate-items">
                    <h6>Tổng đơn hàng</h6>
                    <div className="table-responsive">
                      <table className="table">
                        <tbody>
                          <tr>
                            <td>Tổng giá sản phẩm</td>
                            <td>$230</td>
                          </tr>
                          <tr>
                            <td>Phí vận chuyển</td>
                            <td>$70</td>
                          </tr>
                          <tr className="total">
                            <td>Tổng chi phí</td>
                            <td className="total-amount">$300</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <a href="checkout.html" className="btn btn-sqr d-block">Thanh toán</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ChiTietGioHang;
