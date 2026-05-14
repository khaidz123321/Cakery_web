<?php 
    require_once '../check_login.php'; 
    require_once '../db_connect.php'; 
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Cakery - Quản Lý Sản Phẩm</title>
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
           KHUNG TRÁI (SIDEBAR) - CÔ LẬP HOÀN TOÀN (Giống ảnh mẫu)
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
           KHUNG PHẢI (CONTENT) - CĂN CHỈNH VỪA KHỚP
           ============================================================ */
        #content {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            padding: 25px 40px;
            min-height: 100vh;
            box-sizing: border-box;
        }

        /* Header Admin ở góc phải */
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
        
        .btn-cakery { background-color: var(--primary-color); color: white; border: none; }
        .btn-cakery:hover { background-color: #4a312e; color: white; }
        
        .product-img { width: 50px; height: 50px; object-fit: cover; border-radius: 5px; }
    </style>
</head>

<body>

    <?php include 'sidebar.php'; ?>

    <div id="content">
        <div class="admin-header">
            <h2 class="fw-bold mb-0" style="color: var(--primary-color); font-family: 'Playfair Display', serif;">Quản Lý Sản Phẩm</h2>
            <div class="user-info d-flex align-items-center">
                <span class="me-3 fs-6">Admin: <strong><?php echo $_SESSION['user_admin']; ?></strong></span>
                <img src="../img/team-1.jpg" class="rounded-circle border" width="40" height="40" alt="Admin">
            </div>
        </div>

        <div class="table-container">
            <div class="row mb-3 align-items-center">
                <div class="col-md-6">
                    <div class="input-group" style="max-width: 400px;">
                        <input type="text" id="liveSearchInput" class="form-control" placeholder="Gõ tên bánh để tìm ngay...">
                        <button class="btn btn-outline-secondary" type="button"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <button class="btn btn-cakery px-4" data-bs-toggle="modal" data-bs-target="#addProductModal">
                        <i class="fa fa-plus me-2"></i> Thêm Bánh Mới
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3">ID</th>
                            <!-- Thêm cột Hình ảnh -->
                            <th class="py-3">Hình ảnh</th> 
                            <th class="text-start py-3">Tên sản phẩm</th>
                            <th class="py-3">Danh mục</th>
                            <th class="py-3">Giá bán</th>
                            <th class="py-3">Hành động</th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                        <?php
                        // --- START LOGIC TÌM KIẾM ---
                        $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
                        $where_clause = "";

                        // Nếu người dùng có gõ chữ vào ô tìm kiếm thì mới nối thêm điều kiện WHERE
                        if ($search != "") {
                            $where_clause = " WHERE p.ProductName LIKE '%$search%' ";
                        }

                        // Gọi dữ liệu có kèm theo biến $where_clause
                        $sql = "SELECT p.*, c.CategoryName 
                                FROM Product p 
                                LEFT JOIN Category c ON p.CategoryID = c.CategoryID 
                                $where_clause 
                                ORDER BY p.ProductID DESC";
                                
                        $result = $conn->query($sql);
                        // --- END LOGIC ---
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><strong><?php echo $row['ProductID']; ?></strong></td>
                                <!-- Cột Hình ảnh -->
                                <td>
                                    <img src="../<?php echo htmlspecialchars($row['Image']); ?>" class="product-img" alt="Bánh" onerror="this.src='../img/default.jpg'">
                                </td>
                                
                                <!-- Cột Tên sản phẩm -->
                                <td class="text-start fw-bold"><?php echo htmlspecialchars($row['ProductName']); ?></td>
                                
                                <!-- Cột Danh mục (SỬA Ở ĐÂY) -->
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        <?php echo htmlspecialchars($row['CategoryName'] ?? 'Chưa phân loại'); ?>
                                    </span>
                                </td>
                                
                                <!-- Cột Giá bán -->
                                <td class="text-danger fw-bold"><?php echo number_format($row['Price'], 0, ',', '.'); ?> đ</td>
                                
                                <!-- Cột Hành động -->
                                <td>
                                    <!-- Nút Sửa dẫn sang trang Chi tiết -->
                                    <a href="admin_product_detail.php?id=<?php echo $row['ProductID']; ?>" class="btn btn-sm btn-outline-primary me-1" title="Chỉnh sửa"><i class="fa fa-edit"></i></a>
                                    
                                    <!-- Nút Xóa dẫn sang file xử lý kèm thông báo xác nhận -->
                                    <a href="process_product.php?action=delete&id=<?php echo $row['ProductID']; ?>" class="btn btn-sm btn-outline-danger" title="Xóa" onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn sản phẩm này?')"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php 
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center p-4 text-muted'>Hiện chưa có sản phẩm nào!</td></tr>";
                        }
                        ?>
                        <!--END TRUY VẤN-->
                    </tbody>
                </table>
            </div>

            <nav aria-label="Page navigation" class="mt-4">
                <ul class="pagination justify-content-end mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#">Trước</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">Tiếp</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- ================= MODAL THÊM SẢN PHẨM MỚI ================= -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold" id="addProductModalLabel"><i class="fa fa-plus-circle me-2"></i>Thêm Bánh Mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Quan trọng: enctype="multipart/form-data" để gửi file ảnh -->
                <form action="process_product.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tên bánh</label>
                                <input type="text" name="product_name" class="form-control" placeholder="VD: Tiramisu Dâu Tây" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Danh mục</label>
                                <select name="category_id" class="form-select" required>
                                    <option value="">-- Chọn danh mục --</option>
                                    <?php
                                    $cats = $conn->query("SELECT * FROM Category");
                                    while($c = $cats->fetch_assoc()) {
                                        echo "<option value='".$c['CategoryID']."'>".$c['CategoryName']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Giá bán (VNĐ)</label>
                                <input type="number" name="price" class="form-control" placeholder="VD: 350000" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Hình ảnh</label>
                                <input type="file" name="product_image" class="form-control" accept="image/*" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Mô tả sản phẩm</label>
                                <textarea name="description" class="form-control" rows="4" placeholder="Nhập mô tả ngắn về bánh..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" name="btn_add_product" class="btn btn-cakery px-4 fw-bold">Lưu Sản Phẩm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!--START AJAX CHO NÚT TÌM KIẾM-->
    <script>
    $(document).ready(function(){
        // Lắng nghe sự kiện 'keyup' (nhả phím) trên ô tìm kiếm
        $('#liveSearchInput').on('keyup', function(){
            var keyword = $(this).val(); // Lấy từ khóa Khải vừa gõ
            
            // Gửi ngầm từ khóa đi
            $.ajax({
                url: 'ajax_search_product.php', 
                method: 'POST',
                data: {query: keyword},
                success: function(response){
                    // Lấy kết quả trả về đè lên toàn bộ phần ruột của bảng
                    $('#productTableBody').html(response);
                }
            });
        });
    });
    </script>
    <!--END AJAX CHO NÚT TÌM KIẾM-->

</body>
</html>