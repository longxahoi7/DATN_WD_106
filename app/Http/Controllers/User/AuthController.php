<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
    //
    public function home(){
        return view('user.layouts.app');
    }

    public function viewRegister(){
        return view('auth.register');
    }

    public function register(request $req)
    {
        // Kiểm tra xem email đã tồn tại hay chưa
        $check = User::where('email', $req->email)->exists();
        if ($check) {
            // Email đã tồn tại
            return redirect()->back()->with('error', 'Email đã tồn tại');
        }

        // Kiểm tra password và ConfirmPassword có khớp nhau hay không
        if ($req->password === $req->confirmpassword) {
            // Tạo dữ liệu new users
            $data = [
                'name' => $req->name,
                // 'username' => $req->username,
                'email' => $req->email,
                'password' => Hash::make($req->password), // Mã hóa mật khẩu
                'phone' => $req->phone,
                'address' => $req->address,
            ];
            
            // Lưu dữ liệu vào cơ sở dữ liệu
            User::create($data);

            // Trả về với thông báo thành công
            return redirect()->route('login')->with('success', 'Đăng kí tài khoản thành công');
        } else {
            // Mật khẩu và xác nhận mật khẩu không khớp
            return redirect()->back()->with('error', 'Nhập lại mật khẩu không khớp');
        }
    }

    public function viewLogin(){
        return view('auth.login');
    }
    // login
    public function login(request $req)
    {

        $data = [
            'email' => $req->email,
            'password' => $req->password,
        ];
        // dd($data);
        $remember = $req->has('remember');

        if (Auth::attempt($data, $remember)) {
            // pass login
            // if (Auth::user()->role == '1') {
            //     return redirect()->route('index')
            //         ->with('success', "Đăng nhập thành công");
            // } else {
                return redirect()->route('home')
                    ->with('success', "Đăng nhập thành công");
            // }
        } else {
            return redirect()->route('viewLogin')
                ->with('error', "Email hoặc mật khẩu không chính xác");
        }
    }
}
