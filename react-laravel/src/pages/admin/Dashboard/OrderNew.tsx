import React from "react";

type Props = {};

const OrderNew = (props: Props) => {
    return (
        <div className="container mt-4">
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
            <div className="position-relative">
                <div
                    className="d-flex justify-content-around align-items-end"
                    style={{ height: "300px" }}
                >
                    <div
                        className="bg-info"
                        style={{ width: "15%", height: "90%" }}
                    ></div>
                    <div
                        className="bg-info"
                        style={{ width: "15%", height: "90%" }}
                    ></div>
                    <div
                        className="bg-info"
                        style={{ width: "15%", height: "90%" }}
                    ></div>
                    <div
                        className="bg-info"
                        style={{ width: "15%", height: "20%" }}
                    ></div>
                    <div
                        className="bg-info"
                        style={{ width: "15%", height: "40%" }}
                    ></div>
                </div>
                <div className="d-flex justify-content-around mt-2 text-muted small">
                    <div>#LDSELI6VNC65L - (13:53:58 24-11-2024)</div>
                    <div>#P7GZDCEQUEUJK - (13:53:13 24-11-2024)</div>
                    <div>#ABYDSHJQKMFSH - (13:52:22 24-11-2024)</div>
                    <div>#JJUNCLOZADBZM - (08:30:29 24-11-2024)</div>
                    <div>#ZVTG7RDABUVTA - (18:01:10 23-11-2024)</div>
                </div>
            </div>
            <div className="text-center mt-4 text-muted">
                Thống kê từ ngày: 2024-10-01 đến 2024-11-25
            </div>
        </div>
    );
};

export default OrderNew;
