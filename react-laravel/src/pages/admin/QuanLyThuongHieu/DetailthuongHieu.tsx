import React from "react";
import { Modal } from "antd";
import "../../../style/quanLy.css";

const DetailThuongHieu = ({ open, onClose, brand }) => {
    // Định dạng ngày tháng
    const formatDate = (date) => {
        if (date) {
            return new Date(date).toLocaleString();
        }
        return "Chưa có thông tin";
    };

    return (
        <Modal
            title="Chi tiết thương hiệu"
            open={open}
            onCancel={onClose}
            footer={null}
            width={650}
        >
            {brand && (
                <div className="detail-container">
                    <div className="info-container">
                        <p className="product-name">{brand.name}</p>

                        <div className="date-container">
                            <p>Ngày tạo: {formatDate(brand.created_at)}</p>
                            <p>Ngày cập nhật: {formatDate(brand.updated_at)}</p>
                        </div>
                        <p>{brand.description}</p>
                    </div>
                </div>
            )}
        </Modal>
    );
};

export default DetailThuongHieu;
