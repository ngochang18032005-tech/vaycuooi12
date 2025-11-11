@if(session()->has('success'))
<script>
document.addEventListener("DOMContentLoaded", function() {
    Swal.fire({
        title: "Thành công!",
        text: "{{ session('success') }}",
        icon: "success",
        timer: 2000,
        showConfirmButton: false
    });
});
</script>
@endif


<!-- Xóa mềm -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const deleteForms = document.querySelectorAll(".delete-form");

    deleteForms.forEach((form) => {
        form.addEventListener("submit", function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Bạn có chắc muốn xóa?',
                text: "Sau khi xóa sẽ đưa vào thùng rác!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f', // Đỏ
                cancelButtonColor: '#ccc', // Xám
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
<!-- Xóa vĩnh viễn -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const deleteButtons = document.querySelectorAll(".force-delete-btn");

    deleteButtons.forEach(button => {
        button.addEventListener("click", function(e) {
            e.preventDefault();

            const id = this.getAttribute("data-id");
            const form = document.getElementById(`xoa-vinh-vien-${id}`);

            Swal.fire({
                title: 'Bạn có chắc muốn xóa vĩnh viễn?',
                text: 'Dữ liệu này sẽ bị xóa hoàn toàn và không thể khôi phục!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f', // Màu đỏ
                cancelButtonColor: '#6c757d', // Màu xám
                confirmButtonText: 'Xóa vĩnh viễn',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>


<!-- Cập nhật -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const updateForm = document.querySelector(".update-form");

    updateForm.addEventListener("submit", function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Bạn có chắc muốn cập nhật?',
            text: "Hành động này sẽ thay đổi thông tin!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6', // Xanh dương
            cancelButtonColor: '#d33', // Đỏ
            confirmButtonText: 'Cập nhật',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                updateForm.submit();
            }
        });
    });
});
</script>

<!-- Khôi phục danh mục -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const restoreLinks = document.querySelectorAll(".restore-cat");

    restoreLinks.forEach((link) => {
        link.addEventListener("click", function(e) {
            e.preventDefault();

            const categoryId = link.getAttribute("data-id");
            console.log(categoryId);

            Swal.fire({
                title: 'Bạn có chắc muốn khôi phục danh mục này?',
                text: "Danh mục sẽ được phục hồi và hiển thị lại!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6', // Xanh
                cancelButtonColor: '#d33', // Đỏ
                confirmButtonText: 'Khôi phục',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    const restoreUrl =
                        `{{ url('admin/khoi-phuc-danh-muc') }}/${categoryId}`;
                    console.log(restoreUrl);
                    window.location.href = restoreUrl;
                }
            });
        });
    });
});
</script>


<!-- Khôi phục sản phẩm -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const restoreLinks = document.querySelectorAll(".restore-pro");

    restoreLinks.forEach((link) => {
        link.addEventListener("click", function(e) {
            e.preventDefault();

            const categoryId = link.getAttribute("data-id");
            console.log(categoryId);

            Swal.fire({
                title: 'Bạn có chắc muốn khôi phục sản phẩm này?',
                text: "Sản phẩm sẽ được phục hồi và hiển thị lại!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6', // Xanh
                cancelButtonColor: '#d33', // Đỏ
                confirmButtonText: 'Khôi phục',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    const restoreUrl =
                        `{{ url('admin/khoi-phuc-san-pham') }}/${categoryId}`;
                    console.log(restoreUrl);
                    window.location.href = restoreUrl;
                }
            });
        });
    });
});
</script>

<!-- Khôi phục thương hiệu -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const restoreLinks = document.querySelectorAll(".restore-brand");

    restoreLinks.forEach((link) => {
        link.addEventListener("click", function(e) {
            e.preventDefault();

            const categoryId = link.getAttribute("data-id");
            console.log(categoryId);

            Swal.fire({
                title: 'Bạn có chắc muốn khôi phục thương hiệu này?',
                text: "Thương hiệu sẽ được phục hồi và hiển thị lại!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6', // Xanh
                cancelButtonColor: '#d33', // Đỏ
                confirmButtonText: 'Khôi phục',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    const restoreUrl =
                        `{{ url('admin/khoi-phuc-thuong-hieu') }}/${categoryId}`;
                    console.log(restoreUrl);
                    window.location.href = restoreUrl;
                }
            });
        });
    });
});
</script>