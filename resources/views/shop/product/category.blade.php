@extends('layout.shop.layout')
@section('title', 'Danh muc')
@section('content')

<!-- ------------------------------------------------------------------------------------------ -->
<div class="container-fluid pt-5">
    <div class="mb-4">
        <h2>Sản phẩm thuộc danh mục: {{ $category->category_name }}</h2>
    </div>
    <div class="row px-xl-5 pb-3">
        @foreach($products as $product)
        <div class="col-2 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    @if($product->image)
                    <img src="{{ asset('images/products/' . $product->image) }}" alt="Ảnh sản phẩm"
                        class="img-fluid w-100" style="width: 100px; height: 250px; object-fit: cover;">
                    @else
                    <span>Chưa có ảnh</span>
                    @endif
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-2 pb-3">
                    <h6 class="mb-3"
                        style="overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                        {{ $product->product_name }}
                    </h6>


                    @if ($product->sale_price && $product->sale_price > 0)
                    <div class="d-flex justify-content-between px-3">
                        <strong class="text-danger">
                            {{ number_format($product->sale_price, 0, ',', '.') }}₫
                        </strong>
                        <small class="text-muted text-decoration-line-through">
                            {{ number_format($product->price, 0, ',', '.') }}₫
                        </small>
                    </div>
                    @else
                    <div class="d-flex justify-content-center">
                        <strong>{{ number_format($product->price, 0, ',', '.') }}₫</strong>
                    </div>
                    @endif
                </div>

                <div class="card-footer d-flex justify-content-between align-items-center bg-light border px-2">
                    <!-- nút view -->
                    <a href="{{ route('shop.detail', ['slug' => $product->slug]) }}" class="btn btn-sm text-dark"><i
                            class="fas fa-eye text-primary mr-1"></i>View</a>

                    <!-- nút thêm giỏ hàng -->
                    <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1"> <!-- quantity cố định 1 -->

                        <button type="submit" class="btn btn-sm text-dark">
                            <i class="fas fa-shopping-cart text-primary mr-1"></i>Add
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>



@endsection