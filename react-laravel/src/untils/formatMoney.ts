export const formatPrice = (amount) => {
    // Chuyển đổi số thành chuỗi, thêm dấu phân cách hàng nghìn và đồng VND vào cuối
    return amount?.toLocaleString("vi-VN", {
        style: "currency",
        currency: "VND",
    });
};
