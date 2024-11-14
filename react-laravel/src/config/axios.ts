import axios from "axios";

const api = axios.create({
    baseURL: "http://localhost:8000/api/",
    headers: {
        "Content-Type": "application/json",
    },
});

// Thêm token Authorization cho từng request
api.interceptors.request.use(
    (config) => {
        const userType = localStorage.getItem("userType"); // 'admin' hoặc 'user'
        const token = localStorage.getItem("token");

        if (token) {
            config.headers.Authorization = `Bearer ${token}`;
        }

        // Gán header riêng cho admin
        if (userType === "admin") {
            config.headers["Admin-Access"] = "true";
        }

        return config;
    },
    (error) => {
        return Promise.reject(error);
    }
);

// Xử lý lỗi phản hồi
api.interceptors.response.use(
    (response) => response,
    (error) => {
        if (error.response && error.response.status === 401) {
            // Token không hợp lệ hoặc hết hạn, có thể chuyển hướng đến trang đăng nhập
            localStorage.clear();
            window.location.href = "/login"; // Hoặc trang phù hợp với ứng dụng của bạn
        }
        return Promise.reject(error);
    }
);

export default api;
