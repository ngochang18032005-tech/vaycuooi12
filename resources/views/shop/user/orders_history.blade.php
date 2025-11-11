@extends('layout.shop.layout')
@section('title', 'Lịch sử đặt hàng')
@section('content')
<div class="container">
    <h3>Lịch sử đặt hàng</h3>

    @forelse ($orders as $order)
        <div class="card mb-3">
            <div class="card-header">
                <strong>Đơn hàng #{{ $order->id }}</strong> - Ngày đặt: {{ $order->created_at->format('d/m/Y H:i') }}
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderDetails as $detail)
                        <tr>
                            <td>{{ $detail->product->product_name ?? 'Đã xóa' }}</td>
                            <td>{{ number_format($detail->price, 0, ',', '.') }}₫</td>
                            <td>{{ $detail->qty }}</td>
                            <td>{{ number_format($detail->amount, 0, ',', '.') }}₫</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-end fw-bold">
                    Tổng tiền: {{ number_format($order->orderDetails->sum('amount'), 0, ',', '.') }}₫
                </div>
            </div>
        </div>
    @empty
        <p>Bạn chưa đặt đơn hàng nào.</p>
    @endforelse
</div>
@endsection
