<?php 
    require_once '../check_login.php'; 
    require_once '../db_connect.php'; 

    // START TRUY VẤN
    $revenue = $conn->query("SELECT SUM(TotalAmount) as total FROM `Order` WHERE Status = 'Completed'")->fetch_assoc()['total'] ?? 0;
    $pending = $conn->query("SELECT COUNT(*) as total FROM `Order` WHERE Status = 'Pending' OR Status = 'Processing'")->fetch_assoc()['total'] ?? 0;
    $completed = $conn->query("SELECT COUNT(*) as total FROM `Order` WHERE Status = 'Completed'")->fetch_assoc()['total'] ?? 0;
    $customers = $conn->query("SELECT COUNT(DISTINCT CustomerPhone) as total FROM `Order` ")->fetch_assoc()['total'] ?? 0;
    // END TRUY VẤN
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Cakery Admin - Bảng Điều Khiển</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <link href="../img/favicon.svg" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #5c3d3a;
            --secondary-color: #EAA636;
            --sidebar-width: 250px;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
            margin: 0;
            overflow-x: hidden;
        }

        /* ============================================================
        KHUNG TRÁI (SIDEBAR) - CÔ LẬP HOÀN TOÀN
        ============================================================ */
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: var(--primary-color);
            z-index: 1000;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
            color: #fff;
        }

        /* Header của Sidebar */
        #sidebar .sidebar-header {
            padding: 30px 25px;
            background: rgba(0, 0, 0, 0.1);
            text-align: left; /* Căn trái theo ảnh mẫu */
        }

        #sidebar .sidebar-header h3 {
            color: var(--secondary-color);
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 26px;
            margin-bottom: 2px;
        }

        #sidebar .sidebar-header small {
            color: rgba(255, 255, 255, 0.6);
            font-size: 14px;
        }

        /* Danh sách Menu trong Sidebar */
        #sidebar ul.components {
            padding: 20px 0;
            list-style: none;
        }

        #sidebar ul li a {
            padding: 18px 25px;
            display: block;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 16px;
            transition: 0.3s;
            border-left: 5px solid transparent; /* Tạo lề ẩn để không bị giật khi active */
        }

        #sidebar ul li a i {
            margin-right: 15px;
            width: 20px;
            text-align: center;
        }

        /* Hiệu ứng Active - Đúng theo ảnh image_a6d9bc.png */
        #sidebar ul li.active > a {
            color: #fff;
            background: rgba(255, 255, 255, 0.1); /* Màu nền sáng hơn một chút */
            border-left: 5px solid var(--secondary-color); /* Dải màu vàng nhấn bên trái */
            font-weight: 500;
        }

        #sidebar ul li a:hover {
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
        }

        /* Nút Thoát - Màu vàng đặc trưng */
        #sidebar .logout-link {
            color: var(--secondary-color) !important;
            margin-top: 40px;
            font-weight: 600;
        }

        /* ============================================================
        KHUNG PHẢI (CONTENT) - GIỮ NGUYÊN BỐ CỤC
        ============================================================ */
        #content {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            padding: 25px 40px;
            min-height: 100vh;
            box-sizing: border-box;
        }

        /* Giữ nguyên giao diện các thẻ thống kê và bảng như Khải muốn */
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
        }

        .stat-card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            height: 100%;
        }

        .border-rev { border-left: 5px solid var(--primary-color) !important; }
        .border-pen { border-left: 5px solid #ffc107 !important; }
        .border-com { border-left: 5px solid #28a745 !important; }
        .border-cus { border-left: 5px solid #17a2b8 !important; }

        .table-container {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            margin-top: 30px;
        }

        /* Trạng thái Bo tròn (Badge) */
        .badge-status { 
            padding: 6px 16px; 
            border-radius: 50px; 
            font-weight: 600; 
            font-size: 13px;
            display: inline-block;
            min-width: 110px;
        }
        .status-pending { background-color: #fff3cd; color: #856404; }
        .status-completed { background-color: #d4edda; color: #155724; }
        .status-cancelled { background-color: #f8d7da; color: #721c24; }
    </style>
</head>

<body>

    <?php include 'sidebar.php'; ?>
    
    <div id="content">
        <div class="admin-header">
            <h2 class="fw-bold mb-0" style="color: var(--primary-color); font-family: 'Playfair Display', serif;">Bảng Điều Khiển</h2>
            <div class="user-info d-flex align-items-center">
                <span class="me-2 fs-6">Admin: <strong><?php echo $_SESSION['user_admin']; ?></strong></span>
                <img src="../img/team-1.jpg" class="rounded-circle" width="35" height="35" alt="Admin">
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-3">
                <div class="stat-card border-rev">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle me-3"><i class="fa fa-dollar-sign text-primary"></i></div>
                        <div>
                            <p class="text-muted mb-1 small fw-bold text-uppercase">Doanh thu</p>
                            <h4 class="mb-0 fw-bold"><?php echo number_format($revenue, 0, ',', '.'); ?> đ</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card border-pen">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle me-3"><i class="fa fa-clock text-warning"></i></div>
                        <div>
                            <p class="text-muted mb-1 small fw-bold text-uppercase">Chờ xử lý</p>
                            <h4 class="mb-0 fw-bold"><?php echo $pending; ?> đơn</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card border-com">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle me-3"><i class="fa fa-check-circle text-success"></i></div>
                        <div>
                            <p class="text-muted mb-1 small fw-bold text-uppercase">Hoàn thành</p>
                            <h4 class="mb-0 fw-bold"><?php echo $completed; ?> đơn</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card border-cus">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle me-3"><i class="fa fa-users text-info"></i></div>
                        <div>
                            <p class="text-muted mb-1 small fw-bold text-uppercase">Khách hàng</p>
                            <h4 class="mb-0 fw-bold"><?php echo $customers; ?> khách</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">Đơn hàng mới nhận</h5>
                <a href="admin_orders.php" class="btn btn-sm btn-link text-decoration-none text-secondary">Xem tất cả <i class="fa fa-arrow-right ms-1"></i></a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3">Mã đơn</th>
                            <th class="text-start py-3">Khách hàng</th>
                            <th class="py-3">Tổng tiền</th>
                            <th class="py-3">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // START TRUY VẤN CHO MỘT SỐ ĐƠN HÀNG THỬ
                        $res_tab = $conn->query("SELECT * FROM `Order` ORDER BY OrderDate DESC LIMIT 5");
                        while ($row = $res_tab->fetch_assoc()) {
                            $st = $row['Status'];
                            $txt = 'Chờ xử lý'; $cl = 'status-pending';
                            if ($st == 'Completed') { $txt = 'Đã hoàn thành'; $cl = 'status-completed'; }
                            elseif ($st == 'Cancelled') { $txt = 'Đã hủy'; $cl = 'status-cancelled'; }
                            elseif ($st == 'Processing') { $txt = 'Đang xử lý'; $cl = 'status-pending'; } // Cùng tông màu với Chờ xử lý theo mẫu
                        // END TRUY VẤN
                        ?>
                        <tr>
                            <td class="fw-bold">#CAKE-<?php echo $row['OrderID']; ?></td>
                            <td class="text-start fw-bold"><?php echo htmlspecialchars($row['CustomerName']); ?></td>
                            <td class="text-danger fw-bold"><?php echo number_format($row['TotalAmount'], 0, ',', '.'); ?> đ</td>
                            <td><span class="badge-status <?php echo $cl; ?>"><?php echo $txt; ?></span></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>