<?php 
    // TRUY VẤN
    require_once '../check_login.php'; 
    require_once '../db_connect.php'; 
    
    // Lấy ID đơn hàng từ URL
    $order_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    
    // --- XỬ LÝ LƯU THÔNG TIN KHI CÓ POST REQUEST ---
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_update_info'])) {
        $new_name = $_POST['edit_name'];
        $new_phone = $_POST['edit_phone'];
        $new_address = $_POST['edit_address'];
        $new_note = $_POST['edit_note'];

        // Cập nhật Database
        $update_sql = "UPDATE `Order` SET 
                        CustomerName = ?, 
                        CustomerPhone = ?, 
                        Address = ?, 
                        Note = ? 
                       WHERE OrderID = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("ssssi", $new_name, $new_phone, $new_address, $new_note, $order_id);
        
        if ($stmt->execute()) {
            $msg_success = "Đã cập nhật thông tin giao hàng thành công!";
        } else {
            $msg_error = "Lỗi cập nhật: " . $conn->error;
        }
        $stmt->close();
    }
    // ------------------------------------------------

    // 1. Lấy thông tin tổng quan của đơn hàng (Bảng Order)
    $sql_order = "SELECT * FROM `Order` WHERE OrderID = $order_id";
    $result_order = $conn->query($sql_order);
    
    if($result_order->num_rows == 0) {
        die("<div class='container mt-5 alert alert-danger'>Lỗi: Không tìm thấy đơn hàng này trong hệ thống!</div>");
    }
    $order = $result_order->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Chi tiết đơn hàng #CAKE-<?php echo $order_id; ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <link href="../img/favicon.svg" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #5c3d3a;
            --secondary-color: #EAA636;
            --sidebar-width: 250px;
        }

        body { background-color: #f8f9fa; font-family: 'Roboto', sans-serif; margin: 0; overflow-x: hidden; }

        #sidebar {
            width: var(--sidebar-width); height: 100vh; position: fixed; top: 0; left: 0;
            background: var(--primary-color); z-index: 1000; box-shadow: 4px 0 10px rgba(0,0,0,0.1); color: #fff;
        }

        #sidebar .sidebar-header { padding: 30px 25px; background: rgba(0, 0, 0, 0.1); text-align: left; }
        #sidebar .sidebar-header h3 { color: var(--secondary-color); font-family: 'Playfair Display', serif; font-weight: 700; font-size: 26px; margin-bottom: 2px; }
        #sidebar .sidebar-header small { color: rgba(255, 255, 255, 0.6); font-size: 14px; }
        #sidebar ul.components { padding: 20px 0; list-style: none; }
        #sidebar ul li a { padding: 18px 25px; display: block; color: rgba(255, 255, 255, 0.8); text-decoration: none; font-size: 16px; transition: 0.3s; border-left: 5px solid transparent; }
        #sidebar ul li a i { margin-right: 15px; width: 20px; text-align: center; }
        #sidebar ul li.active > a { color: #fff; background: rgba(255, 255, 255, 0.1); border-left: 5px solid var(--secondary-color); font-weight: 500; }
        #sidebar ul li a:hover { background: rgba(255, 255, 255, 0.05); color: #fff; }
        #sidebar .logout-link { color: var(--secondary-color) !important; font-weight: 600; margin-top: 40px; }

        /* CONTENT STYLE */
        #content { margin-left: var(--sidebar-width); width: calc(100% - var(--sidebar-width)); padding: 25px 40px; min-height: 100vh; box-sizing: border-box; }
        .admin-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 35px; }
        .invoice-container { background: #fff; border-radius: 15px; padding: 40px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        .info-section { border-bottom: 1px dashed #dee2e6; padding-bottom: 20px; margin-bottom: 20px; }
        .label-text { font-size: 0.85rem; text-transform: uppercase; color: #888; font-weight: bold; margin-bottom: 5px; }
        .value-text { font-size: 1.05rem; color: #333; margin-bottom: 15px; }
        
        .badge-status { padding: 7px 18px; border-radius: 50px; font-weight: 600; font-size: 13px; display: inline-block; }
        .status-pending { background-color: #fff3cd; color: #856404; }
        .status-completed { background-color: #d4edda; color: #155724; }
        .status-cancelled { background-color: #f8d7da; color: #721c24; }
        .status-processing { background-color: #cce5ff; color: #004085; }

        /* Nút quay lại */
        .btn-back { background-color: transparent; border: 1px solid #ccc; color: #555; padding: 6px 15px; border-radius: 5px; text-decoration: none; display: inline-block; margin-bottom: 20px; transition: 0.2s;}
        .btn-back:hover { background-color: #f4f4f4; color: #333;}
    </style>
</head>

<body>

    <?php include 'sidebar.php'; ?>

    <div id="content">
        <!-- Nút quay lại danh sách -->
        <a href="admin_orders.php" class="btn-back"><i class="fa fa-arrow-left me-2"></i>Quay lại danh sách</a>

        <div class="admin-header">
            <h2 class="fw-bold mb-0" style="color: var(--primary-color); font-family: 'Playfair Display', serif;">Hóa Đơn Chi Tiết</h2>
            <div class="user-info d-flex align-items-center">
                <span class="me-3">Admin: <strong><?php echo $_SESSION['user_admin']; ?></strong></span>
                <img src="../img/team-1.jpg" class="rounded-circle border" width="40" height="40">
            </div>
        </div>

        <div class="invoice-container">
            <!-- Hiển thị thông báo cập nhật -->
            <?php if(isset($msg_success)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle me-2"></i><?php echo $msg_success; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <?php if(isset($msg_error)): ?>
                <div class="alert alert-danger"><i class="fa fa-exclamation-triangle me-2"></i><?php echo $msg_error; ?></div>
            <?php endif; ?>

            <div class="row info-section">
                <!-- CỘT 1: THÔNG TIN KHÁCH HÀNG (Có nút sửa) -->
                <div class="col-md-6 border-end position-relative">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="text-primary fw-bold mb-0"><i class="fa fa-user me-2"></i>Thông tin khách hàng</h5>
                        <!-- Nút mở Modal sửa -->
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editInfoModal">
                            <i class="fa fa-edit"></i> Sửa
                        </button>
                    </div>

                    <div class="label-text">Họ tên người nhận</div>
                    <div class="value-text"><?php echo htmlspecialchars($order['CustomerName']); ?></div>
                    <div class="label-text">Số điện thoại</div>
                    <div class="value-text text-primary fw-bold"><?php echo htmlspecialchars($order['CustomerPhone']); ?></div>
                    <div class="label-text">Địa chỉ giao hàng</div>
                    <div class="value-text"><?php echo htmlspecialchars($order['Address']); ?></div>
                    
                    <?php if(!empty($order['Note'])): ?>
                        <div class="label-text mt-3">Ghi chú</div>
                        <div class="value-text fst-italic text-muted"><?php echo htmlspecialchars($order['Note']); ?></div>
                    <?php endif; ?>
                </div>
                
                <!-- CỘT 2: THÔNG TIN ĐƠN HÀNG (Không cho sửa) -->
                <div class="col-md-6 ps-md-4">
                    <h5 class="text-primary fw-bold mb-3"><i class="fa fa-file-invoice me-2"></i>Thông tin đơn hàng</h5>
                    <div class="label-text">Mã đơn hàng</div>
                    <div class="value-text fw-bold">#CAKE-<?php echo $order_id; ?></div>
                    <div class="label-text">Thời gian đặt</div>
                    <div class="value-text"><?php echo date('d/m/Y H:i', strtotime($order['OrderDate'])); ?></div>
                    <div class="label-text">Trạng thái</div>
                    <div class="value-text">
                        <?php 
                            $st = $order['Status'];
                            $cl = 'status-pending'; $txt = 'Chờ xử lý';
                            if($st == 'Completed') { $cl = 'status-completed'; $txt = 'Hoàn thành'; }
                            elseif($st == 'Cancelled') { $cl = 'status-cancelled'; $txt = 'Đã hủy'; }
                            elseif($st == 'Processing') { $cl = 'status-processing'; $txt = 'Đang xử lý'; }
                        ?>
                        <span class="badge-status <?php echo $cl; ?>"><?php echo $txt; ?></span>
                    </div>
                </div>
            </div>

            <!-- DANH SÁCH SẢN PHẨM -->
            <div class="mt-4">
                <h5 class="text-primary fw-bold mb-3"><i class="fa fa-birthday-cake me-2"></i>Danh sách sản phẩm</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center border">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th class="text-start">Tên bánh</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_items = "SELECT od.*, p.ProductName 
                                          FROM OrderDetail od 
                                          JOIN Product p ON od.ProductID = p.ProductID 
                                          WHERE od.OrderID = $order_id";
                            $result_items = $conn->query($sql_items);
                            $stt = 1;

                            while ($item = $result_items->fetch_assoc()) {
                                $subtotal = $item['PriceAtOrder'] * $item['Quantity'];
                            ?>
                                <tr>
                                    <td><?php echo $stt++; ?></td>
                                    <td class="text-start fw-bold"><?php echo htmlspecialchars($item['ProductName']); ?></td>
                                    <td><?php echo number_format($item['PriceAtOrder'], 0, ',', '.'); ?> đ</td>
                                    <td>x<?php echo $item['Quantity']; ?></td>
                                    <td class="fw-bold text-danger"><?php echo number_format($subtotal, 0, ',', '.'); ?> đ</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="4" class="text-end fw-bold py-3">TỔNG CỘNG THANH TOÁN:</td>
                                <td class="text-danger fw-bold fs-5 py-3"><?php echo number_format($order['TotalAmount'], 0, ',', '.'); ?> đ</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= MODAL SỬA THÔNG TIN KHÁCH HÀNG ================= -->
    <div class="modal fade" id="editInfoModal" tabindex="-1" aria-labelledby="editInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold" id="editInfoModalLabel"><i class="fa fa-edit me-2"></i>Sửa Thông Tin Giao Hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Form gửi data trực tiếp về chính trang này -->
                <form action="admin_order_detail.php?id=<?php echo $order_id; ?>" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Họ tên người nhận</label>
                            <input type="text" class="form-control" name="edit_name" value="<?php echo htmlspecialchars($order['CustomerName']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Số điện thoại</label>
                            <input type="tel" class="form-control" name="edit_phone" value="<?php echo htmlspecialchars($order['CustomerPhone']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Địa chỉ giao hàng</label>
                            <textarea class="form-control" name="edit_address" rows="2" required><?php echo htmlspecialchars($order['Address']); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Ghi chú (Tùy chọn)</label>
                            <textarea class="form-control" name="edit_note" rows="2"><?php echo htmlspecialchars($order['Note']); ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" name="btn_update_info" class="btn btn-success fw-bold"><i class="fa fa-save me-1"></i> Lưu Thay Đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ================= KẾT THÚC MODAL ================= -->

    <!-- Cần load Bootstrap JS để Modal hoạt động -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>