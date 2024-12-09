<?php

namespace App\Http\Controllers\Admin;
use App\Components\CategoryRecusive;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{

    //
   

    public function listCategory(Request $request)
    {
        $categories = Category::where('name', 'like', '%' . $request->nhap . '%')
            ->orWhere('is_active', 'like', '%' . $request->nhap . '%')
            ->orWhere('slug', 'like', '%' . $request->nhap . '%')
            ->orWhere('description', 'like', '%' . $request->nhap . '%')
            ->orWhere('parent_id', 'like', '%' . $request->nhap . '%')
            ->latest()->paginate(5);
        return view('admin.pages.category.list', compact('categories'));
    }
    public function toggle($id)
    {
        $brand = Category::findOrFail($id);
    
        // Thay đổi trạng thái is_active
        $brand->is_active = !$brand->is_active;
        $brand->save();
    
        return redirect()->back()->with('success', 'Trạng thái thương hiệu đã được thay đổi!');
    }
    
    public function createCategory()
    {
        // Gọi phương thức getCategory với tham số parentId
        $categories = Category::callTreeCategory();
        
        // Trả về view với biến htmlOption
        return view('admin.pages.category.create', data: compact('categories'));
    }


    public function addCategory(Request $request)
    {
        $anh=null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            // Tạo tên mới cho ảnh để tránh trùng lặp
            $newImage = time() . "." . $image->getClientOriginalExtension();
            
            // Lưu ảnh vào thư mục 'imagePro' trong thư mục 'public'
            $anh = $image->storeAs('/storage/imagePro/images', $newImage, 'public');
        }else {
            // Nếu không có ảnh, sử dụng ảnh mặc định
            $anh = 'default.jpg';
        }
    
        $category = Category::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $anh, // Đảm bảo trường này không bao giờ null
            'parent_id' => $request->input('parent_id'),
            'slug' => str::slug($request->input('name')),
        ]);
    
        return redirect()->route('admin.categories.index')->with([
            'category' => $category,
            'message' => 'Category add successfully!',
        ], 201);
    }
    public function detailCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.pages.category.detail', compact('category'));
    }
    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::callTreeCategory();  // Lấy danh mục con dưới dạng mảng
        return view('admin.pages.category.edit', compact('category', 'categories'));
    }
    public function updateCategory(Request $request, $id)
    {

        $category = Category::findOrFail($id);
        $anh = $category->image;
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($category->image);
            $image = $request->files('image');
            $newImage = time() . "." . $image->getClientOrigenalExtension();
            $anh = $image->storeAs('images', $newImage, 'public');
        }
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->slug = $request->input('slug')
            ? Str::slug($request->input('slug'))
            : Str::slug($request->input('name'));
        $category->image = $anh;
        $category->parent_id = $request->input('parent_id');
        $category->save();
        return redirect()->route('admin.categories.index')->with('message' ,'Category updated successfully!',);
        

    }
    public function destroyCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('message' ,'Category delEtedq successfully!',);
    }

}
