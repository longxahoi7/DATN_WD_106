import React, { useEffect, useState, useCallback } from "react";
import { Space, Table, Button, Modal, message, Image } from "antd";
import {
    EditOutlined,
    DeleteOutlined,
    PlusOutlined,
    EyeOutlined,
} from "@ant-design/icons";
import "../../../style/quanLy.css";
import FormSanPham from "./FormSanPham";
import DetailSanPham from "./DetailSanPham";
import { IProduct } from "../../../interface/IProduct";
import api from "../../../config/axios";

const QuanLySanPham = () => {
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [isDetailOpen, setIsDetailOpen] = useState(false);
    const [loading, setLoading] = useState(true);
    const [formLoading, setFormLoading] = useState(false);
    const [currentProduct, setCurrentProduct] = useState<IProduct | null>(null);
    const [products, setProducts] = useState<IProduct[]>([]);

    const fetchProducts = useCallback(async () => {
        setLoading(true);
        try {
            const response = await api.get("admin/products/list-product");
            const parseProducts = Array.isArray(response.data?.data)
                ? response.data.data
                : [];
            setProducts(parseProducts);
        } catch (error) {
            console.error("Lỗi khi lấy sản phẩm:", error);
            message.error("Không thể tải sản phẩm.");
        } finally {
            setLoading(false);
        }
    }, []);

    useEffect(() => {
        fetchProducts();
    }, [fetchProducts]);

    const handleModalOpen = (product: IProduct | null) => {
        setCurrentProduct(product);
        setIsModalOpen(true);
    };

    const handleDetailOpen = (product: IProduct) => {
        setCurrentProduct(product);
        setIsDetailOpen(true);
    };

    const handleDelete = async (product_id: number) => {
        Modal.confirm({
            title: "Bạn có chắc chắn muốn xóa sản phẩm này?",
            onOk: async () => {
                try {
                    await api.delete(
                        `admin/products/destroy-product/${product_id}`
                    );
                    setProducts(
                        products.filter(
                            (product) => product.product_id !== product_id
                        )
                    );
                    message.success("Xóa sản phẩm thành công");
                } catch (error) {
                    console.error("Xóa sản phẩm thất bại:", error);
                    message.error("Không thể xóa sản phẩm.");
                }
            },
        });
    };

    const handleOk = async (values: IProduct) => {
        setFormLoading(true);
        try {
            if (currentProduct) {
                // Sửa sản phẩm
                await api.put(
                    `admin/products/update-product/${currentProduct.product_id}`,
                    values
                );
                setProducts((prev) =>
                    prev.map((product) =>
                        product.product_id === currentProduct.product_id
                            ? { ...product, ...values }
                            : product
                    )
                );
                message.success("Cập nhật sản phẩm thành công");
            } else {
                // Thêm mới sản phẩm
                const response = await api.post(
                    "admin/products/add-product",
                    values
                );
                setProducts((prev) => [...prev, response.data]);
                message.success("Thêm sản phẩm thành công");
            }
            setIsModalOpen(false);
        } catch (error) {
            console.error("Lỗi khi thêm/sửa sản phẩm:", error);
            message.error("Không thể thêm hoặc sửa sản phẩm.");
        } finally {
            setFormLoading(false);
        }
    };

    const columns = [
        {
            title: "Mã sản phẩm",
            dataIndex: "product_id",
            key: "product_id",
            align: "center" as const,
        },
        {
            title: "Tên Sản Phẩm",
            dataIndex: "name",
            key: "name",
            render: (name) => <span style={{ color: "green" }}>{name}</span>,
            align: "center" as const,
        },
        {
            title: "Hình ảnh",
            dataIndex: "main_image_url",
            key: "main_image_url",
            render: (imageURL) => (
                <Image
                    src={imageURL}
                    alt="Product"
                    width={50}
                    preview={false}
                />
            ),
            align: "center" as const,
        },
        {
            title: "Mô tả",
            dataIndex: "description",
            key: "description",
            align: "center" as const,
        },
        {
            title: "Danh mục",
            dataIndex: "category",
            key: "category",
            render: (category) => <span>{category?.name}</span>,
            align: "center" as const,
        },
        {
            title: "Thương hiệu",
            dataIndex: "brand",
            key: "brand",
            render: (brand) => <span>{brand?.name}</span>,
            align: "center" as const,
        },
        {
            title: "Thao tác",
            key: "action",
            render: (record: IProduct) => (
                <Space size="middle">
                    <EyeOutlined
                        style={{ color: "green" }}
                        onClick={() => handleDetailOpen(record)}
                    />
                    <EditOutlined
                        style={{ color: "orange" }}
                        onClick={() => handleModalOpen(record)}
                    />
                    <DeleteOutlined
                        style={{ color: "red" }}
                        onClick={() => handleDelete(record.product_id)}
                    />
                </Space>
            ),
            align: "center" as const,
        },
    ];

    return (
        <div className="quan-ly-san-pham-container">
            <div className="header">
                <p className="title-css">Quản lý sản phẩm</p>
            </div>
            <Button
                type="primary"
                icon={<PlusOutlined />}
                onClick={() => handleModalOpen(null)}
                style={{ marginBottom: "10px", float: "right" }}
            >
                Thêm mới
            </Button>
            <Table
                columns={columns}
                dataSource={products}
                pagination={{ pageSize: 5 }}
                loading={loading}
                rowKey={(record) => record.product_id}
            />
            <FormSanPham
                open={isModalOpen}
                onOk={handleOk}
                onCancel={() => setIsModalOpen(false)}
                initialValues={currentProduct}
            />
            <DetailSanPham
                open={isDetailOpen}
                onClose={() => setIsDetailOpen(false)}
                product={currentProduct}
            />
        </div>
    );
};

export default QuanLySanPham;
