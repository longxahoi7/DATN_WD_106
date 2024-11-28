export interface IProduct {
    product_id: number;
    brand_id: Brands;
    product_category_id: Category;
    name: string;
    description: string;
    sku: string;
    subtitle: string;
    slug: string;
    is_active: number;
    deletedAt?: Date | null;
    createdAt?: Date | null;
    updatedAt?: Date | null;
    price: number | null;
    size?: Size;
    color?: Color;
    image: string;
}

export interface IProductUser {
    product_id: number;
    brand: Brands;
    category: Category;
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
    size?: string;
    color?: string;
}

export interface Size {
    size_id: number;
    name: string;
    created_at: string;
    updated_at: string;
    deleted_at?: string;
}

export interface Color {
    color_id: number;
    name: string;
    color_code: string;
    created_at: string;
    updated_at: string;
    deleted_at?: string;
}

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
