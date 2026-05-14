<?php 
    session_start(); // Bắt buộc phải có cái này để chạy Popup đăng nhập
    require_once 'db_connect.php'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Tiệm bánh Cakery</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.svg" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>


<!-- start nhúng file social_plugin để hiển thị -->
<div id="contact-placeholder"></div>
<script>
    fetch("social_plugin.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById('contact-placeholder').innerHTML = data;
        });
</script>
<!-- end nhúng -->

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start (thanh trên cùng)-->
    <div class="container-fluid top-bar bg-dark text-light px-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="row gx-0 align-items-center d-none d-lg-flex">
            <div class="col-lg-6 px-5 text-start">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="small text-light" href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a class="small text-light" href="#">Tuyển dụng</a></li>
                    <li class="breadcrumb-item"><a class="small text-light" href="#">Điều khoản dịch vụ</a></li>
                    <li class="breadcrumb-item"><a class="small text-light" href="#">Chính sách bảo mật</a></li>
                </ol>
            </div>
            <div class="col-lg-6 px-5 text-end">
                <small>Ghé thăm trang của chúng mình:</small>
                <div class="h-100 d-inline-flex align-items-center">

                    <!-- lệnh href để gắn link điều hướng -->
                    <a class="btn-lg-square text-primary border-end rounded-0" href="https://www.facebook.com/profile.php?id=61586429619814"><i class="fab fa-facebook-f"></i></a> 
                    <a class="btn-lg-square text-primary pe-0" href="https://www.instagram.com/ca1ery/"><i class="fab fa-instagram"></i></a>

                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start (thanh điều hướng)-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="index.php" class="navbar-brand ms-4 ms-lg-0">
            <h1 class="text-primary m-0">Tiệm bánh Cakery</h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto p-4 p-lg-0">
                <a href="index.php" class="nav-item nav-link active">Trang chủ</a>
                <a href="about.php" class="nav-item nav-link">Về chúng tôi</a>
                <a href="service.php" class="nav-item nav-link">Dịch vụ</a>
                <div class="nav-item dropdown">
                    <a href="product.php" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Sản phẩm</a>
                    <div class="dropdown-menu m-0">
                        <a href="product.php?category=all" class="dropdown-item">Tất cả sản phẩm</a>
                        <a href="product.php?category=banh-sinh-nhat" class="dropdown-item">Bánh Sinh Nhật</a>
                        <a href="product.php?category=banh-ngot" class="dropdown-item">Bánh Ngọt</a>
                        <a href="product.php?category=banh-cookies" class="dropdown-item">Bánh Cookies</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Khám phá</a>
                    <div class="dropdown-menu m-0">
                        <a href="team.php" class="dropdown-item">Đội ngũ của chúng tôi</a>
                        <a href="testimonial.php" class="dropdown-item">Đánh giá</a>
                        <a href="carrer.php" class="dropdown-item">Tuyển dụng</a>
                    </div>
                </div>
                <a href="contact.php" class="nav-item nav-link">Liên hệ</a>
                <a href="membership.php" class="nav-item nav-link">Hội viên</a>
                <!-- 🌟 THÊM NÚT TRA CỨU ĐƠN HÀNG VÀO ĐÂY 🌟 -->
                <a href="#" data-bs-toggle="modal" data-bs-target="#trackOrderModal" class="nav-item nav-link fw-bold" style="color: #EAA636;">
                    <i class="fa fa-truck me-1"></i> Tra cứu đơn hàng
                </a>
                <!-- ====================================== -->
                <a href="#" onclick="document.getElementById('loginPopup').style.display='block'" class="nav-item nav-link">
                    <i class="fa fa-user-shield"></i> Admin
                </a>
            </div>
            <div class="nav-item dropdown d-none d-lg-flex align-items-center ms-4">
                <a href="#" class="nav-link position-relative d-flex align-items-center justify-content-center flex-shrink-0 btn-lg-square border border-light rounded-circle text-primary p-0" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" style="width: 45px; height: 45px;">
                    <i class="fa fa-shopping-bag fs-5"></i>
                    <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px; padding: 4px 6px;">0</span>
                </a>
                
                <div class="dropdown-menu dropdown-menu-end p-0 shadow-lg border-0" style="width: 340px; border-radius: 8px; margin-top: 15px;">
                    <div class="p-3 border-bottom text-center bg-light fw-bold" style="border-radius: 8px 8px 0 0;">
                        Giỏ hàng của bạn
                    </div>
                    
                    <div id="cart-items" class="p-3" style="max-height: 300px; overflow-y: auto;">
                        <p class="text-center text-muted my-3">Giỏ hàng đang trống</p>
                    </div>
                    
                    <div class="p-3 border-top">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted" style="font-size: 14px;">TỔNG TIỀN:</span>
                            <span id="cart-total" class="fw-bold text-danger fs-5">0đ</span>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="cart.php" class="btn btn-outline-dark w-50 rounded-0" style="font-size: 14px;">GIỎ HÀNG</a>
                            <a href="checkout.php" class="btn w-50 rounded-0 text-white" style="background-color: #5c3d3a; font-size: 14px;">THANH TOÁN</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Carousel Start (Banner trượt)--> 
    <div class="container-fluid p-0 pb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="img/carousel-1.jpg" alt="">
                <div class="owl-carousel-inner">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-lg-8">
                                <p class="text-primary text-uppercase fw-bold mb-2">Tiệm bánh Cakery</p>
                                <h1 class="display-1 text-light mb-4 animated slideInDown">Gói Trọn Yêu Thương Trong Từng Vị Bánh</h1>
                                <p class="text-light fs-5 mb-4 pb-3">Nhận thiết kế bánh theo yêu cầu</p>
                                <a href="product.php" class="btn btn-primary rounded-pill py-3 px-5">Xem Sản Phẩm</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="img/carousel-2.jpg" alt="">
                <div class="owl-carousel-inner">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-lg-8">
                                <p class="text-primary text-uppercase fw-bold mb-2">Tiệm Bánh Cakery</p>
                                <h1 class="display-1 text-light mb-4 animated slideInDown">Lưu Giữ Trọn Vẹn Từng Khoảnh Khắc</h1>
                                <p class="text-light fs-5 mb-4 pb-3">Nhận thiết kế bánh theo yêu cầu</p>
                                <a href="product.php" class="btn btn-primary rounded-pill py-3 px-5">Xem Sản Phẩm</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Facts Start (thống kê thực tế)-->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="fact-item bg-light rounded text-center h-100 p-5">
                        <i class="fa fa-certificate fa-4x text-primary mb-4"></i>
                        <p class="mb-2">Năm Phục Vụ</p>
                        <h1 class="display-5 mb-0" data-toggle="counter-up">50</h1>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.3s">
                    <div class="fact-item bg-light rounded text-center h-100 p-5">
                        <i class="fa fa-users fa-4x text-primary mb-4"></i>
                        <p class="mb-2">Đội ngũ chuyên nghiệp</p>
                        <h1 class="display-5 mb-0" data-toggle="counter-up">170</h1>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="fact-item bg-light rounded text-center h-100 p-5">
                        <i class="fa fa-cookie-bite fa-4x text-primary mb-4"></i>
                        <p class="mb-2">Mẫu Bánh Đa Dạng</p>
                        <h1 class="display-5 mb-0" data-toggle="counter-up">20</h1>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.7s">
                    <div class="fact-item bg-light rounded text-center h-100 p-5">
                        <i class="fa fa-cart-plus fa-4x text-primary mb-4"></i>
                        <p class="mb-2">Chiếc Bánh Trao Tay</p>
                        <h1 class="display-5 mb-0" data-toggle="counter-up">9436</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts End -->


    <!-- About Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="row img-twice position-relative h-100">
                        <div class="col-6">
                            <img class="img-fluid rounded" src="img/about-1.jpg" alt="">
                        </div>
                        <div class="col-6 align-self-end">
                            <img class="img-fluid rounded" src="img/about-2.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                        <p class="text-primary text-uppercase mb-2">Về chúng tôi</p>
                        <h1 class="display-6 mb-4">Câu chuyện của chúng mình</h1>
                        <p>Chào mừng bạn đến với tiệm bánh của chúng tôi, nơi mỗi chiếc bánh không chỉ là một món tráng miệng, mà còn là một tác phẩm nghệ thuật được tạo ra từ sự đam mê và tâm huyết. Chúng tôi tin rằng, một chiếc bánh ngon phải bắt đầu từ những nguyên liệu tươi mới và chất lượng nhất, được chọn lọc kỹ càng mỗi ngày.</p>
                        <p>Với đội ngũ thợ làm bánh lành nghề và tận tâm, chúng tôi luôn chăm chút tỉ mỉ từng chi tiết nhỏ nhất – từ cốt bánh mềm xốp, lớp kem thanh mát, đến cách trang trí tinh tế. Dù là bánh sinh nhật thiết kế riêng hay những chiếc bánh ngọt ăn vặt hàng ngày, chúng tôi luôn nỗ lực mang đến hương vị trọn vẹn, giúp bạn lưu giữ những khoảnh khắc ngọt ngào nhất bên người thân yêu.</p>
                        <div class="row g-2 mb-4">
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Nguyên liệu tươi mới
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Thiết kế theo yêu cầu
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Đặt bánh nhanh chóng
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Giao tận nơi
                            </div>
                        </div>
                        <a class="btn btn-primary rounded-pill py-3 px-5" href="about.php">Tìm hiểu thêm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Product Start (thanh sản phẩm)-->
    <div class="container-xxl bg-light my-6 py-6 pt-0">
        <div class="container">
            <div class="bg-primary text-light rounded-bottom p-5 my-6 mt-0 wow fadeInUp" data-wow-delay="0.1s">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6">
                        <h1 class="display-4 text-light mb-0">Thực Đơn</h1>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <div class="d-inline-flex align-items-center text-start">
                            <i class="fa fa-phone-alt fa-4x flex-shrink-0"></i>
                            <div class="ms-4">
                                <p class="fs-5 fw-bold mb-0">Hỗ Trợ Đặt Bánh</p>
                                <p class="fs-1 fw-bold mb-0">+84 846271105</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="text-primary text-uppercase mb-2">Cakery</p>
                <h1 class="display-6 mb-4">Khám Phá Các Mẫu Bánh</h1>
            </div>

            <div class="row g-4">
                <?php
                // Truy vấn lấy 3 sản phẩm mới nhất từ bảng product
                $sql = "SELECT * FROM product ORDER BY ProductID DESC LIMIT 3";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    $delay = 0.1; // Khởi tạo độ trễ ban đầu cho hiệu ứng wow
                    while($row = $result->fetch_assoc()) {
                ?>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="<?php echo $delay; ?>s">
                        <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100 shadow-sm">
                            <div class="text-center p-4">
                                <div class="d-inline-block border border-primary rounded-pill px-3 mb-3">
                                    <?php echo number_format($row['Price'], 0, ',', '.'); ?> vnd
                                </div>
                                <h3 class="mb-3"><?php echo $row['ProductName']; ?></h3>
                                <span><?php echo $row['Description']; ?></span>
                            </div>
                            <div class="position-relative mt-auto">
                                <img class="img-fluid" src="<?php echo $row['Image']; ?>" alt="<?php echo $row['ProductName']; ?>" style="width: 100%; height: 250px; object-fit: cover;">
                                <div class="product-overlay">
                                    <a class="btn btn-lg-square btn-outline-light rounded-circle" href="product_detail.php?id=<?php echo $row['ProductID']; ?>">
                                        <i class="fa fa-eye text-primary"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php 
                    $delay += 0.2; // Tăng độ trễ cho ô tiếp theo (0.1 -> 0.3 -> 0.5)
                    } 
                } else {
                    echo "<p class='text-center w-100'>Tiệm đang cập nhật các mẫu bánh mới, Khải quay lại sau nhé!</p>";
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Product End -->


    <!-- Service Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="text-primary text-uppercase mb-2">Đặc quyền tại tiệm</p>
                    <h1 class="display-6 mb-4">Bạn nhận được những gì?</h1>
                    <p class="mb-5">Tại Tiệm Bánh Cakery, chúng tôi không chỉ trao tay những chiếc bánh thơm ngon, mà còn gửi gắm vào đó sự chăm sóc tận tâm để mỗi trải nghiệm của bạn đều trở nên hoàn hảo và trọn vẹn.</p>
                    <div class="row gy-5 gx-4">
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                    <i class="fa fa-bread-slice text-white"></i>
                                </div>
                                <h5 class="mb-0">Hương Vị Thuần Khiết</h5>
                            </div>
                            <span>Mỗi chiếc bánh là sự kết tinh từ nguyên liệu tự nhiên, được nướng mỗi ngày bằng cả tâm huyết.</span>
                        </div>
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.2s">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                    <i class="fa fa-birthday-cake text-white"></i>
                                </div>
                                <h5 class="mb-0">Cá Nhân Hóa Ý Tưởng</h5>
                            </div>
                            <span>Chúng mình lắng nghe câu chuyện của bạn để tạo ra những mẫu bánh độc bản, mang dấu ấn cá nhân riêng biệt.</span>
                        </div>
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.3s">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                    <i class="fa fa-cart-plus text-white"></i>
                                </div>
                                <h5 class="mb-0">Đặt Bánh Nhanh Chóng</h5>
                            </div>
                            <span>Dù bạn ở đâu, chỉ cần một tin nhắn, những món quà ngọt ngào sẽ luôn sẵn sàng chờ đợi bạn.</span>
                        </div>
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.4s">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle me-3">
                                    <i class="fa fa-truck text-white"></i>
                                </div>
                                <h5 class="mb-0">Giao Hàng Trọn Vẹn</h5>
                            </div>
                            <span>Bánh được đóng gói kỹ lưỡng và vận chuyển chuyên nghiệp, cam kết tươi mới đến tận cửa nhà bạn.</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="row img-twice position-relative h-100">
                        <div class="col-6">
                            <img class="img-fluid rounded" src="img/service-1.jpg" alt="">
                        </div>
                        <div class="col-6 align-self-end">
                            <img class="img-fluid rounded" src="img/service-2.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Team Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="text-primary text-uppercase mb-2">Đội Ngũ Của Chúng Tôi</p>
                <h1 class="display-6 mb-4">Thợ Bánh Tâm Huyết</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <img class="img-fluid" src="img/team-1.jpg" alt="">
                        <div class="team-text">
                            <div class="team-title">
                                <h5>Vũ Cuốc Cải</h5>
                                <span>Bếp Trưởng</span>
                            </div>
                            <div class="team-social">
                                <a class="btn btn-square btn-light rounded-circle" href="https://www.facebook.com/dave.gray.948017/"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-light rounded-circle" href="https://www.instagram.com/q.khair_/"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <img class="img-fluid" src="img/team-2.jpg" alt="">
                        <div class="team-text">
                            <div class="team-title">
                                <h5>Trần Nhâm Oanh</h5>
                                <span>Chuyên Gia Trang Trí Bánh</span>
                            </div>
                            <div class="team-social">
                                <a class="btn btn-square btn-light rounded-circle" href="https://www.facebook.com/cunyeuowii"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-light rounded-circle" href="https://www.instagram.com/cunyeu.owii_/"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <img class="img-fluid" src="img/team-3.jpg" alt="">
                        <div class="team-text">
                            <div class="team-title">
                                <h5>Nguyễn Văn Bơ</h5>
                                <span>Chủ Tiệm</span>
                            </div>
                            <div class="team-social">
                                <a class="btn btn-square btn-light rounded-circle" href="https://www.facebook.com/profile.php?id=61586429619814"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-light rounded-circle" href="https://www.instagram.com/ca1ery/"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <img class="img-fluid" src="img/team-4.jpg" alt="">
                        <div class="team-text">
                            <div class="team-title">
                                <h5>Trần Thông Minh</h5>
                                <span>Phụ Bếp</span>
                            </div>
                            <div class="team-social">
                                <a class="btn btn-square btn-light rounded-circle" href="https://www.facebook.com/profile.php?id=100057527406287"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-light rounded-circle" href="https://www.instagram.com/cunyeu.dayy_/"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Testimonial Start -->
    <div class="container-xxl bg-light my-6 py-6 pb-0">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="text-primary text-uppercase mb-2">Chia sẻ từ khách hàng</p>
                <h1 class="display-6 mb-4">Lan tỏa hương vị đến hơn 20000 thực khách</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                <div class="testimonial-item bg-white rounded p-4">
                    <div class="d-flex align-items-center mb-4">
                        <img class="flex-shrink-0 rounded-circle border p-1" src="img/testimonial-1.jpg" alt="">
                        <div class="ms-4">
                            <h5 class="mb-1">Chị Minh Anh</h5>
                            <span>Khách hàng thân thiết</span>
                        </div>
                    </div>
                    <p class="mb-0">Bánh ở đây luôn tươi mới và có độ ngọt rất vừa phải. Gia đình mình cực kỳ thích cốt bánh mềm xốp của tiệm!</p>
                </div>
                <div class="testimonial-item bg-white rounded p-4">
                    <div class="d-flex align-items-center mb-4">
                        <img class="flex-shrink-0 rounded-circle border p-1" src="img/testimonial-2.jpg" alt="">
                        <div class="ms-4">
                            <h5 class="mb-1">Anh Quốc Bảo</h5>
                            <span>Nhiếp ảnh gia</span>
                        </div>
                    </div>
                    <p class="mb-0">Mình từng đặt bánh sinh nhật thiết kế riêng tại tiệm, kết quả thật bất ngờ vì bánh giống hệt mẫu và cực kỳ nghệ thuật.</p>
                </div>
                <div class="testimonial-item bg-white rounded p-4">
                    <div class="d-flex align-items-center mb-4">
                        <img class="flex-shrink-0 rounded-circle border p-1" src="img/testimonial-3.jpg" alt="">
                        <div class="ms-4">
                            <h5 class="mb-1">Anh Phùng Thanh Độ</h5>
                            <span>Streamer</span>
                        </div>
                    </div>
                    <p class="mb-0">Bánh kem của tiệm rất đặc biệt, kem mịn không bị ngọt gắt nên các bé nhà mình ăn rất ngon miệng. Chắc chắn mình sẽ còn ủng hộ tiệm dài dài.</p>
                </div>
                <div class="testimonial-item bg-white rounded p-4">
                    <div class="d-flex align-items-center mb-4">
                        <img class="flex-shrink-0 rounded-circle border p-1" src="img/testimonial-4.jpg" alt="">
                        <div class="ms-4">
                            <h5 class="mb-1">Bạn Thu Thảo</h5>
                            <span>Nhân viên văn phòng</span>
                        </div>
                    </div>
                    <p class="mb-0">Dịch vụ giao hàng rất chuyên nghiệp, bánh kem đến nơi vẫn còn nguyên vẹn và lạnh sâu. Rất đáng tiền!</p>
                </div>
            </div>
            <div class="bg-primary text-light rounded-top p-5 my-6 mb-0 wow fadeInUp" data-wow-delay="0.1s">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h1 class="display-4 text-light mb-0">Theo dõi chúng mình để nhận tin mới nhất</h1>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="position-relative">
                            <input class="form-control bg-transparent border-light w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                            <button type="button" class="btn btn-dark py-2 px-3 position-absolute top-0 end-0 mt-2 me-2">Đăng Ký</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    <!-- Footer Start (Chân Trang)-->
    <div class="container-fluid bg-dark text-light footer my-6 mb-0 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Địa chỉ</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>6/9/21, Yên Xá, Tân Triều, Hà Nội</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>0846271105</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>vuquockhai88@gmail.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href="https://www.facebook.com/profile.php?id=61586429619814"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href="https://www.youtube.com/@TheScandinavianFikaYT"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Khám phá</h4>
                    <a class="btn btn-link" href="">Về chúng tôi</a>
                    <a class="btn btn-link" href="">Liên hệ</a>
                    <a class="btn btn-link" href="">Chăm sóc khách hàng</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Chính sách và điều khoản</h4>
                    <a class="btn btn-link" href="">Điều khoản & Dịch vụ</a>
                    <a class="btn btn-link" href="">Chính sách vận chuyển</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Fanpage</h4>
                    <div class="w-100 bg-white rounded overflow-hidden">
                        <iframe 
                            src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fprofile.php%3Fid%3D61586429619814&tabs=&width=340&height=200&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" 
                            width="100%" 
                            height="200" 
                            style="border:none;overflow:hidden" 
                            scrolling="no" 
                            frameborder="0" 
                            allowfullscreen="true" 
                            allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright text-light py-4 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a href="#">Since 2026</a>, All Right Reserved.
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    Thiết kế: <a href="">Cakery</a>
                    <br>Bản quyền thuộc về: <a class="border-bottom" href="" target="_blank">Cakery</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script src="js/cart.js"></script>

<div id="loginPopup" style="display:none; position: fixed; z-index: 1001; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); backdrop-filter: blur(5px);">
        
        <div style="background: white; width: 420px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); padding: 40px; border-radius: 15px; box-shadow: 0 15px 35px rgba(0,0,0,0.4);">
            
            <span onclick="document.getElementById('loginPopup').style.display='none'" style="position: absolute; right: 20px; top: 15px; cursor: pointer; font-size: 28px; color: #888;">&times;</span>
            <h2 style="text-align: center; color: #333; margin-bottom: 25px; font-family: 'Playfair Display', serif;">Admin Login</h2>
            
            <form action="process_login.php" method="POST">
                <input type="text" name="username" placeholder="Tên đăng nhập" required style="width: 100%; padding: 12px 15px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 8px; font-size: 16px;">
                <input type="password" name="password" placeholder="Mật khẩu" required style="width: 100%; padding: 12px 15px; margin-bottom: 25px; border: 1px solid #ccc; border-radius: 8px; font-size: 16px;">
                <button type="submit" name="login_btn" style="width: 100%; background: #cda45e; color: white; padding: 14px; border: none; border-radius: 8px; cursor: pointer; font-size: 16px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">Đăng nhập</button>
            </form>
            
        </div>
    </div>
    <!-- ================= MODAL TRA CỨU ĐƠN HÀNG (Không dùng AJAX) ================= -->
    <div class="modal fade" id="trackOrderModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header text-white" style="background-color: #5c3d3a;">
            <h5 class="modal-title text-white"><i class="fa fa-search me-2"></i>Tra Cứu Đơn Hàng</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-4">
            <!-- Form chuyển hướng thẳng tới trang track_order.php -->
            <form action="track_order.php" method="POST">
                <div class="mb-3">
                    <label class="form-label fw-bold">Mã đơn hàng (VD: 12 hoặc #CAKE-12)</label>
                    <input type="text" name="order_id" class="form-control" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Số điện thoại đặt hàng</label>
                    <input type="tel" name="phone" class="form-control" required>
                </div>
                <button type="submit" name="btn_track" class="btn w-100 fw-bold" style="background-color: #EAA636; color: white;">Tra Cứu Ngay</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- ================= END MODAL ================= -->
</body>

</html>