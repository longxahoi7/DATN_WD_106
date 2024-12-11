<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    public function login(Request $request)
{
    // Xác thực dữ liệu đầu vào
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:8',
    ]);

    // Kiểm tra thông tin đăng nhập
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'Email không tồn tại trong hệ thống.'])->withInput();
    }

    // Kiểm tra mật khẩu
    if (!Hash::check($request->password, $user->password)) {
        return back()->withErrors(['password' => 'Mật khẩu không đúng.'])->withInput();
    }

    // Đăng nhập người dùng
    Auth::login($user);

    // Chuyển hướng người dùng sau khi đăng nhập thành công
    switch ($user->role) {
        case 1: // admin
            return redirect()->route('admin.dashboard'); // Redirect to admin dashboard
        case 2: // user
            return redirect()->route('user.dashboard'); // Redirect to user dashboard
        case 3: // manager
            return redirect()->route('admin.dashboard'); // Redirect to manager dashboard
        default:
            return redirect()->route('/'); // Default route
    }
}
}
