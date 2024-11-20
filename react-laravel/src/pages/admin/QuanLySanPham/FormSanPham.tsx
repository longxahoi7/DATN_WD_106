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
} from "antd";
import { UploadOutlined, DeleteOutlined } from "@ant-design/icons";
import { ColorPicker, Space } from "antd";
import moment from "moment";
import { Attributes, Brands, Category } from "../../../interface/IProduct";

const { Option } = Select;

const FormSanPham = ({
    open,
    onOk,
    onCancel,
    initialValues,
    brands,
    categories,
    attributeColors,
    attributesSizes,
}) => {
    const [form] = Form.useForm();
    const [previewImage, setPreviewImage] = useState<string | null>(null);
    const token = localStorage.getItem("token");

    // const [brands, setBrands] = useState<Array<Brands> | null>(null);
    // const [category, setCategory] = useState<Array<Category> | null>(null);
    // const [attribute, setAttribute] = useState<Array<Attributes> | null>(null);

    // Fetch data for brands, categories, and attributes on component mount
    // useEffect(() => {
    //     const fetchBrands = async () => {
    //         try {
    //             const response = await fetch(
    //                 "http://localhost:8000/api/admin/brands/list-brand",
    //                 {
    //                     method: "GET",
    //                     headers: {
    //                         Authorization: `Bearer ${token}`,
    //                         "Content-Type": "application/json",
    //                     },
    //                 }
    //             );
    //             const data = await response.json();
    //             setBrands(data.data);
    //         } catch (error) {
    //             console.error("Failed to fetch brands", error);
    //         }
    //     };

    //     const fetchCategories = async () => {
    //         try {
    //             const response = await fetch(
    //                 "http://localhost:8000/api/admin/categories/list-category",
    //                 {
    //                     method: "GET",
    //                     headers: {
    //                         Authorization: `Bearer ${token}`,
    //                         "Content-Type": "application/json",
    //                     },
    //                 }
    //             );
    //             const data = await response.json();
    //             setCategory(data.data);
    //         } catch (error) {
    //             console.error("Failed to fetch categories", error);
    //         }
    //     };

    //     const fetchAttributes = async () => {
    //         try {
    //             const response = await fetch(
    //                 "http://localhost:8000/api/admin/attributes/list-attribute",
    //                 {
    //                     method: "GET",
    //                     headers: {
    //                         Authorization: `Bearer ${token}`,
    //                         "Content-Type": "application/json",
    //                     },
    //                 }
    //             );
    //             const data = await response.json();
    //             setAttribute(data.data);
    //         } catch (error) {
    //             console.error("Failed to fetch attributes", error);
    //         }
    //     };

    //     fetchBrands();
    //     fetchCategories();
    //     fetchAttributes();
    // }, [token]);

    // Set initial values when initialValues prop changes
    useEffect(() => {
        if (initialValues) {
            form.setFieldsValue({
                brand_id: initialValues.brand_id,
                product_category_id: initialValues.product_category_id,
                name: initialValues.name,
                // price: initialValues.price,
                sku: initialValues.sku,
                description: initialValues.description,
                subtitle: initialValues.subtitle,
                attribute_id: initialValues.attribute_id,
                discount: initialValues.discount,
                // in_stock: initialValues.in_stock,
                createdAt: initialValues.created_at
                    ? moment(initialValues.created_at)
                    : null,
                updatedAt: initialValues.updated_at
                    ? moment(initialValues.updated_at)
                    : null,
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
            formData.append("brand_id", values.brand_id);
            formData.append("product_category_id", values.product_category_id);
            formData.append("name", values.name);
            // formData.append("price", values.price);
            formData.append("sku", values.sku);
            formData.append("description", values.description);
            formData.append("subtitle", values.subtitle);
            formData.append("attribute_id", values.attribute_id);
            formData.append("discount", values.discount);
            formData.append("size", values.size);
            // formData.append("in_stock", values.in_stock);

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

            if (previewImage) {
                const response = await fetch(previewImage);
                const blob = await response.blob();
                formData.append("main_image_url", blob);
                // formData.append("main_image_url", blob, "uploaded_image.jpg");
            }

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
                console.log(previewImage, "previewImage");
            }
        };
        reader.readAsDataURL(file);
        // const blobUrl = URL.createObjectURL(file);
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
                            name="size"
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
                                {attributesSizes?.map((size, index) => (
                                    <Option value={size} key={index}>
                                        {size}
                                    </Option>
                                ))}
                            </Select>
                        </Form.Item>
                    </Col>
                    <Col span={6}>
                        <Form.Item
                            name="colors"
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
                                {attributeColors?.map((color, index) => (
                                    <Option value={color} key={index}>
                                        <i
                                            className="fa-solid fa-ice-cream"
                                            style={{
                                                color: color,
                                                marginRight: "8px",
                                            }}
                                        ></i>
                                        {color}
                                    </Option>
                                ))}
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

                    {/* <Col span={12}>
                        <Form.Item
                            name="in_stock"
                            label="Stock sản phẩm"
                            rules={[
                                {
                                    required: true,
                                    message: "Vui lòng nhập Stock sản phẩm",
                                },
                                {
                                    max: 50,
                                    message:
                                        "Stock sản phẩm không được vượt quá 50 ký tự",
                                },
                            ]}
                        >
                            <Input placeholder="Stock sản phẩm" />
                        </Form.Item>
                    </Col> */}

                    {/* <Col span={12}>
                        <Form.Item
                            name="price"
                            label="Giá sản phẩm"
                            rules={[
                                {
                                    required: true,
                                    message: "Vui lòng nhập giá sản phẩm",
                                },
                            ]}
                        >
                            <Input
                                type="number"
                                placeholder="Nhập giá sản phẩm"
                            />
                        </Form.Item>
                    </Col> */}

                    <Col span={12}>
                        <Form.Item
                            name="brand_id"
                            label="Thương hiệu"
                            rules={[
                                {
                                    required: true,
                                    message: "Vui lòng chọn thương hiệu",
                                },
                            ]}
                        >
                            <Select placeholder="Chọn thương hiệu">
                                {brands?.map((brand) => (
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

                    <Col span={12}>
                        <Form.Item
                            name="product_category_id"
                            label="Danh mục sản phẩm"
                            rules={[
                                {
                                    required: true,
                                    message: "Vui lòng chọn danh mục",
                                },
                            ]}
                        >
                            <Select placeholder="Chọn danh mục">
                                {categories?.map((category) => (
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
                        <div
                            style={{
                                display: "flex",
                                justifyContent: "space-between",
                                gap: "16px",
                            }}
                        >
                            <Form.Item
                                name="createdAt"
                                label="Ngày tạo"
                                style={{ flex: 1 }}
                            >
                                <DatePicker format="YYYY-MM-DD" />
                            </Form.Item>

                            <Form.Item
                                name="updatedAt"
                                label="Ngày cập nhật"
                                style={{ flex: 1 }}
                            >
                                <DatePicker format="YYYY-MM-DD" />
                            </Form.Item>
                        </div>
                    </Col>

                    <Col span={12}>
                        <Form.Item
                            label="Hình ảnh sản phẩm"
                            valuePropName="fileList"
                            getValueFromEvent={({ fileList }) => fileList}
                        >
                            <Upload
                                listType="picture-card"
                                showUploadList={false}
                                customRequest={handleImageUpload}
                            >
                                {previewImage ? (
                                    <img
                                        src={previewImage}
                                        alt="product"
                                        style={{ width: "100%" }}
                                    />
                                ) : (
                                    <div>
                                        <UploadOutlined />
                                        <div>Chọn hình ảnh</div>
                                    </div>
                                )}
                            </Upload>
                            {previewImage && (
                                <Button
                                    icon={<DeleteOutlined />}
                                    type="link"
                                    onClick={handleRemoveImage}
                                >
                                    Xóa hình ảnh
                                </Button>
                            )}
                        </Form.Item>
                    </Col>
                </Row>
            </Form>
        </Modal>
    );
};

export default FormSanPham;
