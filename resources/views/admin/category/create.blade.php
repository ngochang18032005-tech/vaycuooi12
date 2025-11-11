@extends('layout.admin.layout')

@section('title', 'Thêm danh mục')
@section('content')
<div class="container mt-3">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Thêm Danh Mục</h4>
        </div>
        <x-notification />
        <div class="card-body">
            <form action="{{ route('admin.categoryStore') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Tên & Slug -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tên danh mục</label>
                        <input type="text" name="category_name" class="form-control border" value="{{ old('category_name') }}"
                            oninput="updateSlug(this)" required>
                        @error('category_name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Slug</label>
                        <input type="text" id="slug" name="slug" class="form-control border" value="{{ old('slug') }}"
                            readonly>
                        @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>


                <!-- Danh mục cha -->
                <div class="mb-3">
                    <label class="form-label">Danh mục cha</label>
                    <select name="parent_id" class="form-select">
                        <option value="0">-- Không có --</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('parent_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->category_name }}
                        </option>
                        @endforeach
                    </select>
                    @error('parent_id') <small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <!-- Sort order & Status & Image -->
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Thứ tự</label>
                        <input type="number" name="sort_order" class="form-control border" value="{{ old('sort_order', 0) }}">
                        @error('sort_order') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Trạng thái</label>
                        <select name="status" class="form-select" required>
                            <option value="1" {{ old('status')=='1'? 'selected':'' }}>Hiển thị</option>
                            <option value="0" {{ old('status')=='0'? 'selected':'' }}>Ẩn</option>
                        </select>
                        @error('status') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Ảnh</label>
                        <input type="file" name="image" class="form-control border" accept="image/*">
                        @error('image') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>

                <!-- Mô tả -->
                <div class="mb-3">
                    <label class="form-label">Mô tả</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                    @error('description') <small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <!-- Submit -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Thêm danh mục</button>
                    <a href="{{ route('admin.categoryList') }}" class="btn btn-secondary">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection