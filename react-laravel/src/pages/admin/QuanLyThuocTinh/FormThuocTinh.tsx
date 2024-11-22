import React, { useEffect, useState } from "react";
import { Modal, Form, Input, Button, Select } from "antd";

const FormThuocTinh = ({ open, onOk, onCancel, initialValues, loading }) => {
    const [form] = Form.useForm();
    const [attributeType, setAttributeType] = useState('color'); // state để lưu loại thuộc tính ('color' hoặc 'size')

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

    // Hàm xử lý khi người dùng thay đổi loại thuộc tính
    const handleAttributeChange = (value) => {
        setAttributeType(value);
    };

    return (
        <Modal
            title={initialValues ? "Cập nhật thuộc tính" : "Thêm mới thuộc tính"}
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
                    label="Tên thuộc tính"
                    rules={[
                        {
                            required: true,
                            message: "Vui lòng nhập tên thuộc tính",
                        },
                    ]}
                >
                    <Select
                        defaultValue="color"
                        onChange={handleAttributeChange}
                    >
                        <Select.Option value="color">Màu sắc</Select.Option>
                        <Select.Option value="size">Kích thước</Select.Option>
                    </Select>
                </Form.Item>

                {/* Input cho giá trị của thuộc tính */}
                {attributeType === 'color' ? (
                    <Form.Item
                        label="Giá trị thuộc tính"
                        name="value"
                        rules={[{ required: true, message: "Vui lòng chọn giá trị!" }]}
                    >
                        <Input type="color" />
                    </Form.Item>
                ) : (
                    <Form.Item
                        label="Giá trị thuộc tính"
                        name="value"
                        rules={[{ required: true, message: "Vui lòng nhập giá trị!" }]}
                    >
                        <Input placeholder="Nhập giá trị thuộc tính (X, M, L, XL...)" />
                    </Form.Item>
                )}
            </Form>
        </Modal>
    );
};

export default FormThuocTinh;
