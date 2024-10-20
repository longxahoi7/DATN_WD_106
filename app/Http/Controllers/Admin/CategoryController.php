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
        return response()->json($categories);
    }


    public function addCategory(Request $request)
    {
        $anh = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $newImage = time() . "." . $image->getClientOriginalExtension();
            $anh = $image->storeAs('images', $newImage, 'public');
        }

        $category = Category::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $anh,
            'parent_id' => $request->input('parent_id'),
            'slug' => str::slug($request->input('name')),
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);
        return response()->json([
            'category' => $category,
            'message' => 'Category add successfully!',
        ], 201);

    }
    public function detailCategory($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
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
        $category->is_active = $request->input('is_active');
        $category->save();
        return response()->json([
            'category' => $category,
            'message' => 'Category updated successfully!',
        ], 200);

    }
    public function destroyCategory($id){
        $category=Category::findOrFail($id);
        $category->delete();
        return response()->json([
            'message' => 'Category soft deleted successfully'
        ],200);
    }

}
