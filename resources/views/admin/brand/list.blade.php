@extends('layout.admin.layout')
@section('title', 'Quản lý thương hiệu')
@section('content')

<div class="container my-4">
    <!-- Tiêu đề trang -->
    <h1>Quản Lý Thương Hiệu</h1>

    <!-- Nút thêm danh mục mới -->
    <a href="{{ route('admin.brandCreate') }}"><button class="btn btn-primary mb-2">Thêm thương hiệu</button></a>
    <a href="{{ route('admin.brandTrash') }}"><button class="btn btn-success mb-2">trash({{$trashCount}})</button></a>

    <x-notification />

    <!-- Bảng danh mục -->
    <table class="table table-striped table-bordered table-fixed">
        <thead>
            <tr class="text-center align-middle">
                <th style="min-width: 50px; width: 50px;">ID</th>
                <th style="width: 150px;">Tên thương hiệu</th>
                <th>Slug</th>
                <th style="width: 300px;">Mô tả</th>
                <th style="width:100px">Hình Ảnh</th>
                <th style="width: 100px;">Trạng Thái</th>
                <th style="width: 150px;">Chức Năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($brands as $brand)
            <!-- Dữ liệu danh mục (ví dụ) -->
            <tr style="height: 100px;" class="text-center align-middle">
                <td>{{ $brand->id }}</td>
                <td>{{ $brand->name }}</td>
                <td>{{ $brand->slug }}</td>
                <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    {{ $brand->description }}
                </td>

                <td>
                    @if($brand->image)
                    <img src="{{asset('images/brands/' .$brand->image)}}" alt="Ảnh thương hiệu"
                        class="img-thumbnail rounded shadow-sm"
                        style="width: 80px; height: 80px; object-fit: cover; object-position: center;">

                    @endif
                </td>
                <td>
                    @if($brand->status == 1)
                    <span class="text-success">Hiển thị</span>
                    @else
                    <span class="text-danger">Ẩn</span>
                    @endif
                </td>


                <td class="text-center align-middle">
                    <a href="{{ route('admin.brandShow', $brand->id) }}" class="btn btn-success btn-sm bi bi-eye"></a>
                    <a href="{{ route('admin.brandEdit', $brand->id) }}"
                        class="btn btn-warning btn-sm bi bi-pencil"></a>
                    <form action="{{ route('admin.brandDestroy', ['id' => $brand->id]) }}" method="POST"
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
                @if ($brands->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">«</span>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="{{ $brands->previousPageUrl() }}">«</a>
                </li>
                @endif

                <!-- {{-- Số trang --}} -->
                @foreach ($brands->getUrlRange(1, $brands->lastPage()) as $page => $url)
                @if ($page == $brands->currentPage())
                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                @else
                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
                @endforeach

                <!-- {{-- Nút "Trang tiếp theo" --}} -->
                @if ($brands->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $brands->nextPageUrl() }}">»</a>
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