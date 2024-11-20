import React, { useState, useEffect, useMemo } from "react";
import { Space, Table, Button, Modal, message, Tooltip } from "antd";
import { EditOutlined, DeleteOutlined, PlusOutlined } from "@ant-design/icons";
import "../../../style/quanLy.css";
import FormThuocTinh from "./FormThuocTinh";
import type { TooltipProps } from "antd";
import api from "../../../config/axios";
import { Attributes } from "../../../interface/IProduct";

const QuanLyThuocTinh = () => {
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
            title: "Tên Thuộc Tính",
            dataIndex: "name",
            key: "name",
            render: (text) => <a style={{ color: "green" }}>{text}</a>,
            align: "center" as "center",
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
                            onClick={() => handleDelete(record.attribute_id)}
                        />
                    </Tooltip>
                </Space>
            ),
            align: "center" as "center",
        },
    ];
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [currentAttributes, setCurrentAttributes] =
        useState<Attributes | null>(null);
    const [loading, setLoading] = useState(true);
    const [arrow, setArrow] = useState<"Show" | "Hide" | "Center">("Show");
    const [formLoading, setFormLoading] = useState(false); // Thêm state formLoading
    const [attattributes, setattattributes] = useState<Attributes[]>([]);

    useEffect(() => {
        const fetchAttributes = async () => {
            setLoading(true); // Bắt đầu tải dữ liệu
            try {
                const response = await api.get(
                    "admin/attributes/list-attribute"
                );
                console.log(
                    "Dữ liệu thuộc tính nhận được:",
                    response.data.data
                );
                const attributeData = Array.isArray(response.data.data)
                    ? response.data.data
                    : [];
                setattattributes(attributeData); // Cập nhật state với dữ liệu nhận được
            } catch (error) {
                console.error("Lỗi khi lấy thuộc tính:", error);
                message.error("Không thể tải thuộc tính.");
            } finally {
                setLoading(false); // Kết thúc tải dữ liệu
            }
        };

        fetchAttributes();
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

    const handleAddAttributes = () => {
        setCurrentAttributes(null);
        setIsModalOpen(true);
    };

    const handleEdit = (record: Attributes) => {
        setCurrentAttributes(record);
        setIsModalOpen(true);
    };

    const handleDelete = (attribute_id: number) => {
        Modal.confirm({
            title: "Bạn có chắc chắn muốn xóa danh mục này?",
            onOk: async () => {
                try {
                    await api.delete(
                        `admin/attributes/destroy-attribute/${attribute_id}`
                    ); // Gửi yêu cầu xóa
                    setattattributes(
                        attattributes.filter(
                            (attribute) =>
                                attribute.attribute_id !== attribute_id
                        )
                    ); // Cập nhật lại danh sách
                    message.success("Xóa thuộc tính thành công");
                } catch (error) {
                    console.error("Xóa thuộc tính thất bại:", error);
                    message.error("Không thể xóa thuộc tính.");
                }
            },
        });
    };

    const handleCancel = () => {
        setIsModalOpen(false);
    };

    const handleOk = async (values: Attributes) => {
        setFormLoading(true); // Bắt đầu quá trình lưu
        try {
            if (currentAttributes) {
                // Nếu có thuộc tính đang chỉnh sửa, sử dụng PUT hoặc PATCH
                await api.put(
                    `admin/attributes/update-attribute/${currentAttributes.attribute_id}`,
                    values
                );
                // Cập nhật danh sách thuộc tính sau khi sửa
                setattattributes(
                    attattributes.map((attribute) =>
                        attribute.attribute_id ===
                        currentAttributes.attribute_id
                            ? { ...attribute, ...values }
                            : attribute
                    )
                );
                message.success("Cập nhật thuộc tính thành công");
            } else {
                // Nếu không có thuộc tính đang chỉnh sửa, thêm mới thuộc tính
                const response = await api.post(
                    "admin/attributes/add-attribute",
                    values
                );
                setattattributes([...attattributes, response.data]);
                message.success("Thêm thuộc tính thành công");
            }
            setIsModalOpen(false); // Đóng modal sau khi lưu thành công
        } catch (error) {
            console.error("Lỗi khi thêm/sửa thuộc tính:", error);
            message.error("Không thể thêm hoặc sửa thuộc tính.");
        } finally {
            setFormLoading(false); // Kết thúc quá trình lưu
        }
    };

    return (
        <div className="quan-ly-container">
            <div className="header">
                <p className="title-css">Quản lý thuộc tính</p>
            </div>
            <div className="table">
                <Button
                    type="primary"
                    icon={<PlusOutlined />}
                    onClick={handleAddAttributes}
                    style={{ marginBottom: "10px", float: "right" }}
                >
                    Thêm mới
                </Button>
                <Table
                    columns={columns(handleEdit, handleDelete)}
                    dataSource={attattributes.length > 0 ? attattributes : []}
                    loading={loading}
                    pagination={{ pageSize: 5 }}
                />

                <FormThuocTinh
                    open={isModalOpen}
                    onOk={handleOk}
                    onCancel={handleCancel}
                    initialValues={currentAttributes}
                    loading={formLoading}
                />
            </div>
        </div>
    );
};

export default QuanLyThuocTinh;
