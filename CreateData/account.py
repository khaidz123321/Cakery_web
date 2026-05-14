import csv
import random
import os
from faker import Faker

# Khởi tạo Faker với ngôn ngữ Tiếng Việt
fake = Faker('vi_VN')

# ---------------------------------------------------------
# CẤU HÌNH ĐƯỜNG DẪN ĐỒNG BỘ
# ---------------------------------------------------------
save_dir = r"C:\MSQLALL\Uploads\ltw_data"
filename = os.path.join(save_dir, 'accounts.csv')

# Tự động tạo thư mục nếu chưa tồn tại
if not os.path.exists(save_dir):
    os.makedirs(save_dir)

with open(filename, mode='w', newline='', encoding='utf-8') as file:
    writer = csv.writer(file)
    
    # 1. Ghi Header (Đã XÓA cột Role)
    writer.writerow(['AccountID', 'Username', 'Password', 'FullName', 'Phone'])
    
    # 2. Tạo tài khoản Admin chính (ID = 1)
    writer.writerow([1, 'admin', '123456', 'Vũ Quốc Khải', '0846271105'])
    
    # 3. Tạo thêm 4 tài khoản Admin phụ (Nhân viên quản lý)
    for i in range(2, 6):
        username = f'admin0{i}'
        password = '123456'
        full_name = fake.name()
        
        # Tạo SĐT chuẩn Việt Nam
        prefixes = ['03', '05', '07', '08', '09']
        phone = random.choice(prefixes) + "".join([str(random.randint(0, 9)) for _ in range(8)])
        
        writer.writerow([i, username, password, full_name, phone])

print(f"🚀 Thành công! Đã tạo 5 tài khoản Quản trị viên tại: {filename}")