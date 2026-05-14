<?php 
    session_start(); // Để hiện cái Popup Admin nếu cần
    require_once 'db_connect.php'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cakery - Về chúng tôi</title>
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
                    <li class="breadcrumb-item"><a class="small text-light" href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a class="small text-light" href="#">Tuyển dụng</a></li>
                    <li class="breadcrumb-item"><a class="small text-light" href="#">Điều khoản dịch vụ</a></li>
                    <li class="breadcrumb-item"><a class="small text-light" href="#">Chính sách bảo mật</a></li>
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
                <a href="about.php" class="nav-item nav-link active">Về chúng tôi</a>
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
            <h1 class="display-4 text-white animated slideInDown mb-3">Về chúng tôi</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Về chúng tôi</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- About Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="row img-twice position-relative h-100">
                        <div class="col-6">
                            <img class="img-fluid rounded" src="img/about-1.jpg" alt="Không gian tiệm bánh Cakery">
                        </div>
                        <div class="col-6 align-self-end">
                            <img class="img-fluid rounded" src="img/about-2.jpg" alt="Thợ bánh Cakery làm việc">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                        <p class="text-primary text-uppercase mb-2">Hành trình của Cakery</p>
                        <h1 class="display-6 mb-4">Từ Căn Bếp Nhỏ Đến Giấc Mơ Ngọt Ngào Giữa Lòng Hà Nội</h1>
                        <p class="mb-3" style="text-align: justify;">Hành trình của <strong>Tiệm bánh Cakery</strong> không bắt đầu từ một cửa hiệu khang trang, mà được ươm mầm từ một căn bếp nhỏ cách đây 3 năm. Nơi đó chỉ có mùi bơ Pháp thơm lừng, những đám mây bột mì trắng xóa và cuốn sổ tay công thức được ghi chép miệt mài mỗi ngày. Tình yêu mãnh liệt với nghệ thuật làm bánh chính là viên gạch đầu tiên xây dựng nên thương hiệu của chúng mình.</p>
                        <p class="mb-3" style="text-align: justify;">Thế nhưng, con đường theo đuổi đam mê chưa bao giờ trải đầy hoa hồng. Nhớ lại những ngày đầu, đã có vô số mẻ bánh phải ngậm ngùi bỏ đi vì cốt bánh chưa đạt độ xốp mềm chuẩn mực. Đó là những đêm thức trắng rèn luyện cách bắt bông kem, pha màu nghệ thuật, hay những giọt mồ hôi rơi khi trăn trở tìm ra tỷ lệ hoàn hảo – để bánh giữ được vị ngọt thanh tao, béo ngậy mà không hề gắt cổ.</p>
                        <p class="mb-4" style="text-align: justify;">Vượt qua muôn vàn thử thách và sự thiếu thốn của những ngày chập chững, bằng sự kiên định và nỗ lực không ngừng nghỉ, Cakery đã chính thức vươn mình. Giờ đây, mỗi chiếc bánh ra lò không chỉ được làm từ những nguyên liệu cao cấp nhất, mà còn gói ghém trọn vẹn mồ hôi, tâm huyết và lời cam kết về chất lượng tuyệt đối mà chúng mình muốn gửi trao đến bạn.</p>
                        <p class="mb-6" style="text-align: justify;">Hành trình trưởng thành từ gian bếp nhỏ đến ngày hôm nay có dấu ấn vô cùng lớn từ sự tin yêu của khách hàng. Giữ vững ngọn lửa nhiệt huyết của những ngày đầu tiên, Cakery cam kết sẽ không ngừng học hỏi, đổi mới và tỉ mỉ trong từng chi tiết để mỗi lần bạn ghé thăm đều là một trải nghiệm ẩm thực thăng hoa. Cảm ơn bạn đã chọn Cakery làm nơi gửi gắm những yêu thương!</p>
                        <div class="row g-2 mb-4">
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Đam mê và nhiệt huyết
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Thiết kế theo yêu cầu
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Chất lượng làm nên uy tín
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Giao hàng tận nơi
                            </div>
                        </div>
                        <a class="btn btn-primary rounded-pill py-3 px-5" href="about.php">Khám phá thêm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Team Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="text-primary text-uppercase mb-2">Đội ngũ của chúng tôi</p>
                <h1 class="display-6 mb-4">Thợ Lành Nghề</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item text-center rounded overflow-hidden">
                        <img class="img-fluid" src="img/team-1.jpg" alt="">
                        <div class="team-text">
                            <div class="team-title">
                                <h5>Vũ Quốc Cải</h5>
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
                                <span>Chuyên Gia Trang Trí </span>
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
                                <span>Phó Bếp</span>
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