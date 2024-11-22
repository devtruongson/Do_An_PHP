<?php
include './connect.php';
$product_id = isset($_GET['sp']) ? (int) $_GET['sp'] : 0;
$query = "select * from Sua where id = $product_id";
$result = mysqli_query($conn, query: $query);

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    echo "Product not found";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['title']; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <header class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-lg font-bold">
                <a href="index.php">Shop Sữa Trường Sơn</a>
            </div>
            <div class="flex space-x-4">
                <input type="text" class="p-2 rounded-lg" placeholder="Tìm kiếm sản phẩm...">
                <button class="bg-blue-800 p-2 rounded-lg">
                    <a href="admin/index.php">Đăng nhập</a>
                </button>
            </div>
        </div>
    </header>
    <div class="container mx-auto p-5">
        <marquee behavior="" direction="">Với Sự Tham Gia Của Các Diễn Viên. Trường Sơn vai Trường Sơn Dev. Tiến Tỉa
            Trong Vai Tiến Đz. Nô Lệ Trong Vai Lê Hoa
        </marquee>
        <div class="bg-white shadow-lg rounded-lg p-6">
            <div class="flex flex-wrap md:flex-nowrap">
                <div class="w-full md:w-1/2 mb-4 md:mb-0">
                    <div class="border rounded overflow-hidden">
                        <img src="<?php echo htmlspecialchars($product['thumbnail']); ?>"
                            alt="<?php echo htmlspecialchars($product['title']); ?>" class="object-cover w-full h-96">
                    </div>
                </div>
                <div class="w-full md:w-1/2 md:pl-6">
                    <h1 class="text-3xl font-semibold text-gray-900 mb-4">
                        <?php echo htmlspecialchars($product['title']); ?>
                    </h1>
                    <p class="text-2xl font-bold text-red-500 mb-4">$<?php echo number_format($product['price'], 2); ?>
                    </p>
                    <div class="flex items-center mb-4">
                        <p class="text-gray-600">Weight: <?php echo number_format($product['weight'], 2); ?> kg</p>
                        <?php if ($product['is_active']): ?>
                            <span class="ml-4 px-2 py-1 text-xs font-semibold text-white bg-green-500 rounded">In
                                Stock</span>
                        <?php else: ?>
                            <span class="ml-4 px-2 py-1 text-xs font-semibold text-white bg-red-500 rounded">Out of
                                Stock</span>
                        <?php endif; ?>
                    </div>
                    <div>
                        <button type="button" id="btn_add_to_cart"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Default</button>
                    </div>
                </div>
            </div>
            <div class="text-gray-700 mb-6">
                <?php echo nl2br(htmlspecialchars($product['content'])); ?>
            </div>
        </div>
    </div>


    <footer class="bg-blue-600 text-white p-4 mt-8">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Shop Sữa Trường Sơn. All rights reserved.</p>
        </div>
    </footer>

    <div class="fixed top-0 left-0 right-0 bottom-0 w-[100vw] h-[100vh] bg-[rgba(0,0,0,0.6)]"
        style="background: rgba(0,0,0,0.6);">
        <div class="absolute w-[70%] top-0 right-0 bottom-0 bg-[#fff] h-[100%] py-10 px-12">
            <h2 class="text-[26px] font-bold text-[#ee4d2d]">Giỏ Hàng Của Bạn</h2>
            <div class="mt-6">

            </div>
        </div>
    </div>
</body>

</html>