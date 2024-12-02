import React from "react";
import { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import { BrowserRouter } from "react-router-dom";
import { ConfigProvider, App as AntdApp } from "antd"; // Đổi tên App của Ant Design để tránh trùng với App của bạn
import App from "./App";
import "bootstrap/dist/css/bootstrap.min.css";

const root = createRoot(document.getElementById("root")!);

root.render(
    <BrowserRouter>
        <ConfigProvider>
            <AntdApp>
                {" "}
                <App />
            </AntdApp>
        </ConfigProvider>
    </BrowserRouter>
);
