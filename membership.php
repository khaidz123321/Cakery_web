<?php 
    session_start(); // Để hiện cái Popup Admin nếu cần
    require_once 'db_connect.php'; 
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Hội viên - Tiệm bánh Cakery</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link href="img/favicon.svg" rel="icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet"> 

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">

    <style>
        .btn-primary {
            color: #ffffff !important;
            background-color: #8B4513 !important; 
            border-color: #8B4513 !important;
        }

        .btn-primary:hover {
            color: #ffffff !important;
            background-color: #A0522D !important; 
            border-color: #A0522D !important;
        }

        .btn-primary:focus, .btn-primary:active {
            color: #ffffff !important;
            background-color: #A0522D !important; 
            border-color: #A0522D !important;
        }
    </style>
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
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <div class="container-fluid top-bar bg-dark text-light px-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="row gx-0 align-items-center d-none d-lg-flex">
            <div class="col-lg-6 px-5 text-start">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="small text-light" href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a class="small text-light" href="tuyen-dung.php">Tuyển dụng</a></li>
                    <li class="breadcrumb-item"><a class="small text-light" href="#">Điều khoản dịch vụ</a></li>
                </ol>
            </div>
            <div class="col-lg-6 px-5 text-end">
                <small>Ghé thăm trang của chúng mình:</small>
                <div class="h-100 d-inline-flex align-items-center">
                    <a class="btn-lg-square text-primary border-end rounded-0" href="https://www.facebook.com/profile.php?id=61586429619814"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn-lg-square text-primary pe-0" href="https://www.instagram.com/ca1ery/"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="index.php" class="navbar-brand ms-4 ms-lg-0">
            <h1 class="text-primary m-0">Tiệm Bánh Cakery</h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto p-4 p-lg-0">
                <a href="index.php" class="nav-item nav-link">Trang chủ</a>
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
                <a href="membership.php" class="nav-item nav-link active">Hội viên</a>
            </div>

            <div class="nav-item dropdown d-none d-lg-flex align-items-center ms-4">
                <a href="#" class="nav-link position-relative d-flex align-items-center justify-content-center flex-shrink-0 btn-lg-square border border-light rounded-circle text-primary p-0" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" style="width: 45px; height: 45px;">
                    <i class="fa fa-shopping-bag fs-5"></i>
                    <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px; padding: 4px 6px;">0</span>
                </a>
                
                <div class="dropdown-menu dropdown-menu-end p-0 shadow-lg border-0" style="width: 340px; border-radius: 8px; margin-top: 15px;">
                    <div class="p-3 border-bottom text-center bg-light fw-bold" style="border-radius: 8px 8px 0 0;">Giỏ hàng của bạn</div>
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
    <div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('img/carousel-1.jpg') center center no-repeat; background-size: cover; margin-bottom: 6rem;">
        <div class="container text-center pt-5 pb-3">
            <h1 class="display-4 text-white animated slideInDown mb-3 mt-5">Chương Trình Hội Viên</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Hội viên</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-xxl py-6">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="text-primary text-uppercase mb-2">Đặc quyền riêng bạn</p>
                <h1 class="display-6 mb-4">Trở thành hội viên của Cakery</h1>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="p-5 h-100 rounded shadow-sm text-center" style="background-color: #FFF8EA; border: 1px solid #e1d1b5;">
                        <i class="fa fa-medal fa-3x text-secondary mb-4"></i>
                        <h3 class="mb-3">Hạng BẠC</h3>
                        <h4 class="text-primary mb-4">Miễn Phí</h4>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2"><i class="fa fa-check text-primary me-2"></i>Tích điểm 2% đơn hàng</li>
                            <li class="mb-2"><i class="fa fa-check text-primary me-2"></i>Free ship (1km)</li>
                        </ul>
                        <button type="button" class="btn btn-primary rounded-pill py-3 px-5" data-bs-toggle="modal" data-bs-target="#registerModal">Đăng Ký</button>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="p-5 h-100 rounded shadow-lg text-center border border-primary position-relative" style="background-color: #ffffff; transform: scale(1.05); z-index: 1;">
                        <div class="bg-primary text-white position-absolute top-0 start-50 translate-middle px-3 py-1 rounded-pill" style="font-size: 0.8rem;">PHỔ BIẾN</div>
                        <i class="fa fa-crown fa-3x text-primary mb-4"></i>
                        <h3 class="mb-3">Hạng VÀNG</h3>
                        <h4 class="text-primary mb-4">199k <small class="text-muted fw-light">/năm</small></h4>
                        <ul class="list-unstyled mb-4 text-start ms-4">
                            <li class="mb-2"><i class="fa fa-check text-primary me-2"></i>Tích điểm 5% đơn hàng</li>
                            <li class="mb-2"><i class="fa fa-check text-primary me-2"></i>Nhận Voucher lên tới 100k mỗi tháng</li>
                            <li class="mb-2"><i class="fa fa-check text-primary me-2"></i>Free ship (3km)</li>
                        </ul>
                        <button type="button" class="btn btn-primary rounded-pill py-3 px-5" data-bs-toggle="modal" data-bs-target="#registerModal">Nâng Cấp</button>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="p-5 h-100 rounded shadow-sm text-center" style="background-color: #FFF8EA; border: 1px solid #e1d1b5;">
                        <i class="fa fa-gem fa-3x text-info mb-4"></i>
                        <h3 class="mb-3">KIM CƯƠNG</h3>
                        <h4 class="text-primary mb-4">499k <small class="text-muted fw-light">/năm</small></h4>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2"><i class="fa fa-check text-primary me-2"></i>Tích điểm 10% đơn hàng</li>
                            <li class="mb-2"><i class="fa fa-check text-primary me-2"></i>Tặng 01 bánh/tháng</li>
                        </ul>
                        <button type="button" class="btn btn-primary rounded-pill py-3 px-5" data-bs-toggle="modal" data-bs-target="#registerModal">Nâng Cấp</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Start -->
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
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top" style="background-color: #EAA636 !important; border-color: #EAA636 !important;"><i class="bi bi-arrow-up"></i></a>
    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <script src="js/main.js"></script>
    <script src="js/cart.js"></script>

    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white border-0">
            <h5 class="modal-title text-white" id="registerModalLabel">Đăng Ký Hội Viên Cakery</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-4">
            <div class="row g-4">
                <div class="col-md-6 border-end-md">
                    <h6 class="text-primary mb-3 text-uppercase border-bottom pb-2">1. Thông tin cá nhân</h6>
                    <form>
                        <div class="mb-3">
                            <label for="fullName" class="form-label small">Họ và tên *</label>
                            <input type="text" class="form-control bg-light" id="fullName" placeholder="Nhập tên của bạn" required>
                        </div>
                        <div class="mb-3">
                            <label for="phoneNumber" class="form-label small">Số điện thoại *</label>
                            <input type="tel" class="form-control bg-light" id="phoneNumber" placeholder="Nhập số điện thoại" required>
                        </div>
                        <div class="mb-3">
                            <label for="memberTier" class="form-label small">Gói hội viên muốn đăng ký *</label>
                            <select class="form-select bg-light" id="memberTier">
                                <option value="bac">Hạng Bạc (Miễn phí)</option>
                                <option value="vang" selected>Hạng Vàng (199.000đ/năm)</option>
                                <option value="kimcuong">Hạng Kim Cương (499.000đ/năm)</option>
                            </select>
                        </div>
                    </form>
                </div>
                
                <div class="col-md-6">
                    <h6 class="text-primary mb-3 text-uppercase border-bottom pb-2">2. Thanh toán chuyển khoản</h6>
                    <div class="bg-light p-3 rounded text-dark">
                        <p class="mb-2 small"><strong>Ngân hàng:</strong> BIDV</p>
                        <p class="mb-2 small"><strong>Số tài khoản:</strong> 1234567890</p>
                        <p class="mb-2 small"><strong>Chủ tài khoản:</strong> VU QUOC KHAI</p>
                        <p class="mb-2 small"><strong>Nội dung chuyển khoản:</strong></p>
                        <div class="p-2 border border-danger rounded text-center mb-2 bg-white">
                            <span class="text-danger fw-bold">[SĐT của bạn] + [Tên Gói]</span>
                        </div>
                        <p class="small text-muted mb-0"><em>Ví dụ: 0987654321 GOI VANG</em></p>
                    </div>
                    
                    <div class="mt-3 small text-muted">
                        <i class="fa fa-info-circle text-primary me-1"></i>
                        <em>Sau khi chuyển khoản, vui lòng nhấn "Xác nhận gửi". Cakery sẽ kiểm tra và kích hoạt hạng thẻ cho bạn trong vòng 24h!</em>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer border-0 justify-content-center pb-4">
            <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Đóng lại</button>
            <button type="button" class="btn btn-primary rounded-pill px-5 fw-bold">Xác Nhận Gửi</button>
          </div>
        </div>
      </div>
    </div>
</body>

</html>