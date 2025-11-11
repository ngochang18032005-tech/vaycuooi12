@extends('layout.shop.layout')
@section('title', 'Chi tiết sản phẩm')
@section('content')
<div class="container py-5">
    <div class="row g-5">
        <!-- Cột ảnh sản phẩm -->
        <div class="col-md-6">
            <div class="border rounded shadow-sm bg-white p-3">
                @if ($products->image)
                    <img src="{{ asset('images/products/' . $products->image) }}" 
                         alt="Ảnh sản phẩm" 
                         class="img-fluid w-100 rounded" 
                         style="object-fit: cover; max-height: 500px;">
                @else
                    <div class="text-center text-muted py-5">Chưa có ảnh</div>
                @endif
            </div>
        </div>

        <!-- Cột thông tin -->
        <div class="col-md-6">
            <div class="bg-white p-4 rounded shadow-sm">
                <h2 class="fw-bold mb-3">{{ $products->product_name }}</h2>
                <div class="mb-2 text-muted">Lượt xem: {{ $products->views }}</div>
                <div class="mb-2">
                    Tình trạng: 
                    <span class="{{ $products->status ? 'text-success' : 'text-danger' }} fw-semibold">
                        {{ $products->status ? 'Còn hàng' : 'Hết hàng' }}
                    </span>
                </div>
                <div class="mb-3">
                    Thương hiệu: <strong>{{ $products->brand->name ?? 'Không có' }}</strong>
                </div>

                <!-- Giá -->
                <div class="mb-4">
                    <h3 class="text-danger fw-bold">
                        @if ($products->sale_price)
                            {{ number_format($products->sale_price, 0, ',', '.') }}₫
                            <span class="text-muted text-decoration-line-through ms-2 fs-6">
                                {{ number_format($products->price, 0, ',', '.') }}₫
                            </span>
                        @else
                            {{ number_format($products->price, 0, ',', '.') }}₫
                        @endif
                    </h3>
                </div>

                <!-- Kích thước -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Kích thước:</label>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach (['S', 'M', 'L', 'XL', 'XXL'] as $size)
                            <button type="button" 
                                    class="btn btn-outline-dark rounded-pill px-3 py-1"
                                    {{ $size == 'XXL' ? 'disabled' : '' }}>
                                {{ $size }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Số lượng -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Số lượng:</label>
                    <div class="input-group" style="width: 130px;">
                        <button class="btn btn-outline-dark" type="button" onclick="changeQuantity(-1)">−</button>
                        <input type="text" id="input-quantity" name="quantity" class="form-control text-center" value="1" readonly>
                        <button class="btn btn-outline-dark" type="button" onclick="changeQuantity(1)">+</button>
                    </div>
                </div>

                <!-- Thêm vào giỏ -->
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $products->id }}">
                    <input type="hidden" name="quantity" id="quantity-hidden" value="1">
                    <button type="submit" class="btn btn-dark btn-lg w-100 rounded-pill">
                        <i class="fas fa-shopping-cart me-2"></i> Thêm vào giỏ hàng
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Sản phẩm liên quan -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Sản phẩm liên quan</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        @forelse ($relatedProducts as $related)
        <div class="col-2 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    @if ($related->image)
                    <img src="{{ asset('images/products/' . $related->image) }}" alt="Ảnh sản phẩm"
                        class="img-fluid w-100" style="width: 100px; height: 250px; object-fit: cover;">
                    @else
                    <span>Chưa có ảnh</span>
                    @endif
                </div>
                <!-- Nếu là sản phẩm mới, có thể thêm badge "Mới" -->
                @if ($related->is_new)
                <span class="badge bg-danger position-absolute" style="top: 10px; left: 10px;">Mới</span>
                @endif

                <div class="card-body border-left border-right text-center p-0 pt-2 pb-3">
                    <h6 class="text-truncate mb-3">{{ $related->product_name }}</h6>

                    @if ($related->sale_price && $related->sale_price > 0)
                    <div class="d-flex justify-content-between px-3">
                        <strong class="text-danger">
                            {{ number_format($related->sale_price, 0, ',', '.') }}₫
                        </strong>
                        <small class="text-muted text-decoration-line-through">
                            {{ number_format($related->price, 0, ',', '.') }}₫
                        </small>
                    </div>
                    @else
                    <div class="d-flex justify-content-center">
                        <strong>{{ number_format($related->price, 0, ',', '.') }}₫</strong>
                    </div>
                    @endif
                </div>

                <div class="card-footer d-flex justify-content-between align-items-center bg-light border px-2">
                    <!-- nút view -->
                    <a href="{{ route('shop.detail', ['slug' => $related->slug]) }}" class="btn btn-sm text-dark">
                        <i class="fas fa-eye text-primary mr-1"></i>View
                    </a>

                    <!-- nút thêm giỏ hàng -->
                    <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $related->id }}">
                        <input type="hidden" name="quantity" value="1"> <!-- quantity cố định 1 -->
                        <button type="submit" class="btn btn-sm text-dark">
                            <i class="fas fa-shopping-cart text-primary mr-1"></i>Add
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <p class="text-muted">Không có sản phẩm liên quan.</p>
        @endforelse
    </div>
</div>


<script>
    function changeQuantity(amount) {
        const input = document.getElementById('input-quantity');
        const hiddenInput = document.getElementById('quantity-hidden');
        let current = parseInt(input.value);
        current = isNaN(current) ? 1 : current;
        current += amount;
        if (current < 1) current = 1;
        input.value = current;
        hiddenInput.value = current;
    }
</script>

@endsection