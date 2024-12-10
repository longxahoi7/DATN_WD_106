<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function listCustomer(Request $request){
        $customers = User::where('name', 'like', '%' . $request->nhap . '%')
        ->orWhere('email', 'like', '%' . $request->nhap . '%')
        ->orWhere('role', 'like', '%' . $request->nhap . '%')
        ->orWhere('is_active', 'like', '%' . $request->nhap . '%')
        ->latest()->paginate(5);
    
        return view('admin.pages.account.customer.list') ->with(['customers'=>$customers]);
            }
            public function toggle($id)
            {
                $customer = User::findOrFail($id);
            
                // Thay đổi trạng thái is_active
                $customer->is_active = !$customer->is_active;
                $customer->save();
            
                return redirect()->back()->with('success', 'Trạng thái thương hiệu đã được thay đổi!');
            }
}
