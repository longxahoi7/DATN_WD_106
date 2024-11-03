<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use Illuminate\Support\Facades\Str;
class AttributeController extends Controller
{
    //

    public function listAttribute(Request $request)
    {
        $attributes = Attribute::where('name','like','%'. $request->nhap.'%')
        ->orWhere('value','like','%'. $request->nhap.'%')
        ->latest()->paginate(5);
        return response()->json($attributes);
    }
    public function addAttribute(Request $request)
    {

        $attribute =Attribute::create([
            'name' => $request->input('name'),
            'value' => $request->input('value'),
        ]);
        return response()->json([
                'attribute'=>$attribute, 
            'message' => 'Attribute add successfully!',
        ], 201);

}
public function detailAttribute($id)
{
    $attribute = Attribute::findOrFail($id);
    return response()->json($attribute);
}
public function updateAttribute(Request $request,$id)
{

    $attribute=Attribute::findOrFail($id);
    $attribute->name = $request->input('name');
    $attribute->value = $request->input('value');
      
      $attribute->save();
    return response()->json([
        'attribute'=>$attribute,
        'message' => 'Attribute updated successfully!',],200);

}
public function destroyAttribute($id){
    $attribute=Attribute::findOrFail($id);
    $attribute->delete();
    return response()->json([
        'message' => 'Attribute soft deleted successfully'
    ],200);
}

}
