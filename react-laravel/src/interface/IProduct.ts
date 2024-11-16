export interface IProduct {
    id: number;
    name: string;
    image: string;
    price: number;
    category: string;
    mota: string;
}
export type FormData = Pick<
    IProduct,
    "name" | "image" | "price" | "category" | "mota"
>;

export interface Category {
    category_id: number;
    name: string;
    description: string;
    image: string;
    slug: string;
    is_active: number;
    parent_id: number;
    created_at: string;
    updated_at: string;
    children?: Category[];
}
