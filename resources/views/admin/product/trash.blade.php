@extends('layout.admin.layout')

@section('title', 'Danh sách sản phẩm đã xóa')

@section('content')

<div class="bg-white p-4 shadow rounded-lg w-100 ">
    <h1>Sản phẩm bị xóa tạm</h1>

    <x-notification />

    <table class="table table-bordered ">
        <thead class="table-light">
            <tr class="text-center">
                <th style="min-width: 50px; width: 50px;">ID</th>
                <th style="width: 150px;">Tên sản phẩm</th>
                <th>slug</th>
                <th style="width:100px">Hình ảnh</th>
                <th style="width: 150px;">Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <!-- Dữ liệu danh mục (ví dụ) -->
            <tr style="height: 100px;" class="text-center align-middle">
                <td style="max-height: 100px; overflow: hidden;">{{$product->id}}</td>
                <td>{{$product->product_name}}</td>
                <td>{{$product->slug}}</td>

                <td>
                    @if($product->image)
                    <img src="{{asset('images/products/' . $product->image)}}" alt="Ảnh sản phẩm"
                        class="img-thumbnail rounded shadow-sm"
                        style="width: 80px; height: 80px; object-fit: cover; object-position: center;">
                    @else
                    <span>Chưa có ảnh</span>
                    @endif
                </td>
                <td>
                    <!-- khôi phục -->
                    <a href="{{ route('admin.productRestore', ['id' => $product->id]) }}"
                        class="btn btn-success btn-sm bi bi-arrow-clockwise restore-pro"
                        data-id="{{ $product->id }}"></a>
                    <!-- xóa vĩnh viễn -->
                    <form action="{{ route('admin.productForceDelete', ['id' => $product->id]) }}" method="POST"
                        class="d-inline xoa-vinh-vien" id="xoa-vinh-vien-{{ $product->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm bi bi-trash3 force-delete-btn"
                            data-id="{{ $product->id }}" title="Xoá vĩnh viễn"></button>
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
                @if ($products->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">«</span>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="{{ $products->previousPageUrl() }}">«</a>
                </li>
                @endif

                <!-- {{-- Số trang --}} -->
                @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                @if ($page == $products->currentPage())
                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                @else
                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
                @endforeach

                <!-- {{-- Nút "Trang tiếp theo" --}} -->
                @if ($products->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $products->nextPageUrl() }}">»</a>
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