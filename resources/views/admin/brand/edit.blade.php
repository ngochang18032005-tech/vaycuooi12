@extends('layout.admin.layout')
@section('title', 'Chỉnh sửa thương hiệu')
@section('content')

<div class="container mt-3">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Chỉnh sửa thương hiệu</h4>
        </div>

        <x-notification />

        <div class="card-body">
            <form action="{{ route('admin.brandUpdate', $brand->id) }}" method="POST" enctype="multipart/form-data"
                class="update-form">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="brand_name" class="form-label">Tên thương hiệu</label>
                        <input type="text" class="form-control border" id="brand_name" name="brand_name"
                            value="{{ old('name', $brand->name) }}" required>
                        @error('brand_name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control border" id="slug" name="slug"
                            value="{{ old('slug', $brand->slug) }}" required>
                        @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="description" class="form-label">Mô tả</label>
                        <textarea class="form-control border" name="description"
                            rows="4">{{ old('description', $brand->description) }}</textarea>
                        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="status" class="form-label">Trạng thái</label>
                        <select class="form-select border" name="status" required>
                            <option value="1" {{ old('status', $brand->status) == 1 ? 'selected' : '' }}>Hiển thị
                            </option>
                            <option value="0" {{ old('status', $brand->status) == 0 ? 'selected' : '' }}>Ẩn</option>
                        </select>
                        @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Ảnh thương hiệu (nếu muốn thay)</label>
                    <input type="file" class="form-control border" name="image">
                    @if($brand->image)
                    <div class="mt-2">
                        <img src="{{ asset('images/brands/' . $brand->image) }}" alt="Ảnh thương hiệu hiện tại"
                            style="width: 100px; border:1px solid #ccc; border-radius:10%; padding:10px ">
                    </div>
                    @endif
                    @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Cập nhật thương hiệu</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const brandNameInput = document.getElementById("brand_name");
        const slugInput = document.getElementById("slug");

        brandNameInput.addEventListener("input", function () {
            const slug = brandNameInput.value
                .toLowerCase()
                .normalize("NFD").replace(/[\u0300-\u036f]/g, "") // loại bỏ dấu tiếng Việt
                .replace(/[^a-z0-9\s-]/g, "") // loại bỏ ký tự đặc biệt
                .trim()
                .replace(/\s+/g, "-"); // thay khoảng trắng bằng dấu gạch ngang

            slugInput.value = slug;
        });
    });
</script>

@endsection