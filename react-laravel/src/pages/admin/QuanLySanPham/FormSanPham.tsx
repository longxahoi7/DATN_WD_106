import React, { useState, useEffect } from "react";
import { Modal, Form, Input, Select, Row, Col, message } from "antd";
import api from "../../../config/axios";
import { Brands, Category } from "../../../interface/IProduct";

const { Option } = Select;

const FormSanPham = ({ open, onOk, onCancel, initialValues }) => {
    const [form] = Form.useForm();
    const [loading, setLoading] = useState(true);
    const token = localStorage.getItem("token");

    const [brands, setBrands] = useState<Brands[]>([]);
    const [categories, setCategories] = useState<Category[]>([]);
    const [attributeColors, setAttributeColors] = useState([]);
    const [attributesSizes, setAttributeSizes] = useState([]);

    // Fetch data từ API
    const fetchData = async () => {
        setLoading(true);
        try {
            const response = await api.get("admin/products/get-data");
            if (response.data) {
                setBrands(response.data.brands || []);
                setCategories(response.data.categories || []);
                setAttributeColors(response.data.colors || []);
                setAttributeSizes(response.data.sizes || []);
            }
        } catch (error) {
            console.error("Lỗi khi lấy dữ liệu sản phẩm:", error);
            message.error("Không thể tải dữ liệu sản phẩm.");
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        fetchData();
    }, []);

    // Gán giá trị ban đầu khi nhận `initialValues`
    useEffect(() => {
        if (initialValues) {
            form.setFieldsValue({
                name: initialValues.name || "",
                sku: initialValues.sku || "",
                subtitle: initialValues.subtitle || "",
                description: initialValues.description || "",
                product_category_id:
                    initialValues.product_category_id || undefined,
                brand_id: initialValues.brand_id || undefined,
                in_stock: initialValues.in_stock || "",
                price: initialValues.price || "",
                color_id: initialValues.color_id || [],
                size_id: initialValues.size_id || [],
                discount: initialValues.discount || "",
                main_image_url: initialValues.main_image_url || "",
            });
        } else {
            form.resetFields();
        }
    }, [initialValues, form]);

    const handleOk = async () => {
        try {
            const values = await form.validateFields();
            const formData = new FormData();

            Object.keys(values).forEach((key) => {
                if (Array.isArray(values[key])) {
                    values[key].forEach((item) =>
                        formData.append(`${key}[]`, item)
                    );
                } else {
                    formData.append(key, values[key]);
                }
            });

            const url = initialValues
                ? `http://localhost:8000/api/admin/products/update-product/${initialValues.product_id}`
                : "http://localhost:8000/api/admin/products/add-product";

            const method = initialValues ? "PUT" : "POST";

            const response = await fetch(url, {
                method: method,
                headers: {
                    Authorization: `Bearer ${token}`,
                },
                body: formData,
            });

            if (response.ok) {
                const responseData = await response.json();
                message.success(
                    initialValues
                        ? "Cập nhật sản phẩm thành công!"
                        : "Thêm sản phẩm mới thành công!"
                );
                onOk(responseData);
                form.resetFields();
            } else {
                const errorText = await response.text();
                console.error("Failed to save product:", errorText);
                message.error("Lỗi khi lưu sản phẩm.");
            }
        } catch (error) {
            console.error("Validation failed:", error);
        }
    };

    return (
        <Modal
            title={initialValues ? "Cập nhật sản phẩm" : "Thêm mới sản phẩm"}
            open={open}
            onOk={handleOk}
            onCancel={() => {
                onCancel();
                form.resetFields();
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
                                    message: "Không được vượt quá 50 ký tự",
                                },
                            ]}
                        >
                            <Input placeholder="Nhập tên sản phẩm" />
                        </Form.Item>
                    </Col>
                    <Col span={12}>
                        <Form.Item
                            name="sku"
                            label="Mã sản phẩm"
                            rules={[
                                {
                                    required: true,
                                    message: "Vui lòng nhập mã sản phẩm",
                                },
                                {
                                    max: 50,
                                    message: "Không được vượt quá 50 ký tự",
                                },
                            ]}
                        >
                            <Input placeholder="Nhập mã sản phẩm" />
                        </Form.Item>
                    </Col>
                    <Col span={12}>
                        <Form.Item
                            name="subtitle"
                            label="Subtitle sản phẩm"
                            rules={[
                                {
                                    required: true,
                                    message: "Vui lòng nhập subtitle sản phẩm",
                                },
                                {
                                    max: 50,
                                    message: "Không được vượt quá 50 ký tự",
                                },
                            ]}
                        >
                            <Input placeholder="Nhập subtitle sản phẩm" />
                        </Form.Item>
                    </Col>
                    <Col span={12}>
                        <Form.Item
                            name="description"
                            label="Mô tả sản phẩm"
                            rules={[
                                {
                                    required: true,
                                    message: "Vui lòng nhập mô tả sản phẩm",
                                },
                                {
                                    max: 255,
                                    message: "Không được vượt quá 255 ký tự",
                                },
                            ]}
                        >
                            <Input placeholder="Mô tả sản phẩm" />
                        </Form.Item>
                    </Col>
                    <Col span={12}>
                        <Form.Item
                            name="product_category_id"
                            label="Danh mục sản phẩm"
                        >
                            <Select placeholder="Chọn danh mục sản phẩm">
                                {categories.map((category) => (
                                    <Option
                                        key={category.category_id}
                                        value={category.category_id}
                                    >
                                        {category.name}
                                    </Option>
                                ))}
                            </Select>
                        </Form.Item>
                    </Col>
                    <Col span={12}>
                        <Form.Item name="brand_id" label="Thương hiệu sản phẩm">
                            <Select placeholder="Chọn thương hiệu sản phẩm">
                                {brands.map((brand) => (
                                    <Option
                                        key={brand.brand_id}
                                        value={brand.brand_id}
                                    >
                                        {brand.name}
                                    </Option>
                                ))}
                            </Select>
                        </Form.Item>
                    </Col>
                </Row>
            </Form>
        </Modal>
    );
};

export default FormSanPham;
