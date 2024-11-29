import React, { useState, useEffect } from "react";
import { Space, Table, Button, Modal, message, Tooltip } from "antd";
import { EditOutlined, DeleteOutlined, PlusOutlined } from "@ant-design/icons";
import "../../../style/quanLy.css";
import api from "../../../config/axios";
import { Category } from "../../../interface/IProduct";
import FormDanhMuc from "./FormDanhMuc";

const QuanLyDanhMuc = () => {
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [modalLoading, setModalLoading] = useState(false); // Loading riêng cho modal
    const [loading, setLoading] = useState(true);
    const [categories, setCategories] = useState<Category[]>([]); // Dữ liệu danh mục
    const [currentCategory, setCurrentCategory] = useState<Category | null>(
        null
    );
    const [pagination, setPagination] = useState({
        current: 1,
        pageSize: 10,
        total: 0,
    });

    // Lấy danh sách danh mục
    const fetchCategories = async (page = 1) => {
        setLoading(true);
        try {
            const response = await api.get(
                `admin/categories/list-category?page=${page}`
            );
            const { data, total, per_page, current_page } = response.data;
            setCategories(data?.filter((item) => item?.category_id) || []);
            setPagination({
                current: current_page,
                pageSize: per_page,
                total: total,
            });
        } catch (error) {
            console.error("Lỗi khi lấy danh sách danh mục:", error);
            message.error("Không thể tải danh sách danh mục.");
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        fetchCategories(pagination.current);
    }, [pagination.current]);

    // Mở modal thêm danh mục
    const handleAddCategory = () => {
        setCurrentCategory(null);
        setIsModalOpen(true);
    };

    // Mở modal chỉnh sửa danh mục
    const handleEdit = (record) => {
        setCurrentCategory(record);
        setIsModalOpen(true);
    };

    // Xóa danh mục
    const handleDelete = (category_id) => {
        Modal.confirm({
            title: "Bạn có chắc chắn muốn xóa danh mục này?",
            onOk: async () => {
                try {
                    await api.delete(
                        `admin/categories/delete-category/${category_id}`
                    );
                    setCategories((prev) =>
                        prev.filter(
                            (category) => category.category_id !== category_id
                        )
                    );
                    setPagination((prev) => ({
                        ...prev,
                        total: prev.total - 1,
                    }));
                    await fetchCategories(pagination.current);
                    message.success("Xóa danh mục thành công");
                } catch (error) {
                    console.error("Xóa danh mục thất bại:", error);
                    message.error("Không thể xóa danh mục.");
                }
            },
        });
    };

    // Lưu thêm hoặc cập nhật danh mục
    const handleOk = async (values) => {
        setModalLoading(true);
        try {
            if (currentCategory) {
                const response = await api.put(
                    `admin/categories/update-category/${currentCategory.category_id}`,
                    values
                );
                const updatedCategory = response.data;

                setCategories((prevCategories) =>
                    prevCategories.map((category) =>
                        category.category_id === updatedCategory.category_id
                            ? { ...category, ...updatedCategory }
                            : category
                    )
                );
                await fetchCategories(pagination.current);
                message.success("Cập nhật danh mục thành công");
            } else {
                const response = await api.post(
                    "admin/categories/add-category",
                    values
                );
                await fetchCategories(pagination.current);
                message.success("Thêm danh mục thành công");
            }
            setIsModalOpen(false);
        } catch (error) {
            console.error("Lỗi khi thêm/sửa danh mục:", error);
            message.error("Không thể thêm hoặc sửa danh mục.");
        } finally {
            setModalLoading(false);
        }
    };

    // Hủy modal
    const handleCancel = () => {
        setIsModalOpen(false);
    };

    return (
        <div className="quan-ly-container">
            <div className="header">
                <p className="title-css">Quản lý danh mục</p>
            </div>
            <div className="table">
                <Button
                    type="primary"
                    icon={<PlusOutlined />}
                    onClick={handleAddCategory}
                    style={{ marginBottom: "10px", float: "right" }}
                >
                    Thêm mới
                </Button>

                <Table
                    rowKey={(record) =>
                        record.category_id || `temp-${Date.now()}`
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
                            title: "Tên danh mục",
                            dataIndex: "name",
                            key: "name",
                            render: (text) => (
                                <a style={{ color: "green" }}>{text}</a>
                            ),
                            align: "center",
                        },
                        {
                            title: "Mô tả",
                            dataIndex: "description",
                            key: "description",
                            render: (text) => (
                                <span style={{ color: "gray" }}>{text}</span>
                            ),
                            align: "center",
                        },
                        // {
                        //     title: "Tên đường dẫn sản phẩm",
                        //     dataIndex: "slug",
                        //     key: "slug",
                        //     render: (text) => (
                        //         <span style={{ color: "blue" }}>{text}</span>
                        //     ),
                        //     align: "center",
                        // },
                        // {
                        //     title: "Danh mục thuộc",
                        //     dataIndex: "parent_id",
                        //     key: "parent_id",
                        //     align: "center",
                        // },
                        {
                            title: "Hoạt động",
                            dataIndex: "is_active",
                            key: "is_active",
                            render: (text) => (
                                <span style={{ color: text ? "green" : "red" }}>
                                    {text ? "Hoạt động" : "Không hoạt động"}
                                </span>
                            ),
                            align: "center",
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
                                                handleDelete(record.category_id)
                                            }
                                        />
                                    </Tooltip>
                                </Space>
                            ),
                            align: "center",
                        },
                    ]}
                    dataSource={categories}
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

            <FormDanhMuc
                open={isModalOpen}
                onCancel={handleCancel}
                onOk={handleOk}
                initialValues={currentCategory}
                loading={modalLoading}
            />
        </div>
    );
};

export default QuanLyDanhMuc;
