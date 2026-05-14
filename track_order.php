<?php
session_start();
require_once 'db_connect.php';

$order_info = null;
$order_items = []; // Mảng chứa chi tiết các bánh trong đơn
$error_msg = "";
$success_msg = "";

// 1. XỬ LÝ KHI KHÁCH HÀNG BẤM "TRA CỨU" (Hoặc khi chuyển từ Modal trang chủ sang)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_track'])) {
    $phone = $_POST['phone'];
    $order_id = str_replace('#CAKE-', '', $_POST['order_id']);
    $order_id = (int)$order_id;

    // Truy vấn thông tin chung
    $sql = "SELECT * FROM `Order` WHERE OrderID = ? AND CustomerPhone = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $order_id, $phone);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $order_info = $result->fetch_assoc();
        
        // Truy vấn thêm CHI TIẾT SẢN PHẨM trong đơn hàng đó
        $sql_items = "SELECT od.*, p.ProductName, p.Image 
                      FROM OrderDetail od 
                      JOIN Product p ON od.ProductID = p.ProductID 
                      WHERE od.OrderID = ?";
        $stmt_items = $conn->prepare($sql_items);
        $stmt_items->bind_param("i", $order_id);
        $stmt_items->execute();
        $res_items = $stmt_items->get_result();
        while($item = $res_items->fetch_assoc()){
            $order_items[] = $item;
        }

    } else {
        $error_msg = "Không tìm thấy đơn hàng! Vui lòng kiểm tra lại Mã đơn hoặc Số điện thoại.";
    }
}

// 2. XỬ LÝ KHI KHÁCH HÀNG BẤM "XÁC NHẬN HỦY ĐƠN"
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_cancel'])) {
    $cancel_id = (int)$_POST['cancel_id'];
    $cancel_phone = $_POST['cancel_phone'];

    $check_sql = "SELECT Status FROM `Order` WHERE OrderID = ? AND CustomerPhone = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("is", $cancel_id, $cancel_phone);
    $check_stmt->execute();
    $check_res = $check_stmt->get_result();

    if ($check_res->num_rows > 0) {
        $row = $check_res->fetch_assoc();
        if ($row['Status'] == 'Pending') { 
            $update_sql = "UPDATE `Order` SET Status = 'Cancelled' WHERE OrderID = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("i", $cancel_id);
            if ($update_stmt->execute()) {
                $success_msg = "Đã hủy đơn hàng #CAKE-$cancel_id thành công!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Tra Cứu Đơn Hàng - Cakery</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet"> 
    <style>
        body { 
            background-color: #f8f9fa; 
            font-family: 'Roboto', sans-serif; 
            /* Căn giữa toàn bộ màn hình */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .track-container { 
            width: 100%;
            max-width: 650px; 
            background: #fff; 
            padding: 40px; 
            border-radius: 15px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.08); 
        }
        .title-text {
            color: #5c3d3a;
            font-family: 'Playfair Display', serif;
        }
        .status-badge { padding: 8px 20px; border-radius: 50px; font-weight: 600; font-size: 14px;}
        .bg-pending { background-color: #fff3cd; color: #856404; }
        .bg-processing { background-color: #cce5ff; color: #004085; }
        .bg-completed { background-color: #d4edda; color: #155724; }
        .bg-cancelled { background-color: #f8d7da; color: #721c24; }
        
        .item-row { border-bottom: 1px dashed #eee; padding-bottom: 15px; margin-bottom: 15px; }
        .item-row:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
        .item-img { width: 60px; height: 60px; object-fit: cover; border-radius: 8px; }
    </style>
</head>
<body>

    <div class="container">
        <div class="track-container mx-auto">
            <h2 class="text-center fw-bold mb-4 title-text">Tra Cứu Đơn Hàng</h2>
            
            <?php if ($error_msg): ?>
                <div class="alert alert-danger"><i class="fa fa-exclamation-circle me-2"></i><?php echo $error_msg; ?></div>
            <?php endif; ?>
            <?php if ($success_msg): ?>
                <div class="alert alert-success"><i class="fa fa-check-circle me-2"></i><?php echo $success_msg; ?></div>
            <?php endif; ?>

            <!-- NẾU CHƯA CÓ THÔNG TIN ĐƠN HÀNG -> HIỆN FORM NHẬP -->
            <?php if (!$order_info && !$success_msg): ?>
                <form action="track_order.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-muted">Mã đơn hàng (VD: 12 hoặc #CAKE-12)</label>
                        <input type="text" name="order_id" class="form-control form-control-lg" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold text-muted">Số điện thoại đặt hàng</label>
                        <input type="tel" name="phone" class="form-control form-control-lg" required>
                    </div>
                    <button type="submit" name="btn_track" class="btn btn-lg w-100 fw-bold shadow-sm" style="background-color: #EAA636; color: white;">Tra Cứu Ngay</button>
                </form>
            <?php endif; ?>

            <!-- NẾU ĐÃ CÓ THÔNG TIN ĐƠN HÀNG -> ẨN FORM NHẬP, HIỆN CHI TIẾT -->
            <?php if ($order_info && !$success_msg): ?>
                <div class="order-details">
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                        <h5 class="fw-bold mb-0">Mã đơn: <span style="color: #EAA636;">#CAKE-<?php echo $order_info['OrderID']; ?></span></h5>
                        <?php 
                            $st = $order_info['Status'];
                            $txt = 'Chờ xử lý'; $cl = 'bg-pending';
                            if ($st == 'Completed') { $txt = 'Giao thành công'; $cl = 'bg-completed'; }
                            elseif ($st == 'Cancelled') { $txt = 'Đã hủy'; $cl = 'bg-cancelled'; }
                            elseif ($st == 'Processing') { $txt = 'Đang làm bánh'; $cl = 'bg-processing'; }
                        ?>
                        <span class="status-badge <?php echo $cl; ?>"><?php echo $txt; ?></span>
                    </div>

                    <!-- Danh sách món ăn -->
                    <div class="bg-light p-3 rounded mb-4">
                        <p class="fw-bold text-muted mb-3 fs-6">Sản phẩm đã đặt:</p>
                        <?php foreach($order_items as $item): ?>
                            <div class="d-flex align-items-center item-row">
                                <img src="<?php echo $item['Image']; ?>" class="item-img me-3" onerror="this.style.display='none'">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 fw-bold"><?php echo htmlspecialchars($item['ProductName']); ?></h6>
                                    <small class="text-muted">x<?php echo $item['Quantity']; ?></small>
                                </div>
                                <div class="fw-bold text-danger">
                                    <?php echo number_format($item['PriceAtOrder'] * $item['Quantity'], 0, ',', '.'); ?>đ
                                </div>
                            </div>
                        <?php endforeach; ?>
                        
                        <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                            <span class="fw-bold text-uppercase">Tổng thanh toán:</span>
                            <span class="fs-5 fw-bold text-danger"><?php echo number_format($order_info['TotalAmount'], 0, ',', '.'); ?>đ</span>
                        </div>
                    </div>

                    <!-- THÔNG TIN KHÁCH HÀNG -->
                    <div class="mb-4 text-muted small">
                        <p class="mb-1"><i class="fa fa-user me-2"></i>Người nhận: <strong><?php echo htmlspecialchars($order_info['CustomerName']); ?></strong></p>
                        <p class="mb-1"><i class="fa fa-map-marker-alt me-2"></i>Địa chỉ: <?php echo htmlspecialchars($order_info['Address']); ?></p>
                        <p class="mb-0"><i class="fa fa-clock me-2"></i>Ngày đặt: <?php echo date('d/m/Y H:i', strtotime($order_info['OrderDate'])); ?></p>
                    </div>

                    <!-- NÚT HỦY CHỈ HIỆN KHI PENDING -->
                    <?php if ($st == 'Pending'): ?>
                        <div class="p-3 bg-white border border-warning rounded text-center">
                            <p class="small text-muted mb-2">Đơn hàng chưa được làm. Bạn có thể hủy nếu đổi ý.</p>
                            <form action="track_order.php" method="POST">
                                <input type="hidden" name="cancel_id" value="<?php echo $order_info['OrderID']; ?>">
                                <input type="hidden" name="cancel_phone" value="<?php echo $order_info['CustomerPhone']; ?>">
                                <button type="submit" name="btn_cancel" class="btn btn-outline-danger w-100 fw-bold" onclick="return confirm('Bạn chắc chắn muốn hủy đơn hàng này?')">
                                    <i class="fa fa-times me-2"></i> Xác nhận hủy đơn
                                </button>
                            </form>
                        </div>
                    <?php elseif ($st == 'Processing'): ?>
                        <div class="alert alert-info text-center mb-0">
                            <small><i class="fa fa-info-circle me-1"></i> Bếp đang làm bánh, không thể tự hủy lúc này.</small>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <div class="text-center mt-4">
                <a href="index.php" class="text-decoration-none text-muted fw-bold"><i class="fa fa-arrow-left me-1"></i> Quay lại trang chủ</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>