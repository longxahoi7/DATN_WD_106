import React, { useState, useEffect, useMemo } from "react";
import { Space, Table, Button, Modal, message, Tooltip } from "antd";
import { EditOutlined, DeleteOutlined, PlusOutlined } from "@ant-design/icons";
import "../../../style/quanLy.css";
import FormDanhMuc from "./FormDanhMuc";
import type { TooltipProps } from "antd";
import api from "../../../config/axios";
import { Category } from "../../../interface/IProduct";

const QuanLyDanhMuc = () => {
    const columns = (handleEdit, handleDelete) => [
        {
            title: "STT",
            key: "index",
            render: (text, record, index) => (
                <span style={{ display: "flex", justifyContent: "center" }}>
                    {index + 1}
                </span>
            ),
            align: "center" as "center",
            width: "5%",
        },
        {
            title: "Tên Danh Mục",
            dataIndex: "name",
            key: "name",
            render: (text) => <a style={{ color: "green" }}>{text}</a>,
            align: "center" as "center",
        },
        {
            title: "Mô tả",
            dataIndex: "description",
            key: "description",
            align: "center" as "center",
            width: "40%",
        },
        {
            title: "Hình ảnh",
            dataIndex: "image",
            key: "image",
            render: (text) => (
                <div style={{ display: "flex", justifyContent: "center" }}>
                    <img src={text} alt="Category" style={{ width: "50px" }} />
                </div>
            ),
            align: "center" as "center",
            width: "20%",
        },
        {
            key: "action",
            render: (text, record) => (
                <Space size="middle">
                    <Tooltip
                        placement="top"
                        title="chỉnh sửa"
                        arrow={mergedArrow}
                    >
                        <EditOutlined
                            style={{ color: "orange" }}
                            onClick={() => handleEdit(record)}
                        />
                    </Tooltip>
                    <Tooltip placement="top" title="xóa" arrow={mergedArrow}>
                        <DeleteOutlined
                            style={{ color: "red" }}
                            onClick={() => handleDelete(record.category_id)}
                        />
                    </Tooltip>
                </Space>
            ),
            align: "center" as "center",
        },
    ];
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [currentCategory, setCurrentCategory] = useState<Category | null>(
        null
    );
    const [loading, setLoading] = useState(true);
    const [arrow, setArrow] = useState<"Show" | "Hide" | "Center">("Show");
    const [formLoading, setFormLoading] = useState(false); // Thêm state formLoading
    const [categories, setCategories] = useState<Category[]>([]);

    useEffect(() => {
        const fetchCategories = async () => {
            setLoading(true); // Bắt đầu tải dữ liệu
            try {
                const response = await api.get(
                    "admin/categories/list-category"
                );
                console.log("Dữ liệu danh mục nhận được:", response.data.data);
                const categoriesData = Array.isArray(response.data.data)
                    ? response.data.data
                    : [];
                setCategories(categoriesData); // Cập nhật state với dữ liệu nhận được
            } catch (error) {
                console.error("Lỗi khi lấy danh mục:", error);
                message.error("Không thể tải danh mục.");
            } finally {
                setLoading(false); // Kết thúc tải dữ liệu
            }
        };

        fetchCategories();
    }, []);

    const mergedArrow = useMemo<TooltipProps["arrow"]>(() => {
        if (arrow === "Hide") {
            return false;
        }

        if (arrow === "Show") {
            return true;
        }

        return {
            pointAtCenter: true,
        };
    }, [arrow]);

    const handleAddCategory = () => {
        setCurrentCategory(null);
        setIsModalOpen(true);
    };

    const handleEdit = (record: Category) => {
        setCurrentCategory(record);
        setIsModalOpen(true);
    };

    const handleDelete = (category_id: number) => {
        Modal.confirm({
            title: "Bạn có chắc chắn muốn xóa danh mục này?",
            onOk: async () => {
                try {
                    await api.delete(
                        `admin/categories/delete-category/${category_id}`
                    ); // Gửi yêu cầu xóa
                    setCategories(
                        categories.filter(
                            (category) => category.category_id !== category_id
                        )
                    ); // Cập nhật lại danh sách
                    message.success("Xóa danh mục thành công");
                } catch (error) {
                    console.error("Xóa danh mục thất bại:", error);
                    message.error("Không thể xóa danh mục.");
                }
            },
        });
    };

    const handleCancel = () => {
        setIsModalOpen(false);
    };

    const handleOk = async (values: Category) => {
        setFormLoading(true);
        try {
            if (currentCategory) {
                await api.post(`admin/categories/add-category`, values);
                setCategories(
                    categories.map((category) =>
                        category.category_id === currentCategory.category_id
                            ? { ...category, ...values }
                            : category
                    )
                );
                message.success("Cập nhật danh mục thành công");
            } else {
                const response = await api.post(
                    "admin/categories/add-category",
                    values
                );
                setCategories([...categories, response.data]);
                message.success("Thêm danh mục thành công");
            }
            setIsModalOpen(false);
        } catch (error) {
            console.error("Lỗi khi thêm/sửa danh mục:", error);
            message.error("Không thể thêm hoặc sửa danh mục.");
        } finally {
            setFormLoading(false);
        }
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
                    columns={columns(handleEdit, handleDelete)}
                    dataSource={categories.length > 0 ? categories : []}
                    loading={loading}
                    pagination={{ pageSize: 5 }}
                />

                <FormDanhMuc
                    open={isModalOpen}
                    onOk={handleOk}
                    onCancel={handleCancel}
                    initialValues={currentCategory}
                    loading={formLoading}
                />
            </div>
        </div>
    );
};

export default QuanLyDanhMuc;
