import React, { useEffect } from "react";
import { Modal, Form, Input, Upload, Button, InputNumber } from "antd";
import { UploadOutlined, DeleteOutlined } from "@ant-design/icons";

const FormThuocTinh = ({ open, onOk, onCancel, initialValues, loading }) => {
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
            title={
                initialValues ? "Cập nhật thuộc tính" : "Thêm mới thuộc tính"
            }
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
                    <Input placeholder="Nhập tên thuộc tính" />
                </Form.Item>

                <Form.Item
                    label="Giá trị thuộc tính"
                    name="value"
                    rules={[
                        { required: true, message: "Vui lòng nhập giá trị!" },
                    ]}
                >
                    <Input />
                </Form.Item>
            </Form>
        </Modal>
    );
};

export default FormThuocTinh;
