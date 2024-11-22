<?php
function paginate($itemsPerPage, $currentPage, $table)
{
    global $conn;
    $totalItemsQuery = "SELECT COUNT(*) FROM $table";
    $result = $conn->query($totalItemsQuery);
    $totalItems = $result->fetch_row()[0];
    $totalPages = ceil($totalItems / $itemsPerPage);

    // Tính vị trí bắt đầu cho truy vấn SQL
    $startPosition = ($currentPage - 1) * $itemsPerPage;

    // Truy vấn SQL lấy dữ liệu với LIMIT và OFFSET

    $sql = "SELECT s.*, s.thumbnail, b.Title FROM Sua s LEFT JOIN brand b ON s.brand = b.Id LIMIT $itemsPerPage OFFSET $startPosition; ";
    $result = $conn->query($sql);

    // Kiểm tra và hiển thị kết quả
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr class="row_data_customer">
                <td class="py-2 px-4 border text-center">
                    <?php echo $row["id"] ?>
                </td>
                <td focus="true" class="py-2 px-4 border text-center">
                    <?php echo $row["title"] ?>
                </td>
                <td focus="true" class="py-2 px-4 border text-center">
                    <?php echo $row["type"] ?>
                </td>
                <td class="px-4 py-2 border text-center ">
                    <p class="max-h-[200px] overflow-auto max-w-[400px] whitespace-pre">
                        <?php echo $row["content"] ?>
                    </p>
                </td>
                <td class="py-2 px-4 border text-center">
                    <a href="<?php echo $row["thumbnail"] ?>" target="_blank" rel="noopener noreferrer">Xem Hình
                        Ảnh</a>
                </td>
                <td class="py-2 px-4 border text-center">
                    <?php echo $row["weight"] ?>g
                </td>
                <td class="py-2 px-4 border text-center">
                    <?php echo $row["price"] ?>VND
                </td>
                <td class="py-2 px-4 border text-center">
                    <?php echo $row["is_active"] == 0 ? "Ẩn" : "Hiển Thị" ?>
                </td>
                <td class="py-2 px-4 border text-center">
                    <?php echo $row["Title"] ?>
                </td>
                <td class="py-2 px-4 border text-center">
                    <div class="flex gap-2 items-center">
                        <a href="dashboard.php?route=updateSua.php&id=<?php echo $row['id']; ?>"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zM16.862 4.487L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </a>

                        <form action="deleteSua.php" method="POST" class="form-delete-submit" data-id="<?php echo $row["id"] ?>">
                            <input type="hidden" value="<?php echo $row["id"] ?>" name="id" data-name="id">
                            <button type="button" onclick="ConfirmDelete('<?php echo $row["id"] ?>')" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4
                                            focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5
                                            dark:focus:ring-yellow-900">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php
        }
    } else {
        echo "<p class='text-gray-500'>Không có sản phẩm nào.</p>";
    }
}

function paginateBtnNavigate($itemsPerPage, $currentPage, $table)
{
    global $conn;
    $totalItemsQuery = "SELECT COUNT(*) FROM $table";
    $result = $conn->query($totalItemsQuery);
    $totalItems = $result->fetch_row()[0];
    $totalPages = ceil($totalItems / $itemsPerPage);

    // Tính vị trí bắt đầu cho truy vấn SQL
    $startPosition = ($currentPage - 1) * $itemsPerPage;

    // Truy vấn SQL lấy dữ liệu với LIMIT và OFFSET
    $sql = "SELECT * FROM $table LIMIT $itemsPerPage OFFSET $startPosition";
    $result = $conn->query($sql);


    echo "<div class='flex justify-center mt-6'>";
    echo "<ul class='flex space-x-2'>";

    // Quay về (nếu không phải trang đầu tiên)
    if ($currentPage > 1) {
        echo "<li><a href='dashboard.php?route=listProduct.php&page=" . ($currentPage - 1) . "' class='px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600'>Quay về</a></li>";
    } else {
        echo "<li><span class='px-4 py-2 bg-gray-300 text-gray-500 rounded-md'>Quay về</span></li>";
    }

    // Hiển thị các số trang
    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $currentPage) {
            echo "<li><span class='px-4 py-2 bg-blue-500 text-white rounded-md'>$i</span></li>";
        } else {
            echo "<li><a href='dashboard.php?route=listProduct.php&page=$i' class='px-4 py-2 bg-white text-blue-500 rounded-md hover:bg-gray-100'>$i</a></li>";
        }
    }

    // Tiếp tục (nếu không phải trang cuối cùng)
    if ($currentPage < $totalPages) {
        echo "<li><a href='dashboard.php?route=listProduct.php&page=" . ($currentPage + 1) . "' class='px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600'>Tiếp tục</a></li>";
    } else {
        echo "<li><span class='px-4 py-2 bg-gray-300 text-gray-500 rounded-md'>Tiếp tục</span></li>";
    }

    echo "</ul>";
    echo "</div>";
}
?>