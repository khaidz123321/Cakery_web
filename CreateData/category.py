import csv
import os

# ---------------------------------------------------------
# CẤU HÌNH ĐƯỜNG DẪN CỐ ĐỊNH
# ---------------------------------------------------------
save_dir = r"C:\MSQLALL\Uploads\ltw_data"
category_file = os.path.join(save_dir, 'categories.csv')

# Đảm bảo thư mục tồn tại
os.makedirs(save_dir, exist_ok=True)

# ---------------------------------------------------------
# DỮ LIỆU 3 DANH MỤC THẬT THEO GIAO DIỆN
# ---------------------------------------------------------
categories = [
    [1, 'Bánh Sinh Nhật'],
    [2, 'Bánh Ngọt'],
    [3, 'Bánh Cookies']
]

print(f"Đang tạo dữ liệu danh mục và lưu vào: {category_file}...")

with open(category_file, mode='w', newline='', encoding='utf-8') as file:
    writer = csv.writer(file)
    
    # Tạo Header (Khớp với cấu trúc Database)
    writer.writerow(['CategoryID', 'CategoryName'])
    
    # Ghi từng danh mục vào file
    for c in categories:
        writer.writerow(c)

print("✅ Hoàn thành! Đã đóng gói xong file categories.csv.")