import React, { useState, useEffect, useMemo } from "react";
import { Space, Table, Button, Modal, message, Tooltip } from "antd";
import { EditOutlined, DeleteOutlined, PlusOutlined } from "@ant-design/icons";
import "../../../style/quanLy.css";
import FormThuongHieu from "./FormThuongHieu";
import type { TooltipProps } from "antd";
import api from "../../../config/axios";
import { Brand } from "../../../interface/IProduct";

const QuanLyThuongHieu = () => {
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
            title: "Tên thương hiệu",
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
                            onClick={() => handleDelete(record.brand_id)}
                        />
                    </Tooltip>
                </Space>
            ),
            align: "center" as "center",
        },
    ];
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [currentBrand, setCurrentBrand] = useState<Brand | null>(
        null
    );
    const [loading, setLoading] = useState(true);
    const [arrow, setArrow] = useState<"Show" | "Hide" | "Center">("Show");
    const [formLoading, setFormLoading] = useState(false); // Thêm state formLoading
    const [brands, setBrands] = useState<Brand[]>([]);

    useEffect(() => {
        const fetchBrand = async () => {
            setLoading(true); // Bắt đầu tải dữ liệu
            try {
                const response = await api.get(
                    "admin/brands/list-brand"
                );
                console.log("Dữ liệu thương hiệu nhận được:", response.data.data);
                const brandData = Array.isArray(response.data.data)
                    ? response.data.data
                    : [];
                setBrands(brandData); // Cập nhật state với dữ liệu nhận được
            } catch (error) {
                console.error("Lỗi khi lấy thương hiệu:", error);
                message.error("Không thể tải thương hiệu.");
            } finally {
                setLoading(false); // Kết thúc tải dữ liệu
            }
        };

        fetchBrand();
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

    const handleAddBrand = () => {
        setCurrentBrand(null);
        setIsModalOpen(true);
    };

    const handleEdit = (record: Brand) => {
        setCurrentBrand(record);
        setIsModalOpen(true);
    };

    const handleDelete = (brand_id: number) => {
        Modal.confirm({
            title: "Bạn có chắc chắn muốn xóa thương hiệu này?",
            onOk: async () => {
                try {
                    await api.delete(
                        `admin/brands/destroy-brand/${brand_id}`
                    ); // Gửi yêu cầu xóa
                    setBrands(
                       brands.filter(
                            (brand) => brand.brand_id !== brand_id
                        )
                    ); // Cập nhật lại danh sách
                    message.success("Xóa thương hiệu thành công");
                } catch (error) {
                    console.error("Xóa thương hiệu thất bại:", error);
                    message.error("Không thể xóa thương hiệu.");
                }
            },
        });
    };

    const handleCancel = () => {
        setIsModalOpen(false);
    };

    const handleOk = async (values: Brand) => {
        setFormLoading(true);
        try {
            if (currentBrand) {
                await api.post(`admin/brands/add-brand`, values);
                setBrands(
                    brands.map((brand) =>
                        brand.brand_id=== currentBrand.brand_id
                            ? { ...brand, ...values }
                            : brand
                    )
                );
                message.success("Cập nhật thương hiệu thành công");
            } else {
                const response = await api.post(
                    "admin/brands/add-brand",
                    values
                );
                setBrands([...brands, response.data]);
                message.success("Thêm thương hiệu thành công");
            }
            setIsModalOpen(false);
        } catch (error) {
            console.error("Lỗi khi thêm/sửathương hiệu:", error);
            message.error("Không thể thêm hoặc sửa thương hiệu.");
        } finally {
            setFormLoading(false);
        }
    };

    return (
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
                    columns={columns(handleEdit, handleDelete)}
                    dataSource={brands.length > 0 ? brands : []}
                    loading={loading}
                    pagination={{ pageSize: 5 }}
                />

                <FormThuongHieu
                    open={isModalOpen}
                    onOk={handleOk}
                    onCancel={handleCancel}
                    initialValues={currentBrand}
                    loading={formLoading}
                />
            </div>
        </div>
    );
};

export default QuanLyThuongHieu;
