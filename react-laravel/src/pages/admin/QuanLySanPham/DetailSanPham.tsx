import React from "react";
import { Modal } from "antd";
import "../../../style/quanLy.css";

const DetailSanPham = ({ open, onClose, product, brand }) => {
    // Định dạng ngày tháng
    const formatDate = (date) => {
        if (date) {
            return new Date(date).toLocaleString();
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
                            src={product.main_image_url}
                            alt={product.name}
                            className="product-image"
                        />
                    </div>
                    <div className="info-container">
                        <p className="product-name">{product.name}</p>
                        <p className="product-price">
                            {product.price
                                ? `Giá: ${product.price.toLocaleString()} VNĐ`
                                : "Chưa có giá"}{" "}
                        </p>
                        {brand.map((brd, index) => {
                            if (brd.brand_id === product.brand_id) {
                                return (
                                    <p key={brd.brand_id}>
                                        Thương hiệu: {brd.name}
                                    </p>
                                );
                            }
                        })}
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
