// FormDonHang.tsx
import React, { useState } from "react";
import { Link, useNavigate } from "react-router-dom";

type Props = {};

const FormDonHang = (props: Props) => {
    const navigate = useNavigate();
    const [selectedOrder, setSelectedOrder] = useState(null);

    const handleViewDetails = (order) => {
        navigate(`/order-detail/${order.id}`); // Điều hướng tới trang chi tiết đơn hàng
    };

    return (
        <div className="container mt-4">
            <div className="form-row mb-4">
                <div className="col">
                    <input
                        type="date"
                        className="form-control"
                        placeholder="Từ ngày"
                    />
                </div>
                <div className="col-auto">
                    <span>-</span>
                </div>
                <div className="col">
                    <input
                        type="date"
                        className="form-control"
                        placeholder="Đến ngày"
                    />
                </div>
            </div>
            <button className="btn btn-success mb-4">CHỌN LẠI</button>
            <table className="table table-bordered">
                <thead className="thead-light">
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Tình trạng</th>
                        <th>Khách hàng</th>
                        <th>Tổng tiền</th>
                        <th>Ngày mua hàng</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    {[
                        {
                            id: 36,
                            status: "Đã giao hàng",
                            customer: "chiuroi",
                            total: "977.000 đ",
                            date: "2024-11-24 13:55:58",
                            icon: "fa-check-circle",
                            color: "text-success",
                        },
                        {
                            id: 35,
                            status: "Chờ xác nhận",
                            customer: "chiuroi",
                            total: "977.000 đ",
                            date: "2024-11-24 13:53:13",
                            icon: "fa-hourglass-half",
                            color: "text-warning",
                        },
                        {
                            id: 34,
                            status: "Chờ xác nhận",
                            customer: "chiuroi",
                            total: "977.000 đ",
                            date: "2024-11-24 13:52:22",
                            icon: "fa-hourglass-half",
                            color: "text-warning",
                        },
                        {
                            id: 33,
                            status: "Đã giao hàng",
                            customer: "chiuroi",
                            total: "190.000 đ",
                            date: "2024-11-24 08:30:29",
                            icon: "fa-check-circle",
                            color: "text-success",
                        },
                        {
                            id: 32,
                            status: "Đã hoàn thành",
                            customer: "chiuroi",
                            total: "389.000 đ",
                            date: "2024-11-23 18:01:10",
                            icon: "fa-check-circle",
                            color: "text-success",
                        },
                        {
                            id: 31,
                            status: "Chờ xác nhận",
                            customer: "N/A",
                            total: "75 đ",
                            date: "2024-11-22 08:16:21",
                            icon: "fa-hourglass-half",
                            color: "text-warning",
                        },
                    ].map((order) => (
                        <tr key={order.id}>
                            <td>{order.id}</td>
                            <td>
                                <i
                                    className={`fas ${order.icon} ${order.color}`}
                                ></i>{" "}
                                {order.status}
                            </td>
                            <td>{order.customer}</td>
                            <td>{order.total}</td>
                            <td>{order.date}</td>
                            <td>
                                <Link
                                    to={`/admin/detailorder`}
                                    className="fas fa-eye text-success"
                                >
                                    {/* <i
                                        className="fas fa-eye text-success"
                                        // onClick={() => handleViewDetails(order)}
                                    ></i> */}
                                </Link>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
};

export default FormDonHang;
