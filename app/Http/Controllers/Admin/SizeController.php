<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;
class SizeController extends Controller
{
    //
    public function home()
    {
        return view('admin.index');
    }
    public function index()
    {
        return view('admin.pages.size_management');
    }
    public function listSize(Request $request)
    {
        $sizes = Size::where('name', 'like', '%' . $request->nhap . '%')
            ->latest()->paginate(5);
        return response()->json($sizes);
    }
    public function addSize(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:50',
        ]);

        $size = Size::create($validated);
        return response()->json(['size' => $size, 'message' => 'Brand add successfully!',], 201);

    }
    public function detailSize($id)
    {
        $size = Size::findOrFail($id);
        return response()->json($size);
    }
    public function updateSize(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
        ]);

        $size = Size::findOrFail($id);
        $size->name = $validated['name'];
        $size->save();
        return response()->json([
            'message' => 'Size updated successfully!',
            'size' => $size
        ], 200);

    }
    public function destroySize($id)
    {
        $size = Size::findOrFail($id);
        $size->delete();
        return response()->json([
            'message' => 'Size soft deleted successfully'
        ], 200);
    }
}
