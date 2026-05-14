<?php
session_start();
require_once 'db_connect.php';

// XỬ LÝ KHI NGƯỜI DÙNG BẤM NÚT "XÁC NHẬN ĐẶT HÀNG"
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['place_order'])) {
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $note = $_POST['note'];
    $total_price = $_POST['total_price'];
    
    // Giải mã dữ liệu giỏ hàng
    $cart_data = json_decode($_POST['cart_data'], true);

    if (empty($cart_data)) {
        echo "<script>alert('Giỏ hàng trống! Vui lòng chọn bánh trước khi đặt.'); window.location.href='product.php';</script>";
    } else {
        $order_date = date('Y-m-d H:i:s');
        $status = 'Pending'; // Trạng thái mặc định khớp với Admin

        // 1. LƯU VÀO BẢNG `Order` (Cập nhật tên bảng và cột mới)
        $stmt = $conn->prepare("INSERT INTO `Order` (CustomerName, CustomerPhone, TotalAmount, Status, Address, Note, AdminID, OrderDate) VALUES (?, ?, ?, ?, ?, ?, NULL, ?)");
        $stmt->bind_param("ssdssss", $fullname, $phone, $total_price, $status, $address, $note, $order_date);

        if ($stmt->execute()) {
            $order_id = $conn->insert_id; 

            // 2. LƯU VÀO BẢNG `OrderDetail` (Cập nhật cột PriceAtOrder)
            $stmt_detail = $conn->prepare("INSERT INTO OrderDetail (OrderID, ProductID, Quantity, PriceAtOrder) VALUES (?, ?, ?, ?)");
            
            foreach ($cart_data as $item) {
                $prod_id = $item['id'];
                $qty = $item['quantity'];
                $price = $item['price'];
                $stmt_detail->bind_param("iiid", $order_id, $prod_id, $qty, $price);
                $stmt_detail->execute();
            }

            // 3. THÀNH CÔNG -> Xóa đúng key 'cakeryCart'
            echo "<script>
                    localStorage.removeItem('cakeryCart'); 
                    alert('🎉 Đặt hàng thành công! Mã đơn của bạn là: #CAKE-$order_id');
                    window.location.href = 'index.php';
                  </script>";
            exit();
        } else {
            echo "<script>alert('Lỗi lưu đơn hàng: " . $conn->error . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Thanh Toán - Cakery</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center py-5" style="min-height: 100vh;">
    
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="display-4 text-primary fw-bold">Hoàn Tất Đơn Hàng</h1>
            <p class="fs-4 text-muted">Vui lòng điền thông tin giao hàng của bạn</p>
        </div>

        <div class="row g-5">
            <div class="col-lg-7">
                <div class="bg-white p-5 rounded shadow-sm">
                    <form action="checkout.php" method="POST" id="checkoutForm">
                        <h3 class="mb-4 fw-bold border-bottom pb-3">Thông tin giao hàng</h3>
                        
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label fs-5 fw-bold">Họ và tên người nhận *</label>
                                <input type="text" class="form-control form-control-lg" name="fullname" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fs-5 fw-bold">Số điện thoại *</label>
                                <input type="tel" class="form-control form-control-lg" name="phone" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fs-5 fw-bold">Địa chỉ giao hàng chi tiết *</label>
                                <input type="text" class="form-control form-control-lg" name="address" placeholder="Số nhà, tên đường..." required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fs-5 fw-bold">Ghi chú (Tùy chọn)</label>
                                <textarea class="form-control form-control-lg" name="note" rows="3"></textarea>
                            </div>
                        </div>

                        <input type="hidden" name="cart_data" id="cart_data_input">
                        <input type="hidden" name="total_price" id="total_price_input">

                        <div class="d-flex gap-3 mt-5">
                            <a href="product.php" class="btn btn-light btn-lg w-50 border">Quay lại</a>
                            <button type="submit" name="place_order" class="btn btn-primary btn-lg w-50 fw-bold">Xác nhận Đặt Hàng</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="bg-white p-5 rounded shadow-sm h-100">
                    <h3 class="mb-4 fw-bold border-bottom pb-3">Tóm tắt đơn hàng</h3>
                    <div id="checkout-cart-items" class="mb-4"></div>
                    <div class="border-top pt-4 d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold">Tổng thanh toán:</h4>
                        <h3 class="mb-0 text-danger fw-bold" id="checkout-total">0đ</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Lấy đúng key 'cakeryCart'
            let cart = JSON.parse(localStorage.getItem('cakeryCart')) || [];
            
            if (cart.length === 0) {
                alert("Giỏ hàng của bạn đang trống!");
                window.location.href = "product.php";
                return;
            }

            let cartItemsContainer = document.getElementById('checkout-cart-items');
            let totalDisplay = document.getElementById('checkout-total');
            let cartDataInput = document.getElementById('cart_data_input');
            let totalPriceInput = document.getElementById('total_price_input');

            let total = 0;
            let html = '';

            cart.forEach(item => {
                let itemTotal = item.price * item.quantity;
                total += itemTotal;
                html += `
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex align-items-center">
                            <img src="${item.image}" style="width: 70px; height: 70px; object-fit: cover; border-radius: 8px;">
                            <div class="ms-3">
                                <h6 class="mb-0 fw-bold">${item.name}</h6>
                                <small class="text-muted">SL: ${item.quantity}</small>
                            </div>
                        </div>
                        <span class="fw-bold">${itemTotal.toLocaleString('vi-VN')}đ</span>
                    </div>`;
            });

            cartItemsContainer.innerHTML = html;
            totalDisplay.innerText = total.toLocaleString('vi-VN') + 'đ';

            // Gán giá trị cho input ẩn để gửi lên PHP
            cartDataInput.value = JSON.stringify(cart);
            totalPriceInput.value = total;
        });
    </script>
</body>
</html>