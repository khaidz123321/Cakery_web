import csv
import random
import os

# ---------------------------------------------------------
# CẤU HÌNH ĐƯỜNG DẪN CỐ ĐỊNH
# ---------------------------------------------------------
save_dir = r"C:\MSQLALL\Uploads\ltw_data"
product_file = os.path.join(save_dir, 'products.csv')
order_file = os.path.join(save_dir, 'orders.csv')
orderdetail_file = os.path.join(save_dir, 'orderdetails.csv')

# ---------------------------------------------------------
# 1. ĐỌC DỮ LIỆU BÁNH (Lấy chính xác ProductID và Giá)
# ---------------------------------------------------------
products = []
try:
    with open(product_file, mode='r', encoding='utf-8') as f:
        # Bỏ qua dòng header
        next(f)
        for row in csv.reader(f):
            products.append({
                'ProductID': int(row[0]), # Cột đầu tiên là ProductID
                'Price': float(row[4])    # Cột thứ 5 (index 4) là Price
            })
    print(f"Đã nạp {len(products)} sản phẩm từ danh sách thật.")
except FileNotFoundError:
    print(f"⚠️ Lỗi: Không tìm thấy {product_file}. Vui lòng tạo file Product trước!")
    exit()

# ---------------------------------------------------------
# 2. ĐỌC DỮ LIỆU ĐƠN HÀNG (Đếm xem có bao nhiêu hóa đơn)
# ---------------------------------------------------------
order_ids = []
try:
    with open(order_file, mode='r', encoding='utf-8') as f:
        # Bỏ qua header
        next(f)
        # Đếm số dòng để suy ra OrderID (từ 1 đến 100)
        for idx, _ in enumerate(f, start=1):
            order_ids.append(idx)
    print(f"Đã tìm thấy {len(order_ids)} hóa đơn.")
except FileNotFoundError:
    print(f"⚠️ Lỗi: Không tìm thấy {order_file}. Vui lòng tạo file Order trước!")
    exit()

# ---------------------------------------------------------
# 3. TẠO CHI TIẾT ĐƠN HÀNG VÀ LƯU FILE
# ---------------------------------------------------------
print(f"Đang nhặt bánh vào giỏ và đóng gói tại: {orderdetail_file}...")

with open(orderdetail_file, mode='w', newline='', encoding='utf-8') as file:
    writer = csv.writer(file)
    
    # Header chuẩn của Database
    writer.writerow(['OrderID', 'ProductID', 'Quantity', 'PriceAtOrder'])
    
    for order_id in order_ids:
        # Mỗi đơn khách mua ngẫu nhiên từ 1 đến 3 loại bánh
        num_items = random.randint(1, 3)
        
        # Nếu số lượng loại bánh muốn mua lớn hơn số bánh đang có trong kho thì lấy tối đa số bánh trong kho
        num_items = min(num_items, len(products))
        chosen_products = random.sample(products, num_items)
        
        for prod in chosen_products:
            qty = random.randint(1, 2) # Mỗi loại mua 1 hoặc 2 cái
            price = prod['Price'] # Lấy đúng giá bánh thời điểm đó
            
            # Ghi vào file (Cam kết 100% ID hợp lệ)
            writer.writerow([order_id, prod['ProductID'], qty, price])

print("✅ TUYỆT VỜI! Đã tạo xong orderdetails.csv an toàn tuyệt đối với Khóa Ngoại.")