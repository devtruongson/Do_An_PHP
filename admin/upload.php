<?php
$target_dir = "./uploads/";

// Lấy phần mở rộng của file
$fileExtension = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));

// Tạo tên file mới sử dụng uniqid với tiền tố "file_" và thêm phần mở rộng
$newFileName = uniqid("file_", true) . '.' . $fileExtension;

// Đường dẫn đầy đủ đến file đích
$target_file = $target_dir . $newFileName;

$uploadOk = 1;

// Kiểm tra kích thước file (tùy chọn)
if ($_FILES["fileToUpload"]["size"] > 5000000) {  // 5 MB
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Kiểm tra $uploadOk có giá trị 0 bởi lỗi nào đó không
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // Nếu mọi thứ đều ổn, thực hiện tải lên file
} else {
    // Ensure the target directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo $newFileName;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>