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
    id: number;
    name: string;
    size: string;
    slug: string;
    parentId: number | null;
    children?: Category[];
}
