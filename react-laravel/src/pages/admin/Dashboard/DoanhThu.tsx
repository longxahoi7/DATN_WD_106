import React, { useEffect, useRef } from "react";
import { Chart, registerables } from "chart.js";

// Đăng ký các thành phần của Chart.js
Chart.register(...registerables);

const DoanhThu = () => {
    const chartRef = useRef<HTMLCanvasElement | null>(null); // Định nghĩa kiểu cho chartRef

    useEffect(() => {
        // Kiểm tra nếu chartRef.current không phải là null
        if (chartRef.current) {
            const ctx = chartRef.current.getContext("2d");

            if (ctx) {
                // Kiểm tra ctx không phải là null
                const revenueChart = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: ["Tổng doanh thu"],
                        datasets: [
                            {
                                label: "Tổng doanh thu (5251562)",
                                data: [5251562],
                                backgroundColor: "rgba(54, 162, 235, 0.2)",
                                borderColor: "rgba(54, 162, 235, 1)",
                                borderWidth: 1,
                            },
                        ],
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                            },
                        },
                    },
                });

                // Dọn dẹp khi component bị hủy
                return () => {
                    revenueChart.destroy();
                };
            }
        }
    }, []);

    return (
        <div className="container mt-4">
            <div className="bg-white p-4 rounded shadow-sm">
                <div className="d-flex justify-content-between align-items-center mb-4">
                    <input
                        type="text"
                        placeholder="Từ ngày"
                        className="form-control w-50 mr-2"
                    />
                    <span>-</span>
                    <input
                        type="text"
                        placeholder="Đến ngày"
                        className="form-control w-50 ml-2"
                    />
                </div>
                <button className="btn btn-primary mb-4">CHỌN LẠI</button>
                <div className="bg-gray-100 p-4">
                    <div className="flex justify-center space-x-8 border-b-2 border-gray-300">
                        <a
                            href="doanhthu"
                            className="text-gray-600 py-2 no-underline"
                        >
                            TỔNG DOANH THU
                        </a>
                        <a
                            href="khmuanhieu"
                            className="text-gray-600 py-2 no-underline"
                        >
                            5 KHÁCH HÀNG MUA NHIỀU NHẤT
                        </a>
                        <a
                            href="sanphambanchay"
                            className="text-gray-600 py-2 no-underline"
                        >
                            5 SẢN PHẨM BÁN CHẠY NHẤT
                        </a>
                        <a
                            href="ordernew"
                            className="text-gray-600 py-2 no-underline"
                        >
                            5 ĐƠN HÀNG MỚI NHẤT
                        </a>
                        <a
                            href="doanhthutuan"
                            className="text-gray-600 py-2 no-underline"
                        >
                            DOANH THU TUẦN QUA
                        </a>
                    </div>
                </div>
                <div className="text-center mb-4">
                    <p className="text-muted">
                        Tổng doanh thu từ 01-10-2024 đến 25-11-2024
                    </p>
                    <div className="d-flex justify-content-center align-items-center">
                        <div
                            className="bg-primary rounded-circle"
                            style={{
                                width: "16px",
                                height: "16px",
                                marginRight: "8px",
                            }}
                        ></div>
                        <p className="text-muted">Tổng doanh thu (5251562)</p>
                    </div>
                </div>
                <div className="d-flex justify-content-center mb-4">
                    <div className="w-75">
                        <canvas ref={chartRef} className="h-64"></canvas>
                    </div>
                </div>
                <div className="text-center text-muted">
                    <p>Thống kê từ ngày: 2024-10-01 đến 2024-11-25</p>
                </div>
            </div>
        </div>
    );
};

export default DoanhThu;
