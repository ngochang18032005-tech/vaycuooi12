<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        // Kiểm tra tất cả các guard
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Kiểm tra nếu user có role là admin thì chuyển về trang admin.home
                if (Auth::user()->role === 'admin') {
                    return redirect()->route('admin.home');
                }

                // Nếu user có role là user hoặc role khác, chuyển về trang shop.home
                return redirect()->route('admin.login'); // Có thể thay đổi theo nhu cầu
            }
        }

        // Nếu người dùng chưa đăng nhập, tiếp tục yêu cầu
        return $next($request);
    }
}