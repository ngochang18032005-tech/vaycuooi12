<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticate
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Kiểm tra role
            if ($user->role !== 'admin') {
                Auth::logout(); // Đăng xuất ngay nếu không phải admin
                return redirect()->back()
                    ->withErrors(['email' => 'Tài khoản không có quyền truy cập trang quản trị.'])
                    ->withInput();
            }

            return redirect()->intended('/admin');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng.',
        ])->withInput();
    }
}
