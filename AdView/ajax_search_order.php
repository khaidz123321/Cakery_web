<?php
require_once '../db_connect.php';

$search = isset($_POST['query']) ? $conn->real_escape_string($_POST['query']) : '';
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$limit = 20; 
$offset = ($page - 1) * $limit;

$where_clause = "";
if ($search != "") {
    $search_id = str_replace('#CAKE-', '', $search);
    $where_clause = " WHERE OrderID LIKE '%$search_id%' OR CustomerName LIKE '%$search%' ";
}

// 1. Lấy tổng số dòng để làm phân trang
$count_sql = "SELECT COUNT(*) as total FROM `Order` $where_clause";
$total_res = $conn->query($count_sql);
$total_records = $total_res->fetch_assoc()['total'];
$total_pages = ceil($total_records / $limit);

// 2. Lấy dữ liệu trang hiện tại
$sql = "SELECT * FROM `Order` $where_clause ORDER BY OrderID DESC LIMIT $offset, $limit";
$result = $conn->query($sql);

$html_table = "";
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $st = $row['Status'];
        $txt = 'Chờ xử lý'; $cl = 'status-pending';
        if ($st == 'Completed') { $txt = 'Hoàn thành'; $cl = 'status-completed'; }
        elseif ($st == 'Cancelled') { $txt = 'Đã hủy'; $cl = 'status-cancelled'; }
        elseif ($st == 'Processing') { $txt = 'Đang xử lý'; $cl = 'status-processing'; }
        
        $order_id = $row['OrderID'];
        $customer = htmlspecialchars($row['CustomerName']);
        $date = date('d/m/Y H:i', strtotime($row['OrderDate']));
        $total = number_format($row['TotalAmount'], 0, ',', '.') . ' đ';

        $html_table .= "<tr id='order-{$order_id}'>
                <td class='fw-bold'>#CAKE-{$order_id}</td>
                <td class='text-start fw-bold'>{$customer}</td>
                <td>{$date}</td>
                <td class='text-danger fw-bold'>{$total}</td>
                <td class='status-cell'><span class='badge-status {$cl}'>{$txt}</span></td>
                <td class='action-cell'>
                    <a href='admin_order_detail.php?id={$order_id}' class='btn btn-sm btn-outline-primary me-1'><i class='fa fa-eye'></i></a>";
        if ($st == 'Pending') {
            $html_table .= "<button class='btn btn-sm btn-outline-warning me-1 btn-change-status' data-id='{$order_id}' data-status='Processing'><i class='fa fa-spinner'></i></button>
                           <button class='btn btn-sm btn-outline-danger btn-change-status' data-id='{$order_id}' data-status='Cancelled'><i class='fa fa-times'></i></button>";
        }
        if ($st == 'Processing') {
            $html_table .= "<button class='btn btn-sm btn-outline-success btn-change-status' data-id='{$order_id}' data-status='Completed'><i class='fa fa-check'></i></button>";
        }
        $html_table .= "</td></tr>";
    }
} else {
    $html_table = "<tr><td colspan='6' class='text-center py-4 text-muted'>Không tìm thấy đơn hàng nào!</td></tr>";
}

// 3. Vẽ lại các nút phân trang bằng HTML
$html_pagination = "";
if ($total_pages > 1) {
    $html_pagination .= '<ul class="pagination justify-content-center">';
    for ($i = 1; $i <= $total_pages; $i++) {
        $active = ($i == $page) ? 'active' : '';
        $html_pagination .= "<li class='page-item {$active}'><a class='page-link ajax-page-link' href='#' data-page='{$i}'>{$i}</a></li>";
    }
    $html_pagination .= '</ul>';
}

// Trả về một chuỗi JSON chứa cả bảng và phân trang
echo json_encode([
    'table' => $html_table,
    'pagination' => $html_pagination
]);
?>