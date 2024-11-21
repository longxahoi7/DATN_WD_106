<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;
class ColorController extends Controller
{
    //
    public function listColor(Request $request)
    {
        $color = Color::where('name','like','%'. $request->nhap.'%')
        ->orWhere('color_code','like','%'. $request->nhap.'%')
        ->latest()->paginate(5);
        return response()->json($color);
    }
    public function addColor(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'color_code' => 'nullable|string|max:7',
        ]);

        $color = Color::create($validated);
        return response()->json(['color'=>$color,'message' => 'Color add successfully!',],201);

}
public function detailColor($id)
{
    $color = Color::findOrFail($id);
    return response()->json($color);
}
public function updateColor(Request $request,$id)
{
    $color = Color::findOrFail($id);
    $validated = $request->validate([
        'name' => 'required|string|max:50',
        'color_code' => 'nullable|string|max:7',
    ]);

    $color->update($validated);
    return response()->json([
        'message' => 'Color updated successfully!',
        'color' => $color
    ], 200);

}
public function destroyColor($id){
    $color=Color::findOrFail($id);
    $color->delete();
    return response()->json([
        'message' => 'Color soft deleted successfully'
    ],200);
}
}
