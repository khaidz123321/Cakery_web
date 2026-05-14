<?php 
    session_start();
    require_once 'db_connect.php'; 
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Cakery - Sản Phẩm</title>
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

<div id="contact-placeholder"></div>
<script>
    fetch("social_plugin.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById('contact-placeholder').innerHTML = data;
        });
</script>

<body>
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
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
                    <a href="product.php" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Sản phẩm</a>
                    <div class="dropdown-menu m-0">
                        <a href="product.php?category=all" class="dropdown-item">Tất cả sản phẩm</a>
                        <a href="product.php?category=1" class="dropdown-item">Bánh Sinh Nhật</a>
                        <a href="product.php?category=2" class="dropdown-item">Bánh Ngọt</a>
                        <a href="product.php?category=3" class="dropdown-item">Bánh Cookies</a>
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
    <div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center pt-5 pb-3">
            <h1 class="display-4 text-white animated slideInDown mb-3">Sản phẩm</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Sản phẩm</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-xxl py-6">
        <div class="container">
            <div class="bg-primary text-light rounded p-5 mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6">
                        <h1 class="display-4 text-light mb-0">Thực Đơn</h1>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <div class="d-inline-flex align-items-center text-start">
                            <i class="fa fa-phone-alt fa-4x flex-shrink-0"></i>
                            <div class="ms-4">
                                <p class="fs-5 fw-bold mb-0">Hỗ trợ đặt bánh</p>
                                <p class="fs-1 fw-bold mb-0">+84 846271105</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-5">
                <div class="col-lg-9">
                    <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                        <p class="text-primary text-uppercase mb-2">Cakery</p>
                        <h1 class="display-6 mb-4">Khám Phá Sản Phẩm</h1>
                    </div>
                    
                    <!-- START FIX sản phẩm -->
                    <div class="row g-4">
                        <?php
                        // Lấy ID danh mục từ URL, lọc theo số để bảo mật
                        $category_id = isset($_GET['category']) ? $_GET['category'] : 'all';
                        
                        // Xây dựng câu lệnh truy vấn
                        $sql = "SELECT * FROM product";
                        if ($category_id !== 'all') {
                            $sql .= " WHERE CategoryID = " . intval($category_id);
                        }
                        
                        $result = $conn->query($sql);

                        if ($result && $result->num_rows > 0) {
                            $delay = 0.1;
                            while($row = $result->fetch_assoc()) {
                        ?>
                            <div class="col-lg-6 col-md-6 wow fadeInUp product-card" data-wow-delay="<?php echo $delay; ?>s">
                                <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100 shadow-sm">
                                    <div class="text-center p-4">
                                        <div class="d-inline-block border border-primary rounded-pill px-3 mb-3">
                                            <?php echo number_format($row['Price'], 0, ',', '.'); ?>đ
                                        </div>
                                        <h3 class="mb-3 product-title"><?php echo $row['ProductName']; ?></h3>
                                        <span class="text-muted"><?php echo $row['Description']; ?></span>
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
                            $delay += 0.2;
                            if ($delay > 0.5) $delay = 0.1; // Reset delay để không bị lag hiệu ứng
                            } 
                        } else {
                            echo "<p class='text-center w-100'>Hiện chưa có sản phẩm nào trong danh mục này.</p>";
                        }
                        ?>
                    </div>
                    <!-- END FIX sản phẩm -->
                     
                </div>

                <div class="col-lg-3">
                    <div class="wow fadeInUp" data-wow-delay="0.5s">
                        
                        <div class="bg-light p-4 mb-5 rounded shadow-sm wow fadeInUp" data-wow-delay="0.1s">
                            <h4 class="mb-4 border-bottom pb-2">Tìm Kiếm</h4>
                            <div class="input-group">
                                <input type="text" id="searchInput" class="form-control p-3 border-primary" placeholder="Nhập tên bánh..." style="border-radius: 30px 0 0 30px;">
                                <button class="btn btn-primary px-4" id="searchBtn" style="border-radius: 0 30px 30px 0;">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>

                        <div class="bg-light p-4 mb-5 rounded shadow-sm">
                            <h4 class="mb-4 border-bottom pb-2">Danh Mục</h4>
                            <div class="d-flex flex-column">
                                <a class="h6 text-dark mb-3" href="product.php?category=all"><i class="fa fa-angle-right me-2 text-primary"></i>Tất cả bánh</a>
                                <a class="h6 text-dark mb-3" href="product.php?category=1"><i class="fa fa-angle-right me-2 text-primary"></i>Bánh Sinh Nhật</a>
                                <a class="h6 text-dark mb-3" href="product.php?category=2"><i class="fa fa-angle-right me-2 text-primary"></i>Bánh Ngọt</a>
                                <a class="h6 text-dark mb-3" href="product.php?category=3"><i class="fa fa-angle-right me-2 text-primary"></i>Bánh Cookies</a>
                            </div>
                        </div>

                        <div class="bg-light p-4 mb-5 rounded shadow-sm">
                            <h4 class="mb-4 border-bottom pb-2">Bán Chạy</h4>
                            <div class="d-flex align-items-center mb-3">
                                <img class="img-fluid rounded" src="img/p1.jpg" style="width: 60px; height: 60px; object-fit: cover;" alt="">
                                <div class="ps-3">
                                    <a href="product_detail.php?id=1" class="h6 d-block mb-1">Blue Dream Art Cake</a>
                                    <small class="text-primary fw-bold">800.000đ</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <img class="img-fluid rounded" src="img/p6.jpg" style="width: 60px; height: 60px; object-fit: cover;" alt="">
                                <div class="ps-3">
                                    <a href="product_detail.php?id=6" class="h6 d-block mb-1">Cookies Marshmallow</a>
                                    <small class="text-primary fw-bold">25.000đ</small>
                                </div>
                            </div>
                        </div>

                        <div class="position-relative rounded overflow-hidden shadow-sm">
                            <img class="img-fluid w-100" src="img/carousel-1.jpg" alt="">
                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center bg-dark bg-opacity-50">
                                <div class="p-4">
                                    <h5 class="text-white mb-2">Ưu đãi 10%</h5>
                                    <p class="text-white small mb-0">Cho hóa đơn trên 500k</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <script src="js/main.js"></script>
    <script src="js/cart.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        // Tìm tất cả các khối chứa sản phẩm
        const productItems = document.querySelectorAll('.product-card');

        searchInput.addEventListener('input', function() {
            const searchText = this.value.toLowerCase().trim();

            productItems.forEach(item => {
                const productName = item.querySelector('.product-title').innerText.toLowerCase();
                
                if (productName.includes(searchText)) {
                    item.style.setProperty('display', 'block', 'important');
                } else {
                    item.style.setProperty('display', 'none', 'important');
                }
            });
        });
    });
    </script>
</body>

</html>