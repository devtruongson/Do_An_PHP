<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop điện tử</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="https://fstack.io.vn/wp-content/uploads/2024/09/cropped-image-192x192.png" sizes="192x192">
    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/dist/tippy.css" />
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <style>
        .tippy-content {
            border-radius: 6px;
            overflow: hidden;
            padding: 0;
            background: transparent;
            color: #333;
        }
    </style>
</head>

<body class="bg-gray-100">
    <marquee behavior="" direction="">Với Sự Tham Gia Của Các Diễn Viên. Trường Sơn vai Trường Sơn Dev. Tiến Tỉa
        Trong Vai Tiến Đz. Nô Lệ Trong Vai Lê Hoa
    </marquee>
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
    <main class="container mx-auto p-4">
        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">Danh mục sản phẩm</h2>
            <div class="grid grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg text-center">
                    <img src="https://cdn.thuvienphapluat.vn/uploads/tintuc/2023/07/24/sua-dung-thay-sua-me.jpg"
                        alt="Category" class="w-full h-32 object-cover mb-4 rounded-lg">
                    <h3 class="font-semibold">Sữa Bò</h3>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg text-center">
                    <img src="https://cdn.nhathuoclongchau.com.vn/unsafe/800x0/filters:quality(95)/https://cms-prod.s3-sgn09.fptcloud.com/khi_nao_nen_cho_be_uong_sua_1_4401cf044a.jpg"
                        alt="Category" class="w-full h-32 object-cover mb-4 rounded-lg">
                    <h3 class="font-semibold">Sữa Mẹ</h3>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg text-center">
                    <img src="https://media-cdn-v2.laodong.vn/Storage/NewsPortal/2021/1/11/870023/Untitled-1.jpg"
                        alt="Category" class="w-full h-32 object-cover mb-4 rounded-lg">
                    <h3 class="font-semibold">Sữa Đau Đầu</h3>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg text-center">
                    <img src="https://media-cdn-v2.laodong.vn/Storage/NewsPortal/2022/5/31/1051007/Sua-Lua-1.jpg"
                        alt="Category" class="w-full h-32 object-cover mb-4 rounded-lg">
                    <h3 class="font-semibold">Sữa Đá</h3>
                </div>
            </div>
        </section>
        <section>
            <h2 class="text-2xl font-semibold mb-4">Sản phẩm nổi bật</h2>
            <div class="grid grid-cols-3 gap-4">
                <?php
                include './connect.php';
                $query = "select * from Sua";
                $result = mysqli_query($conn, $query);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg">
                            <img src="<?php echo $row["thumbnail"] ?>" alt="Product"
                                class="w-full h-48 object-cover mb-4 rounded-lg">
                            <h3 class="font-semibold line-clamp-1"><?php echo $row["title"] ?></h3>
                            <div class="flex justify-between items-center">
                                <p class="text-gray-600"><?php echo $row["price"] ?></p>
                                <p class="text-gray-600"><?php echo $row["weight"] ?></p>
                            </div>
                            <a href="detail.php?sp=<?php echo $row["id"] ?>"
                                class="bg-blue-600 text-white p-2 rounded-lg mt-4 w-full block text-center">Xem Chi Tiết</a>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </section>
    </main>
    <footer class="bg-blue-600 text-white p-4 mt-8">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Shop Sữa Trường Sơn. All rights reserved.</p>
        </div>
    </footer>
    <button id="productButton" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
        Xem thông tin sản phẩm
    </button>
    <div id="productTooltip" class="hidden">
        <div class="product-card bg-white rounded-lg shadow-lg border border-gray-300 w-96">
            <div class="product-header bg-red-500 text-[#333] px-4 py-2 rounded-t-lg">
                <h1 style="font-weight: 700; font-size: 24px; color: #fff;">Màn hình LG 24MR400-B (23.8
                    inch/FHD/IPS/100Hz/5ms)</h1>
            </div>
            <div class="product-content p-4">
                <div class="product-info mb-4">
                    <strong>Giá bán:</strong>
                    <p class="text-2xl font-bold text-red-500 mb-4">$<?php echo number_format($product['price'], 2); ?>
                </div>
                <div class="product-info">
                    <h2>Mô Tả Sản Phẩm</h2>
                    <p class="text-[#333]" style="max-height: 200px; overflow: auto">
                        <?php echo nl2br(htmlspecialchars($product['content'])); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            tippy('#productButton', {
                content: document.querySelector('#productTooltip').innerHTML,
                allowHTML: true,
                interactive: true,
                theme: 'light',
                placement: 'right',
                maxWidth: 400,
            });
        });
    </script>
</body>

</html>