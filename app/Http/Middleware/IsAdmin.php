<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa và có phải là admin không
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request); // Cho phép truy cập nếu là admin
        }

        // Nếu không phải admin, đăng xuất và chuyển hướng về trang login
        Auth::logout();
        return redirect()->route('admin.login')->withErrors([
            'email' => 'Bạn không có quyền truy cập trang quản trị.'
        ]);
    }
}
