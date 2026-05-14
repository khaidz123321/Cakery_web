<?php 
    session_start(); // Để hiện cái Popup Admin nếu cần
    require_once 'db_connect.php'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cakery - Liên hệ</title>
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
                <small>Ghé thăm trang chúng mình</small>
                <div class="h-100 d-inline-flex align-items-center">
                    <a class="btn-lg-square text-primary border-end rounded-0" href="https://www.facebook.com/profile.php?id=61586429619814"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn-lg-square text-primary pe-0" href="https://www.instagram.com/ca1ery/"><i class="fab fa-instagram"></i></a>
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
                <a href="contact.php" class="nav-item nav-link active">Liên hệ</a>
                <a href="membership.php" class="nav-item nav-link">Hội viên</a>
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


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center pt-5 pb-3">
            <h1 class="display-4 text-white animated slideInDown mb-3">Liên hệ</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Liên Hệ</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="text-primary text-uppercase mb-2">Liên hệ</p>
                <h1 class="display-6 mb-4">Đừng Ngần Ngại Gửi Lời Nhắn Cho Cakery Nhé!</h1>
            </div>
            <div class="row g-0 justify-content-center">
                <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                    
                    <div class="p-5 rounded shadow-sm" style="background-color: #FFF8EA;">
                        
                        <p class="text-center text-dark mb-4">Chúng mình luôn sẵn sàng lắng nghe mọi góp ý, thắc mắc hoặc yêu cầu đặt bánh thiết kế riêng của bạn. Vui lòng điền thông tin vào form dưới đây, đội ngũ chăm sóc khách hàng của Cakery sẽ phản hồi bạn trong thời gian sớm nhất nhé!</p>
                        
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-white text-dark" id="name" placeholder="Họ và tên">
                                        <label for="name" class="text-muted">Họ và tên</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control bg-white text-dark" id="email" placeholder="Email của bạn">
                                        <label for="email" class="text-muted">Email của bạn</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-white text-dark" id="subject" placeholder="Chủ đề">
                                        <label for="subject" class="text-muted">Chủ đề</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control bg-white text-dark" placeholder="Để lại lời nhắn tại đây" id="message" style="height: 200px"></textarea>
                                        <label for="message" class="text-muted">Nội dung lời nhắn</label>
                                    </div>
                                </div>
                                <div class="col-12 text-center mt-4">
                                    <button class="btn btn-primary rounded-pill py-3 px-5 text-uppercase fw-bold text-white" type="submit">Gửi Lời Nhắn</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


    <!-- Google Map Start -->
    <div class="container-xxl py-6 px-0 wow fadeInUp" data-wow-delay="0.1s">
        <iframe class="w-100 mb-n2" style="height: 450px; border:0;" 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.638864290715!2d105.79274721143491!3d20.967013080586238!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135acd872a8ea2d%3A0xfc88af226b4085a6!2zNiBOZy4gMjEgxJAuIFnDqm4gWMOhLCBZw6puIFjDoSwgVGhhbmggTGnhu4d0LCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1775155271726!5m2!1svi!2s" 
            frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0" 
            loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
    <!-- Google Map End -->


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