<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('img/svg/logo.svg')}}" type="image/x-icon">
    <!-- Custom styles -->
    <link rel="stylesheet" href="{{asset('css/style2.min.css')}}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            @include('layout.admin.header')

            <!-- Nội dung chính -->
            <div class="col-md-10 offset-2 p-4">
                @include('layout.admin.navbar')

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Chart library -->
    <script src="./plugins/chart.min.js"></script>
    <!-- Icons library -->
    <script src="plugins/feather.min.js"></script>
    <!-- Custom scripts -->
    <script src="js/script.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Liên kết Bootstrap JS và Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.js"></script>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- slug tu dong product  -->
    <script>
    function SlugProduct() {
        let name = document.getElementById("productName").value;
        let slug = name.toLowerCase();
        slug = slug.normalize('NFD');
        slug = slug.replace(/[\u0300-\u036f]/g, '');
        slug = slug.replace(/[^a-z0-9 -]/g, '');
        slug = slug.replace(/\s+/g, '-');
        slug = slug.replace(/\-\-+/g, '-');
        slug = slug.replace(/^-+|-+$/g, '');
        document.getElementById("slug").value = slug;
    }
    </script>


    <!-- slug tu dong category -->
    <script>
    function generateSlugFromName(input) {
        let slug = input.toLowerCase();

        // Thay thế các ký tự tiếng Việt
        slug = slug.replace(/á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/g, "a");
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/g, "e");
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/g, "i");
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/g, "o");
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/g, "u");
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/g, "y");
        slug = slug.replace(/đ/g, "d");

        // Loại bỏ ký tự đặc biệt
        slug = slug.replace(/[^a-z0-9\s-]/g, "");

        // Thay khoảng trắng thành gạch ngang
        slug = slug.replace(/\s+/g, "-");

        // Bỏ gạch đầu/cuối
        slug = slug.replace(/^-+|-+$/g, "");

        return slug;
    }

    function updateSlug(input) {
        const slugInput = document.getElementById('slug');
        slugInput.value = generateSlugFromName(input.value);
    }
    </script>



    <!-- edit danh mục -->
    <script>
    function SlugCategory() {
        let name = document.getElementById("category_name").value;
        let slug = name.toLowerCase()
            .normalize('NFD').replace(/[\u0300-\u036f]/g, '') // Bỏ dấu tiếng Việt
            .replace(/[^a-z0-9\s-]/g, '') // Bỏ ký tự đặc biệt
            .replace(/\s+/g, '-') // Thay space bằng dấu gạch ngang
            .replace(/-+/g, '-') // Gộp nhiều dấu "-"
            .replace(/^-+|-+$/g, ''); // Bỏ "-" đầu/cuối
        document.getElementById("slug").value = slug;
    }
    </script>
    <!-- edit sản phẩm -->
    <script>
    function generateSlug() {
        let name = document.querySelector('[name="productName"]').value;
        let slug = name.toLowerCase()
            .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
        document.querySelector('[name="slug"]').value = slug;
    }
    </script>
    <!-- thêm thương hiệu -->
    <script>
    document.getElementById('name').addEventListener('input', function() {
        const name = this.value;
        // Hàm chuyển tên sang slug
        const slug = name.toLowerCase()
            .normalize('NFD') // chuyển tiếng Việt có dấu thành không dấu
            .replace(/[\u0300-\u036f]/g, '') // xoá dấu
            .replace(/[^a-z0-9 -]/g, '') // loại bỏ ký tự đặc biệt
            .replace(/\s+/g, '-') // khoảng trắng => dấu gạch ngang
            .replace(/-+/g, '-') // nhiều dấu gạch => 1 dấu
            .replace(/^-+|-+$/g, ''); // bỏ dấu gạch ở đầu/cuối

        document.getElementById('slug').value = slug;
    });
    </script>

</body>

</html>