import React, { useEffect } from "react";
import { Modal, Form, Input, Upload, Button, InputNumber } from "antd";
import { UploadOutlined, DeleteOutlined } from "@ant-design/icons";

const FormThuongHieu = ({ open, onOk, onCancel, initialValues, loading }) => {
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
            title={initialValues ? "Cập nhật thương hiệu" : "Thêm mới thương hiệu"}
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
                            message: "Vui lòng nhập tên thương hiệu",
                        },
                    ]}
                >
                    <Input placeholder="Nhập tên thương hiệu" />
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
                    label="Tên đường dẫn thương hiệu"
                    rules={[
                        {
                            required: true,
                            message: "Vui lòng nhập đường dẫn thương hiệu",
                        },
                    ]}
                >
                    <Input placeholder="Nhập mô tả" />
                </Form.Item>
                <Form.Item
                    name="parent_id"
                    label="thương hiệu thuộc"
                    rules={[
                        {
                            required: true,
                            message: "Vui lòng nhập đường dẫn thương hiệu",
                        },
                    ]}
                >
                    <InputNumber placeholder="Nhập id thương hiệu" />
                </Form.Item>
                <Form.Item
                    name="is_active"
                    label="Hoạt động"
                    rules={[
                        {
                            required: true,
                            message: "Vui lòng nhập đường dẫn thương hiệu",
                        },
                    ]}
                >
                    <InputNumber placeholder="Nhập id hoạt động" />
                </Form.Item>
                
            </Form>
        </Modal>
    );
};

export default FormThuongHieu;
