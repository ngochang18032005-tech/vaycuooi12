<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{

    public function index()
    {
        $users = auth()->user();
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.order.list', compact('users', 'orders'));
    }


    public function show($id)
    {
        $order = Order::with(['orderDetails.product', 'user'])->findOrFail($id);
        return view('admin.order.detail', compact('order'));
    }


    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.edit', compact('order'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:1,2,3,4'
        ]);

        $order = Order::findOrFail($id);
        $order->status = (int) $request->status;
        $order->save();

        return redirect()->route('order.index')->with('success', 'Cập nhật trạng thái thành công.');
    }

}
