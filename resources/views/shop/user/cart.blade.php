@extends('layout.shop.layout')
@section('title', 'Giỏ hàng')
@section('content')
<x-notification />

<div class="container py-5">
    <div class="row justify-content-center">
        @if(count($cart) > 0)
        <div class="col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Giỏ hàng của bạn</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle text-center mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart as $id => $item)
                                <tr>
                                    <td>
                                        <img src="{{ asset('images/products/'.$item['image']) }}" width="50" height="60"
                                            class="img-thumbnail">
                                    </td>
                                    <td class="text-start">{{ $item['name'] }}</td>
                                    <td>{{ number_format($item['price']) }} VNĐ</td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <button class="btn btn-dark btn-sm"
                                                onclick="updateQuantity({{ $id }}, 'decrease')">–</button>

                                            <span class="mx-2" id="quantity-{{ $id }}">{{ $item['quantity'] }}</span>
                                            <button class="btn btn-dark btn-sm"
                                                onclick="updateQuantity({{ $id }}, 'increase')">+</button>

                                        </div>
                                    </td>
                                    <td id="total-price-{{ $id }}" data-price="{{ $item['price'] }}">
                                        {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} VNĐ
                                    </td>
                                    <td>
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $id }}">
                                            <button class="btn btn-sm btn-outline-danger" title="Xóa sản phẩm">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="{{ route('shop.cart.clear') }}"
                    onclick="return confirm('Bạn có chắc chắn muốn xóa tất cả sản phẩm trong giỏ hàng?')"
                    class="btn btn-outline-danger">
                    <i class="bi bi-x-circle"></i> Xóa tất cả
                </a>
                <h5 class="mb-0">Tổng tiền: <span id="cart-total">{{ number_format($totalPrice ?? 0, 0, ',', '.') }}
                        VNĐ</span></h5>
            </div>

            <div class="text-center mt-4">
                <button class="btn btn-success btn-lg px-5" id="payButton">
                    <i class="bi bi-credit-card"></i> Thanh toán
                </button>
            </div>
        </div>
        @else
        <div class="col-md-8 text-center">
            <div class="alert alert-info shadow-sm">
                Giỏ hàng của bạn đang trống.
            </div>
        </div>
        @endif
    </div>

    {{-- Form Thanh Toán --}}
    <div id="checkout-form" class="card p-4 mt-4 shadow-sm border-0" style="display: none;">
        <h5 class="mb-3">Thông Tin Đặt Hàng</h5>
        <form action="{{ route('shop.cart.checkout') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Họ tên</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', Auth::user()->fullname ?? '') }}" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', Auth::user()->email ?? '') }}" required>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Số điện thoại</label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                    value="{{ old('phone', Auth::user()->phone ?? '') }}" required>
                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Địa chỉ</label>
                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                    value="{{ old('address', Auth::user()->address ?? '') }}" required>
                @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-check-circle"></i> Xác nhận đặt hàng
            </button>
        </form>
    </div>
</div>

{{-- Script --}}
<script>
document.getElementById('payButton').addEventListener('click', () => {
    @if(!Auth::check())
    if (confirm('Bạn chưa đăng nhập. Chuyển đến trang đăng nhập?')) {
        window.location.href = "{{ route('shop.login') }}";
    }
    @else
    document.getElementById('checkout-form').style.display = 'block';
    document.getElementById('payButton').style.display = 'none';
    @endif
});

function updateQuantity(id, action) {
    let qtyEl = document.getElementById('quantity-' + id);
    let price = parseFloat(document.getElementById('total-price-' + id).dataset.price);
    let qty = parseInt(qtyEl.textContent);
    qty = action === 'increase' ? qty + 1 : Math.max(1, qty - 1);
    qtyEl.textContent = qty;
    document.getElementById('total-price-' + id).textContent = (qty * price).toLocaleString('vi-VN') + ' VNĐ';

    fetch("{{ route('cart.update') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                product_id: id,
                action: action
            })
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById('cart-total').textContent = data.totalPrice.toLocaleString('vi-VN') + ' VNĐ';
        });
}
</script>
@endsection