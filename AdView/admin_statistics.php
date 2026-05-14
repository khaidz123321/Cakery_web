<?php 
    require_once '../check_login.php'; 
    require_once '../db_connect.php'; 
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Cakery Admin - Thống Kê Chuyên Sâu</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <link href="../img/favicon.svg" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

        /* Giữ nguyên Sidebar style giống các file khác */
        #sidebar { width: var(--sidebar-width); height: 100vh; position: fixed; top: 0; left: 0; background: var(--primary-color); z-index: 1000; box-shadow: 4px 0 10px rgba(0,0,0,0.1); color: #fff; }
        #sidebar .sidebar-header { padding: 30px 25px; background: rgba(0, 0, 0, 0.1); text-align: left; }
        #sidebar .sidebar-header h3 { color: var(--secondary-color); font-family: 'Playfair Display', serif; font-weight: 700; font-size: 26px; margin-bottom: 2px; }
        #sidebar .sidebar-header small { color: rgba(255, 255, 255, 0.6); font-size: 14px; }
        #sidebar ul.components { padding: 20px 0; list-style: none; }
        #sidebar ul li a { padding: 18px 25px; display: block; color: rgba(255, 255, 255, 0.8); text-decoration: none; font-size: 16px; transition: 0.3s; border-left: 5px solid transparent; }
        #sidebar ul li a i { margin-right: 15px; width: 20px; text-align: center; }
        #sidebar ul li.active > a { color: #fff; background: rgba(255, 255, 255, 0.1); border-left: 5px solid var(--secondary-color); font-weight: 500; }
        #sidebar ul li a:hover { background: rgba(255, 255, 255, 0.05); color: #fff; }
        #sidebar .logout-link { color: var(--secondary-color) !important; font-weight: 600; margin-top: 40px; }

        /* Khung nội dung chuẩn */
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

        .stat-box { 
            background: #fff; 
            border-radius: 12px; 
            padding: 30px; 
            box-shadow: 0 5px 20px rgba(0,0,0,0.05); 
            margin-bottom: 25px; 
            height: 100%;
        }

        .filter-bar { 
            background: #fff; 
            padding: 20px 25px; 
            border-radius: 12px; 
            margin-bottom: 30px; 
            border-left: 5px solid var(--secondary-color); 
            box-shadow: 0 5px 20px rgba(0,0,0,0.02);
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>
    <div id="content">
        <div class="admin-header">
            <h2 class="fw-bold mb-0" style="color: var(--primary-color); font-family: 'Playfair Display', serif;">Thống Kê Doanh Thu</h2>
            <div class="user-info d-flex align-items-center">
                <span class="me-3 fs-6">Admin: <strong><?php echo isset($_SESSION['user_admin']) ? $_SESSION['user_admin'] : 'Admin'; ?></strong></span>
                <img src="../img/team-1.jpg" class="rounded-circle border" width="40" height="40" alt="Admin" onerror="this.src='https://ui-avatars.com/api/?name=Admin&background=5c3d3a&color=fff'">
            </div>
        </div>

        <div class="filter-bar d-flex flex-wrap align-items-end gap-3">
            <div>
                <label class="small fw-bold text-muted mb-1">Từ ngày:</label>
                <input type="date" id="startDate" class="form-control border-0 bg-light" value="<?php echo date('Y-m-d', strtotime('-30 days')); ?>">
            </div>
            <div>
                <label class="small fw-bold text-muted mb-1">Đến ngày:</label>
                <input type="date" id="endDate" class="form-control border-0 bg-light" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <button id="btnFilter" class="btn text-white px-4 py-2" style="background: var(--primary-color); border-radius: 8px;">
                <i class="fa fa-filter me-2"></i> Lọc dữ liệu
            </button>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="stat-box text-center" style="border-bottom: 4px solid var(--primary-color);">
                    <div class="icon-circle mb-3"><i class="fa fa-wallet fa-2x text-muted"></i></div>
                    <h6 class="text-muted text-uppercase small fw-bold">Tổng doanh thu kỳ này</h6>
                    <h2 class="fw-bold" style="color: var(--primary-color);" id="txtTotalRevenue">0 đ</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="stat-box text-center" style="border-bottom: 4px solid var(--secondary-color);">
                    <div class="icon-circle mb-3"><i class="fa fa-shopping-bag fa-2x text-muted"></i></div>
                    <h6 class="text-muted text-uppercase small fw-bold">Tổng đơn hoàn thành</h6>
                    <h2 class="fw-bold" style="color: var(--secondary-color);" id="txtTotalOrders">0 đơn</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="stat-box">
                    <h5 class="fw-bold mb-4" style="color: var(--primary-color);">Biểu đồ doanh thu theo ngày</h5>
                    <div style="height: 350px;"><canvas id="revenueChart"></canvas></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-box">
                    <h5 class="fw-bold mb-4" style="color: var(--primary-color);">Top bánh bán chạy</h5>
                    <div id="topProductsList" class="mt-3">
                        </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
    let myChart; // Biến toàn cục để quản lý biểu đồ

    function loadStatistics() {
        const start = $('#startDate').val();
        const end = $('#endDate').val();

        // Thêm hiệu ứng loading cho nút bấm
        const btn = $('#btnFilter');
        const originalHtml = btn.html();
        btn.html('<i class="fa fa-spinner fa-spin me-2"></i> Đang tải...');

        $.ajax({
            url: 'ajax_get_statistics.php',
            method: 'POST',
            data: { start: start, end: end },
            dataType: 'json',
            success: function(res) {
                // 1. Cập nhật con số tổng
                $('#txtTotalRevenue').text(res.total_revenue.toLocaleString('vi-VN') + ' đ');
                $('#txtTotalOrders').text(res.total_orders + ' đơn');

                // 2. Vẽ/Cập nhật biểu đồ ĐÃ ĐƯỢC BEAUTIFY
                const ctx = document.getElementById('revenueChart').getContext('2d');
                if (myChart) myChart.destroy(); 

                myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: res.chart_labels,
                        datasets: [{
                            label: 'Doanh thu (VNĐ)',
                            data: res.chart_data,
                            backgroundColor: 'rgba(234, 166, 54, 0.85)', // Màu thứ cấp hơi trong suốt
                            hoverBackgroundColor: '#5c3d3a', // Rê chuột đổi sang màu Nâu
                            borderRadius: 6, // Bo tròn góc cột cho hiện đại
                            borderSkipped: false
                        }]
                    },
                    options: { 
                        responsive: true, 
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false }, // Giấu chú thích thừa
                            tooltip: {
                                backgroundColor: '#5c3d3a', // Tooltip màu nâu
                                padding: 12,
                                callbacks: {
                                    label: function(context) {
                                        return ' ' + context.parsed.y.toLocaleString('vi-VN') + ' đ';
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                grid: { display: false } // Bỏ lưới dọc cho thoáng
                            },
                            y: {
                                beginAtZero: true,
                                border: { dash: [5, 5] }, // Lưới ngang đứt nét mờ
                                grid: { color: '#f0f0f0' },
                                ticks: {
                                    callback: function(value) {
                                        if(value === 0) return '0 đ';
                                        return value.toLocaleString('vi-VN') + ' đ';
                                    }
                                }
                            }
                        }
                    }
                });

                // 3. Hiển thị Top bánh
                $('#topProductsList').html(res.top_products_html);
                
                // Trả lại nút bấm
                btn.html(originalHtml);
            },
            error: function() {
                alert("Lỗi tải dữ liệu. Vui lòng kiểm tra file ajax_get_statistics.php");
                btn.html(originalHtml);
            }
        });
    }

    $(document).ready(function() {
        loadStatistics(); // Chạy lần đầu khi load trang
        $('#btnFilter').click(loadStatistics);
    });
    </script>
</body>
</html>