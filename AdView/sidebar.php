<?php
// Lấy tên file hiện tại để xử lý trạng thái Active cho Menu
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Cakery Admin</h3>
        <small>Admin: <?php echo isset($_SESSION['user_admin']) ? $_SESSION['user_admin'] : 'Vũ Quốc Khải'; ?></small>
    </div>

    <ul class="list-unstyled components">
        <li class="<?php echo ($current_page == 'admin.php') ? 'active' : ''; ?>">
            <a href="admin.php"><i class="fa fa-home"></i> Tổng quan</a>
        </li>

        <li class="<?php echo ($current_page == 'admin_statistics.php') ? 'active' : ''; ?>">
            <a href="admin_statistics.php">
                <i class="fa fa-chart-line"></i> Thống kê doanh thu
            </a>
        </li>

        <li class="<?php echo ($current_page == 'admin_products.php') ? 'active' : ''; ?>">
            <a href="admin_products.php"><i class="fa fa-birthday-cake"></i> Quản lý Sản phẩm</a>
        </li>

        <li class="<?php echo ($current_page == 'admin_orders.php' || $current_page == 'admin_order_detail.php') ? 'active' : ''; ?>">
            <a href="admin_orders.php"><i class="fa fa-shopping-cart"></i> Đơn hàng</a>
        </li>

        <li class="<?php echo ($current_page == 'admin_customers.php') ? 'active' : ''; ?>">
            <a href="admin_customers.php"><i class="fa fa-users"></i> Khách hàng</a>
        </li>
        
        <li class="mt-5">
            <a href="../logout.php" class="logout-link">
                <i class="fa fa-sign-out-alt"></i> Thoát hệ thống
            </a>
        </li>
    </ul>
</nav>