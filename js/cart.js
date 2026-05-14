// Khởi tạo giỏ hàng từ LocalStorage (bộ nhớ trình duyệt) hoặc một mảng rỗng nếu chưa có gì
let cart = JSON.parse(localStorage.getItem('cakeryCart')) || [];

// 1. HÀM THÊM VÀO GIỎ HÀNG
function addToCart(id, name, price, image) {
    // Tìm ô nhập số lượng trên trang để xem khách muốn mua mấy cái
    let quantityInput = document.querySelector('input[type="number"]');
    // Nếu có ô nhập thì lấy số đó, không thì mặc định là 1
    let quantity = quantityInput ? parseInt(quantityInput.value) : 1; 

    // Kiểm tra xem cái bánh này đã có trong giỏ chưa
    let existingItem = cart.find(item => item.id === id);
    
    if (existingItem) {
        // Nếu có rồi thì cộng dồn số lượng
        existingItem.quantity += quantity; 
    } else {
        // Chưa có thì thêm mới tinh vào giỏ
        cart.push({ id, name, price, image, quantity }); 
    }

    // Lưu ngay vào bộ nhớ trình duyệt để không bị mất
    localStorage.setItem('cakeryCart', JSON.stringify(cart));

    // Gọi hàm để vẽ lại giỏ hàng (dropdown) cho khách xem
    updateCartUI();
}

// 2. HÀM VẼ LẠI GIAO DIỆN GIỎ HÀNG (Dropdown góc phải)
function updateCartUI() {
    const cartItemsContainer = document.getElementById('cart-items');
    const cartTotalElement = document.getElementById('cart-total');
    const cartCountElement = document.getElementById('cart-count');

    // Nếu đang ở trang không có giỏ hàng thì bỏ qua tránh báo lỗi
    if (!cartItemsContainer || !cartTotalElement || !cartCountElement) return;

    // Xóa chữ "Giỏ hàng đang trống" đi để chuẩn bị nhét bánh vào
    cartItemsContainer.innerHTML = '';
    
    let total = 0; // Tổng tiền
    let count = 0; // Số lượng món báo đỏ đỏ trên icon

    if (cart.length === 0) {
        cartItemsContainer.innerHTML = '<p class="text-center text-muted my-3">Giỏ hàng đang trống</p>';
    } else {
        // Lôi từng món trong giỏ ra để vẽ
        cart.forEach(item => {
            total += item.price * item.quantity;
            count += item.quantity;

            // HTML của từng món hàng nhỏ xíu trong dropdown
            const itemHTML = `
                <div class="d-flex align-items-center mb-3">
                    <img src="${item.image}" alt="${item.name}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                    <div class="ms-3 flex-grow-1">
                        <h6 class="mb-0" style="font-size: 14px;">${item.name}</h6>
                        <small class="text-muted">${item.quantity} x ${item.price.toLocaleString('vi-VN')}đ</small>
                    </div>
                    <button class="btn btn-sm btn-outline-danger" onclick="removeItem('${item.id}')"><i class="fa fa-times"></i></button>
                </div>
            `;
            cartItemsContainer.innerHTML += itemHTML;
        });
    }

    // Chèn lại tổng tiền và con số trên badge đỏ
    cartTotalElement.innerText = total.toLocaleString('vi-VN') + 'đ';
    cartCountElement.innerText = count;
}

// 3. HÀM XÓA MÓN HÀNG
function removeItem(id) {
    // Lọc bỏ cái bánh có id bị xóa
    cart = cart.filter(item => item.id !== id);
    // Lưu lại bộ nhớ mới
    localStorage.setItem('cakeryCart', JSON.stringify(cart));
    // Vẽ lại giỏ
    updateCartUI();
}

// Tự động load giỏ hàng ngay khi vừa mở web lên
document.addEventListener('DOMContentLoaded', updateCartUI);