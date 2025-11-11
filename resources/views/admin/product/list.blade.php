@extends('layout.admin.layout')
@section('title', 'Quản lý sản phẩm')
@section('content')

<div class="container my-4">
    <!-- Tiêu đề trang -->
    <h1>Quản Lý Sản Phẩm</h1>

    <!-- Nút thêm sản phẩm mới -->
    <a href="{{route('admin.productCreate')}}"><button class="btn btn-primary mb-2">Thêm Sản phẩm </button></a>
    <a href="/admin/danh-sach-san-pham-da-xoa"><button class="btn btn-success mb-2">trash({{$trashCount}})</button></a>

    <x-notification />

    <!-- Bảng sản phẩm -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr class="text-center">
                <th style="min-width: 50px; width: 50px;">ID</th>
                <th style="width:100px">Hình ảnh </th>
                <th style="width: 250px;">Tên sản phẩm </th>
                <th>Slug</th>
                <th style="width: 100px;">Danh mục </th>
                <th style="width: 120px;">Thương hiệu</th>
                <th>Giá </th>
                <th style="width: 150px;">Chức Năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <!-- Dữ liệu sản phẩm (ví dụ) -->
            <tr style="height: 100px;" class="text-center align-middle">
                <td>{{$product->id}}</td>
                <td>
                    @if($product->image)
                    <img src="{{ asset('images/products/' . $product->image) }}" alt="Ảnh sản phẩm"
                        class="img-thumbnail rounded shadow-sm"
                        style="width: 80px; height: 80px; object-fit: cover; object-position: center;">
                    @else
                    <span>Chưa có ảnh</span>
                    @endif
                </td>
                <td>{{$product->product_name}}</td>
                <td>{{$product->slug}}</td>
                <td>{{$product->category ? $product->category->category_name : 'Không có'}}</td>
                <td>{{$product->brand ? $product->brand->name : 'Không có'}}</td>
                <td>
                    @if ($product->sale_price > 0)
                    <strong>{{ number_format($product->sale_price, 0, ',', '.') }}₫</strong><br>
                    <small class="text-muted text-decoration-line-through">
                        {{ number_format($product->price, 0, ',', '.') }}₫
                    </small>
                    @else
                    <strong>{{ number_format($product->price, 0, ',', '.') }}₫</strong>
                    @endif

                </td>
                <td>
                    <a href="{{ route('admin.productShow', ['id' => $product->id]) }}"
                        class="btn btn-success btn-sm bi bi-eye"></a>
                    <a href="{{ route('admin.productEdit', ['slug' => $product->slug]) }}"
                        class="btn btn-warning btn-sm bi bi-pencil"></a>
                    <form action="{{ route('admin.productDelete', $product->id) }}" method="POST"
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