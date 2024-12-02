import React, { useEffect } from "react";
import {
    Modal,
    Form,
    Input,
    InputNumber,
    Upload,
    Button,
    Row,
    Col,
    Switch,
} from "antd";
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
                <Row gutter={16}>
                    <Col span={12}>
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
                    </Col>
                    <Col span={12}>
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
                    </Col>
                </Row>

                <Col>
                    <Form.Item
                        name="slug"
                        label="Tên đường dẫn danh mục"
                        rules={[
                            {
                                required: true,
                                message: "Vui lòng nhập đường dẫn danh mục",
                            },
                        ]}
                    >
                        <Input placeholder="Nhập tên đường dẫn danh mục" />
                    </Form.Item>
                </Col>

                <Row gutter={16}>
                    <Col span={12}>
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
                            <InputNumber
                                placeholder="Nhập ID danh mục cha"
                                style={{
                                    width: "100%",
                                }}
                            />
                        </Form.Item>
                    </Col>
                    <Col span={12}>
                        <Form.Item
                            name="is_active"
                            label="Trạng thái hoạt động"
                            valuePropName="checked"
                            rules={[
                                {
                                    required: true,
                                    message: "Vui lòng chọn trạng thái",
                                },
                            ]}
                        >
                            <Switch
                                checked={initialValues?.is_active === 1}
                                onChange={(checked) =>
                                    form.setFieldsValue({
                                        is_active: checked ? 1 : 0,
                                    })
                                }
                                checkedChildren="Hoạt động"
                                unCheckedChildren="Không hoạt động"
                            />
                        </Form.Item>
                    </Col>
                </Row>
            </Form>
        </Modal>
    );
};

export default FormDanhMuc;
