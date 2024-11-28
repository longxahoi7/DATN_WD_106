<?php

namespace App\Http\Controllers\Admin;
use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BrandsRequest;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    //
    public function listBrand(Request $request)
    {
        $products = Brand::where('name','like','%'. $request->nhap.'%')
        ->orWhere('is_active','like','%'. $request->nhap.'%')
        ->orWhere('slug','like','%'. $request->nhap.'%')
        ->orWhere('description','like','%'. $request->nhap.'%')
        ->latest()->paginate(5);
        return response()->json($products);
    }
    public function addBrand(BrandsRequest $request)
    {

        $product =Brand::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'slug'=>str::slug($request->input('name')),
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);
        return response()->json([
                'product'=>$product,
            'message' => 'Brand add successfully!',
        ], 201);

}
public function detailBrand($id)
{
    $product = Brand::findOrFail($id);
    return response()->json($product);
}
public function updateBrand(Request $request, $id)
{
    $brand = Brand::findOrFail($id);

    // Không cần kiểm tra trùng 'slug' khi cập nhật
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'slug' => 'nullable|string|max:255', // Đảm bảo slug không bị kiểm tra trùng
        'is_active' => 'required|boolean', // Kiểm tra trạng thái hoạt động
    ]);

    // Nếu có slug mới, cập nhật lại slug
    if ($request->input('slug')) {
        $brand->slug = Str::slug($request->input('slug'));
    } else {
        // Nếu không có slug, dùng slug từ 'name'
        $brand->slug = Str::slug($request->input('name'));
    }

    // Cập nhật các thông tin khác
    $brand->name = $request->input('name');
    $brand->description = $request->input('description');
    $brand->is_active = $request->input('is_active');

    $brand->save();

    return response()->json([
        'message' => 'Brand updated successfully!',
        'product' => $brand
    ], 200);
}


public function destroyBrand($id){
    $product=Brand::findOrFail($id);
    $product->delete();
    return response()->json([
        'message' => 'Brand soft deleted successfully'
    ],200);
}


}