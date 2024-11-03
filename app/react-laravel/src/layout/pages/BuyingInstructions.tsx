import React from "react";
import Footer from "../Footer/footer";
import Header from "../Header/header";
import { Link } from "react-router-dom";

type Props = {};

const BuyingInstructions = (props: Props) => {
    return (
        <>
            <Header />
            <div className=" p-4" style={{ width: "100vw" }}>
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
                        <h1 className="text-2xl font-bold mb-4">
                            Hướng dẫn mua hàng
                        </h1>
                        <p className="mb-4">
                            GENTLEMANOR nhận giao hàng toàn quốc. Bạn có thể mua
                            hàng trực tiếp tại shop hoặc đặt hàng trên Website
                            chính thức www.GENTLEMANOR.vn theo các bước sau:
                        </p>
                        <h2 className="font-bold mb-2 text-blue-500">
                            BƯỚC 1: TÌM SẢN PHẨM MONG MUỐN
                        </h2>
                        <p className="mb-4 text-black">
                            Bạn có thể tìm kiếm bằng 2 cách như sau:
                        </p>
                        <ul className="list-disc list-inside mb-4">
                            <li>
                                Tìm kiếm theo tên/ mã sản phẩm: nhập vào biểu
                                tượng kính lúp ở góc phải, nhập từ khoá tên/ mã
                                tìm kiếm và ấn enter hoặc click vào biểu tượng
                                kính lúp.
                            </li>
                            <li>
                                Tìm kiếm theo nhóm sản phẩm: Click vào danh mục
                                sản phẩm trên menu chính, các mục sản phẩm bao
                                gồm: ÁO KHOÁC, ÁO THUN, SƠ MI, QUẦN DÀI, QUẦN
                                SHORT xuất hiện. Click vào từng mục để hiện ra
                                chi tiết sản phẩm bạn mong muốn.
                            </li>
                        </ul>
                        <h2 className="font-bold mb-2  text-blue-500">
                            BƯỚC 2: THÊM SẢN PHẨM CẦN MUA VÀO GIỎ HÀNG
                        </h2>
                        <p className="mb-4">
                            Sau khi đã tìm được sản phẩm mong muốn bạn cần tham
                            khảo đầy đủ hình ảnh, mô tả kèm theo, hãy thực hiện
                            thao tác chọn size, số lượng cần mua và click CHỌN
                            THÊM VÀO GIỎ HÀNG để thêm sản phẩm vào giỏ hàng hoặc
                            MUA NGAY.
                        </p>
                        <p className="mb-4">
                            Giỏ hàng của bạn hiện lên danh sách sản phẩm bạn
                            đang chọn và tổng giá trị đơn hàng. Click XEM GIỎ
                            HÀNG nếu muốn kiểm tra giỏ hàng, Click THANH TOÁN
                            nếu đã chọn xong sản phẩm và muốn mang món hàng về
                            nhà: Click ký hiệu X để tiếp tục mua hàng.
                        </p>
                        <h2 className="font-bold mb-2  text-blue-500">
                            BƯỚC 3: KIỂM TRA GIỎ HÀNG VÀ TIẾN HÀNH ĐẶT HÀNG
                        </h2>
                        <ul className="list-disc list-inside mb-4">
                            <li>
                                Kiểm tra lại thông tin đầy đủ về sản phẩm muốn
                                đặt mua.
                            </li>
                            <li>
                                Điền mã giảm giá (nếu có) vào ô khung MÃ GIẢM
                                GIÁ và Click SỬ DỤNG.
                            </li>
                            <li>
                                Điền đầy đủ thông tin giao hàng của bạn bao gồm
                                Họ và tên, Email, Số điện thoại, Địa chỉ. Nếu đã
                                có đăng ký tài khoản từ trước hãy Click vào ĐĂNG
                                NHẬP.
                            </li>
                            <li>
                                Kiểm tra lại tất cả thông tin đã nhập, sau khi
                                đã chắc chắn thì Click TIẾP TỤC ĐẾN PHƯƠNG THỨC
                                THANH TOÁN để hoàn tất đơn hàng của bạn.
                            </li>
                        </ul>
                        <h2 className="font-bold mb-2  text-blue-500">
                            BƯỚC 4: CHỌN PHƯƠNG THỨC VẬN CHUYỂN
                        </h2>
                        <p className="mb-4">
                            Sau khi bạn nhập đầy đủ thông tin trong phần thông
                            tin giao hàng, căn cứ vào địa chỉ nhận hàng và tổng
                            giá trị đơn hàng, Website sẽ đưa ra cho bạn hình
                            thức vận chuyển và chi phí vận chuyển để bạn lựa
                            chọn.
                        </p>
                        <p className="mb-4 text-black">
                            Mức phí vận chuyển theo từng khu vực như sau:
                        </p>
                        <h3 className="font-bold mb-2">
                            1. Khu vực TP. Hồ Chí Minh:
                        </h3>
                        <ul className="list-disc list-inside mb-4">
                            <li>
                                Phí Ship 27k. Free ship cho đơn hàng nội thành
                                trên 500k
                            </li>
                            <li>
                                Thời gian nhận hàng trong vòng 24h đối với đơn
                                hàng nội thành HCM, ngoại thành sau 2 ngày.
                            </li>
                        </ul>
                        <h3 className="font-bold mb-2">
                            2. Khu vực tỉnh thành khác:
                        </h3>
                        <ul className="list-disc list-inside mb-4">
                            <li>Phí ship đồng giá 37k.</li>
                            <li>
                                Free ship cho đơn hàng tỉnh thành trên 500k
                                (Khách hàng chuyển khoản trước).
                            </li>
                            <li>
                                Thời gian nhận hàng từ 2-5 ngày làm việc không
                                kể thứ 7 và chủ nhật.
                            </li>
                        </ul>
                        <h2 className="font-bold mb-2  text-blue-500">
                            BƯỚC 5: CHỌN PHƯƠNG THỨC THANH TOÁN
                        </h2>
                        <p className="mb-4">
                            Trong phần PHƯƠNG THỨC THANH TOÁN, bạn có thể thanh
                            toán theo các hình thức sau:
                        </p>
                        <ul className="list-disc list-inside mb-4">
                            <li>Thanh toán khi nhận hàng (COD).</li>
                            <li>
                                Chuyển khoản qua ngân hàng và thanh toán khi
                                nhận hàng.
                            </li>
                        </ul>
                        <p className="mb-4">
                            Bạn chuyển khoản cho GENTLEMANOR ngay sau khi nhận
                            được xác nhận đơn hàng thành công. Thông tin chuyển
                            khoản nhận được Online sẽ hướng dẫn cụ thể.
                        </p>
                        <p className="mb-4">
                            Sau khi chuyển khoản, bạn vui lòng xác nhận lại với
                            GENTLEMANOR bằng cách gọi vào hotline:{" "}
                            <strong>(028) 7300 6200</strong> hoặc để lại tin
                            nhắn trên Fanpage của GENTLEMANOR và chờ nhân viên
                            kiểm tra hoàn thành đơn hàng.
                        </p>
                        <h2 className="font-bold mb-2 text-blue-500">
                            BƯỚC 6: HOÀN TẤT ĐƠN HÀNG
                        </h2>
                        <p className="mb-4">
                            Bạn Click vào nút HOÀN TẤT ĐƠN HÀNG sau khi đã hoàn
                            thành các bước trên và kiểm tra thật kỹ tất cả các
                            thông tin đơn hàng, phương thức vận chuyển, phương
                            thức thanh toán.
                        </p>
                        <p className="mb-4">
                            Nếu có bất cứ vấn đề gì trong khi đặt hàng bạn vui
                            lòng KIỂM TRA ĐƠN HÀNG & gọi vào hotline hoặc liên
                            hệ trực tiếp tổng đài mua hàng{" "}
                            <strong>(028) 7300 6200</strong> (giờ hành chính
                            ngày làm việc).
                        </p>
                    </div>
                </div>
            </div>
            <Footer />
        </>
    );
};

export default BuyingInstructions;
