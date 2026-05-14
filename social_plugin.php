<div class="social-contact-icons">
    <a href="https://zalo.me/0846271105" target="_blank" class="icon zalo" title="Chat Zalo">
        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM16.5 15.5H7.5V14.5L10.5 11.5H7.5V10.5H16.5V11.5L13.5 14.5H16.5V15.5Z" fill="white"/>
        </svg>
    </a>
    <a href="https://www.google.com/maps?q=6/9/21,Yên+Xá,Tân+Triều,Hà+Nội" target="_blank" class="icon maps" title="Vị trí cửa hàng">
        <i class="fa fa-map-marker-alt"></i>
    </a>
    <a href="javascript:void(0)" class="icon message" data-bs-toggle="modal" data-bs-target="#contactModal" title="Để lại lời nhắn">
        <i class="fa fa-envelope"></i>
    </a>
</div>

<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mx-auto" id="contactModalLabel">Để lại lời nhắn cho chúng tôi</h5>
                <button type="button" class="btn-close ms-0" data-bs-toggle="modal" data-bs-target="#contactModal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Tên của bạn">
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Email của bạn">
                    </div>
                    <div class="mb-3">
                        <input type="tel" class="form-control" placeholder="Số điện thoại của bạn">
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" rows="4" placeholder="Nội dung lời nhắn"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary w-100 py-3">GỬI CHO CHÚNG TÔI</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .floating-phone {
        position: fixed;
        bottom: 30px;
        left: 30px; /* Đặt ở góc dưới bên trái để không đụng nút Back to Top */
        z-index: 9999; /* Đảm bảo luôn nổi lên trên cùng */
        text-decoration: none;
    }

    .phone-icon-wrapper {
        width: 60px;
        height: 60px;
        background-color: #8B4513; /* Màu nâu vàng của Cakery */
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white !important;
        font-size: 28px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        /* Gọi hiệu ứng tỏa sóng */
        animation: pulse-ring 2s infinite; 
        transition: transform 0.3s ease, background-color 0.3s ease;
    }

    .floating-phone:hover .phone-icon-wrapper {
        transform: scale(1.1); /* Phóng to nhẹ khi di chuột */
        background-color: #A0522D; /* Sáng lên một chút khi hover */
    }

    /* Hiệu ứng tỏa sóng (Pulse Animation) */
    @keyframes pulse-ring {
        0% {
            box-shadow: 0 0 0 0 rgba(139, 69, 19, 0.7);
        }
        70% {
            box-shadow: 0 0 0 20px rgba(139, 69, 19, 0); /* Sóng lan rộng và mờ dần */
        }
        100% {
            box-shadow: 0 0 0 0 rgba(139, 69, 19, 0);
        }
    }
</style>
<a href="tel:0846271105" class="floating-phone" title="Gọi ngay cho Cakery!">
    <div class="phone-icon-wrapper">
        <i class="fa fa-phone-alt"></i>
    </div>
</a>