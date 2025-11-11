@extends('layout.admin.layout')
@section('title', 'Chi tiết thương hiệu')
@section('content')

<div class="container mt-3">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Chi tiết thương hiệu</h4>
        </div>

        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Tên thương hiệu:</strong>
                    <p>{{ $brand->name }}</p>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <strong>Logo:</strong><br>
                        @if($brand->image)
                        <img src="{{ asset('images/brands/' . $brand->image) }}" alt="Ảnh thương hiệu"
                            style="width: 150px;">
                        @endif
                    </div>
                </div>
            </div>



            <div class="mb-3">
                <strong>Mô tả:</strong>
                <p>{{ $brand->description ?? 'Không có mô tả' }}</p>
            </div>

            <div class="mb-3">
                <strong>Trạng thái:</strong>
                <div class="{{ $brand->status == 1 ? 'text-success' : 'text-dange' }}">
                    {{ $brand->status == 1 ? 'Hiển thị' : 'Ẩn' }}</div>
            </div>

            <div class="mb-3">
                <strong>Ngày tạo:</strong>
                <p>{{ $brand->created_at->format('d/m/Y H:i') }}</p>
            </div>

            <div class="mb-3">
                <strong>Cập nhật lần cuối:</strong>
                <p>{{ $brand->updated_at->format('d/m/Y H:i') }}</p>
            </div>

        </div>
    </div>
</div>

@endsection