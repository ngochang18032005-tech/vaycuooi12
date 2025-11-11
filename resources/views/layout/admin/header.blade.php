<!-- ! Sidebar -->
<aside class="sidebar col-md-2 position-fixed vh-100 start-0 top-0">
    <div class="sidebar-start">
        <div class="sidebar-head">
            <a href="{{route('admin.home')}}" class="logo-wrapper" title="Home">
                <span class="icon logo" aria-hidden="true"></span>
                <div class="logo-text">
                    <span class="logo-title">LuRy Shop</span>
                </div>
            </a>
        </div>
        <div class="sidebar-body">
            <ul class="sidebar-body-menu">
                <li>
                    <a class="text-decoration-none {{ request()->routeIs('admin.home') ? 'active text-white' : '' }}"
                        href="{{route('admin.home')}}"><span class="icon home" aria-hidden="true"></span>Trang chủ</a>
                </li>
                <li>
                    <a class="text-decoration-none {{ request()->routeIs('admin.categoryList') ? 'active text-white' : '' }}"
                        href="{{route('admin.categoryList')}}"><span class="icon folder" aria-hidden="true"></span>Quản
                        lý danh mục </a>
                </li>
                <li>
                    <a class="text-decoration-none {{ request()->routeIs('admin.productList') ? 'active text-white' : '' }}"
                        href="{{route('admin.productList')}}"><span class="icon folder" aria-hidden="true"></span>Quản
                        lý sản phẩm </a>
                </li>
                <li>
                    <a class="text-decoration-none {{ request()->routeIs('admin.brandList') ? 'active text-white' : '' }}"
                        href="{{route('admin.brandList')}}"><span class="icon folder" aria-hidden="true"></span>Quản lý
                        thương hiệu </a>
                </li>
                <li>
                    <a class="text-decoration-none" href="##"><span class="icon image" aria-hidden="true"></span>Quản lý
                        hình ảnh </a>
                </li>
                <li>
                    <a class="text-decoration-none {{ request()->routeIs('admin.userList') ? 'active text-white' : '' }}"
                        href="{{route('admin.userList')}}"><span class="icon user-3" aria-hidden="true"></span>Quản lý
                        người dùng </a>
                </li>
                <li>
                    <a class="text-decoration-none {{ request()->routeIs('order.index') ? 'active text-white' : '' }}"
                        href="{{route('order.index')}}"><span class="icon paper" aria-hidden="true"></span>Quản lý
                        hóa đơn </a>
                </li>

                <li>
                    <a class="text-decoration-none" href="##"><span class="icon document" aria-hidden="true"></span>Quản
                        lý bài viết </a>
                </li>
                <li>
                    <a class="text-decoration-none" href="##"><span class="icon message" aria-hidden="true"></span>Quản
                        lý liên hệ </a>
                </li>
            </ul>
        </div>
    </div>
</aside>