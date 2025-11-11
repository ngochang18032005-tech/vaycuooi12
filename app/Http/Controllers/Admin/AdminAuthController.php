<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    // Hiển thị form login
    public function showLoginForm()
    {
        return view('admin.auth.login'); // Hiển thị trang login của admin
    }

    // Xử lý login
    public function login(Request $request)
    {
        // Validate dữ liệu đầu vào
        $validated = $request->validate([
            'email' => 'required|email', // Xác nhận trường email
            'password' => 'required|min:6',   // Kiểm tra mật khẩu
        ]);

        // Kiểm tra thông tin đăng nhập
        if (Auth::attempt([
            'email' => $validated['email'], // Xác thực với email
            'password' => $validated['password'], // Kiểm tra mật khẩu
        ], $request->filled('remember'))) {
            // Nếu đăng nhập thành công, kiểm tra role
            $user = Auth::user();

            if ($user->role !== 'admin') {
                Auth::logout(); // Đăng xuất nếu không phải admin
                return redirect()->back()
                    ->withErrors(['email' => 'Tài khoản không có quyền truy cập trang quản trị.'])
                    ->withInput();
            }

            // Nếu là admin, chuyển hướng tới trang admin
            return redirect()->route('admin.home');
        }

        // Nếu thông tin không đúng, quay lại trang login với lỗi
        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng.',
        ])->withInput();
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login')
                         ->with('success', 'Đăng xuất thành công!');
    }
}
