<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAuthenticated
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            // Nếu chưa đăng nhập → chuyển về trang admin login
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
