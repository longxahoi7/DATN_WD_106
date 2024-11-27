import React, { useState } from "react";
import { TruckOutlined } from "@ant-design/icons";
import {
    MenuFoldOutlined,
    MenuUnfoldOutlined,
    DashboardOutlined,
    AppstoreAddOutlined,
    TagsOutlined,
} from "@ant-design/icons";
import { Button, Layout, Menu, theme } from "antd";
import { Outlet, Link, useLocation } from "react-router-dom";
import type { MenuProps } from "antd";
import logo from "../../public/image/logo/logo-remove.png";
import "../style/layout.css";

const { Header, Sider, Content } = Layout;

const AdminLayout: React.FC = () => {
    const [collapsed, setCollapsed] = useState<boolean>(false);
    const location = useLocation();

    const {
        token: { colorBgContainer, borderRadiusLG },
    } = theme.useToken();

    const items: MenuProps["items"] = [
        {
            key: "1",
            icon: <DashboardOutlined />,
            label: <Link to="dashboard">Thống kê</Link>,
        },
        {
            key: "sub1",
            icon: <AppstoreAddOutlined />,
            label: "Quản lý",
            children: [
                {
                    key: "2",
                    label: (
                        <Link to="categorymanagement">Quản lý danh mục</Link>
                    ),
                },
                {
                    key: "3",
                    label: <Link to="productmanagement">Quản lý sản phẩm</Link>,
                },
                {
                    key: "4",
                    label: (
                        <Link to="attributemanagement">Quản lý thuộc tính</Link>
                    ),
                },
                {
                    key: "5",
                    label: <Link to="/">Quản lý đơn hàng</Link>,
                },
            ],
        },
        {
            key: "6",
            icon: <TagsOutlined />,
            label: "Thương hiệu",
        },
        {
            key: "7",
            icon: <TruckOutlined />,
            label: "Shipper",
        },
    ];

    return (
        <Layout>
            <Sider
                theme="light"
                trigger={null}
                collapsible
                collapsed={collapsed}
                className="custom-sider"
            >
                <Link to="" className="logo">
                    <img
                        src={logo}
                        alt="logo"
                        style={{
                            width: 100,
                            height: 55,
                            boxShadow: "-moz-initial",
                        }}
                    />
                </Link>
                <Menu
                    theme="light"
                    mode="inline"
                    defaultSelectedKeys={["1"]}
                    items={items}
                />
            </Sider>
            <Layout>
                <Header
                    style={{
                        padding: 0,
                        background: colorBgContainer,
                    }}
                >
                    <Button
                        type="text"
                        icon={
                            collapsed ? (
                                <MenuUnfoldOutlined
                                    style={{ color: "black" }}
                                />
                            ) : (
                                <MenuFoldOutlined style={{ color: "black" }} />
                            )
                        }
                        onClick={() => setCollapsed(!collapsed)}
                        style={{
                            fontSize: "16px",
                            width: 64,
                            height: 64,
                        }}
                    />
                </Header>
                <Content
                    className="custom-contentOutlet"
                    style={{
                        margin: "24px 16px",
                        padding: 24,
                        background: colorBgContainer,
                        borderRadius: borderRadiusLG,
                    }}
                >
                    <Outlet />
                </Content>
            </Layout>
        </Layout>
    );
};

export default AdminLayout;
