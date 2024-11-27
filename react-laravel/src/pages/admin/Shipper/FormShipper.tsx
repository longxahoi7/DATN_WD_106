import React from "react";
import "bootstrap/dist/css/bootstrap.min.css";

const FormShipper = () => {
    const order = {
        orderId: "24",
        customerName: "chiurui",
        phone: "0123456789",
        address: "Năm Mới, Tân Hiệp, Huyện Chợ Lách, Tỉnh Bến Tre",
        orderDate: "2024-11-20 12:36:15",
        products: [
            {
                name: "Quần Áo Nam PN STORE",
                description:
                    "Điều Chỉnh Độ Rộng Vòng Eo Form Dáng Baggy Phong Cách Hàn Quốc Vải Co Giãn - QT CAP",
                price: "99,000 đ",
                total: "1,006,690 đ",
                image: "https://via.placeholder.com/100", // Thay thế bằng đường dẫn ảnh thực tế
            },
        ],
    };

    return (
        <div className="container mt-5" style={{ maxWidth: "600px" }}>
            <h2>Danh sách đơn hàng đang vận chuyển</h2>
            <div
                className="card mb-3"
                style={{ border: "1px solid #ddd", borderRadius: "5px" }}
            >
                <div className="card-body">
                    <h5 className="card-title">{`Mã đơn hàng: ${order.orderId}`}</h5>
                    <p>
                        <strong>Khách hàng:</strong> {order.customerName}
                    </p>
                    <p>
                        <strong>Số điện thoại:</strong> {order.phone}
                    </p>
                    <p>
                        <strong>Địa chỉ nhận hàng:</strong> {order.address}
                    </p>
                    <p>
                        <strong>Đặt hàng lúc:</strong> {order.orderDate}
                    </p>
                    <hr />
                    <h6>Sản phẩm:</h6>
                    {order.products.map((product, index) => (
                        <div
                            key={index}
                            className="mb-2 d-flex align-items-center"
                        >
                            <img
                                src={product.image}
                                alt={product.name}
                                style={{
                                    width: "100px",
                                    marginRight: "10px",
                                    background: "red",
                                }} // Kích thước ảnh
                            />
                            <div>
                                <h6>{product.name}</h6>
                                <p>{product.description}</p>
                                <p>
                                    <strong>Giá:</strong> {product.price}
                                </p>
                            </div>
                        </div>
                    ))}
                    <p style={{ fontWeight: "bold" }}>
                        Tổng tiền: {order.products[0].total}
                    </p>
                    <button
                        className="btn btn-success me-5"
                        style={{ marginTop: "10px" }}
                    >
                        Xác nhận đã giao
                    </button>
                    <button
                        className="btn btn-danger "
                        style={{ marginTop: "10px" }}
                    >
                        Hủy giao
                    </button>
                </div>
            </div>
            <h1>
                {" "}
                lưu ý : khi ấn nút xác nhận đơn hàng thì sẽ không được hủy đơn
                hàng nữa. Nếu hủy giao phải có nút input có lý do vì sao hủy
            </h1>
        </div>
    );
};

export default FormShipper;
