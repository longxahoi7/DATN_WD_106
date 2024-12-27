<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Brand;
use Illuminate\Support\Facades\File;
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
use App\Http\Requests\StoreProductRequest;
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
            return view ('admin.pages.product.list')
            ->with(['products'=>$products]);
    }
    public function toggle($id)
    {
        $product = Product::findOrFail($id);
    
        // Thay đổi trạng thái is_active
        $product->is_active = !$product->is_active;
        $product->save();
    
        return redirect()->back()->with('success', 'Trạng thái thương hiệu đã được thay đổi!');
    }

    public function getData()
    {
        $categories = Category::callTreeCategory();
        $brands = Brand::all();
        $sizes = Size::get();
        $colors = Color::get();
        return view('admin.pages.product.create', 
        compact('categories', 'brands', 'sizes', 'colors'));
    }
    public function addProduct(Request $request)
    {
        // Validate dữ liệu
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:50',
                'sku' => 'required|unique:products,sku|max:50',
                'subtitle' => 'required|max:100',
                'product_category_id' => 'required|exists:categories,id',
                'brand_id' => 'required|exists:brands,id',
                'main_image_url' => 'required|image|max:2048',
                'description' => 'required|max:255',
            ], [
                'name.required' => 'Tên sản phẩm không được để trống.',
                'sku.required' => 'Mã sản phẩm không được để trống.',
                'sku.unique' => 'Mã sản phẩm đã tồn tại.',
                'subtitle.required' => 'Chú thích sản phẩm không được để trống.',
                'product_category_id.required' => 'Danh mục sản phẩm là bắt buộc.',
                'brand_id.required' => 'Thương hiệu sản phẩm là bắt buộc.',
                'main_image_url.required' => 'Ảnh sản phẩm là bắt buộc.',
                'main_image_url.image' => 'File tải lên phải là hình ảnh.',
                'description.required' => 'Mô tả sản phẩm không được để trống.',
            ]);

            // Xử lý upload hình ảnh
            $image = null;
            if ($request->hasFile('main_image_url')) {
                $anh = $request->file('main_image_url');
                if ($anh->isValid()) {
                    $newAnh = time() . "." . $anh->getClientOriginalExtension();
                    // Lưu hình ảnh vào thư mục 'imagePro' trong thư mục public
                    $image = $anh->move(public_path('storage/imagePro/'), $newAnh);
                }
            }

            // Tạo sản phẩm mới với dữ liệu đã validate
            $product = Product::create([
                'brand_id' => $request->input('brand_id'),
                'name' => $request->input('name'),
                'product_category_id' => $request->input('product_category_id'),
                'main_image_url' => $image ? 'imagePro/' . $image->getBasename() : null,
                'sku' => $request->input('sku'),
                'description' => $request->input('description'),
                'subtitle' => $request->input('subtitle'),
                'slug' => Str::slug($request->input('name')),
                'is_active' => $request->has('is_active') ? 1 : 0,
            ]);

            // Xử lý dữ liệu màu sắc và kích thước
            $colors = is_array($request->input('color_id')) ? $request->input('color_id') : explode(',', $request->input('color_id'));
            $sizes = is_array($request->input('size_id')) ? $request->input('size_id') : explode(',', $request->input('size_id'));

            // Chuẩn bị dữ liệu cho bảng AttributeProduct (kết hợp sản phẩm - màu sắc - kích thước)
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

            // Lưu dữ liệu vào bảng AttributeProduct
            AttributeProduct::insert($productColorSizeData);

            // Redirect đến trang quản lý sản phẩm với thông báo thành công
            return redirect()->route('admin.products.getDataAtrPro', ['id' => $product->product_id])->with('success', 'Thêm sản phẩm mới thành công!');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Nếu có lỗi validate, log vào file
            Log::error('Validation failed: ' . $e->getMessage());
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log các lỗi không mong muốn khác
            Log::error('Error occurred during product creation: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra trong quá trình tạo sản phẩm, vui lòng thử lại!');
        }
    }



    public function getDataAtrPro( $id){

        $productsAttPro = AttributeProduct::with([
            'product:product_id,name',
            'color:color_id,name',
            'size:size_id,name'])
         ->where('product_id',  $id)
        
         ->get();
         $groupedByColor = $productsAttPro->groupBy(function ($item) {
            return $item->color->name."-".$item->color->color_id;  // Group by both color name and color_id
        });
        return view('admin.pages.product.editAtrPro')
            ->with(['groupedByColor'=> $groupedByColor,'product_id' => $id]);
    }



    public function updateAllAttributeProducts(Request $request )
    {

        $attributeProducts = json_decode($request->input('attributeProducts', '[]'), true);
        $colorIds = $request->input('color_id', []);
        $product_id=$request->input('product_id',0);
        $images = [];
    
        // Xử lý từng color_id và ảnh tương ứng
        foreach ($colorIds as $colorId) {
            // Lấy ảnh của color_id này
            $colorImages = $request->file("images_{$colorId}");
    
            if ($colorImages) {
                // Lưu ảnh vào thư mục lưu trữ và thêm vào mảng images
                $storedImages = [];
                foreach ($colorImages as $image) {
                    $storedImages[] = $image->store('public/images/color_' . $colorId);
                }
                // Gán ảnh vào mảng theo color_id
                $images[$colorId] = $storedImages;
            }
        }
    
        // Lặp qua tất cả các sản phẩm thuộc tính trong mảng
       
        // Xử lý từng phần dữ liệu
        DB::beginTransaction();
        try {
            foreach ($attributeProducts as $product) {
                $attributeProduct = AttributeProduct::find($product['attribute_product_id']);
                if ($attributeProduct) {
                    $price = (float) str_replace(['.', ','], '', $product['prices']);
                    $inStock = (int) $product['in_stock'];
                    $attributeProduct->update([
                        'price' => $price,
                        'in_stock' => $inStock,
                    ]);
                }
            }
            
            foreach ($images as $key => $image) {
                        // Lưu ảnh vào thư mục storage
                foreach ($image as $item) {
                    log::info('1231231123123', [
                        'key' => json_encode($key), 
                        'item' => json_encode($item), 
                        'product_id' => json_encode($product_id)
                    ]);
                            // Lưu đường dẫn ảnh vào cơ sở dữ liệu
                    DB::table('product_images')->insert([
                        'color_id' => $key,
                        'url' => (string)$item,
                        'product_id'=> $product_id
                    ]);
                        
                }
                
                    
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Lỗi khi cập nhật Attribute Products:', ['message' => $e->getMessage()]);
        }
    return redirect()->route('admin.products.index')->with('success', 'Dữ liệu đã được cập nhật thành công.');


    }
    public function detailProduct($id){
        $attPros = AttributeProduct::with([
            'product:product_id,name,sku,is_best_seller,is_hot,is_active',
            'color:color_id,name',
            'size:size_id,name'])
         ->where('product_id',  $id)
        
         ->get();

         return view('admin.pages.product.detail', compact('attPros'));
  }
  public function editProduct($id) {
    $product=Product::findOrFail($id);
    $categories = Category::callTreeCategory();
   
    $brands = Brand::get();
    $sizes = Size::get();
    $colors = Color::get();
    return view('admin.pages.product.edit',
    compact('product','categories', 'brands', 'sizes', 'colors'));
  }
  public function updateProduct(Request $request, $id)
{
    // Tìm sản phẩm cần cập nhật
    $product = Product::findOrFail($id);

    // Xử lý file ảnh mới
    $image = $product->main_image_url; // Lấy ảnh cũ (nếu có)
    if ($request->hasFile('main_image_url')) {
        // Nếu có ảnh mới, xóa ảnh cũ
        if ($product->main_image_url && File::exists(public_path($product->main_image_url))) {
            File::delete(public_path($product->main_image_url)); // Xóa ảnh cũ
        }

        $anh = $request->file('main_image_url');
        if ($anh->isValid()) {
            // Tạo tên ảnh mới
            $newAnh = time() . "." . $anh->getClientOriginalExtension();
            // Lưu ảnh vào thư mục 'imagePro'
            $image = $anh->move(public_path('storage/imagePro/'), $newAnh);
        }
    }

    // Cập nhật thông tin sản phẩm
    $product->update([
        'brand_id' => $request->input('brand_id'),
        'name' => $request->input('name'),
        'product_category_id' => $request->input('product_category_id'),
       'main_image_url' => $image ? 'imagePro/' . basename($image) : $product->main_image_url,
        'sku' => $request->input('sku'),
        'description' => $request->input('description',''),
        'subtitle' => $request->input('subtitle'),
        'slug' => Str::slug($request->input('name')),
        'is_hot' => $request->has('is_hot') ? 1 : 0,
        'is_best_seller' => $request->has('is_best_seller') ? 1 : 0, 

    ]);

    // Xử lý color và size IDs (có thể là mảng hoặc chuỗi phân cách bởi dấu phẩy)
    $colors = is_array($request->input('color_id')) ? $request->input('color_id') : explode(',', $request->input('color_id'));
    $sizes = is_array($request->input('size_id')) ? $request->input('size_id') : explode(',', $request->input('size_id'));

    // Xóa các kết nối cũ giữa sản phẩm và màu sắc/kích thước
    $product->colors()->detach();  // Xóa các màu sắc đã chọn cũ
    $product->sizes()->detach();   // Xóa các kích thước đã chọn cũ

    // Tạo dữ liệu mới cho bảng AttributeProduct (mối quan hệ sản phẩm - màu sắc - kích thước)
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

    // Cập nhật dữ liệu màu sắc và kích thước cho sản phẩm
    AttributeProduct::insert($productColorSizeData);

    return redirect()->route('admin.products.index', ['id' => $product->product_id])
                     ->with('success', 'Cập nhật sản phẩm thành công!');
}


    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('message' ,'Product delete successfully!',);
    }
    public function restoreProduct($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();

        return redirect()->back()->with('message' ,'Product delete successfully!',);
    }
}