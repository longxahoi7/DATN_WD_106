<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // Nếu người dùng là admin (role = 1) thì cho phép truy cập
            if (Auth::user()->role === 1) {
                return $next($request);  // Admin có quyền thực hiện CRUD
            }

            // Nếu người dùng là manager (role = 3) chỉ có quyền xem
            if (Auth::user()->role === 3) {
                return $next($request);  // Manager chỉ được xem danh sách và chi tiết
            }

            // Nếu không phải admin hoặc manager, chuyển hướng về trang home
            return redirect()->back()
                ->with('alert', 'Bạn không có quyền truy cập vào trang này.');
        }

        // Nếu chưa đăng nhập, chuyển hướng về trang login
        return redirect()->route('login')
            ->with('error', 'Bạn phải đăng nhập trước.');
    }
}