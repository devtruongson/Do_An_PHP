<?php
include '../connect.php';
include "./auth/checkAuth.php";

if (!empty($_POST)) {
    try {
        $id = $_POST["Id"];
        $stmt = $conn->prepare("DELETE FROM Brand WHERE Id = ?");
        $stmt->bind_param("s", $id);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                ?>
                <script>
                    window.location.href = `dashboard.php?route=listHangSua.php&code=0`; 
                </script>
                <?php
            }
        }

        $stmt->close();
    } catch (Throwable $th) {
        ?>
        <script>
            window.location.href = `dashboard.php?route=listHangSua.php&code=1`; 
        </script>
        <?php
    }
} else {
    ?>
    <script>
        window.location.href = `index.php?code=1`; 
    </script>
    <?php
}
?>