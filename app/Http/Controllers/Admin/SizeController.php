<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;
class SizeController extends Controller
{
    //
   
    public function listSize(Request $request)
    {
        $sizes = Size::where('name', 'like', '%' . $request->nhap . '%')
            ->latest()->paginate(5);
            return view('admin.pages.size.list',compact('sizes'));
    }
    public function createSize(Request $request)
    {
        
        return view('admin.pages.size.create');
    }
    public function addSize(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:50',
        ]);

        $size = Size::create($validated);
        return redirect()->route('admin.sizes.index')->with(['size'=>$size,'message' => 'Color add successfully!',],201);

    }
    public function detailSize($id)
    {
        $size = Size::findOrFail($id);
        return view('admin.pages.size.detail',compact('size'));
    }
    public function editColor($id)
{
    $size = Size::findOrFail($id);
    return view('admin.pages.size.edit',compact('size'));
}
    public function updateSize(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
        ]);

        $size = Size::findOrFail($id);
        $size->name = $validated['name'];
        $size->save();
        return redirect()->route('admin.sizes.index')->with(['size'=>$size,'message' => 'Size add successfully!',],200);

    }
    public function destroySize($id)
    {
        $size = Size::findOrFail($id);
        $size->delete();
        return redirect()->route('admin.sizes.index')->with(['message' => 'Size deleted successfully!',],200);
    }
}
