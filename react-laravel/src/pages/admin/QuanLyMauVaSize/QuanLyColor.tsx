import React, { useState, useEffect } from "react";
import { Space, Table, Button, Modal, message, Tooltip } from "antd";
import { EditOutlined, DeleteOutlined, PlusOutlined } from "@ant-design/icons";
import "../../../style/quanLy.css";
import api from "../../../config/axios";
import { Color } from "../../../interface/IProduct";
import FormColor from "./FormColor";

const QuanLyColor = () => {
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [modalLoading, setModalLoading] = useState(false); // Loading riêng cho modal
    const [loading, setLoading] = useState(true);
    const [colors, setColors] = useState<Color[]>([]);
    const [currentColor, setCurrentColor] = useState<Color | null>(null);
    const [pagination, setPagination] = useState({
        current: 1,
        pageSize: 10,
        total: 0,
    });

    // Fetch list of colors
    const fetchColors = async (page = 1) => {
        setLoading(true);
        try {
            const response = await api.get(
                `admin/colors/list-color?page=${page}`
            );
            const { data, total, per_page, current_page } = response.data;
            setColors(data?.filter((item) => item?.color_id) || []);
            setPagination({
                current: current_page,
                pageSize: per_page,
                total: total,
            });
        } catch (error) {
            console.error("Lỗi khi lấy danh sách màu:", error);
            message.error("Không thể tải danh sách màu.");
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        fetchColors(pagination.current);
    }, [pagination.current]);

    const handleAddColor = () => {
        setCurrentColor(null);
        setIsModalOpen(true);
    };

    const handleEdit = (record: Color) => {
        setCurrentColor(record);
        setIsModalOpen(true);
    };

    const handleDelete = (color_id: number) => {
        Modal.confirm({
            title: "Bạn có chắc chắn muốn xóa màu này?",
            onOk: async () => {
                try {
                    await api.delete(`admin/colors/destroy-color/${color_id}`);
                    setColors((prev) =>
                        prev.filter((color) => color.color_id !== color_id)
                    );
                    setPagination((prev) => ({
                        ...prev,
                        total: prev.total - 1,
                    }));
                    await fetchColors(pagination.current);
                    message.success("Xóa màu thành công");
                } catch (error) {
                    console.error("Xóa màu thất bại:", error);
                    message.error("Không thể xóa màu.");
                }
            },
        });
    };

    const handleOk = async (values: Color) => {
        setModalLoading(true);
        try {
            if (currentColor) {
                const response = await api.put(
                    `admin/colors/update-color/${currentColor.color_id}`,
                    values
                );
                const updatedColor = response.data;

                setColors((prevColors) =>
                    prevColors.map((color) =>
                        color.color_id === updatedColor.color_id
                            ? { ...color, ...updatedColor }
                            : color
                    )
                );
                await fetchColors(pagination.current);
                message.success("Cập nhật màu thành công");
            } else {
                const response = await api.post(
                    "admin/colors/add-color",
                    values
                );
                await fetchColors(pagination.current);
                message.success("Thêm màu thành công");
            }
            setIsModalOpen(false);
        } catch (error) {
            console.error("Lỗi khi thêm/sửa màu:", error);
            message.error("Không thể thêm hoặc sửa màu.");
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
                <p className="title-css">Quản lý màu sắc</p>
            </div>
            <div className="table">
                <Button
                    type="primary"
                    icon={<PlusOutlined />}
                    onClick={handleAddColor}
                    style={{ marginBottom: "10px", float: "right" }}
                >
                    Thêm mới
                </Button>

                <Table
                    rowKey={(record) => record.color_id || `temp-${Date.now()}`}
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
                            title: "Tên Màu",
                            dataIndex: "name",
                            key: "name",
                            render: (text) => (
                                <a style={{ color: "green" }}>{text}</a>
                            ),
                            align: "center" as "center",
                        },
                        {
                            title: "Mã Màu",
                            dataIndex: "color_code",
                            key: "color_code",
                            render: (text) => (
                                <span
                                    style={{
                                        display: "inline-block",
                                        width: "40px",
                                        height: "20px",
                                        backgroundColor: text,
                                    }}
                                ></span>
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
                                                handleDelete(record.color_id)
                                            }
                                        />
                                    </Tooltip>
                                </Space>
                            ),
                            align: "center" as "center",
                        },
                    ]}
                    dataSource={colors}
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

            <FormColor
                open={isModalOpen}
                onCancel={handleCancel}
                onOk={handleOk}
                initialValues={currentColor}
                loading={modalLoading}
            />
        </div>
    );
};

export default QuanLyColor;
