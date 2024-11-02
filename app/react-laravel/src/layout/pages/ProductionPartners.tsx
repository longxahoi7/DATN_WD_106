import React from "react";
import Footer from "../Footer/footer";
import { Link } from "react-router-dom";
import Header from "../Header/header";

type Props = {};

const ProductionPartners = (props: Props) => {
    return (
        <>
            <Header />
            <div className="flex" style={{ width: "100vw" }}>
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
                <div className="w-3/4 p-4">
                    <h1 className="text-2xl font-bold mb-4">
                        Đối tác sản xuất
                    </h1>
                    <h2 className="text-xl font-bold mb-4">
                        GENTLEMANOR TÌM KIẾM ĐỐI TÁC SẢN XUẤT
                    </h2>
                    <p className="mb-4">
                        Trong hành trình sáng tạo thời trang của mình,{" "}
                        <span className="text-blue-600">GENTLEMANOR</span> luôn
                        mong muốn tìm kiếm và hợp tác các đối tác sản xuất để
                        đồng hành và phát triển sản phẩm.
                    </p>
                    <h3 className="font-bold mb-2">Yêu cầu:</h3>
                    <ul className="list-disc list-inside mb-4">
                        <li>
                            Cung cấp sản phẩm theo tiêu chuẩn xuất khẩu, chất
                            lượng tốt.
                        </li>
                        <li>
                            Cách thức làm việc nhanh chóng và chuyên nghiệp.
                        </li>
                    </ul>
                    <h3 className="font-bold mb-2">Quyền lợi:</h3>
                    <ul className="list-disc list-inside mb-4">
                        <li>Thanh toán công nợ nhanh chóng và linh hoạt.</li>
                        <li>Số lượng sản xuất đều đặn.</li>
                    </ul>
                    <p className="italic mb-4">
                        Nhà cung cấp có nhu cầu, vui lòng gửi thông tin liên hệ,
                        hình mẫu sản phẩm tại:
                    </p>
                    <p className="font-bold">GENTLEMANOR.VN</p>
                    <p>
                        <a
                            href="mailto:kenta1208@gmail.com"
                            className="text-blue-600"
                        >
                            gentlemanor1208@gmail.com
                        </a>
                    </p>
                    <p>
                        Tầng 8, tòa nhà Ford, số 315 Trường Chinh, quận Thanh
                        Xuân, Hà Nội
                    </p>
                    <p>Liên hệ: (028) 7300 6200</p>
                    <p>Zalo: 0908483900</p>
                </div>
            </div>
            <Footer />
        </>
    );
};

export default ProductionPartners;
