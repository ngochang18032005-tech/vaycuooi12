<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Trang chủ')</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Font Awesome & Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />


    <!-- Swiper -->
    <link href="https://unpkg.com/swiper/swiper-bundle.min.css" rel="stylesheet" />

    <!-- Your app CSS -->
    <link href="{{ asset('css/style.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />

    <!-- ==== CSS Menu “Trà sữa” ==== -->
    <style>
    :root {
        /* Tone trà sữa */
        --tea-bg: #F8F1E6;
        --tea-primary: #CBB292;
        --tea-primary-dark: #B49C82;
        --tea-text: #6B4C3B;
        --tea-hover: #E0D4C3;
    }

    .product-menu-wrapper {
        position: relative;
        display: inline-block;
    }

    .product-menu-btn {
        padding: .5rem 1rem;
        cursor: pointer;
        user-select: none;
        font-weight: 600;
        background-color: var(--tea-primary);
        color: var(--tea-text);
        border: 1px solid var(--tea-primary-dark);
        border-radius: 4px;
        transition: background .2s, color .2s;
    }

    .product-menu-btn:hover {
        background-color: var(--tea-primary-dark);
        color: #fff;
    }

    .product-dropdown {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background: var(--tea-bg);
        border: 1px solid var(--tea-primary);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-radius: 6px;
        list-style: none;
        margin: 0;
        padding: .5rem 0;
        min-width: 220px;
        z-index: 1000;
        opacity: 0;
        transition: opacity .2s ease;
    }

    .product-menu-wrapper:hover>.product-dropdown {
        display: block;
        opacity: 1;
    }

    .product-dropdown li>a {
        display: block;
        padding: .5rem 1rem;
        color: var(--tea-text);
        text-decoration: none;
        font-weight: 500;
        transition: background .2s;
    }

    .product-dropdown li>a:hover {
        background: var(--tea-hover);
    }

    .subnav {
        display: none;
        position: absolute;
        top: 0;
        left: 100%;
        background: var(--tea-bg);
        border: 1px solid var(--tea-primary);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-radius: 6px;
        list-style: none;
        margin: 0;
        padding: .5rem 0;
        min-width: 200px;
        opacity: 0;
        transition: opacity .2s ease;
    }

    .product-dropdown li:hover>.subnav {
        display: block;
        opacity: 1;
    }

    .subnav li>a {
        display: block;
        padding: .4rem 1rem;
        color: var(--tea-text);
        font-weight: 400;
        transition: background .2s;
    }

    .subnav li>a:hover {
        background: var(--tea-hover);
    }
    </style>
</head>

<body class="font-poppins">
    <!-- header -->
    @include('layout.shop.header')
    <!-- nav -->
    @include('layout.shop.nav')
    <!-- nội dung chính -->
    <main class="pb-5">
        @yield('content')
    </main>
    <!-- footer -->
    @include('layout.shop.footer')



    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- jQuery nếu còn dùng -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
</body>

</html>