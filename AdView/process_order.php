<?php
// Gọi file check_login để đảm bảo chỉ Admin mới được chạy lệnh này
require_once '../check_login.php'; 
require_once '../db_connect.php';

// Kiểm tra xem có nhận được ID đơn hàng và TRẠNG THÁI từ URL không
if (isset($_GET['status']) && isset($_GET['id'])) {
    $order_id = (int)$_GET['id'];
    $status = $_GET['status']; // Lấy giá trị 'Completed', 'Processing', hoặc 'Cancelled'
    
    // Lấy ID của Admin đang trực
    $admin_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : 'NULL';

    // BẢO MẬT: Chỉ cho phép các trạng thái này, tránh hacker tự gõ URL bậy bạ
    $allowed_statuses = ['Pending', 'Processing', 'Completed', 'Cancelled'];

    if (in_array($status, $allowed_statuses)) {
        // CẬP NHẬT: Đổi trạng thái và ghi nhận AdminID
        $sql = "UPDATE `Order` SET Status = '$status', AdminID = $admin_id WHERE OrderID = $order_id";
        
        if ($conn->query($sql)) {
            // XỬ LÝ NẾU LÀ AJAX GỌI: Trả về chữ success cho Javascript đọc
            if (isset($_GET['ajax']) && $_GET['ajax'] == 1) {
                echo "success";
                exit();
            }
            
            // DỰ PHÒNG: Nếu truy cập không qua AJAX thì mới chuyển trang
            header("Location: admin_orders.php?msg=success");
            exit();
        } else {
            echo "Lỗi khi cập nhật Database: " . $conn->error;
        }
    } else {
        echo "<script>alert('Trạng thái không hợp lệ!'); window.location.href='admin_orders.php';</script>";
    }
} else {
    // Nếu ai đó cố tình truy cập file này mà không có ID, đẩy về trang danh sách
    header("Location: admin_orders.php");
    exit();
}
?>