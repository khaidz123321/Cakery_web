import csv
import os

# ---------------------------------------------------------
# CẤU HÌNH ĐƯỜNG DẪN CỐ ĐỊNH CỦA BẠN
# ---------------------------------------------------------
save_dir = r"C:\MSQLALL\Uploads\ltw_data"
product_file = os.path.join(save_dir, 'products.csv')

# Đảm bảo thư mục tồn tại (tránh lỗi Not Found)
os.makedirs(save_dir, exist_ok=True)

# ---------------------------------------------------------
# DỮ LIỆU 6 SẢN PHẨM THẬT THEO GIAO DIỆN
# ---------------------------------------------------------
products = [
    [1, 'Blue Dream Art Cake', 'Tuyệt tác bánh kem Starry Night huyền bí.', 'img/p1.jpg', 800000, 1],
    [2, 'Merry Berry Tiramisu', 'Sự kết hợp hoàn hảo giữa vị cà phê và dâu tây.', 'img/p2.jpg', 350000, 2],
    [3, 'Cookies Hạnh Nhân', 'Giòn rụm, tan ngay trong miệng với vị bùi của hạt.', 'img/p3.jpg', 45000, 3],
    [4, 'Puppy Oreo Cake', 'Cốt bánh socola hòa quyện cùng kem phô mai.', 'img/p4.jpg', 450000, 1],
    [5, 'Bánh Cuộn Quế', 'Cốt bánh mềm xốp nướng vàng thơm lừng.', 'img/p5.jpg', 35000, 2],
    [6, 'Cookies Marshmallow', 'Bánh quy giòn rụm điểm xuyết kẹo dẻo.', 'img/p6.jpg', 25000, 3]
]

print(f"Đang tạo dữ liệu sản phẩm và lưu vào: {product_file}...")

with open(product_file, mode='w', newline='', encoding='utf-8') as file:
    writer = csv.writer(file)
    
    # Tạo Header (Khớp với cấu trúc Database)
    writer.writerow(['ProductID', 'ProductName', 'Description', 'Image', 'Price', 'CategoryID'])
    
    # Ghi từng sản phẩm vào file
    for p in products:
        writer.writerow(p)

print("✅ Hoàn thành! Đã nướng xong 6 loại bánh thật và đóng gói vào file products.csv.")