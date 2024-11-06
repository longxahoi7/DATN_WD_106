import React from "react";
import { Link } from "react-router-dom";

type Props = {};

const KhachHangThanThiet = (props: Props) => {
    return (
        <>
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
                        Khách hàng thân thiết
                    </h1>
                    <h2 className="text-xl font-bold text-blue-500 mb-4">
                        CHÍNH SÁCH KHÁCH HÀNG THÂN THIẾT
                    </h2>
                    <table className="w-full border-collapse border">
                        <thead>
                            <tr>
                                <th className="border p-2">
                                    QUYỀN LỢI THÀNH VIÊN
                                </th>
                                <th className="border p-2">
                                    MỨC ĐIỂM TÍCH LŨY (50.000 đồng = 1 điểm)
                                </th>
                                <th className="border p-2">MỨC GIẢM GIÁ</th>
                                <th className="border p-2">
                                    ƯU ĐÃI SINH NHẬT (1 lần giảm trong tháng
                                    sinh nhật)
                                </th>
                                <th className="border p-2">ƯU ĐÃI KÈM THEO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td className="border p-2">MEMBER</td>
                                <td className="border p-2">0 điểm - 60 điểm</td>
                                <td className="border p-2">5%</td>
                                <td className="border p-2">5%</td>
                                <td className="border p-2"></td>
                            </tr>
                            <tr>
                                <td className="border p-2">VIP 5%</td>
                                <td className="border p-2">
                                    61 điểm - 150 điểm
                                </td>
                                <td className="border p-2">5%</td>
                                <td className="border p-2">10%</td>
                                <td className="border p-2"></td>
                            </tr>
                            <tr>
                                <td className="border p-2">VIP 10%</td>
                                <td className="border p-2">
                                    151 điểm - 250 điểm
                                </td>
                                <td className="border p-2">10%</td>
                                <td className="border p-2">15%</td>
                                <td className="border p-2"></td>
                            </tr>
                            <tr>
                                <td className="border p-2">VIP 15%</td>
                                <td className="border p-2">251 điểm trở lên</td>
                                <td className="border p-2">15%</td>
                                <td className="border p-2">20%</td>
                                <td className="border p-2">
                                    Tặng quà khi sinh nhật
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p className="mt-4">
                        Chương trình bắt đầu áp dụng từ 01/09/2024.
                    </p>
                    <p>
                        Với mỗi hóa đơn mua hàng khách hàng đều được tham gia
                        tích điểm với mức tích điểm là{" "}
                        <strong>50.000 vnd = 1 điểm</strong>. Một thẻ thành viên
                        có thể được sử dụng cho người thân, bạn bè đến cùng tích
                        điểm và cùng hưởng giảm giá.
                    </p>
                </div>
            </div>
        </>
    );
};
export default KhachHangThanThiet;
