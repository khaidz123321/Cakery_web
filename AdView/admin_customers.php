<?php 
    require_once '../check_login.php'; 
    require_once '../db_connect.php'; 
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Cakery - Thống Kê Khách Hàng</title>
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

        #sidebar .logout-link { color: var(--secondary-color) !important; font-weight: 600; margin-top: 40px; }

        /* ============================================================
           KHUNG PHẢI (CONTENT) - CĂN CHỈNH VỪA KHÍT
           ============================================================ */
        #content {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            padding: 25px 40px;
            min-height: 100vh;
            box-sizing: border-box;
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
        }

        .table-container {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }
        
        /* Avatar khách hàng */
        .avatar-circle {
            width: 42px;
            height: 42px;
            background-color: var(--secondary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin: 0 auto;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        /* Badge bo tròn kiểu viên thuốc cho đồng bộ */
        .badge-pill-custom {
            padding: 7px 18px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 13px;
        }
    </style>
</head>

<body>

    <?php include 'sidebar.php'; ?>

    <div id="content">
        <div class="admin-header">
            <h2 class="fw-bold mb-0" style="color: var(--primary-color); font-family: 'Playfair Display', serif;">Khách Hàng</h2>
            <div class="user-info d-flex align-items-center">
                <span class="me-3 fs-6">Admin: <strong><?php echo $_SESSION['user_admin']; ?></strong></span>
                <img src="../img/team-1.jpg" class="rounded-circle border" width="40" height="40" alt="Admin">
            </div>
        </div>

        <div class="table-container">
            <div class="row mb-4 align-items-center">
                <div class="col-md-6">
                    <h5 class="fw-bold text-secondary mb-0"><i class="fa fa-medal me-2 text-warning"></i>Khách hàng thân thiết</h5>
                </div>
                <div class="col-md-6">
                    <div class="input-group float-end" style="max-width: 300px;">
                        <input type="text" class="form-control shadow-none" placeholder="Tìm tên khách hàng...">
                        <button class="btn btn-outline-secondary" type="button"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3">STT</th>
                            <th class="py-3">Ảnh</th>
                            <th class="text-start py-3">Họ và tên</th>
                            <th class="py-3">Số điện thoại</th>
                            <th class="py-3">Số đơn đã đặt</th>
                            <th class="py-3">Tổng chi tiêu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // TRUY VẤN: Lấy dữ liệu thật từ bảng Order
                        $sql_cus = "SELECT CustomerName, CustomerPhone, 
                                    COUNT(OrderID) as TotalOrders, 
                                    SUM(TotalAmount) as TotalSpent 
                                    FROM `Order` 
                                    GROUP BY CustomerPhone, CustomerName 
                                    ORDER BY TotalSpent DESC"; 
                        
                        $result_cus = $conn->query($sql_cus);
                        $stt = 1;

                        if ($result_cus && $result_cus->num_rows > 0) {
                            while ($cus = $result_cus->fetch_assoc()) {
                                $initial = strtoupper(substr($cus['CustomerName'], 0, 1));
                        ?>
                            <tr>
                                <td><strong><?php echo $stt++; ?></strong></td>
                                <td><div class="avatar-circle"><?php echo $initial; ?></div></td>
                                <td class="text-start fw-bold"><?php echo htmlspecialchars($cus['CustomerName']); ?></td>
                                <td class="text-primary"><?php echo htmlspecialchars($cus['CustomerPhone']); ?></td>
                                <td><span class="badge badge-pill-custom bg-info text-dark"><?php echo $cus['TotalOrders']; ?> đơn</span></td>
                                <td class="fw-bold text-danger"><?php echo number_format($cus['TotalSpent'], 0, ',', '.'); ?> đ</td>
                            </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center py-4 text-muted'>Chưa có dữ liệu khách hàng!</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>