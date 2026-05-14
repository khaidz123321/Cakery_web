import csv
import random
import os
from datetime import datetime, timedelta
from faker import Faker

fake = Faker('vi_VN')

# ---------------------------------------------------------
# CẤU HÌNH ĐƯỜNG DẪN
# ---------------------------------------------------------
save_dir = r"C:\MSQLALL\Uploads\ltw_data"
account_file = os.path.join(save_dir, 'accounts.csv')
order_file = os.path.join(save_dir, 'orders.csv')
orderdetail_file = os.path.join(save_dir, 'orderdetails.csv')

products = [
    {'ProductID': 1, 'Price': 800000},
    {'ProductID': 2, 'Price': 350000},
    {'ProductID': 3, 'Price': 45000},
    {'ProductID': 4, 'Price': 450000},
    {'ProductID': 5, 'Price': 35000},
    {'ProductID': 6, 'Price': 25000}
]

# 2. ĐỌC DỮ LIỆU TỪ FILE ACCOUNTS (Giờ toàn bộ là Admin)
admin_ids = []
try:
    with open(account_file, mode='r', encoding='utf-8') as f:
        reader = csv.DictReader(f)
        for row in reader:
            admin_ids.append(row['AccountID'])
except FileNotFoundError:
    print(f"⚠️ Lỗi: Không tìm thấy {account_file}. Hãy chạy file account.py trước.")
    exit()

# ---------------------------------------------------------
# 3. SINH DỮ LIỆU ĐỒNG BỘ
# ---------------------------------------------------------
statuses = ['Pending', 'Processing', 'Completed', 'Cancelled']
hanoi_addresses = [
    "Số 12, Chùa Bộc, Đống Đa, Hà Nội",
    "6/9/21, Yên Xá, Tân Triều, Hà Nội",
    "102 Trần Phú, Hà Đông, Hà Nội",
    "Số 5, Ngõ 175 Xuân Thủy, Cầu Giấy, Hà Nội",
    "P1204 Tòa nhà PTIT, Hà Đông, Hà Nội"
]
notes = ["Giao giờ hành chính", "Bánh ít đường", "Gọi trước khi giao 15p", "", "Tặng kèm nến sinh nhật"]

print(f"🚀 Đang tạo 100 đơn hàng đồng bộ tại: {save_dir}...")

with open(order_file, mode='w', newline='', encoding='utf-8') as f_ord, \
     open(orderdetail_file, mode='w', newline='', encoding='utf-8') as f_det:
    
    writer_ord = csv.writer(f_ord)
    writer_det = csv.writer(f_det)
    
    # Header Bảng Order: Cập nhật CustomerName, CustomerPhone và AdminID (thay cho AccountID)
    writer_ord.writerow(['OrderID', 'OrderDate', 'CustomerName', 'CustomerPhone', 'TotalAmount', 'Status', 'Address', 'Note', 'AdminID'])
    # Header Bảng OrderDetail
    writer_det.writerow(['DetailID', 'OrderID', 'ProductID', 'Quantity', 'PriceAtOrder'])
    
    detail_id_counter = 1
    
    for order_id in range(1, 101):
        date_str = (datetime.now() - timedelta(days=random.randint(0, 60))).strftime('%Y-%m-%d %H:%M:%S')
        status = random.choice(statuses)
        
        # Tự động sinh Khách vãng lai
        cus_name = fake.name()
        cus_phone = random.choice(['03', '05', '07', '08', '09']) + "".join([str(random.randint(0, 9)) for _ in range(8)])
        
        # LOGIC QUẢN LÝ (MANAGE): 
        # Nếu đang chờ xử lý thì AdminID là NULL (trong CSV ký hiệu là \N)
        # Nếu đã hoàn thành hoặc hủy thì ngẫu nhiên 1 Admin duyệt
        if status in ['Pending', 'Processing']:
            admin_id = "\\N"
        else:
            admin_id = random.choice(admin_ids)
        
        # Chọn ngẫu nhiên bánh
        num_items = random.randint(1, 3)
        chosen_products = random.sample(products, num_items)
        order_total = 0
        
        for prod in chosen_products:
            qty = random.randint(1, 2)
            price = prod['Price']
            subtotal = qty * price
            order_total += subtotal
            
            writer_det.writerow([detail_id_counter, order_id, prod['ProductID'], qty, price])
            detail_id_counter += 1
            
        # Ghi vào Order
        writer_ord.writerow([
            order_id,
            date_str, 
            cus_name,
            cus_phone,
            order_total, 
            status, 
            random.choice(hanoi_addresses),
            random.choice(notes),
            admin_id
        ])

print("✅ Xong! Dữ liệu đã khớp 100% với Database và ERD mới.")