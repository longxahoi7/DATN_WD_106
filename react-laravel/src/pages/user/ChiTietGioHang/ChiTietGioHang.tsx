import React, { useEffect, useState } from 'react';
import '../../../style/chiTietGioHang.css';

interface CartItem {
  id: number;
  name: string;
  price: number;
  quantity: number;
  image: string;
}

const ChiTietGioHang = () => {
  const [items, setItems] = useState<CartItem[]>([]);
  const token = localStorage.getItem('token'); // Lấy token từ localStorage

  useEffect(() => {
    const fetchCartItems = async () => {
      try {
        const response = await fetch("http://localhost:8000/api/users/cart/list-cart", {
          method: "GET",
          headers: {
            Authorization: `Bearer ${token}`,
            "Content-Type": "application/json",
          },
        });

        if (!response.ok) {
          throw new Error("Không thể lấy dữ liệu giỏ hàng");
        }

        const data = await response.json();
        setItems(data.cart || []); // Gán dữ liệu vào state (giả định `data.cart` là danh sách sản phẩm)
      } catch (error) {
        console.error("Lỗi khi lấy dữ liệu giỏ hàng:", error);
      }
    };

    fetchCartItems();
  }, [token]);

  const updateQuantity = (id: number, increment: boolean) => {
    setItems((prevItems) =>
      prevItems.map((item) =>
        item.id === id
          ? { ...item, quantity: increment ? item.quantity + 1 : Math.max(1, item.quantity - 1) }
          : item
      )
    );
  };

  const removeItem = (id: number) => {
    setItems((prevItems) => prevItems.filter((item) => item.id !== id));
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
                        <th>
                          <input type="checkbox" />
                        </th>
                        <th className="pro-thumbnail">Hình ảnh sản phẩm</th>
                        <th className="pro-title">Sản Phẩm</th>
                        <th className="pro-price">Giá</th>
                        <th className="pro-quantity">Số lượng</th>
                        <th className="pro-subtotal">Tổng</th>
                        <th className="pro-remove">Thao tác</th>
                      </tr>
                    </thead>
                    <tbody>
                      {items.map((item) => (
                        <tr key={item.id}>
                          <td>
                            <input type="checkbox" />
                          </td>
                          <td className="pro-thumbnail">
                            <a href="#">
                              <img className="img-fluid" src={item.image} alt="Product" />
                            </a>
                          </td>
                          <td className="pro-title">
                            <a href="#">{item.name}</a>
                          </td>
                          <td className="pro-price">
                            <span>${item.price.toFixed(2)}</span>
                          </td>
                          <td className="pro-quantity">
                            <div className="quantity-control">
                              <button onClick={() => updateQuantity(item.id, false)}>-</button>
                              <input type="text" value={item.quantity} readOnly />
                              <button onClick={() => updateQuantity(item.id, true)}>+</button>
                            </div>
                          </td>
                          <td className="pro-subtotal">
                            <span>${(item.price * item.quantity).toFixed(2)}</span>
                          </td>
                          <td className="pro-remove">
                            <button onClick={() => removeItem(item.id)}>
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
                    <a href="#" className="btn btn-sqr">
                      Cập nhật giỏ hàng
                    </a>
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
                            <td>
                              $
                              {items
                                .reduce((total, item) => total + item.price * item.quantity, 0)
                                .toFixed(2)}
                            </td>
                          </tr>
                          <tr>
                            <td>Phí vận chuyển</td>
                            <td>$70</td>
                          </tr>
                          <tr className="total">
                            <td>Tổng chi phí</td>
                            <td className="total-amount">
                              $
                              {(
                                items.reduce(
                                  (total, item) => total + item.price * item.quantity,
                                  0
                                ) + 70
                              ).toFixed(2)}
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <a href="checkout.html" className="btn btn-sqr d-block">
                    Thanh toán
                  </a>
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
