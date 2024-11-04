import React from "react";
import { BrowserRouter as Router, Route, Routes } from "react-router-dom";
import DashboardPage from "./pages/admin/Dashboard/DashboardPage";
import AdminLayout from "./layouts/AdminLayout";
import QuanLyDanhMuc from "./pages/admin/QuanLyDanhMuc/QuanLyDanhMuc";
import { ConfigProvider } from "antd";
import QuanLySanPham from "./pages/admin/QuanLySanPham/QuanLySanPham";

const App = () => {
    return (
        <Router>
            {/* Routes cho trang admin */}
            <ConfigProvider
                theme={{
                    token: {
                        colorPrimary: "#00CD66",
                        colorSuccess: "#00CD66",
                    },
                }}
            >
                <Routes>
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
                        {/* <Route path="categories" element={<CategoriesList />} />
                    <Route path="orders" element={<OrdersList />} />
                    <Route path="customers" element={<CustomersList />} />
                    <Route path="employees" element={<EmployeesList />} /> */}
                    </Route>

                    {/* Routes cho trang người dùng */}
                    {/* <Route path="/" element={<UserLayout />}>
                    <Route path="" element={<HomePage />} />
                    <Route path="products/:id" element={<ProductDetail />} />
                    <Route path="cart" element={<CartPage />} />
                    <Route path="login" element={<LoginPage />} />
                    <Route path="register" element={<RegisterPage />} />
                </Route> */}
                </Routes>
            </ConfigProvider>
        </Router>
    );
};

export default App;
