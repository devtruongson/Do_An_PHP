<?php
session_start();
if (empty($_SESSION['username'])) {
    ?>
    <script>
        window.location.href = `index.php?code=403`; 
    </script>
    <?php
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Hãng Sữa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css">
</head>

<body class="bg-gray-100 py-12 flex justify-center items-center px-4 flex-col">
    <div class='h-[100vh]'>
        <div class="w-full bg-white p-8 rounded-lg shadow-lg h-full">
            <h2 class="text-2xl font-bold text-center mb-6">Thêm Mới Hãng Sữa - Cửa Hàng Sữa Đức Thành</h2>
            <form method="POST" action="">
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            Nhập Mã Hãng Sữa
                        </label>
                        <input required
                            class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500"
                            type="text" id="Id" name="Id" placeholder="Nhập mã Hãng Sữa... ">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            Tên Hãng Sữa
                        </label>
                        <input required
                            class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500"
                            type="text" id="title" name="Title" placeholder="Nhập tên Hãng Sữa... ">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="thumbnail">
                            Nhập Số Điện Thoại
                        </label>
                        <input required
                            class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500"
                            type="text" id="PhoneNumber" name="PhoneNumber" placeholder="Nhập Số Điện Thoại... ">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="thumbnail">
                            Nhập Email Hãng Sữa
                        </label>
                        <input required
                            class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500"
                            type="email" id="Email" name="Email" placeholder="Nhập Email ... ">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="thumbnail">
                            Chọn Thumbnail Hãng Sữa
                        </label>
                        <input type="text" hidden name="thumbnail" id="save_thumnail" required>
                        <input required id="thumbnail"
                            class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500"
                            type="file" accept="image/png, image/gif, image/jpeg" id="Email">
                        <div id="bg-preview"
                            class="aspect-video max-w-[500px] hidden m-h-[200px] rounded-lg mt-6 bg-no-repeat bg-cover">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="content">
                            Nhập Địa Chỉ Hãng Sữa
                        </label>
                        <textarea required minlength="4"
                            class="w-full px-3 min-h-[100px] py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500"
                            type="text" id="Address" name="Address" placeholder="Nhập Thông Tin Địa Chỉ... "></textarea>
                    </div>
                </div>
                <div class="mb-6">
                    <div class="flex items-center gap-6 justify-center max-w-[30%] ml-auto">
                        <button
                            class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition duration-300"
                            type="submit">
                            Thêm
                        </button>
                        <button
                            class="w-full bg-yellow-700 text-white py-2 rounded-md hover:bg-blue-600 transition duration-300"
                            type="reset">
                            Clear
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
    include '../connect.php';
    if (!empty($_POST)) {
        try {

            $sql = "INSERT INTO Brand(Id, Title, Address, PhoneNumber, Email, thumbnail) VALUES(?,?,?,?,?,?);";
            $stmt = $conn->prepare($sql);

            $Id = $_POST["Id"];
            $Title = $_POST["Title"];
            $Address = $_POST["Address"];
            $PhoneNumber = $_POST["PhoneNumber"];
            $Email = $_POST["Email"];
            $thumbnail = $_POST["thumbnail"];

            $stmt->bind_param("ssssss", $Id, $Title, $Address, $PhoneNumber, $Email, $thumbnail);

            if ($stmt->execute()) {
                ?>
                <script>
                    Swal.fire({
                        title: "Chúc Mừng",
                        text: "Bạn đã thêm thành công Hãng Sữa!",
                        icon: "success",
                        showConfirmButton: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = window.location.href;
                        }
                    });
                </script>
                <?php
            } else {
                echo "Error: " . $stmt->error;
            }
        } catch (\Throwable $th) {
            ?>
            <script>
                Swal.fire({
                    title: "Có Lỗi",
                    text: "Xin lỗi bạn đã thêm Hãng Sữa bị trùng mã",
                    icon: "info",
                    showConfirmButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = window.location.href;
                    }
                });
            </script>
            <?php
        }
    }
    ?>

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
                        inputSendDataThumbnail.setAttribute('value', res);
                        divPreviewThumbnail.style.display = "block";
                        divPreviewThumbnail.style.backgroundImage = `url(http://${window.location.hostname}/WeekSix/admin/uploads/${res})`;
                    } catch (error) {
                        console.log(error);
                    }
                }
            });
        }
    </script>
</body>

</html>