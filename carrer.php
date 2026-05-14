<?php 
    session_start(); // Để hiện cái Popup Admin nếu cần
    require_once 'db_connect.php'; 
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Tuyển dụng - Tiệm bánh Cakery</title>
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
    <div class="container-fluid top-bar bg-dark text-light px-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="row gx-0 align-items-center d-none d-lg-flex">
            <div class="col-lg-6 px-5 text-start">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="small text-light" href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a class="small text-light" href="tuyen-dung.php">Tuyển dụng</a></li>
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
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="index.php" class="navbar-brand ms-4 ms-lg-0">
            <h1 class="text-primary m-0">Cakery</h1>
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
                    <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Khám phá</a>
                    <div class="dropdown-menu m-0">
                        <a href="team.php" class="dropdown-item">Đội ngũ của chúng tôi</a>
                        <a href="testimonial.php" class="dropdown-item">Đánh giá</a>
                        <a href="tuyen-dung.php" class="dropdown-item active">Tuyển dụng</a>
                    </div>
                </div>
                <a href="contact.php" class="nav-item nav-link">Liên hệ</a>
                <a href="membership.php" class="nav-item nav-link">Hội viên</a>
            </div>
        </div>
    </nav>
    <div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('img/carousel-1.jpg') center center no-repeat; background-size: cover;">
        <div class="container text-center pt-5 pb-3">
            <h1 class="display-4 text-white animated slideInDown mb-3 mt-5">Tuyển Dụng</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Khám phá</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Tuyển dụng</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 justify-content-center">
                <div class="col-lg-10 wow fadeIn" data-wow-delay="0.1s">
                    <h1 class="display-6 mb-4 text-uppercase border-bottom pb-3">Tuyển dụng</h1>
                    
                    <div class="bg-light p-5 rounded shadow-sm">
                        <h3 class="mb-4 text-primary">CAKERY TUYỂN DỤNG NHÂN SỰ</h3>
                        <p style="text-align: justify;">Hoạt động trong lĩnh vực sản xuất và kinh doanh các dòng bánh mỳ, bánh ngọt, bánh tươi, chúng tôi luôn đề cao nguồn nhân lực là tài sản quý giá, vừa là mục tiêu, tiền đề, vừa là động lực để thực hiện chiến lược phát triển của công ty. Nguồn nhân lực còn được xem là yếu tố quyết định sự thành công hay thất bại của một doanh nghiệp. Vì vậy chúng tôi luôn tạo ra một môi trường năng động, trẻ trung cùng với những cơ hội thăng tiến. Chúng tôi chào mừng các bạn gia nhập vào đội ngũ nhân viên của Tiệm bánh Cakery.</p>
                        
                        <h5 class="mt-4 mb-3">CÁCH ỨNG TUYỂN</h5>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2"><i class="fa fa-envelope text-primary me-2"></i><strong>1. Gửi CV qua mail:</strong> vuquockhai88@gmail.com</li>
                            <li class="mb-2"><i class="fa fa-phone-alt text-primary me-2"></i><strong>2. Zalo/Hotline:</strong> 0846271105</li>
                            <li class="mb-2"><i class="fa fa-edit text-primary me-2"></i><strong>3. Điền vào biểu mẫu sau:</strong></li>
                        </ul>

                            <div class="w-100 mt-4 text-center bg-white p-3 rounded border">
                                <div class="w-100 mt-4 bg-white p-4 rounded border shadow-sm">
                                <h5 class="mb-4 text-center">ĐIỀN THÔNG TIN ỨNG TUYỂN</h5>
                                
                                <form action="https://formspree.io/f/YOUR_FORMSPREE_ID" method="POST">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="name" name="Họ_và_tên" placeholder="Họ và tên" required>
                                                <label for="name">Họ và tên *</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="tel" class="form-control" id="phone" name="Số_điện_thoại" placeholder="Số điện thoại" required>
                                                <label for="phone">Số điện thoại liên hệ *</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="email" class="form-control" id="email" name="Email" placeholder="Email của bạn">
                                                <label for="email">Email của bạn (Để nhận phản hồi)</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-select" style="height: 58px;" name="Vị_trí_ứng_tuyển" required>
                                                <option value="" disabled selected>Chọn vị trí ứng tuyển *</option>
                                                <option value="Bán hàng / Thu ngân">Nhân viên bán hàng / Thu ngân</option>
                                                <option value="Thợ bánh / Phụ bếp">Thợ bánh / Phụ bếp bánh</option>
                                                <option value="Quản lý cửa hàng">Quản lý cửa hàng</option>
                                                <option value="Marketing">Marketing / Chăm sóc khách hàng</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-select" style="height: 58px;" name="Ca_làm_việc" required>
                                                <option value="" disabled selected>Chọn ca làm việc *</option>
                                                <option value="Ca sáng">Ca sáng (7h00 - 12h00)</option>
                                                <option value="Ca chiều">Ca chiều (12h00 - 17h00)</option>
                                                <option value="Ca tối">Ca tối (17h00 - 22h00)</option>
                                                <option value="Full-time">Full-time (Toàn thời gian)</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Kinh nghiệm" id="experience" name="Kinh_nghiệm" style="height: 120px" required></textarea>
                                                <label for="experience">Mô tả ngắn gọn kinh nghiệm làm việc của bạn *</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="url" class="form-control" id="cv_link" name="Link_CV" placeholder="Link CV">
                                                <label for="cv_link">Link CV của bạn (Google Drive/Canva - Nhớ mở quyền truy cập)</label>
                                            </div>
                                        </div>
                                        <div class="col-12 text-center mt-4">
                                            <button class="btn btn-primary rounded-pill py-3 px-5 text-uppercase fw-bold" type="submit">Gửi Hồ Sơ Ứng Tuyển</button>
                                        </div>
                                    </div>
                                </form>
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

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>