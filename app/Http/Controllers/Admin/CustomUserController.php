<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;


class CustomUserController extends Controller
{
    // Danh sách người dùng
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('admin.user.list', compact('users'));
    }

    // Form thêm
    public function create()
    {
        return view('admin.user.create');
    }

    // Lưu người dùng mới
    public function store(Request $request)
    {
        // Xác nhận dữ liệu từ form
        $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'gender' => 'required|string|in:male,female,other',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',  // Kiểm tra mật khẩu và xác nhận mật khẩu
            'role' => 'required|string|in:admin,user',

        ]);

        // Tạo người dùng mới
        User::create([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Mã hóa mật khẩu
            'role' => $request->role,
        ]);

        return redirect()->route('admin.userList')->with('success', 'Người dùng đã được thêm thành công.');
    }


    // Form sửa
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    // Cập nhật người dùng
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $data = [
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.userList')->with('success', 'Cập nhật người dùng thành công!');
    }

    // Xem chi tiết người dùng
    public function show($id)
    {
        $user = User::findOrFail($id);

        $orders = Order::where('user_id', $id)
            ->with(['details.product']) // eager load chi tiết đơn hàng và sản phẩm
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.user.detail', compact('user', 'orders'));
    }

    // Xóa vĩnh viễn người dùng (chỉ khi role = user)
    public function forceDelete($id)
    {
        $user = User::findOrFail($id);

        if ($user->role !== 'user') {
            return redirect()->route('admin.userList')->with('error', 'Không thể xoá tài khoản Admin!');
        }

        $user->delete();

        return redirect()->route('admin.userList')->with('success', 'Xóa người dùng thành công!');
    }
}
