<?php
include "./auth/checkAuth.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Sữa</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="">
    <div class="flex h-screen">
        <div class="flex-1 p-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-semibold">Chào mừng đến với Dashboard</h1>
                <div class="flex items-center">
                    <img src="https://via.placeholder.com/40" alt="Admin" class="rounded-full mr-4">
                    <span>Admin</span>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-4">Tổng Sản Phẩm</h3>
                    <p class="text-2xl font-bold">150</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-4">Tổng Đơn Hàng</h3>
                    <p class="text-2xl font-bold">500</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-4">Tổng Doanh Thu</h3>
                    <p class="text-2xl font-bold">₫1,500,000</p>
                </div>
            </div>
            <div id="recent-activity" class="bg-white p-6 rounded-lg shadow-md mb-8">
                <h3 class="text-xl font-semibold mb-4">Hoạt Động Gần Đây</h3>
                <ul>
                    <li class="mb-4">
                        <span class="font-semibold">Đơn hàng #1023</span> - Đã được hoàn thành.
                        <span class="text-gray-500 text-sm">2 giờ trước</span>
                    </li>
                    <li class="mb-4">
                        <span class="font-semibold">Khách hàng #789</span> - Đã đăng ký.
                        <span class="text-gray-500 text-sm">5 giờ trước</span>
                    </li>
                    <li class="mb-4">
                        <span class="font-semibold">Sản phẩm #456</span> - Đã được thêm vào hệ thống.
                        <span class="text-gray-500 text-sm">1 ngày trước</span>
                    </li>
                </ul>
            </div>
            <footer class="text-center text-gray-500 py-6">
                <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Về MilkMart Professional</h3>
                        <p>MilkMart Professional - Nơi cung cấp các sản phẩm sữa chất lượng cao từ các thương hiệu uy tín trên toàn cầu.</p>
                        <p class="mt-2">&copy; 2024 MilkMart Professional. All rights reserved.</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Liên hệ</h3>
                        <ul>
                            <li>Địa chỉ: 123 Đường ABC, Quận XYZ, TP.HCM</li>
                            <li>Số điện thoại: 0123 456 789</li>
                            <li>Email: contact@milkmart.com</li>
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>

</body>

</html>