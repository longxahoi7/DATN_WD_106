import React, { useState } from "react";
import { Space, Table, Button, Modal, message } from "antd";
import { EditOutlined, DeleteOutlined, PlusOutlined } from "@ant-design/icons";
import "../../../style/quanLy.css";
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
        key: "action",
        render: (text, record) => (
            <Space size="middle">
                <EditOutlined
                    style={{ color: "orange" }}
                    onClick={() => handleEdit(record)}
                />
                <DeleteOutlined
                    style={{ color: "red" }}
                    onClick={() => handleDelete(record.key)}
                />
            </Space>
        ),

        align: "center" as "center",
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
    const [currentCategory, setCurrentCategory] = useState(null);

    const handleAddCategory = () => {
        setCurrentCategory(null);
        setIsModalOpen(true);
    };

    const handleEdit = (record) => {
        setCurrentCategory(record);
        setIsModalOpen(true);
    };

    const handleDelete = (key) => {
        Modal.confirm({
            title: "Bạn có chắc chắn muốn xóa danh mục này?",
            onOk: () => {
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
            console.log("Cập nhật danh mục:", values);
        } else {
            console.log("Dữ liệu danh mục mới:", values);
        }
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
