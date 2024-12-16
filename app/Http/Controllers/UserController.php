<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showUserInfo()
    {
        $user = Auth::user(); // Lấy thông tin user hiện tại

        return view('user.profiles.index', compact('user')); // Truyền thông tin user sang view
    }
    public function edit()
    {
        // Lấy thông tin người dùng hiện tại
        $user = Auth::id();
        // Trả về view với thông tin người dùng
        return view('user.profiles.edit', compact('user'));
    }
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id); // Lấy người dùng theo ID

        // Xác thực dữ liệu đầu vào
        $validatedData = $request->validate([
            'recipient_name' => 'required|string|max:255',
            'phone' => 'required|regex:/^0[0-9]{9}$/',
            'shipping_address' => 'required|string|max:500',
        ]);

        // Cập nhật thông tin người dùng
        $user->name = $validatedData['recipient_name'];
        $user->phone = $validatedData['phone'];
        $user->address = $validatedData['shipping_address'];

        // Lưu vào cơ sở dữ liệu
        $user->save();
        // Chuyển hướng về trang chỉnh sửa với thông báo thành công
        return redirect()->route('user.profiles.showUserInfo')->with('success', 'Thông tin tài khoản đã được cập nhật!');
    }
}
