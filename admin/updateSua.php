<?php
include './auth/checkAuth.php';
include '../connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM Sua WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
}

if (!empty($_POST)) {
    try {
        $sql = "UPDATE Sua SET title = ?, thumbnail = ?, weight = ?, price = ?, content = ?, is_active = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);

        $title = $_POST["title"];
        $thumbnail = $_POST["thumbnail"];
        $weight = $_POST["weight"];
        $content = $_POST["content"];
        $is_active = $_POST["is_active"] != "Ẩn";
        $id = $_POST["id"];
        $price = $_POST["price"];

        $stmt->bind_param("ssssssi", $title, $thumbnail, $weight, $price, $content, $is_active, $id);

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
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Hình ảnh:</label>
                <input type="text" name="thumbnail" value="<?php echo $product['thumbnail']; ?>"
                    class="w-full px-4 py-3 border rounded focus:outline-none focus:border-blue-500">
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
            <div class="flex justify-end gap-4">
                <button type="submit"
                    class="bg-blue-500 text-white px-6 py-3 rounded shadow hover:bg-blue-600 transition duration-300">
                    Cập nhật
                </button>
            </div>
        </form>
    </div>
</body>

</html>