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
    <style>
        .block {
            display: block !important;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css">
</head>

<body class="bg-gray-100">
    <header class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-lg font-bold">
                <a href="index.php">Shop Sữa Trường Sơn</a>
            </div>
        </div>
    </header>
    <div class="container mx-auto p-5">
        <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            <a href="index.php">Quay Lại</a>
        </button>
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
                    <p class="text-2xl font-bold text-red-500 mb-4"><?php echo number_format($product['price'], 2); ?> VNĐ
                    </p>
                    <div class="flex items-center mb-4">
                        <p class="text-gray-600">Weight: <?php echo number_format($product['weight'], 2); ?> kg</p>
                        <?php if ($product['is_active']): ?>
                            <span class="ml-4 px-2 py-1 text-xs font-semibold text-white bg-green-500 rounded">Còn Hàng</span>
                        <?php else: ?>
                            <span class="ml-4 px-2 py-1 text-xs font-semibold text-white bg-red-500 rounded">Hết Hàng</span>
                        <?php endif; ?>
                    </div>
                    <div>
                        <button type="button" id="btn_add_to_cart"
                            data-id="<?php echo htmlspecialchars($product['id']); ?>"
                            data-title="<?php echo htmlspecialchars($product['title']); ?>"
                            data-price="<?php echo htmlspecialchars($product['price']); ?>"
                            data-thumbnail="<?php echo htmlspecialchars($product['thumbnail']); ?>"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Thêm
                            Sản Phẩm Vào Giỏ Hàng</button>
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

    <div id="cart_page" class="fixed top-0 left-0 right-0 bottom-0 w-[100vw] h-[100vh] bg-[rgba(0,0,0,0.6)] hidden"
        style="background: rgba(0,0,0,0.6);">
        <div id="overlay"
            class="absolute w-[100%] top-0 right-0 bottom-0 bg-[rgba(0,0,0,0)] h-[100%] py-10 px-12 z-[98]"></div>
        <div class="absolute w-[70%] top-0 right-0 bottom-0 bg-[#fff] h-[100%] py-10 px-12 z-[99]">
            <h2 class="text-[26px] font-bold text-[#ee4d2d]">Giỏ Hàng Của Bạn</h2>
            <div class="mt-6">
                <div class="text-sm text-gray-500 mb-4">
                    <a href="#" class="hover:text-gray-700">Trang Chủ</a> /
                    <a href="#" class="hover:text-gray-700">Giỏ Hàng</a>
                </div>

                <div class="flex flex-col lg:flex-row gap-6">
                    <!-- Product List -->
                    <div class="bg-white p-4 rounded-md shadow-md w-full lg:w-2/3">
                        <table class="table-auto w-full text-left">
                            <thead>
                                <tr class="border-b">
                                    <th class="py-2 text-gray-700">SẢN PHẨM</th>
                                    <th class="py-2 text-gray-700">GIÁ</th>
                                    <th class="py-2 text-gray-700">SỐ LƯỢNG</th>
                                    <th class="py-2 text-gray-700">TỔNG</th>
                                    <th class="py-2"></th>
                                </tr>
                            </thead>
                            <tbody id="render_cart_body"></tbody>
                        </table>
                    </div>

                    <!-- Summary -->
                    <div class="bg-white p-4 rounded-md shadow-md w-full lg:w-1/3">
                        <h2 class="text-lg font-semibold text-gray-700 border-b pb-2">TÓM TẮT ĐƠN HÀNG</h2>
                        <div class="mt-4 text-gray-700">
                            <div id="render_total">

                            </div>
                            <!-- checkout.php -->
                            <a href="#"
                                class="w-full block text-center mt-4 bg-green-500 text-white py-2 rounded hover:bg-green-600">THANH
                                TOÁN</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button id="cart_btn" class="fixed right-[40px] bottom-[50px] z-[9999]">
        <span class="absolute bg-[#ee4d2d] w-[20px] h-[20px] rounded-[50%] text-[#fff] font-[600]"
            id="count_cart"></span>
        <img class="w-[60px] h-[60px] object-cover" src="https://cdn-icons-png.flaticon.com/512/3225/3225209.png"
            alt="">
    </button>
    <script>
        let cartData = JSON.parse(localStorage.getItem("carts"));
        if (!cartData) {
            localStorage.setItem("carts", JSON.stringify([]))
            cartData = [];
        }

        const cart_btn = document.querySelector("#cart_btn");
        const cartPage = document.querySelector("#cart_page");
        const overlay = document.querySelector("#overlay");
        const btnAddtoCart = document.querySelector("#btn_add_to_cart");
        const CountCart = document.querySelector("#count_cart");
        const renderTotalCart = document.querySelector("#render_total");

        btnAddtoCart.addEventListener("click", e => {
            const product = {
                id: btnAddtoCart.dataset.id,
                title: btnAddtoCart.dataset.title,
                price: btnAddtoCart.dataset.price,
                thumbnail: btnAddtoCart.dataset.thumbnail,
                count: 1
            }

            const checkProductExit = JSON.parse(localStorage.getItem("carts")).find(p => p.id === product.id);
            if (checkProductExit) {
                checkProductExit.count += 1;
                const data = JSON.parse(localStorage.getItem("carts")).map(p => {
                    if (p.id === checkProductExit.id) {
                        return checkProductExit;
                    } else {
                        return p;
                    }
                })
                localStorage.setItem("carts", JSON.stringify(data))
            } else {
                const data = [...JSON.parse(localStorage.getItem("carts")), product]
                localStorage.setItem("carts", JSON.stringify(data))
            }
            handleCalcTotalCartCheckOut();
            CountCart.innerHTML = JSON.parse(localStorage.getItem("carts")).length;
        })
        CountCart.innerHTML = JSON.parse(localStorage.getItem("carts")).length;

        cart_btn.addEventListener("click", (e) => {
            cartPage.classList.toggle("block")
            handleRenderItemProduct();
        })

        overlay.addEventListener("click", (e) => {
            cartPage.classList.remove("block")
        })

        const cartRenderItem = document.querySelector("#render_cart_body");

        function handleRenderItemProduct() {
            if (!cartRenderItem) return;
            const html = JSON.parse(localStorage.getItem("carts")).map(product => {
                return `
                    <tr class="border-b">
                        <td class="py-3 flex items-center gap-3">
                            <img src="${product.thumbnail}" alt="Product"
                                class="w-14 h-14 object-cover rounded">
                            <div>
                                <p class="font-semibold text-gray-700">${product.title}</p>
                                <p class="text-sm text-gray-500">size: L giảm 10%</p>
                            </div>
                        </td>
                        <td class="py-3 text-gray-700">${product.price} VND</td>
                        <td class="py-3">
                            <div class="flex items-center">
                                <button class="px-2 py-1 bg-gray-200 hover:bg-gray-300 rounded" onClick='handleCountProductCart("Desc", ${product.id}, ${product.count})'>-</button>
                                <span class="px-4">${product.count}</span>
                                <button class="px-2 py-1 bg-gray-200 hover:bg-gray-300 rounded" onClick='handleCountProductCart("Ins", ${product.id}, ${product.count})'>+</button>
                            </div>
                        </td>
                        <td class="py-3 text-gray-700">${product.price} VND</td>
                        <td class="py-3 text-gray-500 cursor-pointer hover:text-red-500" onClick='handleDeleteProductCart(${product.id})'>✕</td>
                    </tr>
                `;
            }).join("");
            cartRenderItem.innerHTML = html;
        }
        document.addEventListener("DOMContentLoaded", () => {
            handleRenderItemProduct();
        })

        function handleCalcTotalCartCheckOut() {
            if (!renderTotalCart) return;
            const priceTotal = JSON.parse(localStorage.getItem("carts")).reduce((init, item) => {
                return init + item.price * item.count;
            }, 0);


            renderTotalCart.innerHTML = `
                <div class="flex justify-between py-2">
                    <span>Giá Trị Đơn Hàng</span>
                    <span>${priceTotal} VND</span>
                </div>
                <div class="flex justify-between py-2">
                    <span>Phí Vận Chuyển</span>
                    <span>0 VND</span>
                </div>
                <div class="flex justify-between py-2">
                    <span>Thuế</span>
                    <span>0 VND</span>
                </div>
                <div class="flex justify-between py-2 font-bold text-gray-900 border-t pt-2">
                    <span>Total</span>
                    <span>${priceTotal} VND</span>
                </div>
            `;
        }

        handleCalcTotalCartCheckOut();

        function handleDeleteProductCart(product_id) {
            const productExit = JSON.parse(localStorage.getItem("carts")).find(product => product.id == product_id);
            if (productExit) {
                const data = JSON.parse(localStorage.getItem("carts")).filter(p => p.id !== productExit.id)
                localStorage.setItem("carts", JSON.stringify(data))
                handleCalcTotalCartCheckOut();
                handleRenderItemProduct();
                CountCart.innerHTML = JSON.parse(localStorage.getItem("carts")).length;
            }
        }

        function handleCountProductCart(type, product_id, countCurrent) {
            if (countCurrent === 1 && type === "Desc") {
                Swal.fire({
                    title: "Lưu Ý",
                    text: "Sản Phẩm Trong Giỏ Hàng Phải Có Số Lượng Lớn Hơn 0!",
                    icon: "info",
                    showConfirmButton: true,
                    showCancelButton: true,
                })
                return;
            }

            switch (type) {
                case "Ins": {
                    const productExit = JSON.parse(localStorage.getItem("carts")).find(product => product.id == product_id);
                    if (productExit) {
                        productExit.count = countCurrent + 1;
                        const data = JSON.parse(localStorage.getItem("carts")).map(p => {
                            if (p.id === productExit.id) {
                                return productExit;
                            } else {
                                return p;
                            }
                        })
                        localStorage.setItem("carts", JSON.stringify(data))
                        handleCalcTotalCartCheckOut();
                    }
                    break;
                }
                case "Desc": {
                    const productExit = JSON.parse(localStorage.getItem("carts")).find(product => product.id == product_id);
                    if (productExit) {
                        productExit.count = countCurrent - 1;
                        const data = JSON.parse(localStorage.getItem("carts")).map(p => {
                            if (p.id === productExit.id) {
                                return productExit;
                            } else {
                                return p;
                            }
                        })
                        localStorage.setItem("carts", JSON.stringify(data))
                        handleCalcTotalCartCheckOut();
                    }
                    break;
                }
            }
            handleRenderItemProduct();
        }
    </script>
</body>

</html>