<?php
include '../connect.php';
include "./helpers/paginteKhachHang.php";

include "./auth/checkAuth.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sản Phẩm Sữa Tuần 6</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"
        integrity="sha512-WFN04846sdKMIP5LKNphMaWzU7YpMyCU245etK3g/2ARYbPK9Ub18eG+ljU96qKRCWh+quCY7yefSmlkQw1ANQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css">
</head>

<body class="bg-gray-100 py-12 flex justify-center items-center px-4 flex-col">
    <form id="form_update" action="updateKhachHang.php" method="POST" style="display: none;">
        <input type="hidden" name="FullName" data-name="FullName">
        <input type="hidden" name="Address" data-name="Address">
        <input type="hidden" name="PhoneNumber" data-name="PhoneNumber">
        <input type="hidden" name="Gender" data-name="Gender">
        <input type="hidden" name="Id" data-name="Id">
    </form>

    <div class='container mx-auto mt-8'>
        <h2 class="text-2xl font-bold mb-4 text-center text-[#333] italic">Thông Tin Khách Hàng</h2>
        <table class="min-w-full bg-white border-collapse border border-gray-300">
            <thead>
                <tr class="bg-yellow-200 border">
                    <th class="py-2 px-4 border">Mã KH</th>
                    <th class="py-2 px-4 border">Tên KH</th>
                    <th class="py-2 px-4 border">Địa Chỉ</th>
                    <th class="py-2 px-4 border">Số Điện Thoại</th>
                    <th class="py-2 px-4 border">Giới Tính</th>
                    <th class="py-2 px-4 border">Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $itemsPerPage = 5;
                $currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                paginate($itemsPerPage, $currentPage, "Customer");

                ?>
            </tbody>
        </table>
        <?php paginateBtnNavigate($itemsPerPage, $currentPage, "Customer"); ?>
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