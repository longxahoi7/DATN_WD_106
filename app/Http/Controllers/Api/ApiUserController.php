<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class ApiUserController extends Controller
{
    //
    public function listUsers()
    {
        $users = User::orderBy('user_id', 'desc')
            ->get();
        return response()->json([
            'data' => $users,
            'message' => 'Success',
            'status_code' => '200',
        ], 200);
    }
    public function showUser($id)
    {
        $user = User::findOrFail($id);
        return response()->json([
            'data' => $user,
            'message' => 'Success',
            'status_code' => '200',
        ], 200);
    }
    public function updatePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'data' => $user,
            'message' => 'Mật khẩu đã được cập nhật thành công',
            'status_code' => '200',
        ], 200);
    }
    public function register(Request $request)
    {
        // validate


        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ];
        $newUser = User::create($data);
        return response()->json([
            'data' => $newUser,
            'message' => 'success',
            'status_code' => '200',

        ], 200);
    }
    public function deleteUser(Request $request)
    {
        User::find($request->user_id)->delete();
        // $user->delete();

        return response()->json([
            'message' => 'Người dùng đã được xóa thành công',
            'status_code' => '200',
        ], 200);
    }
    //     public function login(Request $request)
//     {
//         if (Auth::attempt([
//             'email' => $request->email,
//             'password' => $request->password,
//         ])) {
//             // Tạo token cho user
//             $token = User::find(Auth::id())->createToken('ApiToken')->plainTextToken;
//             return response()->json([
//                 'token' => $token,
//                 'message' => 'Login successful',
//                 'status_code' => '200',
//             ], 200);
//         }

    //         // Trường hợp đăng nhập thất bại
//         return response()->json([
//             'message' => 'Login failed',
//             'status_code' => '401',
//         ], 401);
//     }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (
            Auth::attempt([
                'email' => $request->email,
                'password' => $request->password,
            ])
        ) {
            // Sử dụng Auth::user() thay vì User::find(Auth::id())
            $token = Auth::user()->createToken('ApiToken')->plainTextToken;

            return response()->json([
                'token' => $token,
                'message' => 'Login successful',
                'status_code' => '200',
            ], 200);
        }

        // Trường hợp đăng nhập thất bại
        return response()->json([
            'message' => 'Login failed',
            'status_code' => '401',
        ], 401);
    }


}
// $user = Auth::user();
// $token = $user->createToken('API Token')->plainTextToken;

// return response()->json(['token' => $token, 'user' => $user]);