@extends('layout.admin.layout')
@section('title', 'Quản lý danh mục')
@section('content')

<div class="container my-4">
    <!-- Tiêu đề trang -->
    <h1>Quản Lý Danh Mục</h1>

    <!-- Nút thêm danh mục mới -->
    <a href="{{route('admin.categoryStore')}}"><button class="btn btn-primary mb-2">Thêm Danh Mục</button></a>
    <a href="/admin/danh-sach-danh-muc-da-xoa"><button class="btn btn-success mb-2">trash({{$trashCount}})</button></a>

    <x-notification />

    <!-- Bảng danh mục -->
    <table class="table table-striped table-bordered table-fixed">
        <thead>
            <tr class="text-center align-middle">
                <th style="min-width: 50px; width: 50px;">ID</th>
                <th style="width: 150px;">Tên Danh Mục</th>
                <th>Slug</th>
                <th>Danh Mục Cha</th>
                <th style="width: 300px;">Mô tả</th>
                <th style="width:100px">Hình Ảnh</th>
                <th style="width: 100px;">Trạng Thái</th>
                <th style="width: 150px;">Chức Năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <!-- Dữ liệu danh mục (ví dụ) -->
            <tr style="height: 100px;" class="text-center align-middle">
                <td>{{$category->id}}</td>
                <td>{{$category->category_name}}</td>
                <td>{{$category->slug}}</td>
                <td>{{$category->parent ? $category->parent->category_name : 'Không có'}}</td>
                <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    {{$category->description}}</td>

                <td>
                    @if($category->image)
                    <img src="{{asset('images/categories/' .$category->image)}}" alt="Ảnh danh mục"
                        class="img-thumbnail rounded shadow-sm"
                        style="width: 80px; height: 80px; object-fit: cover; object-position: center;">
                    @else
                    <span>Chưa có ảnh</span>
                    @endif
                </td>
                <td>
                    <span class="text-sm font-medium {{$category->status ? 'text-success' : 'text-danger'}}">
                        {{$category->status ? 'Hiển thị' : 'Ẩn'}}
                    </span>
                </td>
                <td class="text-center align-middle">
                    <a href="{{ route('admin.categoryShow', $category->id) }}"
                        class="btn btn-success btn-sm bi bi-eye"></a>
                    <a href="{{ route('admin.categoryEdit', $category->id) }}"
                        class="btn btn-warning btn-sm bi bi-pencil"></a>
                    <form action="{{ route('admin.categoryDelete', $category->id) }}" method="POST"
                        class="d-inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm bi bi-trash3"></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="container mt-4">
        <nav>
            <ul class="pagination justify-content-center">
                <!-- {{-- Nút "Trang trước" --}} -->
                @if ($categories->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">«</span>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="{{ $categories->previousPageUrl() }}">«</a>
                </li>
                @endif

                <!-- {{-- Số trang --}} -->
                @foreach ($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                @if ($page == $categories->currentPage())
                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                @else
                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
                @endforeach

                <!-- {{-- Nút "Trang tiếp theo" --}} -->
                @if ($categories->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $categories->nextPageUrl() }}">»</a>
                </li>
                @else
                <li class="page-item disabled">
                    <span class="page-link">»</span>
                </li>
                @endif
            </ul>
        </nav>
    </div>
   
</div>


@endsection