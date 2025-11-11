@extends('layout.admin.layout')
@section('title', 'Trang chủ quản trị')
@section('content')

<div class="container-fluid mt-4">

    {{-- Thống kê nhanh --}}
    <div class="row text-white mb-4">
        <div class="col-md-3">
            <div class="card bg-primary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Sản phẩm</h5>
                    <h3>{{ $productCount ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Đơn hàng</h5>
                    <h3>{{ $orderCount ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Người dùng</h5>
                    <h3>{{ $userCount ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Tổng doanh thu</h5>
                    <h3>{{ number_format($totalRevenue ?? 0, 0, ',', '.') }}₫</h3> <!-- Hiển thị tổng doanh thu -->
                </div>
            </div>
        </div>

    </div>

    {{-- Danh sách đơn hàng mới --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-info text-white">
            Đơn hàng mới nhất
        </div>
        <div class="card-body p-0">
            <table class="table table-hover table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#ID</th>
                        <th>Tên khách</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestOrders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->fullname ?? '[Không có]' }}</td>
                        <td>{{ number_format($order->total_price, 0, ',', '.') }}₫</td> <!-- Hiển thị tổng tiền -->
                        <td>
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

                            <span class="badge bg-{{ $statusColor[$order->status] ?? 'secondary' }}">
                                {{ $statusText[$order->status] ?? 'Không xác định' }}
                            </span>
                        </td>

                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Không có đơn hàng</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    {{-- Thao tác nhanh --}}
    <div class="card shadow-sm">
        <div class="card-header bg-light">Thao tác nhanh</div>
        <div class="card-body">
            <a href="{{ route('admin.productCreate') }}" class="btn btn-primary me-2">➕ Thêm sản phẩm</a>
            <a href="{{ route('admin.categoryCreate') }}" class="btn btn-success me-2">➕ Thêm danh mục</a>
            <a href="{{ route('order.index') }}" class="btn btn-warning me-2">📦 Quản lý đơn hàng</a>
            <a href="{{ route('admin.userList') }}" class="btn btn-info">👥 Quản lý người dùng</a>
        </div>
    </div>
</div>
@endsection