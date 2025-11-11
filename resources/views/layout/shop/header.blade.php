<!-- ------------------------------------------------------------------------------------------------------------------ -->
<div class="container-fluid pb-4">
    <div class="row bg-secondary py-2 px-5">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center">
                <a class="text-dark" href="">FAQs</a>
                <span class="text-muted px-2">|</span>
                <a class="text-dark" href="">Help</a>
                <span class="text-muted px-2">|</span>
                <a class="text-dark" href="">Support</a>
            </div>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                <a class="text-dark px-2" href="">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a class="text-dark px-2" href="">
                    <i class="fab fa-twitter"></i>
                </a>
                <a class="text-dark px-2" href="">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a class="text-dark px-2" href="">
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="text-dark pl-2" href="">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row align-items-center pt-3 px-2">
        <div class="col-md-3 d-none d-lg-block">
            <a href="{{route('shop.home')}}" class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold">
                    <span class="text-primary font-weight-bold border px-3 mr-1">LuRy</span>Shop</h1>
            </a>
        </div>

        <div class="row col-md-9 d-flex flex-wrap">
            <!-- search -->
            <div class="col-md-9 text-left">
                <form action="{{ route('product.search') }}" method="GET" class="d-flex">
                    <input type="text" name="product" class="form-control" placeholder="Tìm kiếm sản phẩm...">
                    <button class="input-group-text bg-transparent text-primary">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
            <div class="col-md-3 d-flex align-items-center justify-content-end gap-3">
                <!-- profile -->
                <div class="dropdown">
                    <a href="#" class="nav-link text-dark" data-bs-toggle="dropdown">
                        <i class="fas fa-user text-primary"></i>
                    </a>
                    <div class="dropdown-menu">
                        @if(Auth::check())
                            <a href="{{route('shop.account')}}" class="dropdown-item text-dark">
                                {{ Auth::user()->fullname }}
                            </a>
                            <a href="{{ route('shop.logout') }}" class="dropdown-item text-dark">Đăng xuất</a>

                            <form id="logout-form" action="{{ route('shop.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        @else
                            <a href="{{ route('shop.login') }}" class="dropdown-item text-dark">Đăng nhập</a>
                            <a href="{{ route('shop.registration') }}" class="dropdown-item text-dark">Đăng ký</a>
                        @endif
                    </div>
                </div>

                <!-- cart -->
                <div>
                    <a href="{{ route('shop.cart') }}" class="btn border-none position-relative">
                        <i class="fas fa-shopping-cart text-primary"></i>

                        @php
                            $cart = session('cart', []);
                            $cartItemCount = count($cart);
                        @endphp

                        @if($cartItemCount > 0)
                            <span class="position-absolute translate-middle badge rounded-pill bg-danger"
                                style="top: 5px; left: 30px;">
                                {{ $cartItemCount }}
                            </span>
                        @endif
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>