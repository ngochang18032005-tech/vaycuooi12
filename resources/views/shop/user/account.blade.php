@extends('layout.shop.layout')

@section('title', 'Tài Khoản')

@section('content')
<x-notification />
<div class="container py-5">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body text-center">
            <img src="{{ asset('images/avatars/' . $user->avatar) }}" class="rounded-circle mb-3"
                style="width: 100px; height: 100px; object-fit: cover;" alt="Avatar">
            <h4 class="mb-1">{{ $user->fullname }}</h4>
            <p class="text-muted">{{ $user->email }}</p>
            <a href="{{ route('user.edit') }}" class="btn btn-primary btn-sm mt-2">✏️ Chỉnh sửa thông tin</a>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h5 class="mb-4">Thông Tin Tài Khoản</h5>
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Họ và tên:</strong> {{ $user->fullname }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Số điện thoại:</strong> {{ $user->phone }}</p>
                    <p><strong>Địa chỉ:</strong> {{ $user->address }}</p>
                </div>
            </div>

            <h3 class="mb-4">Lịch sử đặt hàng</h3>

            @forelse ($orders as $order)
            @php
                $statusText = [
                    1 => 'Đang chờ xử lý',
                    2 => 'Đang giao hàng',
                    3 => 'Hoàn thành',
                    4 => 'Hủy'
                ];

                $statusColor = [
                    1 => 'warning',
                    2 => 'info',
                    3 => 'success',
                    4 => 'danger'
                ];
            @endphp

            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <div>
                        <strong>Đơn hàng #{{ $order->id }}</strong> <br>
                        <small>Ngày đặt: {{ $order->created_at?->format('d/m/Y H:i') ?? 'Không rõ' }}</small>
                    </div>
                    <div>
                        <span class="badge bg-{{ $statusColor[$order->status] ?? 'dark' }}">
                            {{ $statusText[$order->status] ?? 'Không xác định' }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered mb-3">
                        <thead class="table-light">
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
                    <div class="d-flex justify-content-between align-items-center fw-bold">
                        <div>
                            Tổng tiền: {{ number_format($order->orderDetails->sum('amount'), 0, ',', '.') }}₫
                        </div>
                        <div>
                            <a href="{{ route('orders.show', ['order' => $order->id]) }}" class="btn btn-primary btn-sm">
                                Chi tiết
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            @empty
            <div class="alert alert-info">
                Bạn chưa có đơn hàng nào.
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
