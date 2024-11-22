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
    price: number ;
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
export interface Brand {
    brand_id: number;
    name: string;
    description: string;
    slug: string;
    is_active: number;
    created_at: string;
    updated_at: string;
    deleted_at: string;
}
export interface AttributesCart {
    attribute_product_id: number; // ID của thuộc tính sản phẩm
    product_id: number;           // ID của sản phẩm
    attribute_id: number;         // ID của thuộc tính
    price: number;                // Giá của thuộc tính sản phẩm

}
export interface  CartItem extends AttributesCart {
    id: number;
    product_id: number;          // ID của sản phẩm
    brand_id: number;            // ID của thương hiệu
    product_category_id: number; // ID của danh mục sản phẩm
    name: string;                // Tên sản phẩm
    qty: number;                 // so luong sp
    main_image_url: string;      // Đường dẫn hình ảnh chính của sản phẩm
    view_count: number;          // Số lượt xem của sản phẩm
    description: string;         // Mô tả sản phẩm
    sku: string;                 // Mã SKU của sản phẩm
    subtitle: string;            // Phụ đề cho sản phẩm
    slug: string;                // Slug của sản phẩm
    is_active: number;           // Trạng thái hoạt động của sản phẩm
    
  };
  export type CartDetail = CartItem & AttributesCart;