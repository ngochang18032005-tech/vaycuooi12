@extends('layout.shop.layout')
@section('title', 'Trang chu')
@section('content')
    <x-shop.banner />

    <style>
        .card.product-item {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card.product-item:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }
    </style>

    <div class="container py-5">
        <div class="row gx-4 gy-4 text-center">
            @php
                $features = [
                    ['icon' => 'fas fa-check-circle', 'text' => 'Chất lượng'],
                    ['icon' => 'fas fa-shipping-fast', 'text' => 'Giao hàng nhanh'],
                    ['icon' => 'fas fa-exchange-alt', 'text' => 'Đổi trả 14 ngày'],
                    ['icon' => 'fas fa-headset', 'text' => 'Hỗ trợ 24/7'],
                ];
            @endphp
            @foreach($features as $feature)
                <div class="col-md-3">
                    <div class="p-4 border rounded-3" style="background-color: #F0F5F9;">
                        <i class="{{ $feature['icon'] }} fa-2x mb-3" style="color: #00B8A9;"></i>
                        <h5 class="mb-0" style="color: #F6416C;">{{ $feature['text'] }}</h5>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- THƯƠNG HIỆU -->
    <div class="container my-4">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2" style="background-color: #FFDE7D; border-radius: 5px;">Thương
                    hiệu nổi bật</span></h2>
        </div>
        <div class="row justify-content-center">
            @foreach ($brands as $brand)
                <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-4 text-center">
                    <a href="{{ route('shop.productsToBrand', ['brand_id' => $brand->id]) }}"
                        class="d-block p-2 border rounded shadow-sm h-100"
                        style="text-decoration: none; background-color: #F0F5F9;">
                        <img src="{{ asset('images/brands/' . $brand->image) }}" alt="{{ $brand->name }}"
                            class="img-fluid mx-auto d-block" style="max-height: 100px; object-fit: contain;">
                        <p class="mt-2 mb-0 fw-semibold text-dark">{{ $brand->name }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    @php
        $sections = [
            ['title' => 'Sản Phẩm NEW', 'products' => $newProducts, 'type' => 'new', 'badge' => 'Mới', 'badge_color' => '#F6416C', 'text_color' => '#fff'],
            ['title' => 'Sản Phẩm Đang SALE', 'products' => $saleProducts, 'type' => 'sale', 'badge' => 'SALE', 'badge_color' => '#FFDE7D', 'text_color' => '#000'],
            ['title' => 'Sản Phẩm HOT', 'products' => $viewProducts, 'type' => 'hot', 'badge' => '🔥', 'badge_color' => '#00B8A9', 'text_color' => '#fff'],
        ];
    @endphp

    @foreach($sections as $section)
        <div class="container-fluid pt-5">
            <div class="text-center mb-4">
                <h2 class="section-title px-5"><span class="px-2" style="background-color: #FFDE7D; border-radius: 5px;">
                        {{ $section['title'] }} </span></h2>
            </div>
            <div class="row px-xl-5 pb-3">
                @foreach($section['products'] as $product)
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2 pb-1">
                        <div class="card product-item border-0 mb-4">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                @if($product->image)
                                    <img src="{{ asset('images/products/' . $product->image) }}" alt="Ảnh sản phẩm"
                                        class="img-fluid w-100" style="height: 250px; object-fit: cover;">
                                @else
                                    <span>Chưa có ảnh</span>
                                @endif
                                <span class="badge position-absolute"
                                    style="top: 10px; left: 10px; background-color: {{ $section['badge_color'] }}; color: {{ $section['text_color'] }};">
                                    {{ $section['badge'] }}
                                </span>
                            </div>

                            <div class="card-body border-left border-right text-center p-0 pt-2 pb-3">
                                <h6 class="mb-3"
                                    style="overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                    {{ $product->product_name }}
                                </h6>

                                @if ($product->sale_price && $product->sale_price > 0)
                                    <div class="d-flex justify-content-between px-3">
                                        <strong class="text-danger">{{ number_format($product->sale_price, 0, ',', '.') }}₫</strong>
                                        <small
                                            class="text-muted text-decoration-line-through">{{ number_format($product->price, 0, ',', '.') }}₫</small>
                                    </div>
                                @else
                                    <div class="d-flex justify-content-center">
                                        <strong>{{ number_format($product->price, 0, ',', '.') }}₫</strong>
                                    </div>
                                @endif
                            </div>

                            <div class="card-footer d-flex justify-content-between align-items-center bg-light border px-2">
                                <a href="{{ route('shop.detail', ['slug' => $product->slug]) }}" class="btn btn-sm text-white"
                                    style="background-color: #F6416C;">
                                    <i class="fas fa-eye mr-1"></i>View
                                </a>

                                <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-sm text-white" style="background-color: #00B8A9;">
                                        <i class="fas fa-shopping-cart mr-1"></i>Add
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('shop.allProduct', ['type' => $section['type']]) }}" class="btn btn-outline-primary">Xem thêm
                    {{ strtolower($section['title']) }}</a>
            </div>
        </div>
    @endforeach

@endsection