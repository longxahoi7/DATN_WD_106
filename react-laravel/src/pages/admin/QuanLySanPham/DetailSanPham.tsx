import React from "react";
import { Modal } from "antd";
import "../../../style/quanLy.css";

const DetailSanPham = ({ open, onClose, product }) => {
    // Định dạng ngày tháng
    const formatDate = (date) => {
        if (date) {
            return new Date(date).toLocaleString(); // Định dạng ngày theo định dạng mong muốn
        }
        return "Chưa có thông tin";
    };

    return (
        <Modal
            title="Chi tiết sản phẩm"
            open={open}
            onCancel={onClose}
            footer={null}
            width={650}
        >
            {product && (
                <div className="detail-container">
                    <div className="image-container">
                        <img
                            src={product.image || "/default-image.jpg"} // Hình ảnh mặc định nếu không có
                            alt={product.name}
                            className="product-image"
                        />
                    </div>
                    <div className="info-container">
                        <p className="product-name">{product.name}</p>
                        <p className="product-price">
                            {product.price
                                ? product.price.toLocaleString()
                                : "Chưa có giá"}{" "}
                        </p>
                        <p>Thương hiệu: {product.brand_id}</p>
                        <p>Danh mục: {product.category?.name}</p>
                        <div className="date-container">
                            <p>Ngày tạo: {formatDate(product.created_at)}</p>
                            <p>
                                Ngày cập nhật: {formatDate(product.updated_at)}
                            </p>
                        </div>
                        <p>{product.description}</p>
                    </div>
                </div>
            )}
        </Modal>
    );
};

export default DetailSanPham;
