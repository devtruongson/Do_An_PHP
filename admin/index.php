<?php
session_start();

if (!empty($_SESSION['username'])) {
    ?>
    <script>
        window.location.href = "dashboard.php";
    </script>
    <?php
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sản Phẩm</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css">
    <link rel="icon" href="https://fstack.io.vn/wp-content/uploads/2024/09/cropped-image-192x192.png" sizes="192x192">
</head>

<body class="bg-gray-100">
    <div class="font-[sans-serif]">
        <div class="min-h-screen flex fle-col items-center justify-center py-6 px-4">
            <div class="grid md:grid-cols-2 items-center gap-4 max-w-6xl w-full">
                <div
                    class="border border-gray-300 rounded-lg p-6 max-w-md shadow-[0_2px_22px_-4px_rgba(93,96,127,0.2)] max-md:mx-auto">
                    <form class="space-y-4" method="POST">
                        <div class="mb-8">
                            <h3 class="text-gray-800 text-3xl font-extrabold">Đăng Nhập</h3>
                            <p class="text-gray-500 text-sm mt-4 leading-relaxed">Đăng nhập để quản lý sản phẩm của cửa hàng Sữa</p>
                        </div>

                        <div>
                            <label class="text-gray-800 text-sm mb-2 block">Tên tài khoản</label>
                            <div class="relative flex items-center">
                                <input name="username" type="text" required class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-lg outline-blue-600" placeholder="Enter user name" />
                            </div>
                        </div>

                        <div>
                            <label class="text-gray-800 text-sm mb-2 block">Mật khẩu</label>
                            <div class="relative flex items-center">
                                <input name="password" type="password" required class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-lg outline-blue-600" placeholder="Enter password" req />
                            </div>
                        </div>

                        <div class="flex flex-wrap items-center justify-between gap-4">
                            <div class="flex items-center">
                                <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
                                <label for="remember-me" class="ml-3 block text-sm text-gray-800">Nhớ mật khẩu</label>
                            </div>
                            <div class="text-sm">
                                <a href="javascript:void(0);" class="text-blue-600 hover:underline font-semibold">Bạn quên mật khẩu?</a>
                            </div>
                        </div>

                        <div class="!mt-8">
                            <button class="w-full shadow-xl py-3 px-4 text-sm tracking-wide rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">Đăng Nhập</button>
                        </div> 
                        <!--sửa ở đây -->
                        <p class="text-sm !mt-8 text-center text-gray-800">Nếu không có tài khoản! 
                            <a href="dangki.php" class="text-blue-600 font-semibold hover:underline ml-1 whitespace-nowrap">Đăng ký tại đây</a>
                        </p>
                        <p class="text-sm !mt-8 text-center text-gray-800">
                            <a href="../index.php" class="text-blue-600 font-semibold hover:underline ml-1 whitespace-nowrap">Quay lại trang chủ</a>
                        </p>
                    </form>
                </div>
                <div class="lg:h-[400px] md:h-[300px] max-md:mt-8">
                    <img src="https://readymadeui.com/login-image.webp"
                        class="w-full h-full max-md:w-4/5 mx-auto block object-cover" alt="Dining Experience" />
                </div>
            </div>
        </div>
    </div>
    <script>
        const code = window.location.search;
        if (code?.split("=") && code?.split("=").length > 0) {
            const codeSucc = code?.split("=")[1];
            if (codeSucc == "1") {
                Swal.fire({
                    title: "Thất Bại",
                    text: "Tài khoản của bạn không tồn tại trong hệ thống!",
                    icon: "info",
                    showConfirmButton: true,
                }).then(() => {
                    const url = new URL(window.location.href);
                    const param = 'code';
                    url.searchParams.delete(param);
                    window.history.pushState({}, document.title, url.toString());
                });
            }

            if (codeSucc == "2") {
                Swal.fire({
                    title: "Thất Bại",
                    text: "Xin lỗi mật khẩu của bạn nhập bị sai!",
                    icon: "info",
                    showConfirmButton: true,
                }).then(() => {
                    const url = new URL(window.location.href);
                    const param = 'code';
                    url.searchParams.delete(param);
                    window.history.pushState({}, document.title, url.toString());
                });
            }

            if (codeSucc == "0") {
                Swal.fire({
                    title: "Chúc Mừng",
                    text: "Bạn đã đăng nhập thành công!",
                    icon: "success",
                    showConfirmButton: true,
                }).then(() => {
                    window.location.href = "dashboard.php?code=200";
                });
            }

            if (codeSucc == "403") {
                Swal.fire({
                    title: "Cảnh báo",
                    text: "Bạn phải đăng nhập trước khi thao tác!",
                    icon: "success",
                    showConfirmButton: true,
                }).then(() => {
                    window.location.href = `index.php`;
                })
            }
        }
    </script>
</body>

</html>

<?php
if (!empty($_POST)) {
    include "../connect.php";

    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "select * from admin where username = '$username'";
    $result = mysqli_query($conn, $query);
    if ($result->num_rows < 1) {
        ?>
        <script>
            window.location.href = `index.php?code=1`; 
        </script>
        <?php
    } else {
        $row = mysqli_fetch_assoc($result);
        if ($password == $row['password']) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_id'] = $row['id'];

            ?>
            <script>
                window.location.href = `index.php?code=0`; 
            </script>
            <?php

        } else {
            ?>
            <script>
                window.location.href = `index.php?code=2`; 
            </script>
            <?php
        }
    }
}
?>