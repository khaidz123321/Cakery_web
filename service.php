<?php 
    session_start(); // Để hiện cái Popup Admin nếu cần
    require_once 'db_connect.php'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cakery - Dịch vụ</title>
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


    <!-- Topbar Start -->
     <!-- (container-fluid px-0): Giống như việc trải một tấm thảm, lệnh này bắt tấm thảm phải chiếm 100% màn hình, 
      đồng thời hút cạn mọi khe hở bên mép (px-0) để tấm thảm dán chặt vào hai bên lề trình duyệt.-->
    <div class="container-fluid top-bar bg-dark text-light px-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="row gx-0 align-items-center d-none d-lg-flex">
            <div class="col-lg-6 px-5 text-start">
                <!-- chèn dấu / sau mỗi tuy chọn-->
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="small text-light" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="small text-light" href="#">Career</a></li>
                    <li class="breadcrumb-item"><a class="small text-light" href="#">Terms</a></li>
                    <li class="breadcrumb-item"><a class="small text-light" href="#">Privacy</a></li>
                </ol>
            </div>
            <div class="col-lg-6 px-5 text-end">
                <small>Follow us:</small>
                <div class="h-100 d-inline-flex align-items-center">
                    <a class="btn-lg-square text-primary border-end rounded-0" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn-lg-square text-primary border-end rounded-0" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn-lg-square text-primary border-end rounded-0" href=""><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn-lg-square text-primary pe-0" href=""><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="index.php" class="navbar-brand ms-4 ms-lg-0">
            <h1 class="text-primary m-0">Tiệm Bánh Cakery</h1>
        </a>
        <!--khi màn hình bị thu nhỏ các chức năng ẩn đi -> hiện dấu 3 gạch đẻ chọn tuỳ chọn-->
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- giúp tự động thu gọn trên điện thoại-->
        <div class="collapse navbar-collapse" id="navbarCollapse">
            
            <div class="navbar-nav mx-auto p-4 p-lg-0">
                <a href="index.php" class="nav-item nav-link">Trang chủ</a>
                <a href="about.php" class="nav-item nav-link">Về chúng tôi</a>
                <a href="service.php" class="nav-item nav-link active">Dịch vụ</a>
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
            </div>
            <!-- shopping start -->
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
            <!-- shopping end -->
            </div>
    </nav>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center pt-5 pb-3">
            <h1 class="display-4 text-white animated slideInDown mb-3">Dịch vụ</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Dịch vụ</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Facts Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="fact-item bg-light rounded text-center h-100 p-5">
                        <i class="fa fa-certificate fa-4x text-primary mb-4"></i>
                        <p class="mb-2">Năm phục vụ</p>
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
                        <p class="mb-2">Mẫu bánh đa dạng</p>
                        <h1 class="display-5 mb-0" data-toggle="counter-up">20</h1>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.7s">
                    <div class="fact-item bg-light rounded text-center h-100 p-5">
                        <i class="fa fa-cart-plus fa-4x text-primary mb-4"></i>
                        <p class="mb-2">Chiếc bánh trao tay</p>
                        <h1 class="display-5 mb-0" data-toggle="counter-up">9436</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts End -->


<div class="container-xxl py-6">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="text-primary text-uppercase mb-2">Dịch vụ & Quyền lợi</p>
                    <h1 class="display-6 mb-4">Cakery Mang Đến Cho Bạn Những Trải Nghiệm Tuyệt Vời Nào?</h1>
                    <p class="mb-5" style="text-align: justify;">Không chỉ dừng lại ở một tiệm bánh ngọt thông thường, Cakery tự hào là người bạn đồng hành mang đến những giải pháp ẩm thực trọn vẹn. Từ những mẻ bánh nướng thơm lừng dùng hằng ngày, đến các dịch vụ thiết kế theo yêu cầu hay tổ chức tiệc chuyên nghiệp, chúng mình luôn sẵn sàng phục vụ bằng tất cả sự tận tâm và tiêu chuẩn khắt khe nhất.</p>
                    
                    <div class="row gy-5 gx-4">
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square border border-primary rounded-circle me-3" style="background: transparent;">
                                    <i class="fa fa-bread-slice text-primary fs-4"></i>
                                </div>
                                <h5 class="mb-0">Bánh Tươi Mỗi Ngày</h5>
                            </div>
                            <span style="text-align: justify; display: block;">Cam kết 100% nguyên liệu cao cấp, nướng mới mỗi bình minh, mang đến hương vị nguyên bản và an toàn tuyệt đối cho sức khỏe.</span>
                        </div>
                        
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.2s">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square border border-primary rounded-circle me-3" style="background: transparent;">
                                    <i class="fa fa-birthday-cake text-primary fs-4"></i>
                                </div>
                                <h5 class="mb-0">Thiết Kế Độc Bản</h5>
                            </div>
                            <span style="text-align: justify; display: block;">Biến ý tưởng của bạn thành hiện thực với những mẫu bánh kem nghệ thuật, đậm chất riêng cho các dịp sinh nhật, kỷ niệm.</span>
                        </div>
                        
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.3s">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square border border-primary rounded-circle me-3" style="background: transparent;">
                                    <i class="fa fa-cart-plus text-primary fs-4"></i>
                                </div>
                                <h5 class="mb-0">Đặt Hàng Dễ Dàng</h5>
                            </div>
                            <span style="text-align: justify; display: block;">Hệ thống website thông minh giúp bạn thảnh thơi lựa chọn và chốt đơn chiếc bánh yêu thích chỉ với vài thao tác lướt chạm.</span>
                        </div>
                        
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.4s">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square border border-primary rounded-circle me-3" style="background: transparent;">
                                    <i class="fa fa-truck text-primary fs-4"></i>
                                </div>
                                <h5 class="mb-0">Giao Hàng Tận Tay</h5>
                            </div>
                            <span style="text-align: justify; display: block;">Đội ngũ vận chuyển trang bị tủ giữ nhiệt chuyên dụng, đảm bảo bánh trao đến tay bạn luôn nguyên vẹn form dáng và độ mát lạnh.</span>
                        </div>

                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.5s">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square border border-primary rounded-circle me-3" style="background: transparent;">
                                    <i class="fa fa-coffee text-primary fs-4"></i>
                                </div>
                                <h5 class="mb-0">Tiệc Teabreak & Sự Kiện</h5>
                            </div>
                            <span style="text-align: justify; display: block;">Cung cấp trọn gói các dòng bánh ngọt, bánh mặn và đồ uống setup chỉn chu cho hội nghị, khai trương hay tiệc trà ấm cúng.</span>
                        </div>

                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.6s">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square border border-primary rounded-circle me-3" style="background: transparent;">
                                    <i class="fa fa-gift text-primary fs-4"></i>
                                </div>
                                <h5 class="mb-0">Hộp Quà Tặng Tinh Tế</h5>
                            </div>
                            <span style="text-align: justify; display: block;">Những set bánh cookies, macaron được đóng gói sang trọng, là lựa chọn hoàn hảo để thay lời tri ân gửi đến đối tác và người thân.</span>
                        </div>

                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.7s">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square border border-primary rounded-circle me-3" style="background: transparent;">
                                    <i class="fa fa-headphones text-primary fs-4"></i>
                                </div>
                                <h5 class="mb-0">Tư Vấn Tận Tâm 24/7</h5>
                            </div>
                            <span style="text-align: justify; display: block;">Đội ngũ chăm sóc khách hàng luôn sẵn sàng lắng nghe, hỗ trợ bạn tìm ra hương vị và kiểu dáng bánh hoàn hảo nhất cho mọi dịp.</span>
                        </div>

                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.8s">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0 btn-square border border-primary rounded-circle me-3" style="background: transparent;">
                                    <i class="fa fa-crown text-primary fs-4"></i>
                                </div>
                                <h5 class="mb-0">Đặc Quyền Hội Viên</h5>
                            </div>
                            <span style="text-align: justify; display: block;">Tích điểm đổi quà, nhận mã giảm giá bất ngờ vào ngày sinh nhật và vô vàn ưu đãi độc quyền chỉ dành riêng cho khách hàng thân thiết.</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="row img-twice service-frame position-relative h-100">
                        <div class="col-6">
                            <img class="img-fluid rounded" src="img/service-1.jpg" alt="Dịch vụ tiệm bánh Cakery">
                        </div>
                        <div class="col-6 align-self-end">
                            <img class="img-fluid rounded" src="img/service-2.jpg" alt="Giao hàng và đóng gói Cakery">
                        </div>

                        <div class="d-none d-lg-flex flex-column justify-content-center align-items-center position-absolute" style="top: 0; bottom: 0; left: 50%; transform: translateX(-50%); z-index: 10;">
                            <div class="decor-icon-circle shadow mb-4">
                                <i class="fa fa-bread-slice"></i>
                            </div>
                            <div class="decor-icon-circle shadow mb-4">
                                <i class="fa fa-truck"></i>
                            </div>
                            <div class="decor-icon-circle shadow">
                                <i class="fa fa-gift"></i>
                            </div>
                        </div>
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
</body>

</html>