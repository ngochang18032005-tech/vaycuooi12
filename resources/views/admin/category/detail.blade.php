@extends('layout.admin.layout')
@section('title', 'Chi tiết danh mục')

@section('content')
<div class="container mt-3">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Chi tiết danh mục</h4>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    @if($category->image)
                    <img src="{{ asset('images/categories/' . $category->image) }}" class="img-thumbnail"
                        style="width: 400px; height:500px">
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="mb-5">
                        <h1>{{ $category->category_name }}</h1>
                    </div>
                    <div class="row mb-4">
                        <strong class="col-md-3">Mô tả:</strong>
                        <span class="col-md-9">{{ $category->category_name }}</span>
                    </div>
                    <div class="row mb-4">
                        <strong class="col-md-3">Danh mục cha:</strong>
                        <span
                            class="col-md-9">{{ $category->parent ? $category->parent->category_name : 'Không có' }}</span>
                    </div>
                    <div class="row mb-4">
                        <strong class="col-md-3">Trạng thái:</strong>
                        <span
                            class="col-md-9 {{ $category->status == 1 ? 'text-success' : 'text-danger' }}">{{ $category->status == 1 ? 'Hiển thị' : 'Ẩn' }}</span>
                    </div>
                    <div class = "row mb-4">
                        <strong class = "col-md-3">Ngày tạo:</strong>
                        <div class = "col-md-9">{{ $category->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                    <div class = "row mb-4">
                        <strong class = "col-md-3">Cập nhật lần cuối:</strong>
                        <div class = "col-md-9">{{ $category->updated_at->format('d/m/Y H:i') }}</div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection