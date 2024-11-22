<?php

namespace App\Http\Controllers\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Size;
use App\Models\Color;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\AttributeProduct;
use App\Models\Attribute;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    public function listProduct(Request $request)
    {
        $products = Product::with('category:category_id,name', 'brand:brand_id,name')
            // ->where('category.name', 'like', '%' . $request->nhap.'%')
            ->where('name', 'like', '%' . $request->nhap . '%')
            ->orWhereHas('category', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->input('nhap', '') . '%');
            })
            ->orWhereHas('brand', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->input('nhap', '') . '%');
            })
            ->orWhere('is_active', 'like', '%' . $request->nhap . '%')
            ->orWhere('sku', 'like', '%' . $request->nhap . '%')
            ->orWhere('subtitle', 'like', '%' . $request->nhap . '%')
            ->orWhere('slug', 'like', '%' . $request->nhap . '%')
            ->orWhere('description', 'like', '%' . $request->nhap . '%')
            ->latest()->paginate(5);
        return response()->json($products);
    }

    public function getData(Request $request)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $sizes = Size::get();
        $colors = Color::get();
        return response()->json([
            'categories' => $categories,
            'brands' => $brands,
            'sizes' => $sizes,
            'colors' => $colors,
            // 'attribute_products' => $attribute_products,
            // 'products' => $products
        ]);
    }
    // private function imgPro(Request $request, $imageField)
    // {
    //     if ($request->hasFile($imageField)) {
    //         $anh = $request->file($imageField);
    //         $newAnh = time() . "." . $anh->getClientOriginalExtension();
    //         return $image = $anh->storeAs('images', $newAnh, 'public');
    //     }
    //     return null;
    // }
    public function addProduct(Request $request)
    {
        // if ($request->hasFile('main_image_url')) {
        //     $anh = $request->file('main_image_url');
        //     if ($anh->isValid()) {
        //         $newAnh = time() . "." . $anh->getClientOriginalExtension();
        //         $image = $anh->move(public_path('imagePro/'), $newAnh);
        //     } else {
        //         $image = null;
        //     }
        // }
        // $image = $anh->storeAs('images', $newAnh, 'public');
        $product = Product::create([
            'brand_id' => $request->input('brand_id'),
            'name' => $request->input('name'),
            'product_category_id' => $request->input('product_category_id'),
            'main_image_url' => $request->input('main_image_url'),
            'view_count' => 0,
            'discount' => $request->input('discount'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'sku' => $request->input('sku'),
            'description' => $request->input('description'),
            'subtitle' => $request->input('subtitle'),
            'slug' => str::slug($request->input('name')),
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);
        $colors = is_array($request->input('color_id')) ? $request->input('color_id') : explode(',', $request->input('color_id'));
        $sizes = is_array($request->input('size_id')) ? $request->input('size_id') : explode(',', $request->input('size_id'));
        $productColorSizeData = [];
        foreach ($colors as $colorId) {
            foreach ($sizes as $sizeId) {
                $productColorSizeData[] = [
                    'product_id' => $product->product_id,
                    'color_id' => $colorId,
                    'size_id' => $sizeId,
                ];
            }
        }
        $attPro = AttributeProduct::insert($productColorSizeData);



        return response()->json([
            'product' => $product,
            'attPro' => $attPro,
            'message' => 'Product added successfully!',
        ], 201);

    }
    public function getDataAtrPro(Request $request)
    {
        // Lấy tất cả các sản phẩm và thông tin của chúng cùng với màu sắc, kích thước, giá và tồn kho
        $products = Product::with([
            'colors.sizes' => function ($query) {
                // Lọc các màu và size theo từng sản phẩm
                $query->select('sizes.size_id', 'sizes.name', 'attribute_products.price', 'attribute_products.in_stock');
            }
        ])
            ->get();

        // Trả về kết quả
        return response()->json($products);
    }
    public function updateMultipleAttributeProducts(Request $request)
    {
        // Xác thực dữ liệu đầu vào (danh sách các sản phẩm thuộc tính)
        $validatedData = $request->validate([
            'attribute_product' => 'required|array', // Danh sách sản phẩm thuộc tính
            'attribute_product.*.attribute_product_id' => 'required|integer|exists:attribute_products,attribute_product_id', // ID của từng sản phẩm thuộc tính
            'attribute_product.*.price' => 'nullable|numeric|min:0',
            'attribute_product.*.in_stock' => 'nullable|integer|min:0',
        ]);

        // Cập nhật từng sản phẩm thuộc tính trong danh sách
        foreach ($validatedData['attribute_product'] as $productData) {
            $attributeProduct = AttributeProduct::find($productData['attribute_product_id']);

            if ($attributeProduct) {
                // Cập nhật các trường dữ liệu của sản phẩm thuộc tính
                $attributeProduct->update([
                    'price' => $productData['price'] ?? $attributeProduct->price,
                    'in_stock' => $productData['in_stock'] ?? $attributeProduct->in_stock,
                ]);
            }

            // Kiểm tra và cập nhật ảnh cho từng sản phẩm thuộc tính
            if ($request->hasFile('url')) {
                $existingImageCount = ProductImage::where('attribute_product_id', $attributeProduct->attribute_product_id)->count();

                // Giới hạn số ảnh tối đa là 6 ảnh
                foreach ($request->file('url') as $index => $additionalImage) {
                    if ($existingImageCount + $index >= 6) {
                        return response()->json(['error' => 'Ảnh không được vượt quá 6 ảnh'], 400);
                    }

                    // Tạo tên ảnh và lưu vào thư mục images
                    $additionalImageName = time() . $index . "." . $additionalImage->getClientOriginalExtension();
                    $storedImage = $additionalImage->storeAs('images', $additionalImageName, 'public');

                    // Lưu ảnh vào bảng product_images
                    ProductImage::create([
                        'attribute_product_id' => $attributeProduct->attribute_product_id,
                        'url' => $storedImage, // Đảm bảo trường này khớp với cột trong bảng
                    ]);
                }
            }
        }

        // Trả về kết quả
        return response()->json([
            'message' => 'Product attributes and images updated successfully',
        ], 200);
    }

    public function getDataId($id)
    {
        $category = Category::findOrFail($id);
        $brand = Brand::findOrFail($id);

        return response()->json(['category' => $category, 'brand' => $brand,]);
    }
    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json([
            'message' => 'Product deleted successfully!',
        ], 200);
    }
    public function restoreProduct($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();

        return response()->json([
            'message' => 'Product restored successfully!',
        ], 200);
    }
}