@extends('layout.admin.layout')
@section('title', 'Cập Nhật Trạng Thái Đơn Hàng')
@section('content')
<div class="container mt-4">
    <h2>Cập nhật trạng thái đơn hàng #{{ $order->id }}</h2>
    <p><strong>Khách hàng:</strong> {{ $order->user->fullname ?? $order->username }}</p>

    <form action="{{ route('order.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="status">Trạng thái</label>
            <select name="status" id="status" class="form-control">
                <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Đang chờ xử lý</option>
                <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Đang giao hàng</option>
                <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Hoàn thành</option>
                <option value="4" {{ $order->status == 4 ? 'selected' : '' }}>Hủy</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>

</div>
@endsection