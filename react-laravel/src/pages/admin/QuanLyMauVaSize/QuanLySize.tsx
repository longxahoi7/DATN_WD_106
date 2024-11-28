import React, { useState, useEffect } from "react";
import { Space, Table, Button, Modal, message, Tooltip } from "antd";
import { EditOutlined, DeleteOutlined, PlusOutlined } from "@ant-design/icons";
import "../../../style/quanLy.css";
import api from "../../../config/axios";
import { Size } from "../../../interface/IProduct";
import FormSize from "./FormSize";

const QuanLySize = () => {
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [modalLoading, setModalLoading] = useState(false); // Loading riêng cho modal
    const [loading, setLoading] = useState(true);
    const [sizes, setSizes] = useState<Size[]>([]);
    const [currentSize, setCurrentSize] = useState<Size | null>(null);
    const [pagination, setPagination] = useState({
        current: 1,
        pageSize: 10,
        total: 0,
    });

    const fetchSizes = async (page = 1) => {
        setLoading(true);
        try {
            const response = await api.get(
                `admin/sizes/list-size?page=${page}`
            );
            const { data, total, per_page, current_page } = response.data;
            setSizes(data?.filter((item) => item?.size_id) || []);
            setPagination({
                current: current_page,
                pageSize: per_page,
                total: total,
            });
        } catch (error) {
            console.error("Lỗi khi lấy danh sách size:", error);
            message.error("Không thể tải danh sách size.");
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        fetchSizes(pagination.current);
    }, [pagination.current]);

    const handleAddSize = () => {
        setCurrentSize(null);
        setIsModalOpen(true);
    };

    const handleEdit = (record: Size) => {
        setCurrentSize(record);
        setIsModalOpen(true);
    };

    const handleDelete = (size_id: number) => {
        Modal.confirm({
            title: "Bạn có chắc chắn muốn xóa size này?",
            onOk: async () => {
                try {
                    await api.delete(`admin/sizes/destroy-size/${size_id}`);
                    setSizes((prev) =>
                        prev.filter((size) => size.size_id !== size_id)
                    );
                    setPagination((prev) => ({
                        ...prev,
                        total: prev.total - 1,
                    }));
                    await fetchSizes(pagination.current);
                    message.success("Xóa size thành công");
                } catch (error) {
                    console.error("Xóa size thất bại:", error);
                    message.error("Không thể xóa size.");
                }
            },
        });
    };

    const handleOk = async (values: Size) => {
        setModalLoading(true);
        try {
            if (currentSize) {
                const response = await api.put(
                    `admin/sizes/update-size/${currentSize.size_id}`,
                    values
                );
                const updatedSize = response.data;

                setSizes((prevSizes) =>
                    prevSizes.map((size) =>
                        size.size_id === updatedSize.size_id
                            ? { ...size, ...updatedSize }
                            : size
                    )
                );
                await fetchSizes(pagination.current);
                message.success("Cập nhật size thành công");
            } else {
                const response = await api.post("admin/sizes/add-size", values);
                await fetchSizes(pagination.current); // Gọi lại API
                message.success("Thêm size thành công");
            }
            setIsModalOpen(false);
        } catch (error) {
            console.error("Lỗi khi thêm/sửa size:", error);
            message.error("Không thể thêm hoặc sửa size.");
        } finally {
            setModalLoading(false);
        }
    };

    const handleCancel = () => {
        setIsModalOpen(false);
    };

    return (
        <div className="quan-ly-container">
            <div className="header">
                <p className="title-css">Quản lý kích thước (Size)</p>
            </div>
            <div className="table">
                <Button
                    type="primary"
                    icon={<PlusOutlined />}
                    onClick={handleAddSize}
                    style={{ marginBottom: "10px", float: "right" }}
                >
                    Thêm mới
                </Button>

                <Table
                    rowKey={(record) => record.size_id || `temp-${Date.now()}`}
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
                            align: "center" as "center",
                            width: "5%",
                        },
                        {
                            title: "Tên Size",
                            dataIndex: "name",
                            key: "name",
                            render: (text) => (
                                <a style={{ color: "green" }}>{text}</a>
                            ),
                            align: "center" as "center",
                        },
                        {
                            key: "action",
                            render: (text, record) => (
                                <Space size="middle">
                                    <Tooltip placement="top" title="Chỉnh sửa">
                                        <EditOutlined
                                            style={{ color: "orange" }}
                                            onClick={() => handleEdit(record)}
                                        />
                                    </Tooltip>
                                    <Tooltip placement="top" title="Xóa">
                                        <DeleteOutlined
                                            style={{ color: "red" }}
                                            onClick={() =>
                                                handleDelete(record.size_id)
                                            }
                                        />
                                    </Tooltip>
                                </Space>
                            ),
                            align: "center" as "center",
                        },
                    ]}
                    dataSource={sizes}
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

            <FormSize
                open={isModalOpen}
                onCancel={handleCancel}
                onOk={handleOk}
                initialValues={currentSize}
                loading={modalLoading}
            />
        </div>
    );
};

export default QuanLySize;
