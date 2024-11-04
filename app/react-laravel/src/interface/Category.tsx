export interface Category {
    id: number;
    name: string;
    size: string;
    slug: string;
    parentId: number | null;
    children?: Category[];
}
