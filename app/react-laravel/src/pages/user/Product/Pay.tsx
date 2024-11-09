import { Footer, Header } from "antd/es/layout/layout";
import React from "react";

type Props = {};

const Pay = (props: Props) => {
    const [discount, setDiscount] = React.useState(0);
    const [code, setCode] = React.useState("");

    const handleApplyDiscount = () => {
        if (code === "huong123") {
            setDiscount(10000);
        } else if (code === "long") {
            setDiscount(50000);
        } else {
            setDiscount(0);
        }
    };
    return (
        <>
            <div className="max-w-7xl mx-auto p-4">
                <div className="bg-white p-6 rounded-lg shadow-md">
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h2 className="text-lg font-semibold mb-4">
                                Thông tin giao hàng
                            </h2>
                            <div className="mb-4">
                                <div className="flex items-center mb-2">
                                    <div className="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center">
                                        <i className="fas fa-user text-gray-500"></i>
                                    </div>
                                    <div className="ml-4">
                                        <p className="font-semibold">
                                            Hà Hương
                                        </p>
                                        <p className="text-sm text-gray-500">
                                            (huong@gmail.com)
                                        </p>
                                    </div>
                                </div>

                                <div className="mb-4">
                                    <label className="block text-sm font-medium text-gray-700">
                                        Tên đầy đủ
                                    </label>
                                    <input
                                        type="text"
                                        className="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    />
                                </div>
                                <div className="mb-4">
                                    <label className="block text-sm font-medium text-gray-700">
                                        Số điện thoại
                                    </label>
                                    <input
                                        type="text"
                                        className="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    />
                                </div>
                                <div className="mb-4">
                                    <label className="block text-sm font-medium text-gray-700">
                                        Địa chỉ
                                    </label>
                                    <input
                                        type="text"
                                        className="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    />
                                </div>
                                <div className="grid grid-cols-3 gap-4 mb-4">
                                    <div>
                                        <label className="block text-sm font-medium text-gray-700">
                                            Tỉnh / thành
                                        </label>
                                        <select className="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option>Hà Nội</option>
                                            <option>TP. Hồ Chí Minh</option>
                                            <option>Đà Nẵng</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label className="block text-sm font-medium text-gray-700">
                                            Quận / huyện
                                        </label>
                                        <select className="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option>Quận 1</option>
                                            <option>Quận 2</option>
                                            <option>Quận 3</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label className="block text-sm font-medium text-gray-700">
                                            Phường / xã
                                        </label>
                                        <select className="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option>Phường 1</option>
                                            <option>Phường 2</option>
                                            <option>Phường 3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <h2 className="text-lg font-semibold mb-4">
                                Phương thức vận chuyển
                            </h2>
                            <div className="border border-gray-300 rounded-lg p-4 mb-4">
                                <div className="flex items-center justify-center h-32">
                                    <div className="text-center">
                                        <i className="fas fa-box-open text-4xl text-gray-300 mb-2"></i>
                                        <p className="text-gray-500">
                                            Vui lòng chọn tỉnh / thành để có
                                            danh sách phương thức vận chuyển.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <h2 className="text-lg font-semibold mb-4">
                                Phương thức thanh toán
                            </h2>
                            <div className="border border-gray-300 rounded-lg p-4 mb-4">
                                <div className="flex items-center mb-4">
                                    <input
                                        type="radio"
                                        name="payment"
                                        className="mr-2"
                                        checked
                                    />
                                    <div>
                                        <p className="font-semibold">
                                            Thanh toán khi giao hàng (COD)
                                        </p>
                                        <p className="text-sm text-gray-500">
                                            Giao hàng và thanh toán tận nơi trên
                                            Toàn Quốc. Miễn phí ship với đơn
                                            hàng trên 500k. Thời gian giao hàng:
                                            HN trong 12h. Tỉnh thành khác từ 2-4
                                            ngày.
                                        </p>
                                    </div>
                                </div>
                                <div className="flex items-center mb-4">
                                    <input
                                        type="radio"
                                        name="payment"
                                        className="mr-2"
                                    />
                                    <div>
                                        <p className="font-semibold">
                                            Chuyển khoản qua ngân hàng
                                        </p>
                                    </div>
                                    <p className="text-sm text-gray-500">
                                        Sau khi đặt hàng, bạn sẽ nhận được email
                                        hướng dẫn thanh toán. *Nếu bạn cần giao
                                        gấp trong 2h tại HN. Hãy liên hệ ngay
                                        với Gentlemanor nhé!
                                    </p>
                                </div>
                                <div className="flex items-center">
                                    <input
                                        type="radio"
                                        name="payment"
                                        className="mr-2"
                                    />
                                    <div>
                                        <p className="font-semibold">
                                            Chuyển khoản qua ví điện tử Momo
                                        </p>
                                        <img
                                            src="https://placehold.co/100x100"
                                            alt="QR code for Momo payment"
                                            className="w-24 h-24 object-cover rounded-md mt-2"
                                        />
                                    </div>
                                </div>
                            </div>
                            <button className="bg-blue-500 text-white py-2 px-4 rounded-md">
                                Hoàn tất đơn hàng
                            </button>
                        </div>
                        <div>
                            <div className="border border-gray-300 rounded-lg p-4 mb-4">
                                <div className="flex items-center mb-4">
                                    <img
                                        src="https://placehold.co/50x50"
                                        alt="Áo Thun Polo Nam ATP0039"
                                        className="w-12 h-12 object-cover rounded-md mr-4"
                                    />
                                    <div>
                                        <p className="font-semibold">
                                            Áo Thun Polo Nam ATP0039
                                        </p>
                                        <p className="text-sm text-gray-500">
                                            M / Đen
                                        </p>
                                        <p className="font-semibold">
                                            280,000₫
                                        </p>
                                    </div>
                                </div>
                                <div className="mb-4">
                                    <label className="block text-sm font-medium text-gray-700">
                                        Mã giảm giá
                                    </label>
                                    <div className="flex">
                                        <input
                                            type="text"
                                            className="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-l-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            value={code}
                                            onChange={(e) =>
                                                setCode(e.target.value)
                                            }
                                        />
                                        <button
                                            className="bg-gray-200 text-gray-700 py-2 px-4 rounded-r-md"
                                            onClick={handleApplyDiscount}
                                        >
                                            Sử dụng
                                        </button>
                                    </div>
                                </div>

                                <div className="flex justify-between mb-2">
                                    <p className="text-gray-700">Tạm tính</p>
                                    <p className="font-semibold">280,000₫</p>
                                </div>
                                <div className="flex justify-between mb-2">
                                    <p className="text-gray-700">
                                        Phí vận chuyển
                                    </p>
                                    <p className="font-semibold">-</p>
                                </div>
                                <div className="flex justify-between font-semibold text-lg">
                                    <p>Tổng cộng</p>
                                    <p>{280000 - discount}₫</p>
                                </div>
                            </div>
                            <button className="bg-gray-200 text-gray-700 py-2 px-4 rounded-md w-full">
                                Giỏ hàng
                            </button>
                        </div>
                    </div>
                </div>
                <p className="text-center text-gray-500 text-sm mt-6">
                    Powered by Haravan
                </p>
            </div>
        </>
    );
};

export default Pay;
