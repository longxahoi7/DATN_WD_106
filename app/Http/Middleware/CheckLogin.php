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
                return $next($request); 
            }
            if (Auth::user()->role === 2) {
                return $next($request);  
            }
            // Nếu người dùng là manager (role = 3) chỉ có quyền xem
            if (Auth::user()->role === 3) {
                // Kiểm tra các route có liên quan đến 'categories', 'brands', 'users', 'colors', 'sizes'
                if (
                    $request->is('admin/categories/*') ||
                    $request->is('admin/brands/*') ||
                    $request->is('admin/users/*') ||
                    $request->is('admin/colors/*') ||
                    $request->is('admin/sizes/*')
                ) {
                    if (in_array($request->method(), ['PUT'])) {
                        // Nếu là manager và đang thực hiện thao tác CRUD (POST, PUT, DELETE), chuyển hướng về trang chủ
                        return redirect()->route('admin.dashboard')
                            ->with('alert', 'Bạn không có quyền thực hiện thao tác này.');
                    }
                }

                return $next($request);  // Manager chỉ được xem danh sách và chi tiết
            }

            // Nếu không phải admin hoặc manager, chuyển hướng về trang home
            return redirect()->route('home')
                ->with('error', 'Bạn không có quyền truy cập vào trang này.');
        }

        // Nếu chưa đăng nhập, chuyển hướng về trang login
        return redirect()->route('login')
            ->with('error', 'Bạn phải đăng nhập trước.');
    }
}