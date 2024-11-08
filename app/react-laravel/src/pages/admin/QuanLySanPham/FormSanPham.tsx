// QuanLySanPham/FormSanPham.jsx
import React, { useState } from "react";
import {
    Modal,
    Form,
    Input,
    Upload,
    Button,
    DatePicker,
    Select,
    Row,
    Col,
} from "antd";
import { UploadOutlined, DeleteOutlined } from "@ant-design/icons";

const { Option } = Select;

const FormSanPham = ({ open, onOk, onCancel, initialValues }) => {
    const [form] = Form.useForm();
    const [previewImage, setPreviewImage] = useState<string | null>(null);

    const handleOk = () => {
        form.validateFields()
            .then((values) => {
                onOk({ ...values, image: previewImage });
                form.resetFields();
                setPreviewImage(null);
            })
            .catch((info) => {
                console.log("Validation failed:", info);
            });
    };

    const handleImageUpload = ({ file }) => {
        const reader = new FileReader();
        reader.onload = (e) => {
            if (e.target) {
                setPreviewImage(e.target.result as string);
            }
        };
    };

    const handleRemoveImage = () => {
        setPreviewImage(null);
    };

    return (
        <Modal
            title="Thêm mới sản phẩm"
            open={open}
            onOk={handleOk}
            onCancel={() => {
                onCancel();
                form.resetFields();
                setPreviewImage(null);
            }}
            okText="Lưu"
            cancelText="Hủy"
            width={800}
        >
            <Form form={form} layout="vertical">
                <Row gutter={16}>
                    <Col span={12}>
                        <Form.Item
                            name="name"
                            label="Tên sản phẩm"
                            rules={[
                                {
                                    required: true,
                                    message: "Vui lòng nhập tên sản phẩm",
                                },
                                {
                                    max: 50,
                                    message:
                                        "Tên sản phẩm không được vượt quá 50 ký tự",
                                },
                            ]}
                        >
                            <Input placeholder="Nhập tên sản phẩm" />
                        </Form.Item>
                    </Col>
                    <Col span={12}>
                        <Form.Item
                            name="price"
                            label="Giá"
                            rules={[
                                {
                                    required: true,
                                    message: "Vui lòng nhập giá sản phẩm",
                                },
                                {
                                    type: "number",
                                    min: 0,
                                    message: "Giá phải là số dương",
                                },
                            ]}
                        >
                            <Input
                                type="number"
                                placeholder="Nhập giá sản phẩm"
                            />
                        </Form.Item>
                    </Col>
                </Row>

                <Row gutter={16}>
                    <Col span={12}>
                        <Form.Item
                            name="category"
                            label="Danh mục"
                            rules={[
                                {
                                    required: true,
                                    message: "Vui lòng chọn danh mục",
                                },
                            ]}
                        >
                            <Select placeholder="Chọn danh mục">
                                <Option value="danh_muc_a">Danh mục A</Option>
                                <Option value="danh_muc_b">Danh mục B</Option>
                                <Option value="danh_muc_c">Danh mục C</Option>
                            </Select>
                        </Form.Item>
                    </Col>
                    <Col span={12}>
                        <Form.Item
                            name="brand"
                            label="Thương hiệu"
                            rules={[
                                {
                                    required: true,
                                    message: "Vui lòng nhập thương hiệu",
                                },
                            ]}
                        >
                            <Input placeholder="Nhập thương hiệu" />
                        </Form.Item>
                    </Col>
                </Row>

                <Row gutter={16}>
                    <Col span={12}>
                        <Form.Item name="createdAt" label="Ngày tạo">
                            <DatePicker style={{ width: "100%" }} />
                        </Form.Item>
                    </Col>
                    <Col span={12}>
                        <Form.Item name="updatedAt" label="Ngày cập nhật">
                            <DatePicker style={{ width: "100%" }} />
                        </Form.Item>
                    </Col>
                </Row>

                <Form.Item label="Hình ảnh">
                    <div style={{ display: "flex", alignItems: "center" }}>
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
                                showUploadList={false}
                                beforeUpload={(file) => {
                                    handleImageUpload({ file });
                                    return false;
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

export default FormSanPham;
