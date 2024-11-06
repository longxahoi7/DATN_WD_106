import axios from "axios";

const api = axios.create({
    baseURL: "http://localhost:3000/",
});
export default api;

// src/api/product.ts

import { IProduct } from "../interface/IProduct";

const API_BASE_URL = "http://localhost:3000/";

export const GetProductByID = async (
    id: string | undefined
): Promise<IProduct> => {
    try {
        const response = await axios.get(`${API_BASE_URL}/products/${id}`);
        return response.data;
    } catch (error) {
        throw new Error("Lỗi");
    }
};
