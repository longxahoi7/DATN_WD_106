<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function Viewlogin()
    {
        // if(Auth::id() > 0){
        // if (Auth::User()->role == 1) 

        //     return redirect()->route('admin.index');
        // }else{           
        //         return redirect()->route('users.home');
        // }
        return view('users.Login');
    }

    public function login(request $req)
    {

        $data = [
            'email' => $req->email,
            'password' => $req->password,
        ];
        $remember = $req->has('remember');

        if (Auth::attempt($data, $remember)) {
            // pass login
            if (Auth::user()->role == '1') {
                return redirect()->route('admin.index')
                    ->with('success', "Đăng nhập thành công");
            } else {
                return redirect()->route('users.home')
                    ->with('success', "Đăng nhập thành công");
            }
        } else {
            return redirect()->route('viewLogin')
                ->with('error', "Email hoặc mật khẩu không chính xác");
        }
    }
    public function logout(Request $req)
    {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect()->route('viewLogin')
            ->with('success', "Đăng xuất thành công");
    }
    public function register()
    {
        return view('users.Register');
    }
    // public function forgotPassword()
    // {
    //     return view('users.CheckEmail');
    // }

    // public function checkEmail(Request $request)
    // {
    //     $request->validate(['email' => 'required|email']);

    //     $user = User::where('email', $request->email)->first();

    //     if (!$user) {
    //         return redirect()->route('users.forgotPassword')
    //         ->with('error', 'Email không tồn tại trong hệ thống');
    //     }

    //     // User tồn tại và chuyển trang đổi password
    //     return view('users.ChangePassword', ['email' => $request->email]);
    // }

    // public function changePassword(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|min:5|confirmed',
    //     ]);

    //     $user = User::where('email', $request->email)->first();

    //     if (!$user) {
    //         return redirect()->route('users.forgotPassword')
    //         ->with('error', 'Email không tồn tại trong hệ thống');
    //     }
    //     // Đoori mật khẩu và gửi email thông báo
    //     $newPassword = $request->password;
    //     $user->password = Hash::make($newPassword);
    //     $user->save();
    //     Mail::to($user->email)->send(new ResetPasswordMail($user, $newPassword));

    //     return redirect()->route('viewLogin')
    //     ->with('success', 'Mật khẩu đã cập nhật thành công. Vui lòng kiểm tra email của bạn.');
    // }
    // Hiển thị form yêu cầu đổi mật khẩu
    // public function showRequestForm()
    // {
    //     return view('emails.SendMail');
    // }

    // // Gửi email chứa link đổi mật khẩu
    //  public function sendResetLink(Request $request)
    // {
    //     $request->validate(['email' => 'required|email']);

    //     $user = User::where('email', $request->email)->first();

    //     if (!$user) {
    //         return back()->with('error', 'Email không tồn tại trong hệ thống');
    //     }

    //     // Tạo token để gửi qua email
    //     $token = Str::random(60);

    //     // Kiểm tra và cập nhật hoặc chèn token vào database
    //     DB::table('password_reset_tokens')->updateOrInsert(
    //         ['email' => $user->email], // Điều kiện kiểm tra
    //         ['token' => $token, 'created_at' => now()] // Dữ liệu cập nhật hoặc chèn
    //     );

    //     // Gửi email chứa link đổi mật khẩu
    //     Mail::to($user->email)->send(new ResetPasswordMail($token, $user->email));

    //     return back()->with('success', 'Vui lòng kiểm tra email để đổi mật khẩu.');
    // }
    // Hiển thị form để đặt lại mật khẩu mới
    // public function showResetForm(Request $request, $token)
    // {
    //     $email = $request->email;
    //     return view('Auth.update-password', ['token' => $token, 'email' => $email]);
    // }
    // // Đặt lại mật khẩu
    // public function resetPassword(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|min:5|confirmed',
    //         'token' => 'required',
    //     ],[
    //         'email.required' => 'Email không được bỏ trống.',
    //         'email.email' => 'Email phải là một định dạng chính xác.',        
    //         'password.required' => 'Mật khẩu không được bỏ trống.',
    //         'password.min' => 'Mật khẩu phải có ít nhất 5 ký tự.',
    //         'password.confirmed' => 'Mật khẩu xác nhận không chính xác.',   
    //     ]);

    //     // Kiểm tra token
    //     $passwordReset = DB::table('password_reset_tokens')
    //     ->where('token', $request->token)->first();

    //     if (!$passwordReset) {
    //         return redirect()->route('viewLogin')
    //         ->with('error', 'Liên kết đổi mật khẩu không còn tồn tại.');
    //     }

    //     // Cập nhật mật khẩu
    //     $user = User::where('email', $passwordReset->email)->first();
    //     $user->password = Hash::make($request->password);
    //     $user->save();

    //     // Xóa token sau khi đổi mật khẩu
    //     DB::table('password_reset_tokens')
    //     ->where('token', $request->token)->delete();

    //     return redirect()->route('viewLogin')->with('success', 'Mật khẩu đã được cập nhật thành công.');
    // }
}