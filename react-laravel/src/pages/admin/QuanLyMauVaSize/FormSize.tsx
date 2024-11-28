import React, { useEffect } from "react";
import { Modal, Form, Input, Button } from "antd";
import { Size } from "../../../interface/IProduct";

interface FormSizeProps {
    open: boolean;
    onCancel: () => void;
    onOk: (values: Size) => void;
    initialValues: Size | null;
    loading: boolean;
}

const FormSize: React.FC<FormSizeProps> = ({
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

    const handleFinish = (values: Size) => {
        onOk(values); // Gửi dữ liệu khi form submit
    };

    return (
        <Modal
            title={
                initialValues ? "Chỉnh sửa kích thước" : "Thêm mới kích thước"
            }
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
                    label="Tên Kích Thước"
                    name="name"
                    rules={[
                        {
                            required: true,
                            message: "Tên kích thước không được để trống",
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

export default FormSize;
