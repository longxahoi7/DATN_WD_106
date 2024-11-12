import React, { useState } from "react";
import { Space, Table, Button, Modal, message } from "antd";
import {
    EditOutlined,
    DeleteOutlined,
    PlusOutlined,
    EyeOutlined,
} from "@ant-design/icons";
import "../../../style/quanLy.css";
import FormSanPham from "./FormSanPham";
import DetailSanPham from "./DetailSanPham";

const columns = (handleEdit, handleDelete, handleDetail) => [
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
        title: "Tên Sản Phẩm",
        dataIndex: "name",
        key: "name",
        render: (text) => <a style={{ color: "green" }}>{text}</a>,
        align: "center" as "center",
    },
    {
        title: "Hình ảnh",
        dataIndex: "image",
        key: "image",
        render: (text) => (
            <div style={{ display: "flex", justifyContent: "center" }}>
                <img src={text} alt="Product" style={{ width: "50px" }} />
            </div>
        ),
        align: "center" as "center",
    },
    {
        title: "Giá",
        dataIndex: "price",
        key: "price",
        render: (text) => <span>{text.toLocaleString()} VND</span>,
        align: "center" as "center",
    },
    {
        title: "Danh mục",
        dataIndex: "category",
        key: "category",
        align: "center" as "center",
    },
    {
        key: "action",
        render: (text, record) => (
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
        name: "Sản phẩm A",
        price: 100000,
        category: "Danh mục 1",
        image: "https://via.placeholder.com/50",
        brand: "Thương hiệu 1",
        description:
            "Sản phẩm A là lựa chọn hoàn hảo cho những ai tìm kiếm chất lượng và sự tiện lợi. Với thiết kế hiện đại và tính năng ưu việt, sản phẩm này sẽ đáp ứng mọi nhu cầu của bạn.",
        createdDate: "2024-01-01",
        updatedDate: "2024-02-01",
    },
    {
        key: "2",
        name: "Sản phẩm B",
        price: 150000,
        category: "Danh mục 2",
        image: "https://via.placeholder.com/50",
        brand: "Thương hiệu 2",
        description:
            "Sản phẩm B mang lại sự kết hợp hoàn hảo giữa giá cả và chất lượng. Được sản xuất từ các vật liệu cao cấp, sản phẩm này sẽ làm hài lòng những khách hàng khó tính nhất.",
        createdDate: "2024-01-02",
        updatedDate: "2024-02-02",
    },
    {
        key: "3",
        name: "Sản phẩm C",
        price: 200000,
        category: "Danh mục 3",
        image: "https://via.placeholder.com/50",
        brand: "Thương hiệu 3",
        description:
            "Sản phẩm C là một giải pháp tuyệt vời cho những ai yêu thích sự đổi mới và khác biệt. Với thiết kế độc đáo và tính năng thông minh, sản phẩm này sẽ làm nổi bật phong cách của bạn.",
        createdDate: "2024-01-03",
        updatedDate: "2024-02-03",
    },
    {
        key: "4",
        name: "Sản phẩm D",
        price: 250000,
        category: "Danh mục 4",
        image: "https://via.placeholder.com/50",
        brand: "Thương hiệu 4",
        description:
            "Sản phẩm D không chỉ đẹp mà còn rất thực dụng. Với công nghệ tiên tiến, sản phẩm này giúp bạn tiết kiệm thời gian và công sức trong công việc hàng ngày.",
        createdDate: "2024-01-04",
        updatedDate: "2024-02-04",
    },
    {
        key: "5",
        name: "Sản phẩm E",
        price: 300000,
        category: "Danh mục 5",
        image: "https://via.placeholder.com/50",
        brand: "Thương hiệu 5",
        description:
            "Sản phẩm E được thiết kế để đáp ứng nhu cầu sử dụng hàng ngày. Tính năng vượt trội và độ bền cao giúp sản phẩm này trở thành một phần không thể thiếu trong cuộc sống của bạn.",
        createdDate: "2024-01-05",
        updatedDate: "2024-02-05",
    },
    {
        key: "6",
        name: "Sản phẩm F",
        price: 350000,
        category: "Danh mục 6",
        image: "https://via.placeholder.com/50",
        brand: "Thương hiệu 6",
        description:
            "Sản phẩm F mang đến sự thoải mái và tiện lợi cho người sử dụng. Với chất lượng đảm bảo, sản phẩm này sẽ là lựa chọn hàng đầu cho mọi gia đình.",
        createdDate: "2024-01-06",
        updatedDate: "2024-02-06",
    },
    {
        key: "7",
        name: "Sản phẩm G",
        price: 400000,
        category: "Danh mục 7",
        image: "https://via.placeholder.com/50",
        brand: "Thương hiệu 7",
        description:
            "Sản phẩm G được biết đến với thiết kế tinh tế và hiệu suất vượt trội. Đây là sản phẩm lý tưởng cho những ai yêu thích sự sang trọng và đẳng cấp.",
        createdDate: "2024-01-07",
        updatedDate: "2024-02-07",
    },
    {
        key: "8",
        name: "Sản phẩm H",
        price: 450000,
        category: "Danh mục 8",
        image: "https://via.placeholder.com/50",
        brand: "Thương hiệu 8",
        description:
            "Sản phẩm H cung cấp trải nghiệm tuyệt vời cho người dùng. Với các tính năng thông minh, sản phẩm này sẽ hỗ trợ bạn tối đa trong công việc và cuộc sống.",
        createdDate: "2024-01-08",
        updatedDate: "2024-02-08",
    },
    {
        key: "9",
        name: "Sản phẩm I",
        price: 500000,
        category: "Danh mục 9",
        image: "https://via.placeholder.com/50",
        brand: "Thương hiệu 9",
        description:
            "Sản phẩm I là sự lựa chọn hoàn hảo cho những ai tìm kiếm một sản phẩm chất lượng cao với giá thành hợp lý. Được thiết kế đặc biệt, sản phẩm này sẽ không làm bạn thất vọng.",
        createdDate: "2024-01-09",
        updatedDate: "2024-02-09",
    },
    {
        key: "10",
        name: "Sản phẩm J",
        price: 550000,
        category: "Danh mục 10",
        image: "https://via.placeholder.com/50",
        brand: "Thương hiệu 10",
        description:
            "Sản phẩm J là minh chứng cho sự kết hợp giữa công nghệ và thiết kế. Với hiệu suất tốt và tính năng đa dạng, sản phẩm này sẽ đáp ứng mọi yêu cầu của bạn.",
        createdDate: "2024-01-10",
        updatedDate: "2024-02-10",
    },
];

const QuanLySanPham = () => {
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [currentProduct, setCurrentProduct] = useState(null);
    const [isDetailOpen, setIsDetailOpen] = useState(false);

    const handleAddProduct = () => {
        setCurrentProduct(null);
        setIsModalOpen(true);
    };

    const handleEdit = (record) => {
        setCurrentProduct(record);
        setIsModalOpen(true);
    };

    const handleDelete = (key) => {
        Modal.confirm({
            title: "Bạn có chắc chắn muốn xóa sản phẩm này?",
            onOk: () => {
                console.log(`Đã xóa sản phẩm với key: ${key}`);
                message.success("Xóa sản phẩm thành công");
            },
        });
    };

    const handleCancel = () => {
        setIsModalOpen(false);
    };

    const handleOk = (values) => {
        if (currentProduct) {
            console.log("Cập nhật sản phẩm:", values);
        } else {
            console.log("Dữ liệu sản phẩm mới:", values);
        }
        setIsModalOpen(false);
    };

    const handleDetail = (record) => {
        setCurrentProduct(record);
        setIsDetailOpen(true);
    };

    const handleDetailClose = () => {
        setIsDetailOpen(false);
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
                    dataSource={data}
                    pagination={{ pageSize: 4 }}
                />

                <FormSanPham
                    open={isModalOpen}
                    onOk={handleOk}
                    onCancel={handleCancel}
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
