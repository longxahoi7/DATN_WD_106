import React, { useState, useEffect } from "react";
import { Space, Table, Button, Modal, message } from "antd";
import { EditOutlined, DeleteOutlined, PlusOutlined } from "@ant-design/icons";
import "../../../style/quanLy.css";
import FormDanhMuc from "./FormDanhMuc";
import api from "../../../config/axios";
import { Category } from "../../../interface/IProduct";

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
    },
    {
        title: "Trạng thái",
        dataIndex: "is_active",
        key: "is_active",
        render: (text) => (
            <span>{text === 1 ? "Hoạt động" : "Không hoạt động"}</span>
        ),
        align: "center" as "center",
    },
    {
        key: "action",
        render: (text, record) => (
            <Space size="middle">
                <EditOutlined
                    style={{ color: "orange" }}
                    onClick={() => handleEdit(record)}
                />
                <DeleteOutlined
                    style={{ color: "red" }}
                    onClick={() => handleDelete(record.category_id)}
                />
            </Space>
        ),
        align: "center" as "center",
    },
];

const QuanLyDanhMuc = () => {
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [currentCategory, setCurrentCategory] = useState<Category | null>(
        null
    ); // Định nghĩa kiểu cho category hiện tại
    const [categories, setCategories] = useState<Category[]>([]); // Định nghĩa kiểu cho mảng danh mục

    useEffect(() => {
        // Lấy danh sách danh mục từ API khi component được render
        const fetchCategories = async () => {
            try {
                const response = await api.get(
                    "admin/categories/list-category"
                );
                setCategories(response.data); // Gán dữ liệu từ API vào state
            } catch (error) {
                console.error("Lỗi khi lấy danh mục:", error);
                message.error("Không thể tải danh mục.");
            }
        };
        fetchCategories();
    }, []);

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
                    await api.delete(`admin/categories/${category_id}`); // Gửi yêu cầu xóa
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
        try {
            if (currentCategory) {
                // Cập nhật danh mục
                await api.put(
                    `admin/categories/${currentCategory.category_id}`,
                    values
                );
                message.success("Cập nhật danh mục thành công");
            } else {
                // Thêm mới danh mục
                await api.post("admin/categories", values);
                message.success("Thêm danh mục thành công");
            }
            setIsModalOpen(false);
            // Cập nhật lại danh sách danh mục
            const response = await api.get("admin/categories");
            setCategories(response.data);
        } catch (error) {
            console.error("Lỗi khi thêm/sửa danh mục:", error);
            message.error("Không thể thêm hoặc sửa danh mục.");
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
                    dataSource={categories}
                    pagination={{ pageSize: 4 }}
                />

                <FormDanhMuc
                    open={isModalOpen}
                    onOk={handleOk}
                    onCancel={handleCancel}
                    initialValues={currentCategory}
                />
            </div>
        </div>
    );
};

export default QuanLyDanhMuc;
