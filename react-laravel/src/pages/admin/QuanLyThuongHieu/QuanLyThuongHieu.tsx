import React, { useEffect, useState } from "react";
import { Space, Table, Button, Modal, message, Image } from "antd";
import {
    EditOutlined,
    DeleteOutlined,
    PlusOutlined,
    EyeOutlined,
} from "@ant-design/icons";
import "../../../style/quanLy.css";
import FormSanPham from "./FromThuongHieu";
import DetailSanPham from "./DetailthuongHieu";
import { Brands, Category, IProduct } from "../../../interface/IProduct";
import api from "../../../config/axios";
import FormThuongHieu from "./FromThuongHieu";
import DetailThuongHieu from "./DetailthuongHieu";

const QuanLyThuongHieu = () => {
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [isDetailOpen, setIsDetailOpen] = useState(false);
    const [loading, setLoading] = useState(true);
    const [formLoading, setFormLoading] = useState(false);

    const [currentBrand, setCurrentBrand] = useState<Brands | null>(null);

    const [brands, setBrands] = useState<Brands[]>([]);

    const fetchBrands = async () => {
        setLoading(true);
        try {
            const response = await api.get("admin/brands/list-brand");
            console.log(response, "response");

            const parseBrands = Array.isArray(response.data.data)
                ? response.data.data
                : [];
            setBrands(parseBrands);
        } catch (error) {
            console.error("Lỗi khi lấy thương hiệu:", error);
            message.error("Không thể tải thương hiệu.");
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        fetchBrands();
    }, []);

    const columns = (handleEdit, handleDelete, handleDetail) => [
        {
            title: "Mã thương hiệu",
            dataIndex: "brand_id",
            key: "brand_id",
            render: (brand_id) => (
                <span style={{ display: "flex", justifyContent: "center" }}>
                    {brand_id}
                </span>
            ),
            align: "center" as const,
        },
        {
            title: "Tên thương hiệu",
            dataIndex: "name",
            key: "name",
            render: (name) => <a style={{ color: "green" }}>{name}</a>,
            align: "center" as const,
        },
        {
            title: "Mô tả",
            dataIndex: "description",
            key: "description",
            render: (description) => <a>{description}</a>,
            align: "center" as const,
            width: "30%",
        },
        {
            title: "Slug",
            dataIndex: "slug",
            key: "slug",
            render: (slug) => <a>{slug}</a>,
            align: "center" as const,
            width: "30%",
        },

        {
            key: "action",
            render: (text, record: Brands) => (
                <Space size="middle">
                    <EyeOutlined
                        style={{ color: "green" }}
                        onClick={() => handleDetail(record)}
                    />
                    <EditOutlined
                        style={{ color: "orange" }}
                        onClick={() => handleEdit(record)}
                    />
                    <DeleteOutlined
                        style={{ color: "red" }}
                        onClick={() => handleDelete(record.brand_id)}
                    />
                </Space>
            ),
            align: "center" as const,
        },
    ];

    const handleAddBrand = () => {
        setCurrentBrand(null);
        setIsModalOpen(true);
    };

    const handleEdit = (record: Brands) => {
        setCurrentBrand(record);
        setIsModalOpen(true);
    };

    const handleDelete = (brand_id: number) => {
        Modal.confirm({
            title: "Bạn có chắc chắn muốn xóa sản phẩm này?",
            onOk: async () => {
                try {
                    await api.delete(`admin/brands/destroy-brand/${brand_id}`);
                    setBrands(
                        brands.filter((brand) => brand.brand_id !== brand_id)
                    );
                    message.success("Xóa thương hiệu thành công");
                } catch (error) {
                    console.error("Xóa thương hiệu thất bại:", error);
                    message.error("Không thể xóa thương hiệu.");
                }
            },
        });
    };

    const handleDetail = (record: Brands) => {
        setCurrentBrand(record);
        setIsDetailOpen(true);
    };

    const handleDetailClose = () => {
        setIsDetailOpen(false);
    };

    const handleOk = async (values: Brands) => {
        setFormLoading(true);
        try {
            if (currentBrand) {
                await api.put(
                    `admin/brands/update-brand/${currentBrand.brand_id}`, // Sử dụng PUT cho update
                    values
                );
                setBrands(
                    brands.map((brand) =>
                        brand.brand_id === currentBrand.brand_id
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
            console.error("Lỗi khi thêm/sửa thương hiệu:", error);
            message.error("Không thể thêm hoặc sửa thương hiệu.");
        } finally {
            setFormLoading(false);
        }
    };

    return (
        <div className="quan-ly-san-pham-container">
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
                    columns={columns(handleEdit, handleDelete, handleDetail)}
                    dataSource={brands}
                    pagination={{ pageSize: 5 }}
                    loading={loading}
                    rowKey={(record) => record.brand_id}
                />
                <FormThuongHieu
                    open={isModalOpen}
                    onOk={handleOk}
                    onCancel={() => setIsModalOpen(false)}
                    initialValues={currentBrand}
                />
                <DetailThuongHieu
                    open={isDetailOpen}
                    onClose={handleDetailClose}
                    brand={currentBrand}
                />
            </div>
        </div>
    );
};

export default QuanLyThuongHieu;
