<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['username'])) {
    ?>
    <script>
        window.location.href = `index.php?code=403`;
    </script>
    <?php
}
?>