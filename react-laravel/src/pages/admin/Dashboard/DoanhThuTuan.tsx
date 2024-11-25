import React, { useEffect } from "react";
import { Chart, registerables } from "chart.js"; // Đảm bảo bạn đã cài đặt chart.js

// Đăng ký các thành phần của Chart.js
Chart.register(...registerables);

type Props = {};

const DoanhThuTuan = (props: Props) => {
    useEffect(() => {
        const canvasElement = document.getElementById(
            "revenueChart"
        ) as HTMLCanvasElement;
        const ctx = canvasElement?.getContext("2d");

        // Khai báo biến revenueChart với kiểu Chart
        let revenueChart: Chart | null = null;

        if (ctx) {
            // Nếu biểu đồ đã tồn tại, hủy nó
            if (revenueChart) {
                revenueChart.destroy();
            }

            // Tạo mới biểu đồ
            revenueChart = new Chart(ctx, {
                type: "line",
                data: {
                    labels: [
                        "19-11-2024",
                        "20-11-2024",
                        "21-11-2024",
                        "22-11-2024",
                        "23-11-2024",
                        "24-11-2024",
                        "25-11-2024",
                    ],
                    datasets: [
                        {
                            label: "Doanh thu",
                            data: [0, 600000, 200000, 0, 0, 1800000, 0],
                            borderColor: "#00bcd4",
                            backgroundColor: "rgba(0, 188, 212, 0.2)",
                            fill: false,
                            tension: 0.1,
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
        }

        // Cleanup function to destroy the chart on component unmount
        return () => {
            if (revenueChart) {
                revenueChart.destroy();
            }
        };
    }, []); // Chạy một lần khi component mount

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
                    <span className="text-secondary">Biểu đồ doanh thu</span>
                </div>
                <div className="d-flex justify-content-center mb-4">
                    <div className="d-flex align-items-center">
                        <div
                            className="bg-info mr-2"
                            style={{ width: "16px", height: "16px" }}
                        ></div>
                        <span className="text-secondary">Doanh thu</span>
                    </div>
                </div>
                <canvas id="revenueChart" className="mb-4"></canvas>
                <div className="text-center text-secondary">
                    Tổng doanh thu: 2.957.402đ
                </div>
            </div>
        </div>
    );
};

export default DoanhThuTuan;
