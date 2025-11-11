@extends('layout.admin.layout')

@section('title', 'Danh sách sản phẩm đã xóa')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Chi Tiết Sản Phẩm</h4>
        </div>

        <div class="p-4 row">
            <div class="col-md-4">
                <img src="{{ asset('images/products/' . $product->image) }}" alt="Ảnh sản phẩm"
                    style="width: 400px; height:500px">
            </div>
            <div class="col-md-8 ">
                <h1 class="text-left pb-5">{{ $product->product_name }}</h1>
                <div class="row pb-4">
                    <div class="col-md-6">
                        <strong>Danh mục:</strong>
                        {{ $product->category->category_name ?? 'Chưa có' }}
                    </div>
                    <div class="col-md-6">
                        <strong>Thương hiệu:</strong>
                        {{ $product->brand->name ?? 'Chưa có' }}
                    </div>
                </div>

                <div class="row pb-4 align-items-center">
                    <div class="col-md-2"><strong>Giá:</strong></div>
                    <div class="col-md-10">
                        @if($product->sale_price !== null && $product->sale_price < $product->price)
                            <p class="text-danger fw-bold fs-4 mb-1">
                                {{ number_format($product->sale_price, 0, ',', '.') }}₫
                            </p>
                            <p class="text-muted text-decoration-line-through small mb-0">
                                {{ number_format($product->price, 0, ',', '.') }}₫
                            </p>
                            @else
                            <p class="fw-bold fs-4">
                                {{ number_format($product->price, 0, ',', '.') }}₫
                            </p>
                            @endif
                    </div>
                </div>

                <div class="row pb-4">
                    <div class="col-md-2"><strong>Mô tả:</strong></div>
                    <div class="col-md-10">{!! $product->description ? nl2br(e($product->description)) : '<em>Không
                            có</em>' !!}</div>
                </div>

                <div class="row">
                    <div class="col-md-2"><strong>Trạng thái:</strong></div>
                    <div class="col-md-10"><span class="{{ $product->status == 1 ? 'text-success' : 'text-danger' }}">
                            {{ $product->status == 1 ? 'Hiển thị' : 'Ẩn' }}
                        </span></div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection