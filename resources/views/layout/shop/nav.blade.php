<!-- CSS -->
<style>
/* Vùng bọc menu */
/* Vùng bọc menu */
.product-menu-wrapper {
    position: relative;
    display: inline-block;
}

/* Nút "Sản phẩm" */
.product-menu-btn {
    display: inline-block;
    padding: .5rem 1rem;
    cursor: pointer;
    user-select: none;
    font-weight: normal;
    /* Không đậm */
    background: none !important;
    border: none;
    color: #333;
    position: relative;
    text-decoration: none;
}

/* Hover: giữ màu nền, chỉ đổi màu chữ */
.product-menu-btn:hover {
    background: none !important;
    color: #000;
}

/* Mũi tên FontAwesome */
.product-menu-btn::after {
    content: '\f107';
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
    margin-left: 0.5rem;
    font-size: 1.2rem;
}

/* Menu cấp 1 */
.product-dropdown {
    visibility: hidden;
    opacity: 0;
    transform: translateY(10px);
    transition: all 0.2s ease;
    position: absolute;
    top: 100%;
    left: 0;
    background: #fff;
    border: 1px solid #ddd;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    border-radius: 6px;
    list-style: none;
    margin: 0;
    padding: .5rem 0;
    min-width: 220px;
    z-index: 1000;
}

.product-menu-wrapper:hover>.product-dropdown {
    visibility: visible;
    opacity: 1;
    transform: translateY(0);
}

.product-dropdown li {
    position: relative;
    margin: 0;
    padding: 0;
}

.product-dropdown li>a {
    display: block;
    padding: .5rem 1rem;
    color: #333;
    text-decoration: none;
    font-weight: 500;
    transition: background .2s;
}

.product-dropdown li>a:hover {
    background: #f7f7f7;
}

/* Menu cấp 2, 3 */
.subnav {
    visibility: hidden;
    opacity: 0;
    transform: translateX(10px);
    transition: all 0.2s ease;
    position: absolute;
    top: 0;
    left: 100%;
    background: #fff;
    border: 1px solid #ddd;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    border-radius: 6px;
    list-style: none;
    margin: 0;
    padding: .5rem 0;
    min-width: 200px;
    z-index: 1000;
}

.product-dropdown li:hover>.subnav {
    visibility: visible;
    opacity: 1;
    transform: translateX(0);
}

.subnav li>a {
    display: block;
    padding: .4rem 1rem;
    color: #333;
    font-weight: 400;
    text-decoration: none;
    transition: background .2s;
}

.subnav li>a:hover {
    background: #f0f0f0;
}
</style>


<!-- HTML/Blade -->
<div class="col-lg-6 d-flex flex-wrap">
    <a href="{{ route('shop.home') }}" class="nav-item nav-link text-primary">Trang chủ</a>

    {{-- Nút Sản phẩm dùng thẻ <a> --}}
    <div class="product-menu-wrapper">
        <a href="javascript:void(0)" class="product-menu-btn nav-item nav-link text-dark">Sản phẩm</a>
        <ul class="product-dropdown">
            @foreach($categories as $cat)
            @if($cat->parent_id === 0)
            <li>
                <a href="{{ route('shop.category', $cat->slug) }}">{{ $cat->category_name }}</a>
                @if($cat->children->isNotEmpty())
                <ul class="subnav">
                    @foreach($cat->children as $child)
                    <li>
                        <a href="{{ route('shop.category', $child->slug) }}">{{ $child->category_name }}</a>
                        @if($child->children->isNotEmpty())
                        <ul class="subnav">
                            @foreach($child->children as $grand)
                            <li>
                                <a href="{{ route('shop.category', $grand->slug) }}">{{ $grand->category_name }}</a>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endif
            @endforeach
        </ul>
    </div>

    <a href="{{ route('shop.cart') }}" class="nav-item nav-link text-dark">Giỏ hàng</a>
    <a href="{{ route('contact.index') }}" class="nav-item nav-link text-dark">Liên hệ</a>
    <a href="{{ route('shop.product') }}" class="nav-item nav-link text-dark">All sản phẩm</a>
</div>