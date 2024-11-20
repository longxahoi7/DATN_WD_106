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
import { Brands, Category, IProduct } from "../../../interface/IProduct";
import api from "../../../config/axios";

const QuanLySanPham = () => {
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [isDetailOpen, setIsDetailOpen] = useState(false);
    const [loading, setLoading] = useState(true);
    const [formLoading, setFormLoading] = useState(false);

    const [currentProduct, setCurrentProduct] = useState<IProduct | null>(null);
    const [products, setProducts] = useState<IProduct[]>([]);
    const [brands, setBrands] = useState<Brands[]>([]);
    const [categories, setCategories] = useState<Category[]>([]);

    const [attributeColors, setAttributeColors] = useState<[]>([]);
    const [attributesSizes, setAttributeSizes] = useState<[]>([]);

    // const [attributeColors, setAttributeColors] = useState<Attributes[]>([]);
    // const [attributesSizes, setAttributeSizes] = useState<Attributes[]>([]);

    const fetchProducts = async () => {
        setLoading(true);
        try {
            const response = await api.get("admin/products/get-data");
            console.log(response, "response");

            const parseProducts = Array.isArray(response.data.products)
                ? response.data.products
                : [];
            setProducts(parseProducts);

            const parseBrands = Array.isArray(response.data.brands)
                ? response.data.brands
                : [];
            setBrands(parseBrands);

            const parseCategories = Array.isArray(response.data.categories)
                ? response.data.categories
                : [];
            setCategories(parseCategories);
            // console.log(categories, "categories");

            const parseAttributeColors = Array.isArray(response.data.colors)
                ? response.data.colors
                : [];
            setAttributeColors(parseAttributeColors);
            // console.log(attributeColors, "attributeColors");

            const parseAttributeSizes = Array.isArray(response.data.sizes)
                ? response.data.sizes
                : [];
            setAttributeSizes(parseAttributeSizes);
            // console.log(attributesSizes, "attributesSizes");
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

    const columns = (handleEdit, handleDelete, handleDetail) => [
        // {
        //     title: "STT",
        //     key: "index",
        //     render: (text, record, index) => (
        //         <span style={{ display: "flex", justifyContent: "center" }}>
        //             {index + 1}
        //         </span>
        //     ),
        //     align: "center" as const,
        // },
        {
            title: "Mã sản phẩm",
            dataIndex: "product_id",
            key: "product_id",
            render: (product_id) => (
                <span style={{ display: "flex", justifyContent: "center" }}>
                    {product_id}
                </span>
            ),
            align: "center" as const,
        },
        {
            title: "Tên Sản Phẩm",
            dataIndex: "name",
            key: "name",
            render: (name) => <a style={{ color: "green" }}>{name}</a>,
            align: "center" as const,
        },
        {
            title: "Hình ảnh",
            dataIndex: "main_image_url",
            key: "main_image_url",
            render: (imageURL) => (
                <div
                    style={{
                        display: "flex",
                        justifyContent: "center",
                    }}
                >
                    <Image
                        src={imageURL}
                        alt="Product"
                        width={50}
                        preview={false}
                    />
                </div>
            ),
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
            title: "Giá",
            dataIndex: "price",
            key: "price",
            render: (price) => (
                <span>
                    {price ? `${price.toLocaleString()} VND` : "chưa có giá"}
                </span>
            ),
            align: "center" as const,
        },
        {
            title: "Danh mục",
            dataIndex: "category",
            key: "category",
            render: (category) => <span>{category.name}</span>,
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
                    rowKey={(record) => record.product_id}
                />
                <FormSanPham
                    open={isModalOpen}
                    onOk={handleOk}
                    onCancel={() => setIsModalOpen(false)}
                    initialValues={currentProduct}
                    brands={brands}
                    categories={categories}
                    attributeColors={attributeColors}
                    attributesSizes={attributesSizes}
                />
                <DetailSanPham
                    open={isDetailOpen}
                    onClose={handleDetailClose}
                    product={currentProduct}
                    brand={brands}
                />
            </div>
        </div>
    );
};

export default QuanLySanPham;
