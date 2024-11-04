// QuanLyDanhMuc/FormDanhMuc.jsx
import React, { useState } from "react";
import { Modal, Form, Input, Upload, Button } from "antd";
import { UploadOutlined, DeleteOutlined } from "@ant-design/icons";

const FormDanhMuc = ({ open, onOk, onCancel }) => {
    const [form] = Form.useForm();
    const [previewImage, setPreviewImage] = useState(null); // Trạng thái cho ảnh xem trước

    const handleOk = () => {
        form.validateFields()
            .then((values) => {
                onOk({ ...values, image: previewImage }); // Gửi dữ liệu cùng hình ảnh sang component cha
                form.resetFields();
                setPreviewImage(null); // Reset ảnh xem trước
            })
            .catch((info) => {
                console.log("Validation failed:", info);
            });
    };

    const handleImageUpload = ({ file }) => {
        const reader = new FileReader();
        reader.onload = (e) => {
            setPreviewImage(e.target.result); // Lưu đường dẫn xem trước hình ảnh
        };
        reader.readAsDataURL(file);
    };

    const handleRemoveImage = () => {
        setPreviewImage(null); // Xóa ảnh xem trước
    };

    return (
        <Modal
            title="Thêm mới danh mục"
            open={open}
            onOk={handleOk}
            onCancel={() => {
                onCancel();
                form.resetFields();
                setPreviewImage(null); // Reset ảnh xem trước khi hủy
            }}
            okText="Lưu"
            cancelText="Hủy"
        >
            <Form form={form} layout="vertical">
                <Form.Item
                    name="name"
                    label="Tên danh mục"
                    rules={[
                        {
                            required: true,
                            message: "Vui lòng nhập tên danh mục",
                        },
                        {
                            max: 50,
                            message:
                                "Tên danh mục không được vượt quá 50 ký tự",
                        },
                    ]}
                >
                    <Input placeholder="Nhập tên danh mục" />
                </Form.Item>

                <Form.Item
                    name="description"
                    label="Mô tả"
                    rules={[{ required: true, message: "Vui lòng nhập mô tả" }]}
                >
                    <Input placeholder="Nhập mô tả" />
                </Form.Item>
                <Form.Item
                    label="Hình ảnh"
                    rules={[
                        {
                            required: true,
                            message: "Vui lòng tải lên hình ảnh",
                        },
                    ]}
                >
                    <div
                        style={{
                            display: "flex",
                            marginLeft: "80px",
                            alignItems: "center",
                        }}
                    >
                        <div
                            style={{
                                width: "100px",
                                height: "140px",
                                borderRadius: "4px",
                                overflow: "hidden",
                                border: "1px solid #d9d9d9",
                                marginRight: "10px",
                                display: "flex",
                                justifyContent: "center",
                                alignItems: "center",
                            }}
                        >
                            {previewImage ? (
                                <img
                                    src={previewImage}
                                    alt="Preview"
                                    style={{
                                        width: "100%",
                                        height: "100%",
                                        objectFit: "cover",
                                    }}
                                />
                            ) : (
                                <span style={{ color: "#d9d9d9" }}>5:7</span>
                            )}
                        </div>
                        {previewImage ? (
                            <Button
                                icon={<DeleteOutlined />}
                                onClick={handleRemoveImage}
                                danger
                            >
                                Xóa
                            </Button>
                        ) : (
                            <Upload
                                showUploadList={false} // Ẩn danh sách tệp tải lên
                                beforeUpload={(file) => {
                                    handleImageUpload({ file });
                                    return false; // Ngăn tải lên tự động
                                }}
                            >
                                <Button icon={<UploadOutlined />}>
                                    Tải ảnh lên
                                </Button>
                            </Upload>
                        )}
                    </div>
                </Form.Item>
            </Form>
        </Modal>
    );
};

export default FormDanhMuc;
