@extends('layout.admin.layout')
@section('title', 'Chi Tiết Đơn Hàng')

@section('content')
<div class="container mt-4">
    <h2>Chi tiết đơn hàng #{{ $order->id }}</h2>

    <p><strong>Người nhận:</strong> {{ $order->name }} - {{ $order->phone }} - {{ $order->address }}</p>

    @php
        $statusText = match($order->status) {
            1 => 'Đang chờ xử lý',
            2 => 'Đang giao hàng',
            3 => 'Hoàn thành',
            4 => 'Hủy',
            default => 'Không xác định'
        };
        $statusColor = match($order->status) {
            1 => 'warning',
            2 => 'info',
            3 => 'success',
            4 => 'danger',
            default => 'secondary'
        };
    @endphp

    <p><strong>Trạng thái:</strong> 
        <span class="badge bg-{{ $statusColor }}">{{ $statusText }}</span>
    </p>

    <p><strong>Ngày đặt hàng:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderDetails as $detail)
            <tr>
                <td>{{ $detail->product->product_name ?? 'Sản phẩm đã xóa' }}</td>
                <td>
                    @if ($detail->product && $detail->product->image)
                        <img src="{{ asset('images/products/' . $detail->product->image) }}" width="60">
                    @else
                        Không có ảnh
                    @endif
                </td>
                <td>{{ number_format($detail->price, 0, ',', '.') }} VND</td>
                <td>{{ $detail->qty }}</td>
                <td>{{ number_format($detail->amount, 0, ',', '.') }} VND</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h5 class="text-end mt-3">Tổng tiền:
        <span class="text-danger">
            {{ number_format($order->orderDetails->sum('amount'), 0, ',', '.') }} VND
        </span>
    </h5>
</div>
@endsection
