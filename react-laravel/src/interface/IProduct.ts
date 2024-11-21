export interface IProduct {
    product_id: number;
    brandId: number;
    product_category_id: number;
    name: string;
    description: string;
    sku: string;
    subtitle: string;
    slug: string;
    isActive: boolean;
    deletedAt?: Date | null;
    createdAt?: Date | null;
    updatedAt?: Date | null;
    image?: string;
    price: number | null;
    category?: string;
    mota?: string;
    brand?: string;
}

export interface IProductUser {
    product_id: number;
    brandId: number;
    product_category_id: number;
    name: string;
    description: string;
    sku: string;
    subtitle: string;
    slug: string;
    isActive: boolean;
    deletedAt?: Date | null;
    createdAt?: Date | null;
    updatedAt?: Date | null;
    main_image_url: string;
    price: number | null;
    category?: string;
    mota?: string;
}

export type FormData = Pick<
    IProduct,
    "name" | "description" | "sku" | "subtitle" | "slug"
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
    delete_at: string;
}
export interface Attributes {
    attribute_id: number;
    name: string;
    value: string;
    created_at: string;
    updated_at: string;
    deleted_at: string;
}
export interface Brands {
    brand_id: number;
    name: string;
    description: string;
    slug: string;
    is_active: number;
    created_at: string;
    updated_at: string;
    deleted_at: string;
}
export interface Attribute_Products {
    attribute_product_id: number;
    product_id: number;
    attribute_id: number;
    in_stock: number;
    price: number;
    discount: number;
    created_at: string;
    updated_at: string;
}
