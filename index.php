<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MilkMart</title>
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
    <marquee behavior="" direction="">
        Với Sự Tham Gia Của Các Thành Viên Nguyễn Trường Sơn - Nguyễn Tuấn Tiến - Lê Thị Hoa
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
                <div class="text-2xl font-extrabold text-white bg-gradient-to-r from-blue-300 via-blue-400 to-blue-500 p-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:scale-105">
                    <a href="index.php" class="hover:underline">Milk Mart</a>
                </div>
                <div class="flex space-x-4">
                    <button class="bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 text-white text-sm font-semibold px-4 py-2 rounded-md shadow-md hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                        <a href="admin/index.php" class="hover:underline">Đăng nhập</a>
                    </button>
                </div>
            </div>
        </div>
    </header>
    <main class="flex flex-row gap-4 container w-full">
        <aside class="w-1/4 p-4 bg-white rounded-lg shadow-md sticky top-4 ml-0"
            style="background-image: url('./admin/uploads/Head/Aside2.png'); 
              background-size: cover; 
              background-position: center; 
              background-repeat: no-repeat;">
            <h3 class="text-2xl font-bold text-black mb-4">Danh mục sản phẩm</h3>
            <ul class="space-y-2">
                <?php
                include './connect.php';
                $typeQuery = "SELECT DISTINCT type FROM sua WHERE is_active = 1";
                $typeResult = mysqli_query($conn, $typeQuery);

                if ($typeResult->num_rows > 0) {
                    while ($typeRow = $typeResult->fetch_assoc()) {
                        $type = htmlspecialchars($typeRow['type']);
                        echo "
                <li>
                    <a href='#" . strtolower(str_replace(' ', '-', $type)) . "' 
                       class='block text-xl font-bold text-blue-600 hover:text-blue-800'>
                       $type
                    </a>
                </li>";
                    }
                } else {
                    echo "<p class='text-gray-500'>Không có loại sản phẩm nào.</p>";
                }
                ?>
            </ul>
        </aside>
        <div class="w-3/4 p-4">
            <section class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">Đối tác của chúng tôi</h2>
                <div class="grid grid-cols-4 gap-4">
                    <?php

                    $brandQuery = "SELECT Title, thumbnail FROM brand";
                    $brandResult = mysqli_query($conn, $brandQuery);

                    if ($brandResult->num_rows > 0) {
                        while ($brand = $brandResult->fetch_assoc()) {
                            $title = htmlspecialchars($brand["Title"]);
                            $thumbnail = htmlspecialchars($brand["thumbnail"]);
                            echo "
                <div class='bg-white p-4 rounded-lg shadow-md hover:shadow-lg text-center'>
                    <img src='$thumbnail' alt='$title' class='w-full h-32 object-cover mb-4 rounded-lg'>
                    <h3 class='font-semibold'>$title</h3>
                </div>";
                        }
                    } else {
                        echo "<p class='col-span-4 text-center text-gray-500'>Không có thương hiệu nào.</p>";
                    }
                    ?>
                </div>
            </section>
            <section>
                <h2 class="text-2xl font-semibold mb-4">Sản phẩm theo loại</h2>
                <?php

                $typeResult = mysqli_query($conn, $typeQuery);

                if ($typeResult->num_rows > 0) {
                    while ($typeRow = $typeResult->fetch_assoc()) {
                        $type = $typeRow['type'];
                ?>
                        <div id="<?php echo strtolower(str_replace(' ', '-', $type)); ?>" class="mb-6">
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
                                                <p class="text-gray-600"><?php echo htmlspecialchars($row["weight"]); ?> g</p>
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
        </div>
    </main>
    <footer class="bg-blue-800 text-white py-8">
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
            <div>
                <h3 class="text-lg font-semibold mb-4">Đối tác của chúng tôi</h3>
                <ul class="space-y-2">
                    <?php
                    $brandQuery = "SELECT Title FROM brand";
                    $brandResult = mysqli_query($conn, $brandQuery);

                    if ($brandResult->num_rows > 0) {
                        while ($brand = $brandResult->fetch_assoc()) {
                            $title = htmlspecialchars($brand["Title"]);
                            echo "
                <li>
                    <a href='#' class='block text-500 hover:text-blue-700 transition font-medium'>
                        $title
                    </a>
                </li>";
                        }
                    } else {
                        echo "<p>Không có đối tác nào.</p>";
                    }
                    ?>
                </ul>
            </div>
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