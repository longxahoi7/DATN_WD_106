import api from "../config/axios";
import { FormData } from "../interface/IProduct";

export const GetAllProducts = async () => {
    try {
        const { data } = await api.get("admin/categories/list-category");
        return data;
    } catch (error) {
        throw new Error("Lỗi");
    }
};
export const getProductByID = async (id: number | string) => {
    try {
        const { data } = await api.get(`users/products/show-product/${id}`);
        return data;
    } catch (error) {
        throw new Error("Lỗi");
    }
};
export const addProduct = async (productData: FormData) => {
    try {
        const { data } = await api.post(`products`, productData);
        return data;
    } catch (error) {
        throw new Error("Lỗi");
    }
};
export const updateProduct = async (
    productData: FormData,
    id: number | string
) => {
    try {
        const { data } = await api.put(`products/${id}`, productData);
        return data;
    } catch (error) {
        throw new Error("Lỗi");
    }
};
export const deleteProduct = async (id: number | string) => {
    try {
        const { data } = await api.delete(`products/${id}`);
        return data;
    } catch (error) {
        throw new Error("Lỗi");
    }
};
