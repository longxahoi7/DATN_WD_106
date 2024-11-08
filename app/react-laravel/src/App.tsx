import React from "react";
import "./App.css";
import { BrowserRouter as Router, Route, Routes } from "react-router-dom";
import { ConfigProvider, theme as antdTheme } from "antd";
import { ThemeConfig } from "antd/es/config-provider/context";

import ProductList from "./layout/Product/ProductList";
import Location from "./layout/Product/Location";
import LienHe from "./layout/Product/LienHe";
import Products from "./layout/Product/Products";
import ProductDetail from "./layout/Product/ProductDetail";
import Introduce from "./layout/Product/Introduce";
import Pay from "./layout/Product/Pay";
import KhachHangThanThiet from "./pages/user/HuongDan/KhachHangThanThiet";
import HuongDanMuaHang from "./pages/user/HuongDan/HuongDanMuaHang";
import HuongDanDoiHang from "./pages/user/HuongDan/HuongDanDoiHang";
import HuongDanBaoQuan from "./pages/user/HuongDan/HuongDanBaoQuan";
import DoiTacSanXuat from "./pages/user/HuongDan/DoiTacSanXuat";
import Register from "./pages/user/Register";
import Login from "./pages/user/Login";
import ForgotPassword from "./pages/user/ForgotPassword";
import AdminLayout from "./layout/AdminLayout";
import DashboardPage from "./pages/admin/Dashboard/DashboardPage";
import QuanLyDanhMuc from "./pages/admin/QuanLyDanhMuc/QuanLyDanhMuc";
import QuanLySanPham from "./pages/admin/QuanLySanPham/QuanLySanPham";

const App: React.FC = () => {
    const themeConfig: ThemeConfig = {
        token: {
            colorPrimary: "#00CD66",
            colorSuccess: "#00CD66",
        },
    };

    return (
        <ConfigProvider theme={themeConfig}>
            <Routes>
                {/* Routes cho trang admin */}
                <Route path="admin" element={<AdminLayout />}>
                    <Route path="dashboard" element={<DashboardPage />} />
                    <Route
                        path="categorymanagement"
                        element={<QuanLyDanhMuc />}
                    />
                    <Route
                        path="productmanagement"
                        element={<QuanLySanPham />}
                    />
                </Route>

                {/* Routes cho trang người dùng */}
                <Route path="" element={<ProductList />} />
                <Route path="product-detail/:id" element={<ProductDetail />} />
                <Route path="contact" element={<LienHe />} />
                <Route path="introduce" element={<Introduce />} />
                <Route path="pay" element={<Pay />} />
                <Route path="clothingCare" element={<HuongDanBaoQuan />} />
                <Route
                    path="buyingInstructions"
                    element={<HuongDanMuaHang />}
                />
                <Route path="loyalCustomers" element={<KhachHangThanThiet />} />
                <Route path="returnPolicy" element={<HuongDanDoiHang />} />
                <Route path="productionPartners" element={<DoiTacSanXuat />} />
                <Route path="location" element={<Location />} />
                <Route path="products/:category" element={<Products />} />
                <Route path="login" element={<Login />} />
                <Route path="register" element={<Register />} />
                <Route path="forgotPassword" element={<ForgotPassword />} />
            </Routes>
        </ConfigProvider>
    );
};

export default App;
