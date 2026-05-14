<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // SỬA TẠI ĐÂY: Bỏ điều kiện "AND Role = 1" vì bảng Account giờ chỉ toàn Admin
    $sql = "SELECT * FROM Account WHERE Username = ? AND Password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Lưu thông tin vào Session để các trang sau nhận diện được Admin
        $_SESSION['admin_id'] = $row['AccountID']; // Dùng cho file process_order.php
        $_SESSION['user_admin'] = $row['FullName']; // Dùng hiển thị tên trên giao diện
        $_SESSION['username'] = $row['Username'];

        header("Location: AdView/admin.php"); // Chuyển hướng vào trang Dashboard
        exit();
    } else {
        // Cập nhật: Hướng người dùng về trang index.php thay vì login.php khi đăng nhập thất bại
        echo "<script>
                alert('Sai tài khoản hoặc mật khẩu!');
                window.location.href = 'index.php';
              </script>";
    }
}
?>