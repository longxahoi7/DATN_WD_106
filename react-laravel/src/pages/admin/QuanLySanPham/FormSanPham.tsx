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

const FormSanPham = ({ open, onOk, onCancel, initialValues }) => {
    const [form] = Form.useForm();
    const [loading, setLoading] = useState(true);
    const [previewImage, setPreviewImage] = useState<string | null>(null);
    const token = localStorage.getItem("token");

    const [brands, setBrands] = useState<Brands[]>([]);
    const [categories, setCategories] = useState<Category[]>([]);

    const [attributeColors, setAttributeColors] = useState<[]>([]);
    const [attributesSizes, setAttributeSizes] = useState<[]>([]);

    const fetchData = async () => {
        setLoading(true);
        try {
            const response = await api.get("admin/products/get-data");
            console.log(response, "getData");

            const parseBrands = Array.isArray(response.data.brands)
                ? response.data.brands
                : [];
            setBrands(parseBrands);

            const parseCategories = Array.isArray(response.data.categories)
                ? response.data.categories
                : [];
            setCategories(parseCategories);

            const parseAttributeColors = Array.isArray(response.data.colors)
                ? response.data.colors
                : [];
            setAttributeColors(parseAttributeColors);
            // console.log(attributeColors, "attributeColors");

            const parseAttributeSizes = Array.isArray(response.data.sizes)
                ? response.data.sizes
                : [];
            setAttributeSizes(parseAttributeSizes);
        } catch (error) {
            console.error("Lỗi khi lấy sản phẩm:", error);
            message.error("Không thể tải sản phẩm.");
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
                sku: initialValues.sku,
                subtitle: initialValues.subtitle,
                description: initialValues.description,
                attribute_id: initialValues.attribute_id,
                discount: initialValues.discount,
                in_stock: initialValues.in_stock,
                price: initialValues.price,
                brand_id: initialValues.brand_id,
                product_category_id: initialValues.product_category_id,
                createdAt: initialValues.created_at
                    ? moment(initialValues.created_at)
                    : null,
                updatedAt: initialValues.updated_at
                    ? moment(initialValues.updated_at)
                    : null,
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
            formData.append("sku", values.sku);
            formData.append("subtitle", values.subtitle);
            formData.append("description", values.description);
            formData.append(
                "color_id",
                Array.isArray(values.color_id)
                    ? values.color_id
                    : [values.color_id]
            );

            formData.append(
                "size_id",
                Array.isArray(values.size_id)
                    ? values.size_id
                    : [values.size_id]
            );
            formData.append("discount", values.discount);
            // formData.append("in_stock", values.in_stock);
            // formData.append("price", values.price);
            // formData.append("brand_id", values.brand_id);
            // formData.append("product_category_id", values.product_category_id);
            // formData.append("main_image_url", previewImage as string);
            // console.log(previewImage, "previewImage form data");

            // Handle created_at and updated_at fields as dates
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

            // if (previewImage) {
            //     const response = await fetch(previewImage);
            //     const blob = await response.blob();
            //     const file = new File([blob], "uploaded_image.jpg", {
            //         type: "image/jpeg",
            //     });

            //     formData.append("main_image_url", file);
            // }

            formData.append("main_image_url", values.main_image_url);

            // if (previewImage) {
            //     const response = await fetch(previewImage);
            //     console.log(response, "response_image");
            //     let main_image_url = await response.blob();
            //     formData.append("main_image_url", main_image_url);
            //     // formData.append(
            //     //     "main_image_url",
            //     //     main_image_url,
            //     //     "uploaded_image.jpg"
            //     // );
            // }

            // Logging FormData to inspect its contents
            for (let pair of formData.entries()) {
                console.log(pair[0], pair[1]);
            }

            // Submit the form data to the server
            const response = await fetch(
                "http://localhost:8000/api/admin/products/add-product",
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
                console.error("Failed to save product:", await response.text());
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
            title={initialValues ? "Cập nhật sản phẩm" : "Thêm mới sản phẩm"}
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
                            name="sku"
                            label="Mã sản phẩm"
                            rules={[
                                {
                                    required: true,
                                    message: "Vui lòng nhập mã sản phẩm",
                                },
                                {
                                    max: 50,
                                    message:
                                        "Mã sản phẩm không được vượt quá 50 ký tự",
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
                                    message:
                                        "Subtitle sản phẩm không được vượt quá 50 ký tự",
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
                                    max: 50,
                                    message:
                                        "Mô tả sản phẩm không được vượt quá 50 ký tự",
                                },
                            ]}
                        >
                            <Input placeholder="Mô tả sản phẩm" />
                        </Form.Item>
                    </Col>

                    <Col span={6}>
                        <Form.Item
                            name="color_id"
                            label="Chọn màu"
                            rules={[
                                {
                                    required: true,
                                    message: "Vui lòng chọn mã màu",
                                },
                            ]}
                        >
                            <Select
                                placeholder="Chọn thuộc tính"
                                mode="multiple"
                            >
                                {attributeColors?.map((color, index) => {
                                    const {
                                        color_id,
                                        color_code,
                                        created_at,
                                        name,
                                        updated_at,
                                    } = color;
                                    return (
                                        <Option value={color_id} key={color_id}>
                                            <i
                                                className="fa-solid fa-ice-cream"
                                                style={{
                                                    color: color_code,
                                                    marginRight: "8px",
                                                }}
                                            ></i>
                                            {name}
                                        </Option>
                                    );
                                })}
                            </Select>
                        </Form.Item>
                    </Col>
                    <Col span={6}>
                        <Form.Item
                            name="size_id"
                            label="Chọn Size"
                            rules={[
                                {
                                    required: true,
                                    message: "Vui lòng chọn size",
                                },
                            ]}
                        >
                            <Select
                                placeholder="Chọn thuộc tính"
                                mode="multiple"
                            >
                                {attributesSizes.map((size, index) => {
                                    const {
                                        size_id,
                                        name,
                                        created_at,
                                        updated_at,
                                    } = size;
                                    return (
                                        <Option value={size_id} key={size_id}>
                                            {name}
                                        </Option>
                                    );
                                })}
                            </Select>
                        </Form.Item>
                    </Col>

                    <Col span={12}>
                        <Form.Item
                            name="discount"
                            label="Mã giảm giá"
                            rules={[
                                {
                                    required: true,
                                    message:
                                        "Vui lòng nhập mã giảm giá sản phẩm",
                                },
                                {
                                    max: 50,
                                    message:
                                        "Mã giảm giá sản phẩm không được vượt quá 50 ký tự",
                                },
                            ]}
                        >
                            <Input placeholder="Mã giảm giá sản phẩm" />
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

export default FormSanPham;
