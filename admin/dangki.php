<?php
session_start();
if (!empty($_SESSION['username'])) {
    ?>
    <script>
        window.location.href = "dashboard.php";
    </script>
    <?php
}

if (!empty($_POST)) {
    include "../connect.php";

    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];

    $query = "SELECT * FROM admin WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result->num_rows > 0) {
        ?>
        <script>
            window.location.href = "dangki.php?code=1";  
        </script>
        <?php
        exit(); 
    }
    if ($password !== $confirmPassword) {
        ?>
        <script>
            window.location.href = "dangki.php?code=2"; 
        </script>
        <?php
        exit();
    }
    $insertQuery = "INSERT INTO admin (username, password) VALUES ('$username', '$password')";
    if (mysqli_query($conn, $insertQuery)) {
        ?>
        <script>
            window.location.href = "dangki.php?code=0"; 
        </script>
        <?php
    } else {
        ?>
        <script>
            window.location.href = "dangki.php?code=2";  
        </script>
        <?php
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Tài Khoản</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css">
    <link rel="icon" href="https://fstack.io.vn/wp-content/uploads/2024/09/cropped-image-192x192.png" sizes="192x192">
</head>

<body class="bg-gray-100">
    <div class="font-[sans-serif]">
        <div class="min-h-screen flex flex-col items-center justify-center py-6 px-4">
            <div class="grid md:grid-cols-2 items-center gap-4 max-w-6xl w-full">
                <div class="border border-gray-300 rounded-lg p-6 max-w-md shadow-[0_2px_22px_-4px_rgba(93,96,127,0.2)] max-md:mx-auto">
                    <form class="space-y-4" method="POST">
                        <div class="mb-8">
                            <h3 class="text-gray-800 text-3xl font-extrabold">Đăng ký tài khoản</h3>
                            <p class="text-gray-500 text-sm mt-4 leading-relaxed">Hãy tạo tài khoản để quản lý sản phẩm của bạn!</p>
                        </div>

                        <div>
                            <label class="text-gray-800 text-sm mb-2 block">Tên tài khoản</label>
                            <input name="username" type="text" required class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-lg outline-blue-600" placeholder="Nhập tên tài khoản" />
                        </div>

                        <div>
                            <label class="text-gray-800 text-sm mb-2 block">Mật khẩu</label>
                            <div class="relative flex items-center">
                                <input name="password" type="password" required
                                    class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-lg outline-blue-600"
                                    placeholder="Enter password" req />
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb"
                                    class="w-[18px] h-[18px] absolute right-4 cursor-pointer" viewBox="0 0 128 128">
                                    <path
                                        d="M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z"
                                        data-original="#000000"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <label class="text-gray-800 text-sm mb-2 block">Nhập lại mật khẩu</label>
                            <div class="relative flex items-center">
                                <input name="confirm_password" id="confirm_password" type="password" required
                                    class="w-full text-sm text-gray-800 border border-gray-300 px-4 py-3 rounded-lg outline-blue-600"
                                    placeholder="Nhập lại mật khẩu" />
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb"
                                    class="w-[18px] h-[18px] absolute right-4 cursor-pointer" viewBox="0 0 128 128">
                                    <path
                                        d="M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z"
                                        data-original="#000000"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="!mt-8">
                            <button class="w-full shadow-xl py-3 px-4 text-sm tracking-wide rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">Đăng ký</button>
                        </div>

                        <p class="text-sm !mt-8 text-center text-gray-800">Đã có tài khoản? 
                            <a href="index.php" class="text-blue-600 font-semibold hover:underline ml-1 whitespace-nowrap">Đăng nhập tại đây</a>
                        </p>
                    </form>
                </div>
                <div class="lg:h-[400px] md:h-[300px] max-md:mt-8">
                    <img src="https://readymadeui.com/login-image.webp" class="w-full h-full max-md:w-4/5 mx-auto block object-cover" alt="Register Image" />
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const togglePasswordIcons = document.querySelectorAll(".relative svg");
            const passwordFields = document.querySelectorAll("input[type='password']");

            togglePasswordIcons.forEach((icon, index) => {
                icon.addEventListener("click", function () {
                    const passwordField = passwordFields[index];
                    const isPasswordVisible = passwordField.type === "text";
                    passwordField.type = isPasswordVisible ? "password" : "text";
                    const path = icon.querySelector("path");
                    if (isPasswordVisible) {
                        path.setAttribute(
                            "d",
                            "M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z"
                        );
                        icon.setAttribute("fill", "#bbb");
                        icon.setAttribute("stroke", "#bbb");
                    } else {
                        path.setAttribute(
                            "d",
                            "M64 24C22.127 24 1.367 60.504.504 62.057a4 4 0 0 0 0 3.887C1.367 67.496 22.127 104 64 104s62.633-36.504 63.496-38.057a4 4 0 0 0 0-3.887C126.633 60.504 105.873 24 64 24zm0 64c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24z"
                        );
                        icon.setAttribute("fill", "#007bff");
                        icon.setAttribute("stroke", "#007bff");
                    }
                });
            });
        });

        const code = window.location.search;
        if (code?.split("=") && code?.split("=").length > 0) {
            const codeSucc = code?.split("=")[1];

            if (codeSucc == "1") {
                Swal.fire({
                    title: "Thất Bại",
                    text: "Tài khoản đã tồn tại, vui lòng thử tài khoản khác!",
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
                    text: "Mật khẩu không trùng khớp hoặc có lỗi xảy ra trong quá trình đăng ký. Vui lòng thử lại!",
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
                    text: "Bạn đã đăng ký tài khoản thành công!",
                    icon: "success",
                    showConfirmButton: true,
                }).then(() => {
                    window.location.href = "index.php?code=200";
                });
            }
        }
    </script>
</body>

</html>
