<?php
require_once '../db_connect.php';

$start = $_POST['start'];
$end = $_POST['end'];

// 1. Lấy tổng doanh thu & số đơn
$sql_total = "SELECT SUM(TotalAmount) as rev, COUNT(*) as qty 
              FROM `Order` 
              WHERE Status = 'Completed' AND DATE(OrderDate) BETWEEN '$start' AND '$end'";
$res_total = $conn->query($sql_total)->fetch_assoc();

// 2. Lấy dữ liệu biểu đồ (Doanh thu theo ngày)
$sql_chart = "SELECT DATE(OrderDate) as d, SUM(TotalAmount) as v 
              FROM `Order` 
              WHERE Status = 'Completed' AND DATE(OrderDate) BETWEEN '$start' AND '$end' 
              GROUP BY DATE(OrderDate) ORDER BY d ASC";
$res_chart = $conn->query($sql_chart);
$labels = []; $data = [];
while($r = $res_chart->fetch_assoc()){
    $labels[] = date('d/m', strtotime($r['d']));
    $data[] = $r['v'];
}

// 3. Lấy Top 5 bánh bán chạy nhất (Query nâng cao với JOIN)
$sql_top = "SELECT p.ProductName, SUM(od.Quantity) as total_sold 
            FROM OrderDetail od 
            JOIN Product p ON od.ProductID = p.ProductID 
            JOIN `Order` o ON od.OrderID = o.OrderID 
            WHERE o.Status = 'Completed' AND DATE(o.OrderDate) BETWEEN '$start' AND '$end' 
            GROUP BY p.ProductID 
            ORDER BY total_sold DESC LIMIT 5";
$res_top = $conn->query($sql_top);
$top_html = "";
if($res_top->num_rows > 0) {
    while($p = $res_top->fetch_assoc()){
        $top_html .= "<div class='d-flex justify-content-between mb-3 border-bottom pb-2'>
                        <span>{$p['ProductName']}</span>
                        <span class='fw-bold text-success'>{$p['total_sold']} cái</span>
                      </div>";
    }
} else { $top_html = "<p class='text-muted small'>Không có dữ liệu bán hàng kỳ này.</p>"; }

// TRẢ VỀ JSON
echo json_encode([
    'total_revenue' => (float)($res_total['rev'] ?? 0),
    'total_orders' => (int)($res_total['qty'] ?? 0),
    'chart_labels' => $labels,
    'chart_data' => $data,
    'top_products_html' => $top_html
]);