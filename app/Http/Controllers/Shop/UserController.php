<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\RegisterUserRequest;
use App\Models\Order;


class UserController extends Controller
{
    public function account()
    {
        $user = Auth::user(); // Auth::user() trả về đối tượng người dùng đã đăng nhập

        // Lọc đơn hàng chỉ của người dùng này
        $orders = Order::with('orderDetails.product')
        ->where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->get();
        
        // Trả về view với dữ liệu người dùng
        return view('shop.user.account', compact('user', 'orders'));
    }

    // Hiện form đăng ký
    public function registration()
    {
        return view('shop.user.registration');
    }
    // Xử lý đăng ký
    public function doRegistration(RegisterUserRequest $request)
    {
        // Kiểm tra xem có file avatar hay không
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $file     = $request->file('avatar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('images/avatars');
            
            // Kiểm tra nếu thư mục chưa có thì tạo
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $file->move($destinationPath, $fileName);
            $avatarPath = $fileName;
        }

        try {
            // Tạo người dùng mới
            User::create([
                'fullname'  => $request->fullname,
                'username'  => $request->username,
                'email'     => $request->email,
                'phone'     => $request->phone,
                'address'   => $request->address,
                'birthday'  => $request->birthday,
                'gender'    => $request->gender,
                'avatar'    => $avatarPath,
                'password'  => Hash::make($request->password), // Mã hóa mật khẩu
                'role'      => 'user', // Đặt mặc định role là 'user'
            ]);

            return redirect()->route('shop.login')->with('success', 'Đăng ký thành công!');
        } catch (Exception $e) {
            return back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }


    // Hiện form đăng nhập
    public function login(){
        return view('shop.user.login');
    }
    // Xử lý đăng nhập
    public function doLogin(Request $request)
    {
        // Validate đầu vào
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Tìm user theo username
        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return back()->withErrors(['username' => 'Tên đăng nhập không tồn tại']);
        }

        // Kiểm tra password
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Mật khẩu không đúng']);
        }

        // Đăng nhập user
        Auth::login($user);

        return redirect('/')->with('success', 'Đăng nhập thành công!');
    }

    // Chức năng đăng xuất 
    public function Logout(){

        Auth::logout();

        return redirect()->route('shop.home')->with('success', 'Đăng xuất thành công!');
    }


    // chỉnh sửa người dùng 
    public function edit()
    {
        $user = Auth::user(); // Lấy thông tin người dùng đang đăng nhập
        return view('shop.user.edit', compact('user')); // Trả về view 'edit' với thông tin người dùng
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Lấy dữ liệu từ request (không validate)
        $user->fullname = $request->input('fullname');
        $user->email    = $request->input('email');
        $user->phone    = $request->input('phone');
        $user->address  = $request->input('address');

        // Nếu nhập mật khẩu mới thì mã hóa
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Nếu upload avatar
        if ($request->hasFile('avatar')) {
            $file     = $request->file('avatar');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('images/avatars'), $filename);
            $user->avatar = $filename;
        }

        $user->save();

        return redirect()->route('shop.account')->with('success', 'Cập nhật tài khoản thành công!');
    }
}