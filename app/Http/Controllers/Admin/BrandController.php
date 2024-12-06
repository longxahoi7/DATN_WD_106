<?php

namespace App\Http\Controllers\Admin;
use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BrandsRequest;
use Illuminate\Support\Str;

class BrandController extends Controller
{
  
    public function listBrand(Request $request)
    {
        $brands = Brand::where('name', 'like', '%' . $request->nhap . '%')
            ->orWhere('is_active', 'like', '%' . $request->nhap . '%')
            ->orWhere('slug', 'like', '%' . $request->nhap . '%')
            ->orWhere('description', 'like', '%' . $request->nhap . '%')
            ->latest()->paginate(5);
           
        return view ('admin.pages.brand.list')
        ->with(['brands'=>$brands]);
    }
    public function toggle($id)
{
    $brand = Brand::findOrFail($id);

    // Thay đổi trạng thái is_active
    $brand->is_active = !$brand->is_active;
    $brand->save();

    return redirect()->back()->with('success', 'Trạng thái thương hiệu đã được thay đổi!');
}
public function createBrand()
{
    return view('admin.pages.brand.create');
}
    public function addBrand(BrandsRequest $request)
    {

        Brand::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'slug' => str::slug($request->input('name')),
        ]);
        return redirect()->route('admin.brands.index')->with('success', 'Brand added successfully!');

    }
    public function detailBrand($id)
    {
        $detailBrand = Brand::findOrFail($id);
        return view('admin.pages.brand.detail', compact('detailBrand'));

    }
    public function   editBrand($id)
    {
        $detailBrand = Brand::findOrFail($id);
        return view('admin.pages.brand.edit', compact('detailBrand'));

    }

    public function updateBrand(Request $request, $id)
    {
        // Find the brand by ID
        $brand = Brand::findOrFail($id);
    
        // Validate the incoming request data if needed
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);
    
        // Update the brand with the new data
        $brand->update([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description'),
            'is_active' => $request->input('is_active', 1),  // Set to 1 by default if not provided
        ]);
    
        return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully!');
    }


    public function destroyBrand($id)
    {
        $product = Brand::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('message' ,'Brand deleted successfully!',);
    }


}