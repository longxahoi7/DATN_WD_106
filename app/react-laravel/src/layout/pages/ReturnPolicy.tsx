import React from "react";
import Footer from "../Footer/footer";
import { Link } from "react-router-dom";
import Header from "../Header/header";

type Props = {};

const ReturnPolicy = (props: Props) => {
    return (
        <>
            <Header />
            <div className="p-4" style={{ width: "100vw" }}>
                <div className="flex">
                    <div className="w-1/4 p-4">
                        <div className="border p-4">
                            <h2 className="font-bold mb-4">DANH MỤC TRANG</h2>
                            <hr className="border-black border-t-2 mt-1" />
                            <ul>
                                <li className="mb-2">
                                    <Link
                                        to="/huong-dan-mua-hang"
                                        className="text-black"
                                    >
                                        Hướng dẫn mua hàng
                                    </Link>
                                </li>
                                <li className="mb-2">
                                    <Link
                                        to="/khach-hang-than-thiet"
                                        className="text-black"
                                    >
                                        Khách hàng thân thiết
                                    </Link>
                                </li>
                                <li className="mb-2">
                                    <Link
                                        to="/huong-dan-doi-hang"
                                        className="text-black"
                                    >
                                        Chính sách đổi hàng
                                    </Link>
                                </li>

                                <li className="mb-2">
                                    <Link
                                        to="/doi-tac-san-xuat"
                                        className="text-black"
                                    >
                                        Đối tác sản xuất
                                    </Link>
                                </li>
                                <li className="mb-2">
                                    <Link
                                        to="/huong-dan-bao-quan"
                                        className="text-black"
                                    >
                                        Hướng dẫn bảo quản
                                    </Link>
                                </li>
                            </ul>
                            <hr className="border-black mt-4" />
                        </div>
                        <div className="mt-4">
                            <img
                                src="../../../public/image/one.png"
                                alt="Placeholder image of a store front with signage"
                            />
                        </div>
                    </div>
                    <div className="w-3/4 pl-4">
                        <h1 className="text-xl font-bold mb-4">
                            Chính sách đổi hàng
                        </h1>

                        <div className="bg-blue-500 text-white p-4 mb-4">
                            <h2 className="text-center text-lg font-bold">
                                HƯỚNG DẪN ĐỔI HÀNG
                            </h2>
                            <div className="text-center mt-2">
                                <i className="fas fa-shopping-bag text-4xl"></i>
                            </div>
                        </div>
                        <div className="mb-4">
                            <h3 className="font-bold text-blue-500">
                                ĐIỀU KIỆN ĐỔI HÀNG
                            </h3>
                            <ul className="list-disc pl-5">
                                <li>
                                    Thời gian đổi trong 7 ngày, kể từ ngày xuất
                                    hóa đơn.
                                </li>
                                <li>
                                    Có hóa đơn mua hàng, còn nguyên tag giá.
                                </li>
                                <li>
                                    Chưa qua sử dụng, giặt ủi, có mùi lạ, chưa
                                    cắt khuy...
                                </li>
                                <li>
                                    Đổi sản phẩm có giá trị bằng hoặc lớn hơn.
                                    Sản phẩm đổi có giá trị thấp hơn, sẽ không
                                    hoàn lại tiền thừa.
                                </li>
                                <li>Thời gian đổi hàng từ 14h - 22h</li>
                            </ul>
                        </div>
                        <div className="mb-4">
                            <h3 className="font-bold text-blue-500">
                                ĐỔI HÀNG ONLINE
                            </h3>
                            <ul className="list-disc pl-5">
                                <li>
                                    Gọi vào tổng đài (028) 7300 6200 hoặc inbox
                                    qua Fanpage facebook.com/gentlemanorvietnam
                                    để được hướng dẫn.
                                </li>
                                <li>
                                    Quý khách vui lòng QUAY LẠI VIDEO đóng hàng
                                    và gửi lại shop Video, để Gentlemanor đối
                                    chiếu với đơn vị vận chuyển trong trường hợp
                                    thất lạc hàng hoặc có vấn đề phát sinh.
                                </li>
                                <li>
                                    Khi shipper giao hàng quý khách vui lòng gửi
                                    lại hàng đổi và nhận hàng mới. Sau đó thanh
                                    toán phí ship đổi hàng (HCM 30k - tỉnh thành
                                    45k) là xong ạ.
                                </li>
                            </ul>
                        </div>
                        <div className="mb-4">
                            <h3 className="font-bold text-blue-500">LƯU Ý</h3>
                            <ul className="list-disc pl-5">
                                <li>Một hóa đơn chỉ được đổi 1 lần.</li>
                                <li>
                                    Sản phẩm khuyến mãi, hàng phụ kiện không hỗ
                                    trợ chính sách đổi hàng.
                                </li>
                                <li>
                                    Kenta chỉ hỗ trợ đổi hàng, không trả hàng /
                                    hoàn tiền.
                                </li>
                                <li>
                                    Miễn phí vận chuyển 2 chiều nếu sản phẩm bị
                                    lỗi từ nhà sản xuất, shop giao nhầm hàng,
                                    nhầm màu...
                                </li>
                                <li>
                                    Quý khách vui lòng hỗ trợ phí ship 2 chiều
                                    khi: không thích màu, đổi size, muốn đổi sản
                                    phẩm khác...
                                </li>
                            </ul>
                        </div>
                        <div className="text-center bg-gray-200 p-4">
                            <p>Cảm ơn bạn đã lựa chọn GENTLEMANOR</p>
                        </div>
                    </div>
                </div>
            </div>
            <Footer />
        </>
    );
};

export default ReturnPolicy;
