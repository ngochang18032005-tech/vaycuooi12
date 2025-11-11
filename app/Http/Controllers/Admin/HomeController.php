<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;

class HomeController extends Controller
{
    
    public function index(){
        $users = auth()->user();
        
        // Tính tổng doanh thu hôm nay
        $todayRevenue = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->whereDate('orders.created_at', today())
            ->sum('order_details.amount');
        
        // Tính tổng doanh thu toàn bộ hệ thống
        $totalRevenue = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->sum('order_details.amount');
        
        // Lấy danh sách đơn hàng mới nhất cùng tổng tiền của từng đơn hàng
        $latestOrders = Order::with(['user', 'orderDetails']) // Lấy thông tin user và orderDetails
            ->latest()
            ->take(5)
            ->get()
            ->map(function($order) {
                $order->total_price = $order->orderDetails->sum('amount'); // Tính tổng tiền từ order_details
                return $order;
            });
    
        return view('admin.home.home', [
            'productCount'  => Product::count(),
            'orderCount'    => Order::count(),
            'userCount'     => User::count(),
            'todayRevenue'  => $todayRevenue,
            'totalRevenue'  => $totalRevenue, // Truyền tổng doanh thu vào view
            'latestOrders'  => $latestOrders,
        ], compact('users'));
    }
    
}
