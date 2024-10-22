export interface IProduct {
    id: number;
    name: string;
    image: string;
    price: number;
    category: string;
}
export type FormData = Pick<IProduct, "name" | "image" | "price" | "category">;
