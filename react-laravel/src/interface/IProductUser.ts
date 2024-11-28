export interface Product {
    product_id: number;
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
    image: string;
}
