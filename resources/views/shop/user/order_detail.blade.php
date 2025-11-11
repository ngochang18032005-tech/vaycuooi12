@extends('layout.shop.layout')
@section('title', 'Chi tiết đơn hàng')
@section('content')
<div class="p-5">
    <div class="row">
        <!-- Thông tin đơn hàng -->
        <div class="col-lg-6">
            <div class="card shadow-lg border-light rounded">
                <div class="card-header bg-gradient-primary text-white text-center">
                    <h4><strong>Thông Tin Đơn Hàng</strong></h4>
                </div>
                <div class="card-body p-4">
                    <ul class="list-unstyled">
                        <li class="mb-3"><strong>Họ tên:</strong> {{ $order->name }}</li>
                        <li class="mb-3"><strong>Email:</strong> {{ $order->email }}</li>
                        <li class="mb-3"><strong>Số điện thoại:</strong> {{ $order->phone }}</li>
                        <li class="mb-3"><strong>Địa chỉ:</strong> {{ $order->address }}</li>
                        <li class="mb-3"><strong>Ngày tạo:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</li>
                        <li class="mb-3"><strong>Trạng thái:</strong>
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

                            <span class="badge badge-{{ $statusColor[$order->status] ?? 'secondary' }} p-2">
                                {{ $statusText[$order->status] ?? 'Không xác định' }}
                            </span>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <!-- Chi tiết sản phẩm -->
        <div class="col-lg-6">
            <div class="card shadow-lg border-light rounded">
                <div class="card-header bg-gradient-primary text-white text-center">
                    <h4><strong>Sản Phẩm Đặt Mua</strong></h4>
                </div>
                <div class="card-body p-4">
                    <table class="table table-hover table-bordered table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>Hình Ảnh</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Số Lượng</th>
                                <th>Giá</th>
                                <th>Thành Tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderDetails as $orderDetail)
                            <tr>
                                <td>
                                    <!-- Hiển thị hình ảnh sản phẩm -->
                                    <img src="{{ asset('images/products/' . $orderDetail->product->image) }}" alt=""
                                        width="50" height="50" class="img-fluid rounded">
                                </td>
                                <td>{{ $orderDetail->product->product_name }}</td>
                                <td>{{ $orderDetail->qty }}</td>
                                <td>{{ number_format($orderDetail->price, 0, ',', '.') }} đ</td>
                                <td>{{ number_format($orderDetail->amount, 0, ',', '.') }} đ</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between mt-4">
                        <h5><strong>Tổng Tiền:</strong></h5>
                        <h5 class="text-danger">{{ number_format($order->orderDetails->sum('amount'), 0, ',', '.') }} đ
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection