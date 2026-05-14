<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// SỬA Ở ĐÂY: Đổi 'admin_logged_in' thành 'user_admin' cho khớp với process_login.php
if (!isset($_SESSION['user_admin'])) {
    // Đẩy ngay về trang chủ index.php
    header("Location: ../index.php");
    exit();
}
?>