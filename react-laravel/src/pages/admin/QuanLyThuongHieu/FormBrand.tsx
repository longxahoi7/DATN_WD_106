import React, { useEffect } from "react";
import { Modal, Form, Input, Switch } from "antd";

interface FormBrandProps {
    open: boolean;
    onCancel: () => void;
    onOk: (values: any) => void;
    initialValues: any | null;
    loading: boolean;
}

const FormBrand: React.FC<FormBrandProps> = ({
    open,
    onCancel,
    onOk,
    initialValues,
    loading,
}) => {
    const [form] = Form.useForm(); // Khởi tạo form

    useEffect(() => {
        if (initialValues) {
            form.setFieldsValue({
                ...initialValues,
                is_active: initialValues.is_active === 1, // Chuyển 1 -> true, 0 -> false
            });
        } else {
            form.resetFields();
        }
    }, [initialValues, form]);

    const handleOk = () => {
        form.validateFields().then((values) => {
            // Đảm bảo gửi giá trị is_active là 1 hoặc 0
            const updatedValues = {
                ...values,
                is_active: values.is_active ? 1 : 0, // Chuyển true -> 1, false -> 0
            };
            onOk(updatedValues); // Gửi dữ liệu khi form submit
            form.resetFields();
        });
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
            }}
            confirmLoading={loading}
            okText="Lưu"
            cancelText="Hủy"
        >
            <Form form={form} layout="vertical">
                <Form.Item
                    name="name"
                    label="Tên thương hiệu"
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
                    rules={[
                        {
                            required: true,
                            message: "Vui lòng nhập mô tả",
                        },
                    ]}
                >
                    <Input placeholder="Nhập mô tả" />
                </Form.Item>
                <Form.Item
                    name="slug"
                    label="Tên đường dẫn"
                    rules={[
                        {
                            required: true,
                            message: "Vui lòng nhập tên đường dẫn",
                        },
                    ]}
                >
                    <Input placeholder="Nhập tên đường dẫn" />
                </Form.Item>

                <Form.Item
                    name="is_active"
                    label="Trạng thái hoạt động"
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

export default FormBrand;
