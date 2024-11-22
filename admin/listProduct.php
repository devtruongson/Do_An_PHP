<?php
include '../connect.php';
include "./auth/checkAuth.php";
include './helpers/paginteProduct.php'
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sản Phẩm</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"
        integrity="sha512-WFN04846sdKMIP5LKNphMaWzU7YpMyCU245etK3g/2ARYbPK9Ub18eG+ljU96qKRCWh+quCY7yefSmlkQw1ANQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css">
</head>

<body class="bg-gray-100 py-12 flex justify-center items-center px-4 flex-col">
    <form id="form_update" action="update.php" method="POST" style="display: none;">
        <input type="hidden" name="title" data-name="title">
        <input type="hidden" name="thumbnail" data-name="thumbnail">
        <input type="hidden" name="weight" data-name="weight">
        <input type="hidden" name="price" data-name="price">
        <input type="hidden" name="content" data-name="content">
        <input type="hidden" name="is_active" data-name="is_active">
        <input type="hidden" name="id" data-name="id">
    </form>

    <div class='container mx-auto mt-8'>
        <h2 class="text-2xl font-bold mb-4">Danh sách Sản Phẩm</h2>
        <table class="min-w-full bg-white border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4 border">Mã SP</th>
                    <th class="py-2 px-4 border">Tên SP</th>
                    <th class="py-2 px-4 border">Loại SP</th>
                    <th class="py-2 px-4 border">Mô Tả</th>
                    <th class="py-2 px-4 border">Hình Ảnh</th>
                    <th class="py-2 px-4 border">Trọng Lượng</th>
                    <th class="py-2 px-4 border">Giá</th>
                    <th class="py-2 px-4 border">Trạng Thái</th>
                    <th class="py-2 px-4 border">Hãng Sữa</th>
                    <th class="py-2 px-4 border">Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $itemsPerPage = 5;
                $currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                paginate($itemsPerPage, $currentPage, "Sua");
                ?>
            </tbody>
        </table>
        <?php paginateBtnNavigate($itemsPerPage, $currentPage, "Sua"); ?>
    </div>
    <script>
        const formDeleteSubmit = document.querySelectorAll('.form-delete-submit');
        function ConfirmDelete(id) {
            Swal.fire({
                title: "Bạn chắc chắn?",
                text: "Bạn có chắc muốn xóa nếu xóa sẽ không thể khôi phục được!",
                icon: "info",
                showConfirmButton: true,
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    formDeleteSubmit.forEach(formElement => {
                        if (formElement.dataset.id === id) {
                            formElement.submit();
                        }
                    });
                }
            });
        }

        function getUrlParameter(name) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(name);
        }

        if (getUrlParameter("code") === '0') {
            Swal.fire({
                title: "Thành Công",
                text: "Bạn đã cập nhật thành công!",
                icon: "success",
                showConfirmButton: true,
            }).then(() => {
                const url = new URL(window.location.href);
                const param = 'code';
                url.searchParams.delete(param);
                window.history.pushState({}, document.title, url.toString());
            });
        } else if (getUrlParameter("code") === "1") {
            Swal.fire({
                title: "Thất Bại",
                text: "Đã Có Lỗi Xảy Ra!",
                icon: "info",
                showConfirmButton: true,
            }).then(() => {
                const url = new URL(window.location.href);
                const param = 'code';
                url.searchParams.delete(param);
                window.history.pushState({}, document.title, url.toString());
            });
        }
    </script>
</body>

</html>