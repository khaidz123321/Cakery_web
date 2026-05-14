<?php
// Gọi kết nối Database
require_once '../db_connect.php';

if(isset($_POST['query'])){
    $search = $conn->real_escape_string($_POST['query']);
    
    // Câu lệnh tìm kiếm bánh theo tên
    $sql = "SELECT p.*, c.CategoryName 
            FROM Product p 
            LEFT JOIN Category c ON p.CategoryID = c.CategoryID 
            WHERE p.ProductName LIKE '%$search%' 
            ORDER BY p.ProductID DESC";
            
    $result = $conn->query($sql);
    
    // Nếu tìm thấy bánh
    if($result->num_rows > 0){
        // Lặp qua kết quả và vẽ ra các thẻ <tr>
        while($row = $result->fetch_assoc()){
            $id = $row['ProductID'];
            $img = htmlspecialchars($row['Image']);
            $name = htmlspecialchars($row['ProductName']);
            $cat = htmlspecialchars($row['CategoryName'] ?? 'Chưa phân loại');
            $price = number_format($row['Price'], 0, ',', '.') . ' đ';
            
            echo "<tr>
                    <td><strong>{$id}</strong></td>
                    <td>
                        <img src='../{$img}' class='product-img' alt='Bánh' onerror=\"this.src='../img/default.jpg'\">
                    </td>
                    <td class='text-start fw-bold'>{$name}</td>
                    <td><span class='badge bg-light text-dark border'>{$cat}</span></td>
                    <td class='text-danger fw-bold'>{$price}</td>
                    <td>
                        <a href='admin_product_detail.php?id={$id}' class='btn btn-sm btn-outline-primary me-1' title='Chỉnh sửa'><i class='fa fa-edit'></i></a>
                        <a href='process_product.php?action=delete&id={$id}' class='btn btn-sm btn-outline-danger' title='Xóa' onclick=\"return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn sản phẩm này?')\"><i class='fa fa-trash'></i></a>
                    </td>
                  </tr>";
        }
    } else {
        // Nếu gõ không trúng bánh nào
        echo "<tr><td colspan='6' class='text-center p-4 text-muted'><i class='fa fa-search fs-3 d-block mb-2'></i>Không tìm thấy sản phẩm nào khớp với từ khóa!</td></tr>";
    }
}
?>