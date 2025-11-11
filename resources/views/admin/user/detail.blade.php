@extends('layout.admin.layout')

@section('title', 'Chi Tiết Người Dùng')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Chi Tiết Người Dùng</h4>
        </div>

        <div class="p-4 row">
            <div class="col-md-4">
                <img src="{{ asset('images/avatars/' . $user->avatar) }}" alt="Ảnh người dùng" class="img-fluid"
                    style="max-width: 300px; height: auto;">
            </div>
            <div class="col-md-8">
                <h1 class="text-left pb-5">{{ $user->fullname }}</h1>

                <div class="row pb-4">
                    <div class="col-md-6"><strong>Tên đăng nhập:</strong> {{ $user->username }}</div>
                    <div class="col-md-6"><strong>Email:</strong> {{ $user->email }}</div>
                </div>

                <div class="row pb-4">
                    <div class="col-md-6">
                        <strong>Giới tính:</strong> {{ $user->gender == 'male' ? 'Nam' : 'Nữ' }}
                    </div>
                    <div class="col-md-6">
                        <strong>Ngày sinh:</strong> {{ \Carbon\Carbon::parse($user->birthdate)->format('d/m/Y') }}
                    </div>
                </div>

                <div class="row pb-4">
                    <div class="col-md-6"><strong>Số điện thoại:</strong> {{ $user->phone ?? 'Chưa có' }}</div>
                    <div class="col-md-6"><strong>Địa chỉ:</strong> {{ $user->address ?? 'Chưa có' }}</div>
                </div>

                <div class="row pb-4">
                    <div class="col-md-6"><strong>Ngày tham gia:</strong> {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</div>
                    <div class="col-md-6">
                        <strong>Quyền:</strong>
                        <span class="{{ $user->role == 'admin' ? 'text-danger' : 'text-success' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <h2>Lịch sử đặt hàng của {{ $user->fullname }}</h2>

        @if ($user->orders->isEmpty())
            <div class="alert alert-warning mt-3">Người dùng chưa có đơn hàng nào.</div>
        @else
            @foreach($user->orders as $order)
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

                <div class="card mt-4">
                    <div class="card-header bg-secondary text-white">
                        <strong>Đơn hàng #{{ $order->id }}</strong> - Ngày đặt: {{ $order->created_at->format('d/m/Y') }} - 
                        Trạng thái: <span class="badge bg-{{ $statusColor }}">{{ $statusText }}</span>
                    </div>
                    <div class="card-body">
                        <p><strong>Người nhận:</strong> {{ $order->name }} - {{ $order->phone }} - {{ $order->address }}</p>

                        <table class="table table-bordered">
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
                                    <td>{{ $detail->product->product_name ?? 'Sản phẩm không tồn tại' }}</td>
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

                        <div class="mt-3">
                            <strong>Tổng tiền đơn hàng:</strong>
                            <strong class="text-danger">
                                {{ number_format($order->orderDetails->sum('amount'), 0, ',', '.') }} VND
                            </strong>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
