<?php 
    require_once '../check_login.php'; 
    require_once '../db_connect.php'; 
    
    // Lấy ID sản phẩm từ URL
    $product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    
    // --- XỬ LÝ CẬP NHẬT THÔNG TIN SẢN PHẨM ---
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_update_product'])) {
        $new_name = $_POST['edit_name'];
        $new_category = $_POST['edit_category'];
        $new_price = $_POST['edit_price'];
        $new_desc = $_POST['edit_desc'];

        // Xử lý nếu Admin có chọn upload ảnh mới
        $update_image_sql = "";
        if (isset($_FILES['edit_image']) && $_FILES['edit_image']['error'] == 0) {
            $target_dir = "../img/";
            $image_name = time() . "_" . basename($_FILES["edit_image"]["name"]);
            $target_file = $target_dir . $image_name;
            
            if (move_uploaded_file($_FILES["edit_image"]["tmp_name"], $target_file)) {
                $db_image_path = "img/" . $image_name;
                // Nối thêm chuỗi cập nhật ảnh vào câu lệnh SQL
                $update_image_sql = ", Image = '$db_image_path'";
            }
        }

        // Cập nhật Database
        $update_sql = "UPDATE Product SET 
                        ProductName = ?, 
                        CategoryID = ?, 
                        Price = ?, 
                        Description = ? 
                        $update_image_sql
                       WHERE ProductID = ?";
        
        $stmt = $conn->prepare($update_sql);
        // Kiểu dữ liệu: s (string), i (integer), d (double/float)
        $stmt->bind_param("sidsi", $new_name, $new_category, $new_price, $new_desc, $product_id);
        
        if ($stmt->execute()) {
            $msg_success = "Đã cập nhật thông tin bánh thành công!";
        } else {
            $msg_error = "Lỗi cập nhật: " . $conn->error;
        }
        $stmt->close();
    }
    // ------------------------------------------------

    // Lấy thông tin bánh (JOIN với bảng Category để lấy tên danh mục)
    $sql_product = "SELECT p.*, c.CategoryName 
                    FROM Product p 
                    LEFT JOIN Category c ON p.CategoryID = c.CategoryID 
                    WHERE p.ProductID = $product_id";
    $result_product = $conn->query($sql_product);
    
    if($result_product->num_rows == 0) {
        die("<div class='container mt-5 alert alert-danger'>Lỗi: Không tìm thấy sản phẩm này trong hệ thống!</div>");
    }
    $product = $result_product->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Chi tiết bánh - <?php echo htmlspecialchars($product['ProductName']); ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <link href="../img/favicon.svg" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root { --primary-color: #5c3d3a; --secondary-color: #EAA636; --sidebar-width: 250px; }
        body { background-color: #f8f9fa; font-family: 'Roboto', sans-serif; margin: 0; overflow-x: hidden; }

        /* Kế thừa CSS Sidebar & Layout cũ của Khải */
        #sidebar { width: var(--sidebar-width); height: 100vh; position: fixed; top: 0; left: 0; background: var(--primary-color); z-index: 1000; box-shadow: 4px 0 10px rgba(0,0,0,0.1); color: #fff; }
        #sidebar .sidebar-header { padding: 30px 25px; background: rgba(0, 0, 0, 0.1); text-align: left; }
        #sidebar .sidebar-header h3 { color: var(--secondary-color); font-family: 'Playfair Display', serif; font-weight: 700; font-size: 26px; margin-bottom: 2px; }
        #sidebar ul.components { padding: 20px 0; list-style: none; }
        #sidebar ul li a { padding: 18px 25px; display: block; color: rgba(255, 255, 255, 0.8); text-decoration: none; font-size: 16px; transition: 0.3s; }
        #sidebar ul li a i { margin-right: 15px; width: 20px; text-align: center; }
        #sidebar ul li.active > a { color: #fff; background: rgba(255, 255, 255, 0.1); border-left: 5px solid var(--secondary-color); font-weight: 500; }
        #sidebar .logout-link { color: var(--secondary-color) !important; font-weight: 600; margin-top: 40px; }

        #content { margin-left: var(--sidebar-width); width: calc(100% - var(--sidebar-width)); padding: 25px 40px; min-height: 100vh; }
        .admin-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 35px; }
        
        .invoice-container { background: #fff; border-radius: 15px; padding: 40px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        .btn-back { background-color: transparent; border: 1px solid #ccc; color: #555; padding: 6px 15px; border-radius: 5px; text-decoration: none; display: inline-block; margin-bottom: 20px; transition: 0.2s;}
        .btn-back:hover { background-color: #f4f4f4; color: #333;}
        
        .product-large-img { width: 100%; max-width: 350px; border-radius: 15px; object-fit: cover; border: 1px solid #eee; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .label-text { font-size: 0.85rem; text-transform: uppercase; color: #888; font-weight: bold; margin-bottom: 5px; }
    </style>
</head>

<body>

    <?php include 'sidebar.php'; ?>

    <div id="content">
        <a href="admin_products.php" class="btn-back"><i class="fa fa-arrow-left me-2"></i>Quay lại danh sách</a>

        <div class="admin-header">
            <h2 class="fw-bold mb-0" style="color: var(--primary-color); font-family: 'Playfair Display', serif;">Chi Tiết Sản Phẩm</h2>
            <div class="user-info d-flex align-items-center">
                <span class="me-3">Admin: <strong><?php echo $_SESSION['user_admin']; ?></strong></span>
                <img src="../img/team-1.jpg" class="rounded-circle border" width="40" height="40">
            </div>
        </div>

        <div class="invoice-container">
            <?php if(isset($msg_success)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle me-2"></i><?php echo $msg_success; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <?php if(isset($msg_error)): ?>
                <div class="alert alert-danger"><i class="fa fa-exclamation-triangle me-2"></i><?php echo $msg_error; ?></div>
            <?php endif; ?>

            <div class="row">
                <!-- CỘT 1: HÌNH ẢNH & GIÁ -->
                <div class="col-md-5 text-center border-end mb-4 mb-md-0">
                    <img src="../<?php echo htmlspecialchars($product['Image']); ?>" class="product-large-img mb-4" onerror="this.src='../img/default-cake.jpg'">
                    <div class="label-text">Giá bán hiện tại</div>
                    <h2 class="text-danger fw-bold"><?php echo number_format($product['Price'], 0, ',', '.'); ?> đ</h2>
                </div>
                
                <!-- CỘT 2: THÔNG TIN CHI TIẾT -->
                <div class="col-md-7 ps-md-5 position-relative">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h3 class="text-primary fw-bold mb-0"><?php echo htmlspecialchars($product['ProductName']); ?></h3>
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editProductModal">
                            <i class="fa fa-edit me-1"></i> Sửa bánh
                        </button>
                    </div>

                    <div class="mb-4">
                        <span class="badge bg-secondary fs-6 px-3 py-2"><?php echo htmlspecialchars($product['CategoryName'] ?? 'Chưa phân loại'); ?></span>
                        <span class="badge bg-light text-dark border ms-2">Mã SP: #<?php echo $product['ProductID']; ?></span>
                    </div>

                    <div class="label-text">Mô tả sản phẩm</div>
                    <div class="bg-light p-4 rounded border">
                        <p class="mb-0" style="line-height: 1.8;">
                            <?php echo nl2br(htmlspecialchars($product['Description'] ?? 'Chưa có mô tả cho sản phẩm này.')); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= MODAL SỬA THÔNG TIN BÁNH ================= -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold"><i class="fa fa-edit me-2"></i>Sửa Thông Tin Bánh</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <!-- QUAN TRỌNG: Phải có enctype để upload ảnh -->
                <form action="admin_product_detail.php?id=<?php echo $product_id; ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tên bánh</label>
                                <input type="text" class="form-control" name="edit_name" value="<?php echo htmlspecialchars($product['ProductName']); ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Danh mục</label>
                                <select class="form-select" name="edit_category" required>
                                    <?php
                                    $cats = $conn->query("SELECT * FROM Category");
                                    while($c = $cats->fetch_assoc()) {
                                        $selected = ($c['CategoryID'] == $product['CategoryID']) ? 'selected' : '';
                                        echo "<option value='".$c['CategoryID']."' $selected>".$c['CategoryName']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Giá bán (VNĐ)</label>
                                <input type="number" class="form-control" name="edit_price" value="<?php echo $product['Price']; ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Thay ảnh mới (Bỏ trống nếu giữ nguyên)</label>
                                <input type="file" class="form-control" name="edit_image" accept="image/*">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Mô tả sản phẩm</label>
                                <textarea class="form-control" name="edit_desc" rows="4"><?php echo htmlspecialchars($product['Description']); ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" name="btn_update_product" class="btn btn-success fw-bold"><i class="fa fa-save me-1"></i> Lưu Thay Đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ================= KẾT THÚC MODAL ================= -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>