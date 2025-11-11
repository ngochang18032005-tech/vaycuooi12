@extends('layout.admin.layout')
@section('title', 'Chỉnh sửa danh mục')
@section('content')

<x-notification />

<div class="container mt-3">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Chỉnh sửa danh mục</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.categoryUpdate', $category->id) }}" method="POST"
                enctype="multipart/form-data" class="update-form">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="category_name" class="form-label">Tên danh mục</label>
                        <input type="text" name="category_name" id="category_name" class="form-control border"
                            value="{{ old('category_name', $category->category_name) }}" onkeyup="SlugCategory()">
                    </div>

                    <div class="col-md-6">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control border"
                            value="{{ old('slug', $category->slug) }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="parent_id" class="form-label">Danh mục shop</label>
                        <select name="parent_id" class="form-select">
                            <option value="0" {{ $category->parent_id == 0 ? 'selected' : '' }}>-- Không có --</option>
                            @foreach($categories as $parent)
                                <option value="{{ $parent->id }}"
                                    {{ $category->parent_id == $parent->id ? 'selected' : '' }}>
                                    {{ $parent->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="status" class="form-label">Trạng thái</label>
                        <select name="status" class="form-select">
                            <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Hiển thị</option>
                            <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Ẩn</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="image" class="form-label">Chọn hình ảnh mới</label><br>
                        <input type="file" name="image" class="form-control border">
                        <label for="image" class="form-label mt-3">Hình ảnh hiện tại</label><br>
                        <img src="{{ asset('images/categories/' . $category->image) }}" class="img-thumbnail"
                            style="max-width: 150px;">
                    </div>

                    <div class="col-md-7 mb-3">
                        <label for="description" class="form-label">Mô tả</label>
                        <textarea name="description" class="form-control"
                            rows="4">{{ old('description', $category->description) }}</textarea>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Cập nhật danh mục</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
