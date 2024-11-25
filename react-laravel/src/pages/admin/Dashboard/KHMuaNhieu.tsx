import React, { useEffect } from "react";

// Khai báo Global cho Highcharts nếu bạn đang sử dụng TypeScript
declare global {
    interface Window {
        Highcharts: any; // Hoặc có thể thay 'any' bằng kiểu cụ thể nếu bạn biết
    }
}

type Props = {};

const KHMuaNhieu = (props: Props) => {
    useEffect(() => {
        // Kiểm tra xem Highcharts đã được tải
        const checkHighcharts = () => {
            if (window.Highcharts) {
                window.Highcharts.chart("chart-container", {
                    chart: {
                        type: "bar",
                    },
                    title: {
                        text: "Top 5 khách hàng mua hàng nhiều nhất",
                    },
                    xAxis: {
                        categories: ["Chi Rơi", "Test", "Tiền Việt"],
                        title: {
                            text: "Khách hàng",
                        },
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: "Số tiền (VNĐ)",
                            align: "high",
                        },
                        labels: {
                            overflow: "justify",
                        },
                    },
                    plotOptions: {
                        bar: {
                            dataLabels: {
                                enabled: true,
                            },
                        },
                    },
                    legend: {
                        reversed: true,
                    },
                    credits: {
                        enabled: false,
                    },
                    series: [
                        {
                            name: "Tổng số tiền",
                            data: [2957402, 1329976, 964184.2],
                        },
                    ],
                });
            } else {
                // Nếu Highcharts chưa được tải, thử lại sau
                setTimeout(checkHighcharts, 100);
            }
        };

        checkHighcharts(); // Gọi hàm kiểm tra khi component mount
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
                <div
                    id="chart-container"
                    className="w-100"
                    style={{ height: "400px" }}
                ></div>
                <div className="text-center mt-4">
                    Thống kê từ ngày: 2024-10-01 đến 2024-11-25
                </div>
            </div>
        </div>
    );
};

export default KHMuaNhieu;
