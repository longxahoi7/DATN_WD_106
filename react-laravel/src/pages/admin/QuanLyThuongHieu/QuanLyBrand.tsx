import React, { useState, useEffect } from "react";
import { Space, Table, Button, Modal, message, Tooltip, App } from "antd";
import { EditOutlined, DeleteOutlined, PlusOutlined } from "@ant-design/icons";
import "../../../style/quanLy.css";
import api from "../../../config/axios";
import { Brands } from "../../../interface/IProduct";
import FormBrand from "./FormBrand";

const QuanLyBrand = () => {
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [modalLoading, setModalLoading] = useState(false);
    const [loading, setLoading] = useState(true);
    const [brands, setBrands] = useState<Brands[]>([]);
    const [currentBrand, setCurrentBrand] = useState<Brands | null>(null);
    const [pagination, setPagination] = useState({
        current: 1,
        pageSize: 10,
        total: 0,
    });

    // Lấy danh sách thương hiệu
    const fetchBrands = async (page = 1) => {
        setLoading(true);
        try {
            const response = await api.get(
                `admin/brands/list-brand?page=${page}`
            );
            const { data, total, per_page, current_page } = response.data;
            setBrands(data || []);
            setPagination({
                current: current_page,
                pageSize: per_page,
                total,
            });
        } catch (error) {
            console.error("Lỗi khi lấy danh sách thương hiệu:", error);
            message.error("Không thể tải danh sách thương hiệu.");
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        fetchBrands(pagination.current);
    }, [pagination.current]);

    // Mở modal để thêm thương hiệu mới
    const handleAddBrand = () => {
        setCurrentBrand(null);
        setIsModalOpen(true);
    };

    // Mở modal để chỉnh sửa thương hiệu
    const handleEdit = (record: Brands) => {
        setCurrentBrand(record);
        setIsModalOpen(true);
    };

    // Xóa thương hiệu
    const handleDelete = (brand_id: number) => {
        Modal.confirm({
            title: "Bạn có chắc chắn muốn xóa thương hiệu này?",
            onOk: async () => {
                try {
                    await api.delete(`admin/brands/destroy-brand/${brand_id}`);
                    setBrands((prev) =>
                        prev.filter((brand) => brand.brand_id !== brand_id)
                    );
                    setPagination((prev) => ({
                        ...prev,
                        total: prev.total - 1,
                    }));
                    message.success("Xóa thương hiệu thành công");
                } catch (error) {
                    console.error("Xóa thương hiệu thất bại:", error);
                    message.error("Không thể xóa thương hiệu.");
                }
            },
        });
    };

    // Lưu thông tin thêm hoặc chỉnh sửa thương hiệu
    const handleOk = async (values: Brands) => {
        setModalLoading(true);
        try {
            const updatedValues = {
                ...values,
                is_active: values.is_active ? 1 : 0, // Chuyển true -> 1, false -> 0
            };

            if (currentBrand) {
                // Cập nhật thương hiệu
                const response = await api.put(
                    `admin/brands/update-brand/${currentBrand.brand_id}`,
                    updatedValues
                );
                const updatedBrand = response.data;

                // Cập nhật lại danh sách thương hiệu trong state
                setBrands((prevBrands) =>
                    prevBrands.map((brand) =>
                        brand.brand_id === updatedBrand.brand_id
                            ? { ...brand, ...updatedBrand }
                            : brand
                    )
                );
                await fetchBrands(pagination.current);
                message.success("Cập nhật thương hiệu thành công");
            } else {
                // Thêm mới thương hiệu
                const response = await api.post(
                    "admin/brands/add-brand",
                    updatedValues
                );
                await fetchBrands(pagination.current);
                message.success("Thêm thương hiệu thành công");
            }

            setIsModalOpen(false);
        } catch (error) {
            console.error(
                "Lỗi khi thêm/sửa thương hiệu:",
                error.response?.data || error
            );
            message.error(
                error.response?.data?.message ||
                    "Không thể thêm hoặc sửa thương hiệu."
            );
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
                    <p className="title-css">Quản lý thương hiệu</p>
                </div>
                <div className="table">
                    <Button
                        type="primary"
                        icon={<PlusOutlined />}
                        onClick={handleAddBrand}
                        style={{ marginBottom: "10px", float: "right" }}
                    >
                        Thêm mới
                    </Button>

                    <Table
                        rowKey={(record) =>
                            record.brand_id || `temp-${Date.now()}`
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
                                title: "Tên Thương Hiệu",
                                dataIndex: "name",
                                key: "name",
                                render: (text) => (
                                    <a style={{ color: "green" }}>{text}</a>
                                ),
                                align: "center",
                            },
                            {
                                title: "Mô Tả",
                                dataIndex: "description",
                                key: "description",
                                render: (text) => (
                                    <span>
                                        {text.length > 30
                                            ? `${text.slice(0, 30)}...`
                                            : text}
                                    </span>
                                ),
                                align: "center",
                            },
                            {
                                title: "Hoạt Động",
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
                                                        record.brand_id
                                                    )
                                                }
                                            />
                                        </Tooltip>
                                    </Space>
                                ),
                                align: "center",
                            },
                        ]}
                        dataSource={brands}
                        loading={loading}
                        pagination={{
                            current: pagination.current,
                            pageSize: pagination.pageSize,
                            total: pagination.total,
                            onChange: (page) =>
                                setPagination((prev) => ({
                                    ...prev,
                                    current: page,
                                })),
                        }}
                    />
                </div>

                <FormBrand
                    open={isModalOpen}
                    onCancel={handleCancel}
                    onOk={handleOk}
                    initialValues={currentBrand}
                    loading={modalLoading}
                />
            </div>
        </App>
    );
};

export default QuanLyBrand;
