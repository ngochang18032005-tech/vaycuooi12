@extends('layout.admin.layout')
@section('title', 'Danh sách danh mục đã xóa')
@section('content')

<div class="bg-white p-4 shadow rounded-lg w-100">
    <h1>Danh Mục bị xóa tạm </h1>

    <x-notification />

    <table class="table table-bordered">
        <thead class="table-light">
            <tr class="text-center">
                <th style="min-width: 50px; width: 50px;">ID</th>
                <th style="width: 150px;">Tên danh mục</th>
                <th>slug</th>
                <th style="width:100px">Hình ảnh</th>
                <th style="width: 150px;">Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <!-- Dữ liệu danh mục (ví dụ) -->
            <tr style="height: 100px;" class="text-center align-middle">
                <td>{{$category->id}}</td>
                <td>{{$category->category_name}}</td>
                <td>{{$category->slug}}</td>
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
                    <!-- khôi phục -->
                    <a href="{{ route('admin.categoryRestore', $category->id) }}"
                        class="btn btn-success btn-sm bi bi-arrow-clockwise restore-cat"
                        data-id="{{ $category->id }}"></a>

                    <!-- xóa -->
                    <form action="{{ route('admin.categoryForceDelete', $category->id) }}" method="POST"
                        class="d-inline xoa-vinh-vien" id="xoa-vinh-vien-{{ $category->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm bi bi-trash3 force-delete-btn"
                            data-id="{{ $category->id }}" title="Xóa vĩnh viễn"></button>
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