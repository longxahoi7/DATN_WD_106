import React, { useEffect } from "react";
import { Modal, Form, Input, Upload, Button, InputNumber } from "antd";
import { UploadOutlined } from "@ant-design/icons";

const FormDanhMuc = ({ open, onOk, onCancel, initialValues, loading }) => {
    const [form] = Form.useForm();

    // Reset form when initialValues change
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
                    <Input placeholder="Nhập tên đường dẫn sản phẩm" />
                </Form.Item>
                <Form.Item
                    name="parent_id"
                    label="Danh mục thuộc"
                    rules={[
                        {
                            required: true,
                            message: "Vui lòng nhập ID danh mục cha",
                        },
                    ]}
                >
                    <InputNumber placeholder="Nhập ID danh mục cha" />
                </Form.Item>
                <Form.Item
                    name="is_active"
                    label="Hoạt động"
                    rules={[
                        {
                            required: true,
                            message: "Vui lòng nhập trạng thái hoạt động",
                        },
                    ]}
                >
                    <InputNumber placeholder="Nhập ID trạng thái hoạt động" />
                </Form.Item>
                <Form.Item name="image" label="Hình ảnh">
                    <Upload
                        action="/upload" // Thêm action để xử lý việc tải ảnh lên
                        showUploadList={false} // Tắt hiển thị danh sách ảnh tải lên
                        maxCount={1} // Giới hạn số lượng ảnh tải lên
                    >
                        <Button icon={<UploadOutlined />}>Tải ảnh lên</Button>
                    </Upload>
                </Form.Item>
            </Form>
        </Modal>
    );
};

export default FormDanhMuc;
