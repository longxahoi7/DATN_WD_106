import React from "react";
import { Modal } from "antd";
import "../../../style/quanLy.css";

const DetailSanPham = ({ open, onClose, product }) => {
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
                            src={product.image}
                            alt={product.name}
                            className="product-image"
                        />
                    </div>
                    <div className="info-container">
                        <p className="product-name">{product.name}</p>
                        <p className="product-price">
                            {product.price.toLocaleString()} VND
                        </p>
                        <p>Thương hiệu: {product.brand}</p>
                        <p>Danh mục: {product.category}</p>
                        <div className="date-container">
                            <p>Ngày tạo: {product.createdDate}</p>
                            <p>Ngày cập nhật: {product.updatedDate}</p>
                        </div>
                        <p>{product.description}</p>
                    </div>
                </div>
            )}
        </Modal>
    );
};

export default DetailSanPham;
