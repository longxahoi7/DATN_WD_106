<?php

namespace App\Http\Controllers\Admin;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\AttributeProduct;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    //
    public function listProduct(Request $request)
    {
        $products = Product::where('name', 'like', '%' . $request->nhap . '%')
            ->orWhere('is_active', 'like', '%' . $request->nhap . '%')
            ->orWhere('sku', 'like', '%' . $request->nhap . '%')
            ->orWhere('subtitle', 'like', '%' . $request->nhap . '%')
            ->orWhere('slug', 'like', '%' . $request->nhap . '%')
            ->orWhere('description', 'like', '%' . $request->nhap . '%')
            ->latest()->paginate(5);
        return response()->json($products);
    }

    public function getData()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return response()->json([
            'categories' => $categories,
            'brands' => $brands
        ]);
    }
    private function imgPro(Request $request, $imageField)
    {
        if ($request->input($imageField) && filter_var($request->input($imageField), FILTER_VALIDATE_URL)) {
            return $request->input($imageField);
        }
        if ($request->hasFile($imageField)) {
            $anh = $request->file($imageField);
            $newAnh = time() . "." . $anh->getClientOriginalExtension();
            return $image = $anh->storeAs('images', $newAnh, 'public');
        }
        return null;

    }
    public function addProduct(Request $request)
    {
        $main_image = $this->imgPro($request, 'main_image_url');
        $product = Product::create([
            'brand_id' => $request->input('brand_id'),
            'name' => $request->input('name'),
            'product_category_id' => $request->input('product_category_id'),
            'main_image_url' => $main_image,
            'view_count' => 0,
            'sku' => $request->input('sku'),
            'description' => $request->input('description'),
            'subtitle' => $request->input('subtitle'),
            'slug' => str::slug($request->input('name')),
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        $attPros = [];
        $imgAttPros = [];
        // Loop over attributes
        foreach ($request->attribute_id as $attributeId) {
            // Create an attribute product
            $attPro = AttributeProduct::create([
                'product_id' => $product->product_id,
                'attribute_id' => $attributeId,
                'discount' => $request->input('discount'),
                'in_stock' => $request->input('in_stock'),
                'price' => $request->input('price')
            ]);

            $attPros[] = $attPro;
        }
        $errorImg=null;
        // Loop for additional images per attribute product, with limit check
        if ($request->hasFile('url')) {
            $existingImageCount = ProductImage::where('attribute_product_id', $attPro->id)->count();

            // Allow only if total images will be 6 or fewer
            foreach ($request->file('url') as $index => $additionalImage) {
        if ($existingImageCount + $index >= 4){
            $errorImg='Ảnh không được vượt quá 4 ảnh';
                    break;
                }
                     $additionalImageName = time() . $index . "." . $additionalImage->getClientOriginalExtension();
                    $storedImage = $additionalImage->storeAs('images', $additionalImageName, 'public');

                    $imgAttPro = ProductImage::create([
                        'attribute_product_id' => $attPro->attribute_product_id,
                        'product_id' => $product->product_id,
                        'imagePros' => $storedImage,
                    ]);

                    $imgAttPros[] = $imgAttPro;
            }
        }
        return response()->json([
            'product' => $product,
            'attPros' => $attPros,
            'imgAttPros' => $imgAttPros,
            'errorImg'=>$errorImg,
            'message' => $errorImg ? 'Product added with warnings.' : 'Product added successfully!',
        ], 201);

    }
    public function getDataId($id)
    {
        $category = Category::findOrFail($id);
        $brand = Brand::findOrFail($id);
        return response()->json(['category' => $category, 'brand' => $brand]);
    }
    public function updateProduct(Request $request, $id)
    {
        // Tìm sản phẩm theo ID
        $product = Product::findOrFail($id);

        // Cập nhật thông tin sản phẩm

        $main_image = $this->imgPro($request, 'main_image_url');
        $oldMainImage = $product->main_image_url;

        $product->update([
            'brand_id' => $request->input('brand_id'),
            'name' => $request->input('name'),
            'product_category_id' => $request->input('product_category_id'),
            'main_image_url' => $main_image ?? $oldMainImage,
            'sku' => $request->input('sku'),
            'description' => $request->input('description'),
            'subtitle' => $request->input('subtitle'),
            'slug' => Str::slug($request->input('name')),
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);
        if ($main_image && $oldMainImage) {
            Storage::disk('public')->delete($oldMainImage);
        }

        $attPros = [];
        $imgAttPros = [];

        // Cập nhật thuộc tính sản phẩm
        if ($request->has('attribute_id')) {
            // Xóa các thuộc tính hiện tại nếu có
            AttributeProduct::where('product_id', $product->id)->delete();
            // Tạo lại thuộc tính sản phẩm
            foreach ($request->attribute_id as $attributeId) {
                $attPro = AttributeProduct::create([
                    'product_id' => $product->id,
                    'attribute_id' => $attributeId,
                    'discount' => $request->input('discount'),
                    'in_stock' => $request->input('in_stock'),
                    'price' => $request->input('price')
                ]);

                $attPros[] = $attPro;
            }
        }

        // Cập nhật ảnh phụ cho thuộc tính
        if ($request->hasFile('url')) {
            foreach ($attPros as $attPro) {
                // Kiểm tra và thêm ảnh phụ cho từng thuộc tính
                $existingImageCount = ProductImage::where('attribute_product_id', $attPro->id)->count();


                foreach ($request->file('url') as $index => $additionalImage) {
                    if ($existingImageCount + $index >= 4){
                        $errorImg='Ảnh không được vượt quá 4 ảnh';
                                break;
                            }
                    $additionalImageName = time() . $index . "." . $additionalImage->getClientOriginalExtension();
                    $storedImage = $additionalImage->storeAs('images', $additionalImageName, 'public');
                    $imgAttPro = ProductImage::create([
                        'attribute_product_id' => $attPro->id,
                        'product_id' => $product->id,
                        'imagePros' => $storedImage,
                    ]);

                    $imgAttPros[] = $imgAttPro;
                }
            }
        }
        return response()->json([
            'product' => $product,
            'attPros' => $attPros,
            'imgAttPros' => $imgAttPros,
            'errorImg'=>$errorImg,
            'message' => $errorImg ? 'Product added with warnings.' : 'Product updated successfully!',
        ], 200);
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