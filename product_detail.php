<?php 
    session_start(); // Để hiện cái Popup Admin nếu cần
    require_once 'db_connect.php'; 
    // 1. Lấy ID từ thanh địa chỉ (ví dụ: product_detail.php?id=1)
    $id = isset($_GET['id']) ? $_GET['id'] : 0;

    // 2. Truy vấn lấy thông tin chi tiết của chiếc bánh này
    $sql = "SELECT * FROM product WHERE ProductID = '$id'";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();

    // 3. Nếu không tìm thấy bánh (ID bậy bạ), chuyển hướng khách về trang sản phẩm
    if (!$product) {
        echo "<script>alert('Sản phẩm không tồn tại!'); window.location.href='product.php';</script>";
        exit();
    }
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>Cakery - Chi tiết sản phẩm</title>
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

<body>
    <div id="contact-placeholder"></div>
    <script>
        fetch("social_plugin.php")
            .then(response => response.text())
            .then(data => {
                document.getElementById('contact-placeholder').innerHTML = data;
            });
    </script>
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>

    <!-- topbar st -->
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
    <!-- topbar end -->

    <!-- nav st -->
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
    <div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('img/carousel-1.jpg') center center no-repeat; background-size: cover;">
        <div class="container text-center pt-5 pb-3">
            <h1 class="display-4 text-white animated slideInDown mb-3 mt-5">Chi tiết sản phẩm</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="product.php">Sản phẩm</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Chi tiết sản phẩm</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- nav en -->

    <!-- mô tả sản phẩm start -->
<div class="container-xxl py-5">
        <div class="container">

            <!-- START FIX PRODUCT -->
            <div class="row g-5">
                <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                    <img class="img-fluid rounded w-100 shadow-sm" src="<?php echo $product['Image']; ?>" alt="<?php echo $product['ProductName']; ?>" style="object-fit: cover;">
                </div>
                
                <div class="col-lg-7 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="display-6 mb-2"><?php echo $product['ProductName']; ?></h1>
                    <p class="text-muted mb-4">Mã bánh: CAKE-<?php echo $product['ProductID']; ?></p>
                    
                    <h2 class="text-danger mb-4"><?php echo number_format($product['Price'], 0, ',', '.'); ?>đ</h2>
                    
                    <div class="d-flex align-items-center mb-5">
                        <button class="btn btn-primary rounded-pill py-3 px-5 text-uppercase fw-bold" 
                                onclick="flyToCart(event, '<?php echo $product['Image']; ?>'); addToCart('<?php echo $product['ProductID']; ?>', '<?php echo $product['ProductName']; ?>', <?php echo $product['Price']; ?>, '<?php echo $product['Image']; ?>')">
                            Thêm vào giỏ hàng
                        </button>
                    </div>

                    <div class="mt-5 border-top pt-4">
                        <h5 class="mb-3">Mô tả sản phẩm</h5>
                        <p style="text-align: justify; color: #666;">
                            <?php echo $product['Description']; ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- END FIX PRODUCT -->

        </div>
    </div>
    
    <div class="container-xxl py-5 bg-light">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h2 class="display-6 mb-4 text-uppercase">Sản Phẩm Liên Quan</h2>
            </div>
            <div class="row g-4" id="related-products-container">
            
            <!-- START FIX  -->
                <div class="row g-4">
                    <?php
                    $current_cat = $product['CategoryID'];
                    $current_id = $product['ProductID'];
                    
                    // Lấy tối đa 4 sản phẩm cùng loại
                    $sql_related = "SELECT * FROM product WHERE CategoryID = '$current_cat' AND ProductID != '$current_id' LIMIT 4";
                    $res_related = $conn->query($sql_related);
                    
                    if ($res_related && $res_related->num_rows > 0) {
                        while($row_rel = $res_related->fetch_assoc()) {
                    ?>
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100 shadow-sm">
                                <div class="text-center p-4">
                                    <h5 class="mb-2"><?php echo $row_rel['ProductName']; ?></h5>
                                    <span class="text-danger fw-bold"><?php echo number_format($row_rel['Price'], 0, ',', '.'); ?>đ</span>
                                </div>
                                <div class="position-relative mt-auto">
                                    <img class="img-fluid" src="<?php echo $row_rel['Image']; ?>" style="width:100%; height:200px; object-fit:cover;">
                                    <div class="product-overlay">
                                        <a class="btn btn-lg-square btn-outline-light rounded-circle" href="product_detail.php?id=<?php echo $row_rel['ProductID']; ?>">
                                            <i class="fa fa-eye text-primary"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php 
                        }
                    } else {
                        echo "<p class='text-center w-100 text-muted'>Hiện chưa có sản phẩm cùng loại khác.</p>";
                    }
                    ?>
                </div>
            <!--END FIX-->
            
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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <script src="js/main.js"></script>
    
    <script src="js/cart.js"></script>

    <!-- Hiệu ứng Product bay vào Cart start-->
    <script>
        function flyToCart(event, imgSrc) {
            // 1. Tìm vị trí của icon giỏ hàng trên Menu
            const cartIcon = document.querySelector('.fa-shopping-bag');
            if (!cartIcon) return;

            // 2. Lấy tọa độ con chuột khi bạn bấm nút "Thêm vào giỏ"
            const x = event.clientX;
            const y = event.clientY;

            // 3. Tạo ra một bức ảnh nhỏ, hình tròn, mờ mờ
            const flyingImg = document.createElement('img');
            flyingImg.src = imgSrc;
            flyingImg.style.position = 'fixed';
            flyingImg.style.left = x + 'px';
            flyingImg.style.top = y + 'px';
            flyingImg.style.width = '60px';
            flyingImg.style.height = '60px';
            flyingImg.style.objectFit = 'cover';
            flyingImg.style.borderRadius = '50%';
            flyingImg.style.zIndex = '9999';
            flyingImg.style.opacity = '0.8';
            // Tạo đường cong bay mượt mà
            flyingImg.style.transition = 'all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
            flyingImg.style.pointerEvents = 'none'; 
            
            document.body.appendChild(flyingImg);

            // 4. Lấy tọa độ đích (Giỏ hàng ở góc phải)
            const cartRect = cartIcon.getBoundingClientRect();

            // 5. Bắt đầu kích hoạt cho ảnh bay và thu nhỏ dần
            setTimeout(() => {
                flyingImg.style.left = cartRect.left + 'px';
                flyingImg.style.top = cartRect.top + 'px';
                flyingImg.style.width = '10px';
                flyingImg.style.height = '10px';
                flyingImg.style.opacity = '0';
            }, 10);

            // 6. Sau khi bay xong (0.8 giây), xóa ảnh và làm giỏ hàng giật giật (rung lên)
            setTimeout(() => {
                flyingImg.remove();
                // Nếu bạn có gắn link thư viện animate.css thì nó sẽ rung, nếu không có cũng không sao
                if(cartIcon.parentElement) {
                    cartIcon.parentElement.classList.add('animated', 'rubberBand');
                    setTimeout(() => {
                        cartIcon.parentElement.classList.remove('animated', 'rubberBand');
                    }, 1000);
                }
            }, 800);
        }
    </script>
    <!-- Hiệu ứng Product bay vào Cart end-->
</body>

</html>