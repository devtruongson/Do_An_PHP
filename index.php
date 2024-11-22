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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick-theme.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>
    <style>
        .tippy-content {
            border-radius: 6px;
            overflow: hidden;
            padding: 0;
            background: transparent;
            color: #333;
        }

        header {
            height: 300px;
            overflow: hidden;
        }

        .autoplay {
            height: 100%;
        }

        .autoplay img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .relative.z-10 {
            height: 100%;
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body class="bg-gray-100">
    <marquee behavior="" direction="">Với Sự Tham Gia Của Các Diễn Viên. Trường Sơn vai Trường Sơn Dev. Tiến Tỉa
        Trong Vai Tiến Đz. Nô Lệ Trong Vai Lê Hoa
    </marquee>
    <header class="relative">
        <div class="absolute inset-0 z-0 autoplay">
            <img src="./admin/uploads/Head/Head1.png" alt="Head 1">
            <img src="./admin/uploads/Head/Head2.png" alt="Head 2">
            <img src="./admin/uploads/Head/Head3.png" alt="Head 3">
            <img src="./admin/uploads/Head/Head4.png" alt="Head 4">
            <img src="./admin/uploads/Head/Head5.png" alt="Head 5">
            <img src="./admin/uploads/Head/Head6.png" alt="Head 6">
        </div>

        <div class="relative z-10">
            <div class="container mx-auto p-4 flex justify-between items-center">
                <div class="text-lg font-bold">
                    <a href="index.php">Shop Sữa</a>
                </div>
                <div class="flex space-x-4">
                    <input type="text" class="p-2 rounded-lg" placeholder="Tìm kiếm sản phẩm...">
                    <button class="bg-blue-800 p-2 rounded-lg">
                        <a href="admin/index.php" class="text-white">Đăng nhập</a>
                    </button>
                </div>
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
            <h2 class="text-2xl font-semibold mb-4">Sản phẩm theo loại</h2>
            <?php
            include './connect.php';

            $typeQuery = "SELECT DISTINCT type FROM sua WHERE is_active = 1";
            $typeResult = mysqli_query($conn, $typeQuery);

            if ($typeResult->num_rows > 0) {
                while ($typeRow = $typeResult->fetch_assoc()) {
                    $type = $typeRow['type'];
            ?>
                    <div class="mb-6">
                        <h3 class="text-xl font-semibold mb-3"><?php echo htmlspecialchars($type); ?></h3>
                        <div class="grid grid-cols-5 gap-4">
                            <?php
                            $productQuery = "SELECT * FROM sua WHERE type = ? AND is_active = 1";
                            $stmt = $conn->prepare($productQuery);
                            $stmt->bind_param("s", $type);
                            $stmt->execute();
                            $productResult = $stmt->get_result();

                            if ($productResult->num_rows > 0) {
                                while ($row = $productResult->fetch_assoc()) {
                            ?>
                                    <a href="detail.php?sp=<?php echo htmlspecialchars($row["id"]); ?>"
                                        class="block bg-white p-2 rounded-lg shadow-md hover:shadow-lg transition transform hover:scale-105 product-tooltip"
                                        data-title="<?php echo htmlspecialchars($row["title"]); ?>"
                                        data-price="<?php echo htmlspecialchars(number_format($row["price"], 2)); ?>"
                                        data-weight="<?php echo htmlspecialchars($row["weight"]); ?>"
                                        data-description="<?php echo nl2br(htmlspecialchars($row["content"])); ?>">
                                        <img src="<?php echo htmlspecialchars($row["thumbnail"]); ?>" alt="Product"
                                            class="w-full h-32 object-cover mb-2 rounded-lg">
                                        <h3 class="font-semibold text-sm line-clamp-1"><?php echo htmlspecialchars($row["title"]); ?></h3>
                                        <div class="flex justify-between items-center mt-1 text-xs">
                                            <p class="text-gray-600"><?php echo htmlspecialchars(number_format($row["price"], 2)); ?> VNĐ</p>
                                            <p class="text-gray-600"><?php echo htmlspecialchars($row["weight"]); ?> kg</p>
                                        </div>
                                    </a>
                            <?php
                                }
                            } else {
                                echo "<p class='text-gray-500'>Không có sản phẩm nào thuộc loại này.</p>";
                            }
                            ?>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p class='text-gray-500'>Không tìm thấy loại sản phẩm nào.</p>";
            }
            ?>
        </section>

    </main>
    <footer class="bg-blue-600 text-white p-4 mt-8">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Shop Sữa Trường Sơn. All rights reserved.</p>
        </div>
    </footer>
</body>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        tippy('.product-tooltip', {
            content(reference) {
                const title = reference.getAttribute('data-title');
                const price = reference.getAttribute('data-price');
                const weight = reference.getAttribute('data-weight');
                const description = reference.getAttribute('data-description');
                return `
                    <div class="bg-white rounded-lg shadow-lg border border-gray-300 w-80 p-4">
                        <h1 class="font-bold text-lg mb-2">${title}</h1>
                        <p class="text-red-500 font-bold text-sm mb-2">Giá: ${price} VNĐ</p>
                        <p class="text-gray-700 text-sm mb-2">Khối lượng: ${weight} kg</p>
                        <p class="text-gray-600 text-sm overflow-auto max-h-20">${description}</p>
                    </div>
                `;
            },
            allowHTML: true,
            interactive: true,
            theme: 'light',
            placement: 'right',
            maxWidth: 320,
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.autoplay').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            dots: false,
            arrows: false,
            fade: true,
        });
    });
</script>

</html>