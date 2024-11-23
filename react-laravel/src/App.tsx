import React from "react";
import "./App.css";
import {
    BrowserRouter as Router,
    Route,
    Routes,
    Navigate,
} from "react-router-dom";
import { ConfigProvider, theme as antdTheme } from "antd";
import { ThemeConfig } from "antd/es/config-provider/context";
import KhachHangThanThiet from "./pages/user/HuongDan/KhachHangThanThiet";
import HuongDanMuaHang from "./pages/user/HuongDan/HuongDanMuaHang";
import HuongDanDoiHang from "./pages/user/HuongDan/HuongDanDoiHang";
import HuongDanBaoQuan from "./pages/user/HuongDan/HuongDanBaoQuan";
import DoiTacSanXuat from "./pages/user/HuongDan/DoiTacSanXuat";
import Register from "./pages/user/auth/Register";
import Login from "./pages/user/auth/Login";
import ForgotPassword from "./pages/user/ForgotPassword";
import AdminLayout from "./layout/AdminLayout";
import DashboardPage from "./pages/admin/Dashboard/DashboardPage";
import QuanLyDanhMuc from "./pages/admin/QuanLyDanhMuc/QuanLyDanhMuc";
import QuanLySanPham from "./pages/admin/QuanLySanPham/QuanLySanPham";
import ProductList from "./pages/user/Product/ProductList";
import ProductDetail from "./pages/user/Product/ProductDetail";
import LienHe from "./pages/user/Product/LienHe";
import Introduce from "./pages/user/Product/Introduce";
import Pay from "./pages/user/Product/Pay";
import Location from "./pages/user/Product/Location";
import UserLayout from "./layout/UserLayout";
import Product from "./pages/user/Product/Product";
import NotFound from "./pages/404NotFound";
import ChiTietGioHang from "./pages/user/ChiTietGioHang/ChiTietGioHang";
import QuanLyThuocTinh from "./pages/admin/QuanLyThuocTinh/QuanLyThuocTinh";
import QuanLyThuongHieu from "./pages/admin/QuanLyThuongHieu/QuanLyThuongHieu";
// import ChiTietGioHang from "./pages/user/ChiTietGioHang/ChiTietGioHang";

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
                    <Route
                        path="attributemanagement"
                        element={<QuanLyThuocTinh />}
                    />
                    <Route
                        path="brandmanagement"
                        element={<QuanLyThuongHieu />}
                    />
                </Route>

                {/* Routes cho trang người dùng */}
                <Route path="" element={<UserLayout />}>
                    <Route path="" element={<ProductList />} />
                    <Route
                        path="product-detail/:id"
                        element={<ProductDetail />}
                    />
                    <Route path="contact" element={<LienHe />} />
                    <Route path="introduce" element={<Introduce />} />
                    <Route path="pay" element={<Pay />} />
                    <Route path="clothingCare" element={<HuongDanBaoQuan />} />
                    <Route
                        path="buyingInstructions"
                        element={<HuongDanMuaHang />}
                    />
                    <Route
                        path="loyalCustomers"
                        element={<KhachHangThanThiet />}
                    />
                    <Route path="returnPolicy" element={<HuongDanDoiHang />} />
                    <Route
                        path="productionPartners"
                        element={<DoiTacSanXuat />}
                    />
                    <Route path="location" element={<Location />} />
                    <Route path="products/:category" element={<Product />} />
                    <Route path="cart" element={<ChiTietGioHang />} />
                </Route>
                <Route path="login" element={<Login />} />
                <Route path="register" element={<Register />} />
                <Route path="forgotPassword" element={<ForgotPassword />} />
                <Route path="*" element={<NotFound />} />
            </Routes>
        </ConfigProvider>
    );
};

export default App;
