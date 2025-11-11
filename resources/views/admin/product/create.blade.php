@extends('layout.admin.layout')
@section('title', 'Thêm Sản Phẩm')
@section('content')

<div class="container mt-3">
    <div class="card shadow-sm">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Thêm Sản Phẩm</h4>
        </div>

        <x-notification />

        <div class="card-body">
            <form action="{{ route('admin.productStore') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Tên sản phẩm -->
                <div class="mb-3">
                    <label for="productName" class="form-label">Tên sản phẩm</label>
                    <input type="text" class="form-control border" id="productName" name="productName"
                        value="{{ old('productName') }}" onkeyup="SlugProduct()" required>
                </div>

                <!-- Slug và Danh mục -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control border" id="slug" name="slug" value="{{ old('slug') }}"
                            readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cat" class="form-label">Danh mục</label>
                        <select class="form-select border" id="cat" name="cat" required>
                            <option value="">Chọn danh mục</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('cat') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->category_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Thương hiệu và Số lượng -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="brand" class="form-label">Thương hiệu</label>
                        <select class="form-select" id="brand" name="brand">
                            <option value="">Chọn thương hiệu</option>
                            @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ old('brand') == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="qty" class="form-label">Số lượng</label>
                        <input type="number" class="form-control border" id="qty" name="qty" min="0"
                            value="{{ old('qty') }}" required>
                    </div>
                </div>

                <!-- Giá và Giá khuyến mãi -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">Giá (VNĐ)</label>
                        <input type="number" class="form-control border" id="price" name="price" min="1000"
                            value="{{ old('price') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="sale_price" class="form-label">Giá khuyến mãi (VNĐ)</label>
                        <input type="number" class="form-control border" id="sale_price" name="sale_price"
                            value="{{ old('sale_price', 0) }}">
                    </div>
                </div>

                <!-- Hình ảnh và trạng thái -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="image" class="form-label">Hình ảnh sản phẩm</label>
                        <input type="file" class="form-control border" id="image" name="image" accept="image/*">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Trạng thái</label>
                        <select class="form-select" id="status" name="status">
                            <option value="1">Hiển thị</option>
                            <option value="0">Ẩn</option>
                        </select>
                    </div>
                </div>

                <!-- Nút Submit -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-25">Thêm sản phẩm</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection