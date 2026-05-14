<?php 
    require_once '../check_login.php'; 
    require_once '../db_connect.php'; 
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Cakery - Quản Lý Đơn Hàng</title>
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
           KHUNG TRÁI (SIDEBAR) - GIỮ NGUYÊN STYLE ĐÃ FIX
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
           KHUNG PHẢI (CONTENT) - GIỮ NGUYÊN BỐ CỤC CODE CŨ
           ============================================================ */
        #content {
            margin-left: var(--sidebar-width); /* Đẩy khung phải để không bị che */
            width: calc(100% - var(--sidebar-width));
            padding: 25px 40px; /* Căn chỉnh chuẩn không bị dính lề */
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

        /* TRẠNG THÁI VIÊN THUỐC - Theo ảnh image_a6e119.png */
        .badge-status { 
            padding: 7px 18px; 
            border-radius: 50px; 
            font-weight: 600; 
            font-size: 13px;
            display: inline-block;
            min-width: 120px;
        }
        .status-pending { background-color: #fff3cd; color: #856404; }
        .status-completed { background-color: #d4edda; color: #155724; }
        .status-cancelled { background-color: #f8d7da; color: #721c24; }
        .status-processing { background-color: #e2e3e5; color: #383d41; }
    </style>
</head>

<body>

    <?php include 'sidebar.php'; ?>

    <div id="content">
        <div class="admin-header">
            <h2 class="fw-bold mb-0" style="color: var(--primary-color); font-family: 'Playfair Display', serif;">Quản Lý Đơn Hàng</h2>
            <div class="user-info d-flex align-items-center">
                <!--TRUY VẤN TÊN NGƯỜI DÙNG-->
                <span class="me-3 fs-6">Admin: <strong><?php echo $_SESSION['user_admin']; ?></strong></span>
                <img src="../img/team-1.jpg" class="rounded-circle border" width="40" height="40" alt="Admin">
            </div>
        </div>

        <div class="table-container">
            <div class="row mb-4 align-items-center">

                <!--START XỬ LÍ LOGIC CHO TÌM KIẾM-->
                <div class="col-md-6">
                    <!-- 1. Thêm thẻ <form> với method="GET" để gửi dữ liệu lên URL -->
                    <div class="input-group" style="max-width: 350px;">
                        <input type="text" id="liveSearchOrderInput" class="form-control" placeholder="Tìm mã đơn hoặc tên khách...">
                        <button class="btn btn-outline-secondary" type="button"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <!--END XỬ LÍ LOGIC CHO TÌM KIẾM-->
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3">Mã đơn</th>
                            <th class="text-start py-3">Khách hàng</th>
                            <th class="py-3">Ngày đặt</th>
                            <th class="py-3">Tổng tiền</th>
                            <th class="py-3">Trạng thái</th>
                            <th class="py-3">Hành động</th>
                        </tr>
                    </thead>
                    <tbody id="orderTableBody">
                        <?php
                        // --- START LOGIC TÌM KIẾM & PHÂN TRANG ---
                        $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
                        $where_clause = "";

                        if ($search != "") {
                            $search_id = str_replace('#CAKE-', '', $search);
                            $where_clause = " WHERE OrderID LIKE '%$search_id%' OR CustomerName LIKE '%$search%' ";
                        }

                        $limit = 20; 
                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        if ($page < 1) $page = 1;
                        $offset = ($page - 1) * $limit;

                        $count_sql = "SELECT COUNT(*) as total FROM `Order` $where_clause";
                        $count_res = $conn->query($count_sql);
                        $total_records = $count_res->fetch_assoc()['total'];
                        $total_pages = ceil($total_records / $limit);

                        $sql_orders = "SELECT * FROM `Order` $where_clause ORDER BY OrderID DESC LIMIT $offset, $limit";
                        $result_orders = $conn->query($sql_orders);
                        // --- END LOGIC ---

                        if ($result_orders->num_rows > 0) {
                            while ($row = $result_orders->fetch_assoc()) {
                                $st = $row['Status'];
                                $txt = 'Chờ xử lý'; $cl = 'status-pending';
                                if ($st == 'Completed') { $txt = 'Hoàn thành'; $cl = 'status-completed'; }
                                elseif ($st == 'Cancelled') { $txt = 'Đã hủy'; $cl = 'status-cancelled'; }
                                elseif ($st == 'Processing') { $txt = 'Đang xử lý'; $cl = 'status-processing'; }
                        ?> 
                            <!--Sửa đổi xử lí theo Ajax-->
                            <tr id="order-<?php echo $row['OrderID']; ?>">
                                <td class="fw-bold">#CAKE-<?php echo $row['OrderID']; ?></td>
                                <td class="text-start fw-bold"><?php echo htmlspecialchars($row['CustomerName']); ?></td>
                                <td><?php echo date('d/m/Y H:i', strtotime($row['OrderDate'])); ?></td>
                                <td class="text-danger fw-bold"><?php echo number_format($row['TotalAmount'], 0, ',', '.'); ?> đ</td>
                                
                                <td class="status-cell">
                                    <span class="badge-status <?php echo $cl; ?>"><?php echo $txt; ?></span>
                                </td>
                                
                                <td class="action-cell">
                                    <a href="admin_order_detail.php?id=<?php echo $row['OrderID']; ?>" class="btn btn-sm btn-outline-primary me-1" title="Xem chi tiết"><i class="fa fa-eye"></i></a>
                                    
                                    <?php if ($st == 'Pending'): ?>
                                        <button class="btn btn-sm btn-outline-warning me-1 btn-change-status" data-id="<?php echo $row['OrderID']; ?>" data-status="Processing" title="Duyệt đơn"><i class="fa fa-spinner"></i></button>
                                        <button class="btn btn-sm btn-outline-danger btn-change-status" data-id="<?php echo $row['OrderID']; ?>" data-status="Cancelled" title="Hủy đơn"><i class="fa fa-times"></i></button>
                                    <?php endif; ?>

                                    <?php if ($st == 'Processing'): ?>
                                        <button class="btn btn-sm btn-outline-success btn-change-status" data-id="<?php echo $row['OrderID']; ?>" data-status="Completed" title="Xác nhận giao thành công"><i class="fa fa-check"></i></button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <!--End xử lí-->

                        <?php 
                            } // Kết thúc while
                        } else {
                            echo "<tr><td colspan='6' class='text-center py-4 text-muted'>Không tìm thấy đơn hàng nào!</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <!-- HIỂN THỊ NÚT PHÂN TRANG -->
                <?php if ($total_pages > 1): ?>
                    <nav id="paginationContainer" class="mt-4">
                        <ul class="pagination justify-content-center">
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                                    <a class="page-link ajax-page-link" href="#" data-page="<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <!--START Xử lí ajax cho chuyển đổi trạng thái duyệt / huỷ / xử lí-->
    <script>
    $(document).ready(function() {
        $(document).on('click', '.btn-change-status', function() {
            var btn = $(this);
            var orderId = btn.data('id');
            var newStatus = btn.data('status');
            var row = $('#order-' + orderId);

            var confirmMsg = "Bạn có chắc chắn muốn DUYỆT đơn hàng này?";
            if (newStatus === 'Cancelled') confirmMsg = "Bạn có chắc chắn muốn HỦY đơn này?";
            if (newStatus === 'Completed') confirmMsg = "Xác nhận đơn hàng đã giao THÀNH CÔNG?";

            if (confirm(confirmMsg)) {
                var originalIcon = btn.html();
                btn.html('<i class="fa fa-spinner fa-spin"></i>');

                $.ajax({
                    url: 'process_order.php',
                    type: 'GET',
                    data: {
                        action: 'update_status',
                        id: orderId,
                        status: newStatus,
                        ajax: 1
                    },
                    success: function(response) {
                        if (response.trim() === 'success') {
                            var badge = row.find('.badge-status');
                            var actionCell = row.find('.action-cell');

                            if (newStatus === 'Processing') {
                                badge.removeClass().addClass('badge-status status-processing').text('Đang xử lý');
                                var btnComplete = '<button class="btn btn-sm btn-outline-success btn-change-status" data-id="'+orderId+'" data-status="Completed" title="Xác nhận giao thành công"><i class="fa fa-check"></i></button>';
                                actionCell.html('<a href="admin_order_detail.php?id='+orderId+'" class="btn btn-sm btn-outline-primary me-1"><i class="fa fa-eye"></i></a> ' + btnComplete);
                            } 
                            else if (newStatus === 'Completed') {
                                badge.removeClass().addClass('badge-status status-completed').text('Hoàn thành');
                                row.find('.btn-change-status').remove();
                            } else if (newStatus === 'Cancelled') {
                                badge.removeClass().addClass('badge-status status-cancelled').text('Đã hủy');
                                row.find('.btn-change-status').remove();
                            }
                        } else {
                            alert('Cập nhật thất bại: ' + response);
                            btn.html(originalIcon);
                        }
                    },
                    error: function() {
                        alert('Lỗi kết nối tới máy chủ!');
                        btn.html(originalIcon);
                    }
                });
            }
        });
    });
    </script>
    <!--END Xử lí ajax cho chuyển đổi trạng thái duyệt / huỷ / xử lí-->
    
    <!--START Xử lí TÌM KIẾM + Phân trang-->
    <script>
    $(document).ready(function(){
        // Hàm trung tâm để tải dữ liệu đơn hàng
        function fetchOrders(keyword = '', page = 1) {
            $.ajax({
                url: 'ajax_search_order.php',
                method: 'POST',
                data: { query: keyword, page: page },
                dataType: 'json', // Nhận dữ liệu dạng JSON
                success: function(data){
                    $('#orderTableBody').html(data.table);
                    $('#paginationContainer').html(data.pagination);
                }
            });
        }

        // Khi gõ phím tìm kiếm
        $('#liveSearchOrderInput').on('keyup', function(){
            fetchOrders($(this).val(), 1);
        });

        // Khi bấm vào số trang (Sử dụng .on() vì các nút này sinh ra sau khi AJAX chạy)
        $(document).on('click', '.ajax-page-link', function(e){
            e.preventDefault();
            var page = $(this).data('page');
            var keyword = $('#liveSearchOrderInput').val();
            fetchOrders(keyword, page);
        });
    });
    </script>
    <!--END Xử lí TÌM KIẾM + Phan trang-->

</body>
</html>