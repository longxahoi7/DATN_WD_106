import React, { useState, useEffect } from "react";
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
    message,
} from "antd";
import { UploadOutlined, DeleteOutlined } from "@ant-design/icons";
import { ColorPicker, Space } from "antd";
import moment from "moment";
import { Brands, Category } from "../../../interface/IProduct";
import api from "../../../config/axios";

const { Option } = Select;

const FormThuongHieu = ({ open, onOk, onCancel, initialValues }) => {
    const [form] = Form.useForm();
    const [loading, setLoading] = useState(true);
    const [previewImage, setPreviewImage] = useState<string | null>(null);
    const token = localStorage.getItem("token");

    const [brands, setBrands] = useState<Brands[]>([]);
    const [categories, setCategories] = useState<Category[]>([]);

    const fetchData = async () => {
        setLoading(true);
        try {
            const response = await api.get("admin/brands/list-brand");
            console.log(response, "list-brand");

            const parseBrands = Array.isArray(response.data.brands)
                ? response.data.brands
                : [];
            setBrands(parseBrands);
        } catch (error) {
            console.error("Lỗi khi lấy thương hiệu:", error);
            message.error("Không thể tải thương hiệu.");
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        fetchData();
    }, []);

    // Set initial values when initialValues prop changes
    useEffect(() => {
        if (initialValues) {
            form.setFieldsValue({
                name: initialValues.name,
                description: initialValues.description,
                brand_id: initialValues.brand_id,
                main_image_url: initialValues.main_image_url,
            });
            setPreviewImage(initialValues.main_image_url);

            console.log("initialValues", initialValues);
        }
    }, [initialValues, form]);

    const handleOk = async () => {
        try {
            const values = await form.validateFields();
            const formData = new FormData();

            // Ensure form values are appended to FormData
            formData.append("name", values.name);
            formData.append("description", values.description);
            if (values.createdAt) {
                formData.append(
                    "created_at",
                    values.createdAt.format("YYYY-MM-DD")
                );
            }
            if (values.updatedAt) {
                formData.append(
                    "updated_at",
                    values.updatedAt.format("YYYY-MM-DD")
                );
            }

            formData.append("main_image_url", values.main_image_url);

            // Logging FormData to inspect its contents
            for (let pair of formData.entries()) {
                console.log(pair[0], pair[1]);
            }

            // Submit the form data to the server
            const response = await fetch(
                "http://localhost:8000/api/admin/brands/add-brand",
                {
                    method: "POST",
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                    body: formData,
                }
            );

            if (response.ok) {
                onOk(values);
                form.resetFields();
                setPreviewImage(null);
            } else {
                console.error("Failed to save brand:", await response.text());
            }
        } catch (error) {
            console.error("Validation failed:", error);
        }
    };

    // Handle image upload
    const handleImageUpload = ({ file }) => {
        const reader = new FileReader();
        reader.onload = (e) => {
            if (e.target) {
                setPreviewImage(e.target.result as string);
            }
        };
        reader.readAsDataURL(file);
    };

    // Handle image removal
    const handleRemoveImage = () => {
        setPreviewImage(null);
    };

    return (
        <Modal
            title={
                initialValues ? "Cập nhật thương hiệu" : "Thêm mới thương hiệu"
            }
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
                            label="Tên thương hiệu"
                            rules={[
                                {
                                    required: true,
                                    message: "Vui lòng nhập tên thương hiệu",
                                },
                                {
                                    max: 50,
                                    message:
                                        "Tên thương hiệu không được vượt quá 50 ký tự",
                                },
                            ]}
                        >
                            <Input placeholder="Nhập tên thương hiệu" />
                        </Form.Item>
                    </Col>

                    <Col span={12}>
                        <Form.Item
                            name="description"
                            label="Mô tả thương hiệu"
                            rules={[
                                {
                                    required: true,
                                    message: "Vui lòng nhập mô tả thương hiệu",
                                },
                                {
                                    max: 50,
                                    message:
                                        "Mô tả thương hiệu không được vượt quá 50 ký tự",
                                },
                            ]}
                        >
                            <Input placeholder="Mô tả thương hiệu" />
                        </Form.Item>
                    </Col>
                    <Col span={12}>
                        <Form.Item name="main_image_url" label="ảnh">
                            <Input placeholder="ảnh" />
                        </Form.Item>
                    </Col>
                </Row>
            </Form>
        </Modal>
    );
};

export default FormThuongHieu;
