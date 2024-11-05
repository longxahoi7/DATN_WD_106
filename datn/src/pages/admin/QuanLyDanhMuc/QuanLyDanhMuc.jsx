import React, { useState } from "react";
import { Space, Table, Button, Modal, message } from "antd";
import {
    EditOutlined,
    DeleteOutlined,
    PlusOutlined,
    EyeOutlined,
} from "@ant-design/icons";
import "./quanLy.css";
import FormDanhMuc from "./FormDanhMuc";

const columns = (handleEdit, handleDelete) => [
    {
        title: "STT",
        key: "index",
        render: (text, record, index) => (
            <span style={{ display: "flex", justifyContent: "center" }}>
                {index + 1}
            </span>
        ),
        align: "center",
    },
    {
        title: "Tên Danh Mục",
        dataIndex: "name",
        key: "name",
        render: (text) => <a style={{ color: "green" }}>{text}</a>,
        align: "center",
    },
    {
        title: "Mô tả",
        dataIndex: "description",
        key: "description",
        align: "center",
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
        align: "center",
    },
    {
        key: "action",
        render: (text, record) => (
            <Space size="middle">
                <EditOutlined
                    style={{ color: "orange" }}
                    onClick={() => handleEdit(record)} // Thêm sự kiện chỉnh sửa
                />
                <DeleteOutlined
                    style={{ color: "red" }}
                    onClick={() => handleDelete(record.key)} // Thêm sự kiện xóa
                />
            </Space>
        ),
        align: "center",
    },
];

const data = [
    {
        key: "1",
        name: "Danh mục A",
        description: "Mô tả danh mục A",
        image: "https://via.placeholder.com/50",
    },
    {
        key: "2",
        name: "Danh mục B",
        description: "Mô tả danh mục B",
        image: "https://via.placeholder.com/50",
    },
    {
        key: "3",
        name: "Danh mục C",
        description: "Mô tả danh mục C",
        image: "https://via.placeholder.com/50",
    },
];

const QuanLyDanhMuc = () => {
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [currentCategory, setCurrentCategory] = useState(null); // State lưu trữ danh mục hiện tại

    const handleAddCategory = () => {
        setCurrentCategory(null); // Khi thêm mới, không có danh mục hiện tại
        setIsModalOpen(true);
    };

    const handleEdit = (record) => {
        setCurrentCategory(record); // Lưu danh mục hiện tại để chỉnh sửa
        setIsModalOpen(true);
    };

    const handleDelete = (key) => {
        Modal.confirm({
            title: "Bạn có chắc chắn muốn xóa danh mục này?",
            onOk: () => {
                // Xử lý xóa danh mục ở đây
                console.log(`Đã xóa danh mục với key: ${key}`);
                message.success("Xóa danh mục thành công");
            },
        });
    };

    const handleCancel = () => {
        setIsModalOpen(false);
    };

    const handleOk = (values) => {
        if (currentCategory) {
            // Cập nhật danh mục hiện tại
            console.log("Cập nhật danh mục:", values);
        } else {
            // Thêm danh mục mới
            console.log("Dữ liệu danh mục mới:", values);
        }
        setIsModalOpen(false);
    };

    return (
        <div className="quan-ly-danh-muc-container">
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
                    dataSource={data}
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
