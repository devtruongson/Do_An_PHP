<?php
include './auth/checkAuth.php';
include '../connect.php';
$sqlTypes = "SELECT DISTINCT type FROM Sua";
$resultTypes = $conn->query($sqlTypes);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM Sua WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
}

if (!empty($_POST)) {
    try {
        $sql = "UPDATE Sua SET title = ?, thumbnail = ?, weight = ?, price = ?, content = ?, is_active = ?, type = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);

        $title = $_POST["title"];
        $thumbnail = $_POST["thumbnail"];
        $weight = $_POST["weight"];
        $content = $_POST["content"];
        $is_active = $_POST["is_active"] != "Ẩn";
        $id = $_POST["id"];
        $price = $_POST["price"];
        $type = $_POST["type"];

        $stmt->bind_param("sssssssi", $title, $thumbnail, $weight, $price, $content, $is_active, $type, $id);

        if ($stmt->execute()) {
            header("Location: dashboard.php?route=listProduct.php&code=0");
        } else {
            echo "Error: " . $stmt->error;
        }
    } catch (Throwable $th) {
        var_dump($th);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa sản phẩm</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 py-12">
    <div class="container mx-auto mt-8 max-w-6xl rounded-lg">
        <h2 class="text-3xl font-bold text-center mb-8">Chỉnh sửa sản phẩm</h2>
        <form method="POST" action="updateSua.php">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Tên sản phẩm:</label>
                <input type="text" name="title" value="<?php echo $product['title']; ?>"
                    class="w-full px-4 py-3 border rounded focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-3 ">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                    Loại Sản Phẩm
                </label>
                <select
                    class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500"
                    id="type" name="type" required>
                    <option value="" disabled <?php echo empty($product['type']) ? 'selected' : ''; ?>>--- Chọn Loại Sản
                        Phẩm ---</option>
                    <?php
                    if ($resultTypes && $resultTypes->num_rows > 0) {
                        while ($row = $resultTypes->fetch_assoc()) {
                            $selected = ($product['type'] == $row['type']) ? 'selected' : '';
                            echo "<option value='{$row['type']}' $selected>{$row['type']}</option>";
                        }
                    } else {
                        echo "<option value=''>Không có dữ liệu</option>";
                    }
                    ?>
                </select>

            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="thumbnail">
                    Tải Hình Ảnh Cho Sản Phẩm
                </label>
                <input type="text" hidden value="<?php echo $product['thumbnail']; ?>" name="thumbnail"
                    id="save_thumnail" required>
                <input id="thumbnail"
                    class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500"
                    type="file" accept="image/png, image/gif, image/jpeg" id="Email">
                <div id="bg-preview" style="background-image: url('<?php echo $product['thumbnail']; ?>');"
                    class="aspect-video max-w-[500px] m-h-[200px] rounded-lg mt-6 bg-no-repeat bg-cover">
                </div>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Trọng lượng:</label>
                <input type="text" name="weight" value="<?php echo $product['weight']; ?>"
                    class="w-full px-4 py-3 border rounded focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Giá:</label>
                <input type="text" name="price" value="<?php echo $product['price']; ?>"
                    class="w-full px-4 py-3 border rounded focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Mô tả:</label>
                <textarea name="content"
                    class="w-full px-4 py-3 border rounded focus:outline-none focus:border-blue-500 min-h-[200px]"><?php echo $product['content']; ?></textarea>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Trạng thái:</label>
                <select name="is_active"
                    class="w-full px-4 py-3 border rounded focus:outline-none focus:border-blue-500">
                    <option value="Hiển Thị" <?php echo $product['is_active'] ? 'selected' : ''; ?>>Hiển Thị</option>
                    <option value="Ẩn" <?php echo !$product['is_active'] ? 'selected' : ''; ?>>Ẩn</option>
                </select>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="brand">
                    Hãng sữa
                </label>
                <select
                    class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500"
                    id="brand" name="brand" required>
                    <option value="" disabled <?php echo empty($product['brand']) ? 'selected' : ''; ?>>--- Chọn Hãng
                        Sữa ---</option>
                    <?php
                    $sqlBrand = "SELECT Id, Title FROM brand";
                    $resultBrand = $conn->query($sqlBrand);

                    if ($resultBrand && $resultBrand->num_rows > 0) {
                        while ($row = $resultBrand->fetch_assoc()) {
                            $selected = ($product['brand'] == $row['Id']) ? 'selected' : '';
                            echo "<option value='{$row['Id']}' $selected>{$row['Title']}</option>";
                        }
                    } else {
                        echo "<option value=''>Không có dữ liệu</option>";
                    }
                    ?>
                </select>

            </div>
            <div class="flex justify-end gap-4 pb-10">
                <button type="submit"
                    class="bg-blue-500 text-white px-6 py-3 rounded shadow hover:bg-blue-600 transition duration-300">
                    Cập nhật
                </button>
            </div>
        </form>
    </div>
</body>
<script>
    const inputFileThumbnail = document.querySelector("#thumbnail");
    const divPreviewThumbnail = document.querySelector("#bg-preview");
    const inputSendDataThumbnail = document.querySelector("#save_thumnail");

    if (inputFileThumbnail && divPreviewThumbnail) {
        inputFileThumbnail.addEventListener("change", async (e) => {
            const file = e.target.files[0];
            if (file) {
                const formData = new FormData();
                formData.append('fileToUpload', file);
                try {
                    const res = await fetch("upload.php", {
                        body: formData,
                        method: "post",
                    }).then(res => res.text());
                    inputSendDataThumbnail.setAttribute('value', `${window.location.href.split("/admin/")[0]}/admin/uploads/${res}`);
                    divPreviewThumbnail.style.display = "block";
                    divPreviewThumbnail.style.backgroundImage = `url(${window.location.href.split("/admin/")[0]}/admin/uploads/${res})`;
                } catch (error) {
                    console.log(error);
                }
            }
        });
    }
</script>

</html>