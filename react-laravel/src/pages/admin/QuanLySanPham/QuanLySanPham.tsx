import React, { useEffect, useState } from "react";
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
    const columns = (handleEdit, handleDelete, handleDetail) => [
        {
            title: "STT",
            key: "index",
            render: (text, record, index) => (
                <span style={{ display: "flex", justifyContent: "center" }}>
                    {index + 1}
                </span>
            ),
            align: "center" as const,
        },
        {
            title: "Tên Sản Phẩm",
            dataIndex: "name",
            key: "name",
            render: (text) => <a style={{ color: "green" }}>{text}</a>,
            align: "center" as const,
        },
        {
            title: "Hình ảnh",
            dataIndex: "image",
            key: "image",
            render: (text) => (
                <div
                    style={{
                        display: "flex",
                        justifyContent: "center",
                    }}
                >
                    <Image
                        src={text || "default-image-url"} // Thay "default-image-url" bằng URL mặc định bạn muốn
                        alt="Product"
                        width={50}
                        preview={false} // Không cần preview khi click vào hình
                    />
                </div>
            ),
            align: "center" as const,
        },
        {
            title: "Mô tả",
            dataIndex: "description",
            key: "description",
            render: (text) => <a>{text}</a>,
            align: "center" as const,
            width: "30%",
        },
        {
            title: "Giá",
            dataIndex: "price",
            key: "price",
            render: (text) => (
                <span>
                    {text ? `${text.toLocaleString()} VND` : "chưa có giá"}
                </span>
            ),
            align: "center" as const,
        },
        {
            title: "Danh mục",
            dataIndex: "product_category_id",
            key: "product_category_id",
            render: (text) => <span>{text?.product_category_id}</span>,
            align: "center" as const,
        },
        {
            key: "action",
            render: (text, record: IProduct) => (
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
                        onClick={() => handleDelete(record.product_id)}
                    />
                </Space>
            ),
            align: "center" as const,
        },
    ];

    const [isModalOpen, setIsModalOpen] = useState(false);
    const [currentProduct, setCurrentProduct] = useState<IProduct | null>(null);
    const [loading, setLoading] = useState(true);
    const [formLoading, setFormLoading] = useState(false);
    const [products, setProducts] = useState<IProduct[]>([]);
    const [isDetailOpen, setIsDetailOpen] = useState(false);

    const fetchProducts = async () => {
        setLoading(true);
        try {
            const response = await api.get("admin/products/list-product"); // Đúng API sản phẩm
            const productsData = Array.isArray(response.data.data)
                ? response.data.data
                : [];
            setProducts(productsData);
            console.log(response.data.data);
        } catch (error) {
            console.error("Lỗi khi lấy sản phẩm:", error);
            message.error("Không thể tải sản phẩm.");
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        fetchProducts();
    }, []);

    const handleAddProduct = () => {
        setCurrentProduct(null);
        setIsModalOpen(true);
    };

    const handleEdit = (record: IProduct) => {
        setCurrentProduct(record);
        setIsModalOpen(true);
    };

    const handleDelete = (product_id: number) => {
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

    const handleDetail = (record: IProduct) => {
        setCurrentProduct(record);
        setIsDetailOpen(true);
    };

    const handleDetailClose = () => {
        setIsDetailOpen(false);
    };

    const handleOk = async (values: IProduct) => {
        setFormLoading(true);
        try {
            if (currentProduct) {
                await api.put(
                    `admin/products/update-product/${currentProduct.product_id}`, // Sử dụng PUT cho update
                    values
                );
                setProducts(
                    products.map((product) =>
                        product.product_id === currentProduct.product_id
                            ? { ...product, ...values }
                            : product
                    )
                );
                message.success("Cập nhật sản phẩm thành công");
            } else {
                const response = await api.post(
                    "admin/products/add-product",
                    values
                );
                setProducts([...products, response.data]);
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

    return (
        <div className="quan-ly-san-pham-container">
            <div className="header">
                <p className="title-css">Quản lý sản phẩm</p>
            </div>
            <div className="table">
                <Button
                    type="primary"
                    icon={<PlusOutlined />}
                    onClick={handleAddProduct}
                    style={{ marginBottom: "10px", float: "right" }}
                >
                    Thêm mới
                </Button>
                <Table
                    columns={columns(handleEdit, handleDelete, handleDetail)}
                    dataSource={products}
                    pagination={{ pageSize: 5 }}
                    loading={loading}
                    rowKey={(record) => record.product_id} // Sử dụng product_id làm khóa
                />
                <FormSanPham
                    open={isModalOpen}
                    onOk={handleOk}
                    onCancel={() => setIsModalOpen(false)}
                    initialValues={currentProduct}
                />
                <DetailSanPham
                    open={isDetailOpen}
                    onClose={handleDetailClose}
                    product={currentProduct}
                />
            </div>
        </div>
    );
};

export default QuanLySanPham;
