import React, { useEffect } from "react";
import { Modal, Form, Input, Switch, DatePicker, InputNumber } from "antd";
import moment from "moment";

interface FormCouponProps {
    open: boolean;
    onCancel: () => void;
    onOk: (values: any) => void;
    initialValues: any | null;
    loading: boolean;
}

const FormCoupon: React.FC<FormCouponProps> = ({
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
                start_date: initialValues.start_date
                    ? moment(initialValues.start_date)
                    : null,
                end_date: initialValues.end_date
                    ? moment(initialValues.end_date)
                    : null,
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
                start_date: values.start_date
                    ? values.start_date.format("YYYY-MM-DD")
                    : null,
                end_date: values.end_date
                    ? values.end_date.format("YYYY-MM-DD")
                    : null,
            };
            onOk(updatedValues); // Gửi dữ liệu khi form submit
            form.resetFields();
        });
    };

    return (
        <Modal
            title={
                initialValues ? "Cập nhật mã giảm giá" : "Thêm mới mã giảm giá"
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
                    name="stt"
                    label="Số thứ tự"
                    rules={[
                        { required: true, message: "Vui lòng nhập số thứ tự" },
                    ]}
                >
                    <InputNumber placeholder="Nhập số thứ tự" min={1} />
                </Form.Item>

                <Form.Item
                    name="code"
                    label="Mã giảm giá"
                    rules={[
                        {
                            required: true,
                            message: "Vui lòng nhập mã giảm giá",
                        },
                    ]}
                >
                    <Input placeholder="Nhập mã giảm giá" />
                </Form.Item>

                <Form.Item
                    name="discount_amount"
                    label="Số tiền giảm"
                    rules={[
                        {
                            required: true,
                            message: "Vui lòng nhập số tiền giảm",
                        },
                    ]}
                >
                    <InputNumber placeholder="Nhập số tiền giảm" min={0} />
                </Form.Item>

                <Form.Item
                    name="discount_percentage"
                    label="Tỷ lệ giảm"
                    rules={[
                        { required: true, message: "Vui lòng nhập tỷ lệ giảm" },
                    ]}
                >
                    <InputNumber
                        placeholder="Nhập tỷ lệ giảm"
                        min={0}
                        max={100}
                        formatter={(value) => `${value}%`}
                    />
                </Form.Item>

                <Form.Item
                    name="quantity"
                    label="Số lượng"
                    rules={[
                        { required: true, message: "Vui lòng nhập số lượng" },
                    ]}
                >
                    <InputNumber placeholder="Nhập số lượng" min={1} />
                </Form.Item>

                <Form.Item
                    name="min_order_value"
                    label="Giá trị đơn hàng tối thiểu"
                    rules={[
                        {
                            required: true,
                            message: "Vui lòng nhập giá trị đơn hàng tối thiểu",
                        },
                    ]}
                >
                    <InputNumber
                        placeholder="Nhập giá trị đơn hàng tối thiểu"
                        min={0}
                    />
                </Form.Item>

                <Form.Item
                    name="max_order_value"
                    label="Giá trị đơn hàng tối đa"
                    rules={[
                        {
                            required: true,
                            message: "Vui lòng nhập giá trị đơn hàng tối đa",
                        },
                    ]}
                >
                    <InputNumber
                        placeholder="Nhập giá trị đơn hàng tối đa"
                        min={0}
                    />
                </Form.Item>

                <Form.Item
                    name="condition"
                    label="Điều kiện"
                    rules={[
                        { required: true, message: "Vui lòng nhập điều kiện" },
                    ]}
                >
                    <Input placeholder="Nhập điều kiện" />
                </Form.Item>

                <Form.Item
                    name="is_public"
                    label="Công khai"
                    valuePropName="checked"
                    rules={[
                        {
                            required: true,
                            message: "Vui lòng chọn trạng thái công khai",
                        },
                    ]}
                >
                    <Switch
                        checked={initialValues?.is_public === 1}
                        onChange={(checked) =>
                            form.setFieldsValue({ is_public: checked ? 1 : 0 })
                        }
                        checkedChildren="Công khai"
                        unCheckedChildren="Không công khai"
                    />
                </Form.Item>

                <Form.Item
                    name="start_date"
                    label="Ngày bắt đầu"
                    rules={[
                        {
                            required: true,
                            message: "Vui lòng chọn ngày bắt đầu",
                        },
                    ]}
                >
                    <DatePicker
                        placeholder="Chọn ngày bắt đầu"
                        style={{ width: "100%" }}
                    />
                </Form.Item>

                <Form.Item
                    name="end_date"
                    label="Ngày kết thúc"
                    rules={[
                        {
                            required: true,
                            message: "Vui lòng chọn ngày kết thúc",
                        },
                    ]}
                >
                    <DatePicker
                        placeholder="Chọn ngày kết thúc"
                        style={{ width: "100%" }}
                    />
                </Form.Item>

                <Form.Item
                    name="is_active"
                    label="Trạng thái hoạt động"
                    valuePropName="checked"
                    rules={[
                        {
                            required: true,
                            message: "Vui lòng chọn trạng thái hoạt động",
                        },
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

export default FormCoupon;
