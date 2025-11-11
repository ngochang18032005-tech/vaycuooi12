@extends('layout.admin.layout')
@section('title', 'Danh Sách Đơn Hàng')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Danh sách đơn hàng</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr class="text-center">
                <th>ID</th>
                <th>Khách hàng</th>
                <th>Ngày đặt</th>
                <th>Trạng thái</th>
                <th>Tổng tiền</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr class="align-middle text-center">
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->fullname ?? 'Khách vãng lai' }}</td>
                <td>{{ $order->created_at->format('d/m/Y') }}</td>
                <td>
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
                    <span class="badge bg-{{ $statusColor }}">{{ $statusText }}</span>
                </td>
                <td>{{ number_format($order->orderDetails->sum('amount'), 0, ',', '.') }} VND</td>
                <td>
                    <a href="{{ route('order.show', $order->id) }}" class="btn btn-sm btn-info">Chi tiết</a>
                    <a href="{{ route('order.edit', $order->id) }}" class="btn btn-sm btn-warning">Cập nhật</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection
