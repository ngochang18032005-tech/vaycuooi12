<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order; 

class OrderController extends Controller
{

    // lịch sử đặt hàng
    public function history()
    {
        $user = Auth::user();

        $orders = Order::with(['orderDetails.product']) // eager load sản phẩm trong chi tiết
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.history', compact('orders'));
    }

    // Hiển thị chi tiết đơn hàng
    public function show($orderId)
    {
        // Kiểm tra đăng nhập
        if (!Auth::check()) {
            return redirect()->route('shop.cart')->with('error', 'Vui lòng đăng nhập để xem chi tiết đơn hàng.');
        }

        $user = Auth::user();  // Lấy thông tin người dùng hiện tại

        // Lấy đơn hàng của người dùng hiện tại
        $order = Order::with('orderDetails.product')  // Tải các chi tiết đơn hàng cùng với sản phẩm
                    ->where('user_id', $user->id)   // Chỉ lấy đơn hàng của người dùng này
                    ->find($orderId);  // Tìm đơn hàng theo order_id

        // Nếu không tìm thấy đơn hàng, trả về 404
        if (!$order) {
            return redirect()->route('shop.cart')->with('error', 'Không tìm thấy đơn hàng này.');
        }

        // Trả về view với thông tin đơn hàng
        return view('shop.user.order_detail', compact('order'));
    }


}