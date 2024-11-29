import React, { useState, useEffect } from "react";
import { Space, Table, Button, Modal, message, Tooltip, App } from "antd";
import { EditOutlined, DeleteOutlined, PlusOutlined } from "@ant-design/icons";
import "../../../style/quanLy.css";
import api from "../../../config/axios";
import { Coupon } from "../../../interface/IProduct";
import FormCoupon from "./FormCoupon";

const QuanLyCoupon = () => {
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [modalLoading, setModalLoading] = useState(false);
    const [loading, setLoading] = useState(true);
    const [coupons, setCoupons] = useState<Coupon[]>([]);
    const [currentCoupon, setCurrentCoupon] = useState<Coupon | null>(null);
    const [pagination, setPagination] = useState({
        current: 1,
        pageSize: 10,
        total: 0,
    });

    // Lấy danh sách mã giảm giá
    const fetchCoupons = async (page = 1) => {
        setLoading(true);
        try {
            const response = await api.get(
                `admin/coupons/list-coupon?page=${page}`
            );
            const { data, total, per_page, current_page } = response.data;
            setCoupons(data || []);
            setPagination({
                current: current_page,
                pageSize: per_page,
                total,
            });
        } catch (error) {
            console.error("Lỗi khi lấy danh sách mã giảm giá:", error);
            message.error("Không thể tải danh sách mã giảm giá.");
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        fetchCoupons(pagination.current);
    }, [pagination.current]);

    // Mở modal để thêm mã giảm giá mới
    const handleAddCoupon = () => {
        setCurrentCoupon(null);
        setIsModalOpen(true);
    };

    // Mở modal để chỉnh sửa mã giảm giá
    const handleEdit = (record: Coupon) => {
        // Specify Coupon type for record
        setCurrentCoupon(record);
        setIsModalOpen(true);
    };

    // Xóa mã giảm giá
    const handleDelete = (coupon_id: number) => {
        Modal.confirm({
            title: "Bạn có chắc chắn muốn xóa mã giảm giá này?",
            onOk: async () => {
                try {
                    await api.delete(
                        `admin/coupons/destroy-coupon/${coupon_id}`
                    );
                    setCoupons((prev) =>
                        prev.filter((coupon) => coupon.coupon_id !== coupon_id)
                    );
                    setPagination((prev) => ({
                        ...prev,
                        total: prev.total - 1,
                    }));
                    message.success("Xóa mã giảm giá thành công");
                } catch (error) {
                    console.error("Xóa mã giảm giá thất bại:", error);
                    message.error("Không thể xóa mã giảm giá.");
                }
            },
        });
    };

    // Lưu thông tin thêm hoặc chỉnh sửa mã giảm giá
    const handleOk = async (values: any) => {
        // Update type as needed for form values
        setModalLoading(true);
        try {
            const updatedValues = {
                ...values,
                is_active: values.is_active ? 1 : 0,
            };

            if (currentCoupon) {
                // Cập nhật mã giảm giá
                const response = await api.put(
                    `admin/coupons/update-coupon/${currentCoupon.coupon_id}`,
                    updatedValues
                );
                const updatedCoupon = response.data;

                // Cập nhật lại danh sách mã giảm giá trong state
                setCoupons((prevCoupons) =>
                    prevCoupons.map((coupon) =>
                        coupon.coupon_id === updatedCoupon.coupon_id
                            ? { ...coupon, ...updatedCoupon }
                            : coupon
                    )
                );
                await fetchCoupons(pagination.current);
                message.success("Cập nhật mã giảm giá thành công");
            } else {
                // Thêm mới mã giảm giá
                const response = await api.post(
                    "admin/coupons/add-coupon",
                    updatedValues
                );
                await fetchCoupons(pagination.current);
                message.success("Thêm mã giảm giá thành công");
            }

            setIsModalOpen(false);
        } catch (error) {
            console.error("Lỗi khi thêm/sửa mã giảm giá:", error);
            message.error("Không thể thêm hoặc sửa mã giảm giá.");
        } finally {
            setModalLoading(false);
        }
    };

    const handleCancel = () => {
        setIsModalOpen(false);
    };

    return (
        <App>
            <div className="quan-ly-container">
                <div className="header">
                    <p className="title-css">Quản lý Mã Giảm Giá</p>
                </div>
                <div className="table">
                    <Button
                        type="primary"
                        icon={<PlusOutlined />}
                        onClick={handleAddCoupon}
                        style={{ marginBottom: "10px", float: "right" }}
                    >
                        Thêm mới
                    </Button>

                    <Table
                        rowKey={(record) =>
                            record.coupon_id || `temp-${Date.now()}`
                        }
                        columns={[
                            {
                                title: "STT",
                                key: "index",
                                render: (text, record, index) => (
                                    <span
                                        style={{
                                            display: "flex",
                                            justifyContent: "center",
                                        }}
                                    >
                                        {index + 1}
                                    </span>
                                ),
                                align: "center",
                                width: "5%",
                            },
                            {
                                title: "Mã Giảm Giá",
                                dataIndex: "code",
                                key: "code",
                                align: "center",
                            },
                            {
                                title: "Số Tiền Giảm",
                                dataIndex: "discount_amount",
                                key: "discount_amount",
                                align: "center",
                            },
                            {
                                title: "Tỷ Lệ Giảm",
                                dataIndex: "discount_percentage",
                                key: "discount_percentage",
                                align: "center",
                            },
                            {
                                title: "Số Lượng",
                                dataIndex: "quantity",
                                key: "quantity",
                                align: "center",
                            },
                            {
                                title: "Giá trị Đơn Hàng Tối Thiểu",
                                dataIndex: "min_order_value",
                                key: "min_order_value",
                                align: "center",
                            },
                            {
                                title: "Giá trị Đơn Hàng Tối Đa",
                                dataIndex: "max_order_value",
                                key: "max_order_value",
                                align: "center",
                            },
                            {
                                title: "Điều Kiện",
                                dataIndex: "condition",
                                key: "condition",
                                align: "center",
                            },
                            {
                                title: "Công Khai",
                                dataIndex: "is_public",
                                key: "is_public",
                                render: (text) => (
                                    <span
                                        style={{
                                            color: text ? "green" : "red",
                                        }}
                                    >
                                        {text ? "Công khai" : "Không công khai"}
                                    </span>
                                ),
                                align: "center",
                            },
                            {
                                title: "Ngày Bắt Đầu",
                                dataIndex: "start_date",
                                key: "start_date",
                                align: "center",
                            },
                            {
                                title: "Ngày Kết Thúc",
                                dataIndex: "end_date",
                                key: "end_date",
                                align: "center",
                            },
                            {
                                title: "Trạng Thái",
                                dataIndex: "is_active",
                                key: "is_active",
                                render: (text) => (
                                    <span
                                        style={{
                                            color: text ? "green" : "red",
                                        }}
                                    >
                                        {text === 1
                                            ? "Hoạt động"
                                            : "Không hoạt động"}
                                    </span>
                                ),
                                align: "center",
                            },
                            {
                                key: "action",
                                render: (text, record) => (
                                    <Space size="middle">
                                        <Tooltip
                                            placement="top"
                                            title="Chỉnh sửa"
                                        >
                                            <EditOutlined
                                                style={{ color: "orange" }}
                                                onClick={() =>
                                                    handleEdit(record)
                                                }
                                            />
                                        </Tooltip>
                                        <Tooltip placement="top" title="Xóa">
                                            <DeleteOutlined
                                                style={{ color: "red" }}
                                                onClick={() =>
                                                    handleDelete(
                                                        record.coupon_id
                                                    )
                                                }
                                            />
                                        </Tooltip>
                                    </Space>
                                ),
                                align: "center",
                            },
                        ]}
                        dataSource={coupons}
                        pagination={{
                            current: pagination.current,
                            pageSize: pagination.pageSize,
                            total: pagination.total,
                            onChange: (page) =>
                                setPagination({ ...pagination, current: page }),
                        }}
                        loading={loading}
                    />
                </div>

                <FormCoupon
                    open={isModalOpen}
                    onCancel={handleCancel}
                    onOk={handleOk}
                    initialValues={currentCoupon}
                    loading={modalLoading}
                ></FormCoupon>
            </div>
        </App>
    );
};

export default QuanLyCoupon;
