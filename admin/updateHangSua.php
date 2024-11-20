<?php
include '../connect.php';
include "./auth/checkAuth.php";

if (!empty($_POST)) {
    try {
        $sql = "UPDATE Brand SET Title = ?, Address = ?, PhoneNumber = ?, Email = ? WHERE Id = ?";
        $stmt = $conn->prepare($sql);

        $Title = $_POST["Title"];
        $Address = $_POST["Address"];
        $PhoneNumber = $_POST["PhoneNumber"];
        $Email = $_POST["Email"];
        $Id = $_POST["Id"];

        $stmt->bind_param("sssss", $Title, $Address, $PhoneNumber, $Email, $Id);

        if ($stmt->execute()) {
            ?>
            <script>
                window.location.href = `dashboard.php?route=listHangSua.php&code=0`; 
            </script>
            <?php
        } else {
            echo "Error: " . $stmt->error;
        }

    } catch (Throwable $th) {
        var_dump($th);

    }
}
?>