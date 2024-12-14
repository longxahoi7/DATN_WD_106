<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Hiển thị danh sách người dùng theo vai trò (role).
     */
    public function listUser(Request $request)
    {
        // Lọc danh sách người dùng theo role nếu có yêu cầu
        $role = $request->query('role');

        $users = User::when($role, function ($query, $role) {
            return $query->where('role', $role);
        })->get();

        return view('admin.pages.user.listUser', compact('users', 'role'));
    }

    /**
     * Hiển thị form chỉnh sửa vai trò của người dùng.
     */

    /**
     * Cập nhật vai trò của người dùng.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|integer',
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->input('role');
        $user->save();

        return redirect()->route('admin.users.listUser')->with('success', 'Cập nhật vai trò thành công!');
    }


}

