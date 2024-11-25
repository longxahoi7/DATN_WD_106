import React from "react";

type Props = {};

const SPBanChay = (props: Props) => {
    React.useEffect(() => {
        // Kiểm tra xem Highcharts đã được tải
        const checkHighcharts = () => {
            if (window.Highcharts) {
                window.Highcharts.chart("chart-container", {
                    chart: {
                        type: "bar",
                    },
                    title: {
                        text: "",
                    },
                    xAxis: {
                        categories: [
                            "Áo Sơ Mi Tay Ngắn Nữ",
                            "Quần Âu Baggy Nam",
                            "Assumenda necessitat",
                            "Quần Âu Nam PN STORE",
                            "Omnis nulla ut adipi",
                        ],
                        title: {
                            text: "Sản phẩm",
                        },
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: "Số lượng",
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
                        layout: "vertical",
                        align: "right",
                        verticalAlign: "top",
                        x: -40,
                        y: 80,
                        floating: true,
                        borderWidth: 1,
                        backgroundColor:
                            window.Highcharts.defaultOptions.legend
                                .backgroundColor || "#FFFFFF",
                        shadow: true,
                    },
                    credits: {
                        enabled: false,
                    },
                    series: [
                        {
                            name: "Tổng số lượng",
                            data: [8, 7, 2, 1, 1],
                        },
                    ],
                });
            } else {
                // Nếu Highcharts chưa được tải, thử lại sau
                setTimeout(checkHighcharts, 100);
            }
        };

        checkHighcharts(); // Gọi hàm kiểm tra
    }, []);

    return (
        <div className="container mx-auto p-4">
            <div className="bg-white p-4 rounded shadow">
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
                    className="mb-4"
                    style={{ height: "400px" }}
                ></div>
                <div className="text-center text-gray-600">
                    Thống kê từ ngày: 2024-10-01 đến 2024-11-25
                </div>
            </div>
        </div>
    );
};

export default SPBanChay;
