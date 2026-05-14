<?php
require_once '../db_connect.php';

// ========================================================
// 1. XỬ LÝ THÊM SẢN PHẨM MỚI (Từ Form POST)
// ========================================================
if (isset($_POST['btn_add_product'])) {
    $name = $_POST['product_name'];
    $cat_id = $_POST['category_id'];
    $price = $_POST['price'];
    $desc = $_POST['description'];

    // 1. Xử lý Upload ảnh
    $target_dir = "../img/"; // Thư mục lưu ảnh thực tế
    $image_name = time() . "_" . basename($_FILES["product_image"]["name"]); // Đổi tên để tránh trùng
    $target_file = $target_dir . $image_name;
    $db_image_path = "img/" . $image_name; // Đường dẫn lưu vào database

    if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
        // 2. Lưu vào Database
        $sql = "INSERT INTO Product (ProductName, Description, Image, Price, CategoryID) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $name, $desc, $db_image_path, $price, $cat_id);

        if ($stmt->execute()) {
            header("Location: admin_products.php?status=success");
        } else {
            echo "Lỗi database: " . $conn->error;
        }
        $stmt->close();
    } else {
        echo "Lỗi upload ảnh.";
    }
}
// ========================================================
// 2. XỬ LÝ XÓA SẢN PHẨM (Từ URL GET)
// ========================================================
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if ($id > 0) {
        // BƯỚC A: Tìm và xóa file ảnh trong thư mục /img/ cho đỡ nặng Server
        $sql_get_img = "SELECT Image FROM Product WHERE ProductID = $id";
        $res_img = $conn->query($sql_get_img);
        
        if ($res_img->num_rows > 0) {
            $img_path = $res_img->fetch_assoc()['Image'];
            $full_path = "../" . $img_path;
            
            // Hàm unlink() dùng để xóa file vật lý
            if (file_exists($full_path) && is_file($full_path) && $img_path != '') {
                unlink($full_path); 
            }
        }

        // BƯỚC B: Xóa dữ liệu trong bảng Product
        $sql_delete = "DELETE FROM Product WHERE ProductID = $id";
        
        if ($conn->query($sql_delete) === TRUE) {
            // Xóa xong thì quay lại trang danh sách sản phẩm
            header("Location: admin_products.php?status=deleted");
            exit(); // NGẮT CODE TẠI ĐÂY
        } else {
            echo "Lỗi khi xóa khỏi CSDL: " . $conn->error;
        }
    } else {
        echo "ID sản phẩm không hợp lệ!";
    }
}
?>