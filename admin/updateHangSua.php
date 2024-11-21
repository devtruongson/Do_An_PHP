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
        $sql = "UPDATE Brand SET Title = ?, Address = ?, thumbnail = ?, PhoneNumber = ?, Email = ? WHERE Id = ?";
        $stmt = $conn->prepare($sql);

        // Lấy giá trị từ form
        $Title = $_POST["Title"];
        $Address = $_POST["Address"];
        $thumbnail = $_POST["thumbnail"];
        $PhoneNumber = $_POST["PhoneNumber"];
        $Email = $_POST["Email"];
        $Id = $_POST["Id"];

        // Liên kết các tham số và thực thi câu lệnh
        $stmt->bind_param("ssssss", $Title, $Address, $thumbnail, $PhoneNumber, $Email, $Id);

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
        <form method="POST" action="updateHangSua.php">
            <input type="hidden" name="Id" value="<?php echo $brand['Id']; ?>">

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Tên thương hiệu:</label>
                <input type="text" name="Title" value="<?php echo $brand['Title']; ?>"
                    class="w-full px-4 py-3 border rounded focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="thumbnail">
                    Tải Hình Ảnh Cho Sản Phẩm
                </label>
                <input type="text" hidden value="<?php echo $brand['thumbnail']; ?>" name="thumbnail" id="save_thumnail" required>
                <input id="thumbnail"
                    class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500"
                    type="file" accept="image/png, image/gif, image/jpeg" id="Email">
                <div id="bg-preview"
                    style="background-image: url('<?php echo $brand['thumbnail']; ?>');"
                    class="aspect-video max-w-[500px] m-h-[200px] rounded-lg mt-6 bg-no-repeat bg-cover">
                </div>
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