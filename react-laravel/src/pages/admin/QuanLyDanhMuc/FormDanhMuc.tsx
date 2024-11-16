import React, { useEffect } from "react";
import { Modal, Form, Input, Upload, Button, InputNumber } from "antd";
import { UploadOutlined, DeleteOutlined } from "@ant-design/icons";

const FormDanhMuc = ({ open, onOk, onCancel, initialValues, loading }) => {
    const [form] = Form.useForm();

    useEffect(() => {
        if (initialValues) {
            form.setFieldsValue(initialValues);
        } else {
            form.resetFields();
        }
    }, [initialValues, form]);

    const handleOk = () => {
        form.validateFields().then((values) => {
            onOk(values);
            form.resetFields();
        });
    };

    return (
        <Modal
            title={initialValues ? "Cập nhật danh mục" : "Thêm mới danh mục"}
            open={open}
            onOk={handleOk}
            onCancel={() => {
                onCancel();
                form.resetFields();
            }}
            confirmLoading={loading}
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
                    name="slug"
                    label="Tên đường dẫn sản phẩm"
                    rules={[
                        {
                            required: true,
                            message: "Vui lòng nhập đường dẫn sản phẩm",
                        },
                    ]}
                >
                    <Input placeholder="Nhập mô tả" />
                </Form.Item>
                <Form.Item
                    name="parent_id"
                    label="Danh mục thuộc"
                    rules={[
                        {
                            required: true,
                            message: "Vui lòng nhập đường dẫn sản phẩm",
                        },
                    ]}
                >
                    <InputNumber placeholder="Nhập id Danh Mục" />
                </Form.Item>
                <Form.Item
                    name="is_active"
                    label="Hoạt động"
                    rules={[
                        {
                            required: true,
                            message: "Vui lòng nhập đường dẫn sản phẩm",
                        },
                    ]}
                >
                    <InputNumber placeholder="Nhập id hoạt động" />
                </Form.Item>
                <Form.Item name="image" label="Hình ảnh">
                    <Upload>
                        <Button icon={<UploadOutlined />}>Tải ảnh lên</Button>
                    </Upload>
                </Form.Item>
            </Form>
        </Modal>
    );
};

export default FormDanhMuc;
