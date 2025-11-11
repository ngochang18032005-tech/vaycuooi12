@extends('layout.admin.layout')
@section('title', 'Sửa sản phẩm')
@section('content')

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Chỉnh sửa sản phẩm</h4>
        </div>

        <x-notification/>

        <div class="card-body">
            <form action="{{ route('admin.productUpdate', $product->slug) }}" method="POST"
                enctype="multipart/form-data"  class="update-form">
                @csrf

                <!-- Tên sản phẩm + Slug -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="product_name" class="form-label">Tên sản phẩm</label>
                        <input type="text" name="productName" id="product_name" class="form-control border"
                            value="{{ old('productName', $product->product_name) }}" onkeyup="generateSlug()" required>
                    </div>

                    <div class="col-md-6">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control border"
                            value="{{ old('slug', $product->slug) }}" readonly>
                    </div>
                </div>

                <!-- Danh mục + Thương hiệu -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="cat" class="form-label">Danh mục</label>
                        <select name="cat" class="form-select">
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ old('cat', $product->cat_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->category_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="brand" class="form-label">Thương hiệu</label>
                        <select name="brand" class="form-select">
                            @foreach($brands as $brand)
                            <option value="{{ $brand->id }}"
                                {{ old('brand', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Giá + Giá khuyến mãi -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="price" class="form-label">Giá</label>
                        <input type="number" name="price" class="form-control border"
                            value="{{ old('price', $product->price) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="sale_price" class="form-label">Giá khuyến mãi</label>
                        <input type="number" name="sale_price" class="form-control border"
                            value="{{ old('sale_price', $product->sale_price) }}">
                    </div>
                    <div class="col-md-4">
                        <label for="qty" class="form-label">Số lượng</label>
                        <input type="number" name="qty" class="form-control border"
                            value="{{ old('qty', $product->qty) }}" required>
                    </div>
                </div>

                <!-- Mô tả + Trạng thái -->
                <div class="row mb-3">

                    <div class="col-md-8 ">
                        <label for="description" class="form-label">Mô tả</label>
                        <textarea name="description" class="form-control"
                            rows="4">{{ old('description', $product->description) }}</textarea>
                    </div>
                    <div class="col-md-4 ">
                        <label for="status" class="form-label">Trạng thái</label>
                        <select name="status" class="form-select">
                            <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Hiển thị
                            </option>
                            <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Ẩn</option>
                        </select>
                    </div>
                </div>

                <!-- Ảnh sản phẩm -->
                <div class="mb-3">
                    <label for="image" class="form-label">Hình ảnh hiện tại</label><br>
                    @if($product->image)
                    <img src="{{ asset('images/products/' . $product->image) }}" class="img-thumbnail mb-2"
                        style="max-width: 150px;">
                    @endif
                    <input type="file" name="image" class="form-control mt-2 border" accept="image/*">
                </div>

                <!-- Nút -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script tạo slug -->
<script>
function generateSlug() {
    let name = document.getElementById('product_name').value;
    let slug = name.toLowerCase()
        .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-+|-+$/g, '');
    document.getElementById('slug').value = slug;
}
</script>


@endsection