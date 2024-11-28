import React, { useEffect } from "react";
import { Modal, Form, Input, Button } from "antd";
import { Color } from "../../../interface/IProduct";

interface FormColorProps {
    open: boolean;
    onCancel: () => void;
    onOk: (values: Color) => void;
    initialValues: Color | null;
    loading: boolean;
}

const FormColor: React.FC<FormColorProps> = ({
    open,
    onCancel,
    onOk,
    initialValues,
    loading,
}) => {
    const [form] = Form.useForm(); // Khởi tạo form

    useEffect(() => {
        // Cập nhật giá trị form nếu initialValues thay đổi
        if (initialValues) {
            form.setFieldsValue(initialValues);
        } else {
            form.resetFields();
        }
    }, [initialValues, form]);

    const handleFinish = (values: Color) => {
        onOk(values); // Gửi dữ liệu khi form submit
    };

    return (
        <Modal
            title={initialValues ? "Chỉnh sửa màu sắc" : "Thêm mới màu sắc"}
            open={open} // Đảm bảo sử dụng prop `open`
            onCancel={onCancel}
            onOk={form.submit} // Kích hoạt submit khi nhấn OK
            confirmLoading={loading}
        >
            <Form
                form={form} // Kết nối form với instance được tạo từ `useForm`
                onFinish={handleFinish} // Không sử dụng `initialValues` ở đây
            >
                <Form.Item
                    label="Tên Màu"
                    name="name"
                    rules={[
                        {
                            required: true,
                            message: "Tên màu không được để trống",
                        },
                    ]}
                >
                    <Input />
                </Form.Item>
                <Form.Item
                    label="Mã Màu"
                    name="color_code"
                    rules={[
                        {
                            required: true,
                            message: "Mã màu không được để trống",
                        },
                    ]}
                >
                    <Input />
                </Form.Item>
                {/* <Form.Item>
                    <Button
                        type="primary"
                        htmlType="submit"
                        loading={loading}
                        block
                    >
                        Lưu
                    </Button>
                </Form.Item> */}
            </Form>
        </Modal>
    );
};

export default FormColor;
