import React, { useEffect, useState } from "react";
import { Modal, Form, Input, Switch, Select, Row, Col } from "antd";
import {
    IProduct,
    Category,
    Brands,
    Size,
    Color,
} from "../../../interface/IProduct";
import api from "../../../config/axios";

interface FormSanPhamProps {
    open: boolean;
    onCancel: () => void;
    onOk: (values: IProduct) => void;
    initialValues: IProduct | null;
    loading: boolean;
}

const FormSanPham: React.FC<FormSanPhamProps> = ({
    open,
    onCancel,
    onOk,
    initialValues,
    loading,
}) => {
    const [form] = Form.useForm();
    const [categories, setCategories] = useState<Category[]>([]);
    const [brands, setBrands] = useState<Brands[]>([]);
    const [sizes, setSizes] = useState<Size[]>([]);
    const [colors, setColors] = useState<Color[]>([]);

    useEffect(() => {
        if (open) {
            // Lấy dữ liệu từ API khi modal được mở
            api.get("http://localhost:8000/api/admin/products/get-data")
                .then((response) => {
                    const { categories, brands, sizes, colors } = response.data;
                    setCategories(categories);
                    setBrands(brands);
                    setSizes(sizes);
                    setColors(colors);
                })
                .catch((error) => {
                    console.error("Error fetching data:", error);
                });
        }
    }, [open]);

    useEffect(() => {
        if (initialValues) {
            form.setFieldsValue({
                ...initialValues,
                is_active: initialValues.is_active === 1,
            });
        } else {
            form.resetFields();
        }
    }, [initialValues, form]);

    const handleOk = () => {
        form.validateFields().then((values) => {
            const updatedValues = {
                ...values,
                is_active: values.is_active ? 1 : 0,
            };
            onOk(updatedValues);
            form.resetFields();
        });
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
            confirmLoading={loading}
            okText="Lưu"
            cancelText="Hủy"
            width={1000}
            style={{
                maxHeight: "90vh",
                marginTop: "20px",
                marginBottom: "20px",
            }}
            bodyStyle={{
                overflowY: "auto",
                maxHeight: "400px",
                padding: "20px",
            }}
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
                            ]}
                        >
                            <Input
                                type="number"
                                min={0}
                                placeholder="Nhập giá sản phẩm"
                            />
                        </Form.Item>
                    </Col>
                </Row>
                <Row gutter={16}>
                    <Col span={12}>
                        <Form.Item
                            name="product_category_id"
                            label="Danh mục sản phẩm"
                            rules={[
                                {
                                    required: true,
                                    message: "Vui lòng chọn danh mục sản phẩm",
                                },
                            ]}
                        >
                            <Select placeholder="Chọn danh mục sản phẩm">
                                {categories.map((category) => (
                                    <Select.Option
                                        key={category.category_id}
                                        value={category.category_id}
                                    >
                                        {category.name}
                                    </Select.Option>
                                ))}
                            </Select>
                        </Form.Item>
                    </Col>
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
                                {brands.map((brand) => (
                                    <Select.Option
                                        key={brand.brand_id}
                                        value={brand.brand_id}
                                    >
                                        {brand.name}
                                    </Select.Option>
                                ))}
                            </Select>
                        </Form.Item>
                    </Col>
                    <Col span={12}>
                        <Form.Item
                            name="color_id"
                            label="Màu sắc"
                            rules={[
                                {
                                    required: true,
                                    message: "Vui lòng chọn màu sắc sản phẩm",
                                },
                            ]}
                        >
                            <Select placeholder="Chọn màu sắc sản phẩm">
                                {colors.map((color) => (
                                    <Select.Option
                                        key={color.color_id}
                                        value={color.color_id}
                                    >
                                        {color.name}
                                    </Select.Option>
                                ))}
                            </Select>
                        </Form.Item>
                    </Col>
                    <Col span={12}>
                        <Form.Item
                            name="size_id"
                            label="Size"
                            rules={[
                                {
                                    required: true,
                                    message:
                                        "Vui lòng chọn các size của sản phẩm",
                                },
                            ]}
                        >
                            <Select mode="multiple" placeholder="Chọn size">
                                {sizes.map((size) => (
                                    <Select.Option
                                        key={size.size_id}
                                        value={size.size_id}
                                    >
                                        {size.name}
                                    </Select.Option>
                                ))}
                            </Select>
                        </Form.Item>
                    </Col>
                </Row>
                <Row gutter={16}>
                    <Col span={12}>
                        <Form.Item
                            name="description"
                            label="Mô tả"
                            rules={[
                                {
                                    required: true,
                                    message: "Vui lòng nhập mô tả sản phẩm",
                                },
                            ]}
                        >
                            <Input.TextArea placeholder="Nhập mô tả sản phẩm" />
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
                            ]}
                        >
                            <Input placeholder="Nhập mã sản phẩm" />
                        </Form.Item>
                    </Col>
                </Row>
                <Row gutter={16}>
                    <Col span={12}>
                        <Form.Item name="subtitle" label="Phụ đề">
                            <Input placeholder="Nhập phụ đề sản phẩm" />
                        </Form.Item>
                    </Col>
                    <Col span={12}>
                        <Form.Item
                            name="slug"
                            label="Tên đường dẫn"
                            rules={[
                                {
                                    required: true,
                                    message:
                                        "Vui lòng nhập tên đường dẫn sản phẩm",
                                },
                            ]}
                        >
                            <Input placeholder="Nhập slug sản phẩm" />
                        </Form.Item>
                    </Col>
                </Row>
                <Form.Item
                    name="is_active"
                    label="Trạng thái"
                    valuePropName="checked"
                    rules={[
                        { required: true, message: "Vui lòng chọn trạng thái" },
                    ]}
                >
                    <Switch
                        checked={initialValues?.is_active === 1}
                        onChange={(checked) =>
                            form.setFieldsValue({ is_active: checked ? 1 : 0 })
                        }
                        checkedChildren="Hoạt động"
                        unCheckedChildren="Không hoạt động"
                    />
                </Form.Item>
            </Form>
        </Modal>
    );
};

export default FormSanPham;
