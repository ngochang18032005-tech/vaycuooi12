@extends('layout.admin.layout')
@section('title', 'Danh sách thương hiệu đã xóa')
@section('content')

<div class="bg-white p-4 shadow rounded-lg w-100">
    <h1>Thương Hiệu bị xóa tạm </h1>

    <x-notification />

    <table class="table table-bordered">
        <thead class="table-light">
            <tr class="text-center">
                <th style="min-width: 50px; width: 50px;">ID</th>
                <th style="width: 150px;">Tên thương hiệu</th>
                <th>slug</th>
                <th style="width:100px">Hình ảnh</th>
                <th style="width: 150px;">Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($brands as $brand)
            <!-- Dữ liệu danh mục (ví dụ) -->
            <tr style="height: 100px;" class="text-center align-middle">
                <td>{{$brand->id}}</td>
                <td>{{$brand->name}}</td>
                <td>{{$brand->slug}}</td>
                <td>
                    @if($brand->image)
                    <img src="{{asset('images/brands/' .$brand->image)}}" alt="Ảnh thương hiệu"
                        class="img-thumbnail rounded shadow-sm"
                        style="width: 80px; height: 80px; object-fit: cover; object-position: center;">

                    @endif
                </td>
                <td>
                    <!-- khôi phục -->
                    <a href="{{ route('admin.brandRestore', $brand->id) }}"
                        class="btn btn-success btn-sm bi bi bi-arrow-clockwise restore-brand"
                        data-id="{{ $brand->id }}"></a>
                    
                    <!-- xóa -->
                    <form action="{{ route('admin.brandForceDelete', $brand->id) }}" method="POST"
                        class="d-inline xoa-vinh-vien" id="xoa-vinh-vien-{{ $brand->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm bi bi-trash3 force-delete-btn" data-id="{{ $brand->id }}"
                            title="Xoá vĩnh viễn"></button>
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