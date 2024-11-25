import React from "react";

type Props = {};

const DetailDonHang = (props: Props) => {
    return (
        <div className="container order-details">
            <div className="row">
                <div className="col-md-4">
                    <div className="order-card">
                        <h2>1. Thông tin khách hàng</h2>
                        <p>
                            <strong>Tên người mua:</strong>
                            chuirori
                        </p>
                        <p>
                            <strong>Email:</strong>
                            chuirori@gmail.com
                        </p>
                        <p>
                            <strong>Điện thoại:</strong>
                            123456789
                        </p>
                        <p>
                            <strong>Địa chỉ:</strong>
                            123 Xuân Phương, Xã Chiềng Châu, Huyện Mai Châu,
                            Tỉnh Hòa Bình
                        </p>
                    </div>
                </div>
                <div className="col-md-4">
                    <div className="order-card">
                        <h2>2. Thông tin đơn hàng</h2>
                        <p>
                            <strong>Mã đơn hàng:</strong>
                            35
                        </p>
                        <p>
                            <strong>Trạng thái thanh toán:</strong>
                            Chưa thanh toán
                        </p>
                        <p>
                            <strong>Ngày mua hàng:</strong>
                            2021-11-24 13:53:13
                        </p>
                        <p>
                            <strong>Trạng thái:</strong>
                            Chờ xác nhận
                        </p>
                        <div className="mt-4 g-20">
                            <button className="btn btn-success ">
                                Xác nhận đơn hàng
                            </button>
                            <button className="btn btn-danger ml-10!">
                                Hủy đơn hàng
                            </button>
                        </div>
                    </div>
                </div>
                <div className="col-md-4">
                    <div className="order-card">
                        <h2>3. Thông tin giao hàng</h2>
                        <p>
                            <strong>Người giao:</strong>
                            ABC
                        </p>
                        <p>
                            <strong>Hình thức:</strong>
                            ABC
                        </p>
                    </div>
                </div>
            </div>
            <div className="order-card">
                <h2>4. Chi tiết đơn hàng</h2>
                <p>Khách hàng ghi chú:</p>
                <table className="table table-bordered order-table mt-4">
                    <thead className="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td className="text-center">1.</td>
                            <td className="text-center">
                                <img
                                    alt="Áo Sơ Mi Tay Ngắn Nữ Cotton Sựờng TA324C8220"
                                    height="50"
                                    src="https://storage.googleapis.com/a1aa/image/Wge7wZXnR80xOypFuAPPInrIYcULlfGtJg9beNun1lyHjzonA.jpg"
                                    width="50"
                                />
                            </td>
                            <td>
                                Áo Sơ Mi Tay Ngắn Nữ Cotton Sựờng TA324C8220 -
                                Chính Hãng GenViet - GENVJET JEANS
                            </td>
                            <td className="text-right">199.000 đ</td>
                            <td className="text-center">3</td>
                            <td className="text-right">597.000 đ</td>
                        </tr>
                        <tr>
                            <td className="text-center">2.</td>
                            <td className="text-center">
                                <img
                                    alt="Quần Âu Baggy Nam Caro TUT05 Menswear ODT03"
                                    height="50"
                                    src="https://storage.googleapis.com/a1aa/image/jxg4bQLEJHInKhX5eNVCLeIsobFkevdTt763rdAUm4CFjzonA.jpg"
                                    width="50"
                                />
                            </td>
                            <td>
                                Quần Âu Baggy Nam Caro TUT05 Menswear ODT03 -
                                Quần Tây Đen Ống Côn Trẻ Trung Cotton Hàn Quốc
                                Ít Nhăn, Tôn Dáng, Lịch Sự
                            </td>
                            <td className="text-right">190.000 đ</td>
                            <td className="text-center">2</td>
                            <td className="text-right">380.000 đ</td>
                        </tr>
                    </tbody>
                </table>
                <div className="text-right mt-4">
                    <strong>Tổng tiền:</strong>
                    <span className="total-amount">48247099.50 đ</span>
                </div>
            </div>
        </div>
    );
};

export default DetailDonHang;
