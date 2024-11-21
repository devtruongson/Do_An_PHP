<?php
include '../connect.php';
include "./auth/checkAuth.php";

// Kiểm tra nếu có tham số 'Id' từ GET
if (isset($_GET['Id'])) {
    $Id = $_GET['Id'];
    // Lấy dữ liệu từ bảng Brand dựa trên Id
    $query = "SELECT * FROM Brand WHERE Id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $Id);
    $stmt->execute();
    $result = $stmt->get_result();
    $brand = $result->fetch_assoc();
}

if (!empty($_POST)) {
    try {
        $sql = "UPDATE Brand SET Title = ?, Address = ?, PhoneNumber = ?, Email = ? WHERE Id = ?";
        $stmt = $conn->prepare($sql);

        // Lấy giá trị từ form
        $Title = $_POST["Title"];
        $Address = $_POST["Address"];
        $PhoneNumber = $_POST["PhoneNumber"];
        $Email = $_POST["Email"];
        $Id = $_POST["Id"];

        // Liên kết các tham số và thực thi câu lệnh
        $stmt->bind_param("sssss", $Title, $Address, $PhoneNumber, $Email, $Id);

        if ($stmt->execute()) {
            header("Location: dashboard.php?route=listHangSua.php&code=0");
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
    <title>Chỉnh sửa thương hiệu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 py-12">
    <div class="container mx-auto mt-8 max-w-6xl rounded-lg">
        <h2 class="text-3xl font-bold text-center mb-8">Chỉnh sửa thương hiệu</h2>
        <form method="POST" action="updateSua.php">
            <input type="hidden" name="Id" value="<?php echo $brand['Id']; ?>">

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Tên thương hiệu:</label>
                <input type="text" name="Title" value="<?php echo $brand['Title']; ?>"
                    class="w-full px-4 py-3 border rounded focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Địa chỉ:</label>
                <input type="text" name="Address" value="<?php echo $brand['Address']; ?>"
                    class="w-full px-4 py-3 border rounded focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Số điện thoại:</label>
                <input type="text" name="PhoneNumber" value="<?php echo $brand['PhoneNumber']; ?>"
                    class="w-full px-4 py-3 border rounded focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="email" name="Email" value="<?php echo $brand['Email']; ?>"
                    class="w-full px-4 py-3 border rounded focus:outline-none focus:border-blue-500">
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