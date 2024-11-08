import { Footer, Header } from "antd/es/layout/layout";
import React from "react";
type Props = {};

const Location = (props: Props) => {
    return (
        <>
            <div className="bg-white p-6 rounded-lg shadow-lg flex">
                <div className="w-1/3 pr-6">
                    <h2 className="text-2xl font-bold mb-4">Tìm cửa hàng</h2>
                    <div className="mb-4">
                        <label className="block text-gray-700 mb-2">
                            Chọn tỉnh thành
                        </label>
                        <select className="w-full p-2 border border-gray-300 rounded">
                            <option>Hà Nội</option>
                            <option>Hà Nam</option>
                            <option>Nam Định</option>
                            <option>TP HỒ Chí Minh</option>
                        </select>
                    </div>
                    <div className="mb-4">
                        <label className="block text-gray-700 mb-2">
                            Chọn cửa hàng
                        </label>
                        <select className="w-full p-2 border border-gray-300 rounded">
                            <option>Đống Đa</option>
                            <option> Phủ Lý</option>
                            <option>Ý Yên</option>
                            <option>Thủ Đức</option>
                        </select>
                    </div>
                    <div className="mb-4">
                        <div className="flex items-start mb-4">
                            <i className="fas fa-map-marker-alt text-red-500 text-xl mr-2"></i>
                            <div>
                                <h3 className="font-bold">
                                    TORANO 02 CHÙA BỘC
                                </h3>
                                <p>Số 02, Chùa Bộc , Đống Đa, Hà Nội</p>
                                <p>
                                    Thời gian hoạt động:{" "}
                                    <strong>8:30 - 22:00</strong>
                                </p>
                                <p>
                                    Số điện thoại: <strong>097 640 8388</strong>
                                </p>
                                <a href="#" className="text-blue-500">
                                    Xem bản đồ
                                </a>
                            </div>
                        </div>
                        <div className="flex items-start">
                            <i className="fas fa-map-marker-alt text-red-500 text-xl mr-2"></i>
                            <div>
                                <h3 className="font-bold">
                                    TORANO 31 YÊN LÃNG
                                </h3>
                                <p>Số 31 Yên Lãng, Quận Đống Đa, TP. Hà Nội</p>
                                <p>
                                    Thời gian hoạt động:{" "}
                                    <strong>8:30 - 22:00</strong>
                                </p>
                                <p>
                                    Số điện thoại: <strong>0969963658</strong>
                                </p>
                                <a href="#" className="text-blue-500">
                                    Xem bản đồ
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="w-2/3">
                    <h2 className="text-2xl font-bold mb-4">
                        Hệ thống cửa hàng
                    </h2>
                    <div className="w-full h-full">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.702245364073!2d105.8229443154021!3d21.00311799396364!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab6c5b5b5b5b%3A0x5b5b5b5b5b5b5b5b!2s2%20P.%20Ch%C3%B9a%20B%E1%BB%99c%2C%20Kim%20Li%C3%AAn%2C%20%C4%90%E1%BB%91ng%20%C4%90a%2C%20H%C3%A0%20N%E1%BB%99i%2C%20Vietnam!5e0!3m2!1sen!2sus!4v1633021234567!5m2!1sen!2sus"
                            width="100%"
                            height="450"
                            style={{ border: 0 }}
                            loading="lazy"
                        ></iframe>
                    </div>
                </div>
            </div>
        </>
    );
};

export default Location;
