-- 1. XÓA BẢNG CŨ NẾU CÓ (Xóa bảng con trước, bảng cha sau để không lỗi khóa ngoại)
DROP TABLE IF EXISTS OrderDetail;
DROP TABLE IF EXISTS `Order`;
DROP TABLE IF EXISTS Product;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS Account;

-- 2. TẠO BẢNG TÀI KHOẢN (Đã cập nhật: Xóa cột Role vì giờ chỉ toàn Admin)
CREATE TABLE Account (
    AccountID INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(50) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL,
    FullName VARCHAR(100) NOT NULL,
    Phone VARCHAR(20)
);

-- 3. TẠO BẢNG DANH MỤC SẢN PHẨM
CREATE TABLE Category (
    CategoryID INT PRIMARY KEY AUTO_INCREMENT,
    CategoryName VARCHAR(100) NOT NULL
);

-- 4. TẠO BẢNG SẢN PHẨM (BÁNH)
CREATE TABLE Product (
    ProductID INT PRIMARY KEY AUTO_INCREMENT,
    ProductName VARCHAR(255) NOT NULL,
    Description TEXT,
    Image VARCHAR(255),
    Price DECIMAL(10, 2) NOT NULL,
    CategoryID INT,
    FOREIGN KEY (CategoryID) REFERENCES Category(CategoryID) ON DELETE SET NULL
);

-- 5. TẠO BẢNG ĐƠN HÀNG (Đã cập nhật: Đẩy thông tin khách vào trực tiếp, đổi thành AdminID quản lý)
CREATE TABLE `Order` (
    OrderID INT PRIMARY KEY AUTO_INCREMENT,
    OrderDate DATETIME DEFAULT CURRENT_TIMESTAMP,
    CustomerName VARCHAR(255) NOT NULL, -- Tên khách hàng (vãng lai vẫn mua được)
    CustomerPhone VARCHAR(20) NOT NULL, -- SĐT khách hàng
    TotalAmount DECIMAL(10, 2) NOT NULL,
    Status VARCHAR(50) DEFAULT 'Pending',
    Address TEXT,
    Note TEXT,
    AdminID INT NULL, -- Cho phép NULL (Trống) khi đơn vừa được đặt, chưa có Admin nào duyệt
    FOREIGN KEY (AdminID) REFERENCES Account(AccountID) ON DELETE SET NULL
);

-- 6. TẠO BẢNG CHI TIẾT ĐƠN HÀNG (Đã cập nhật: Khớp PriceAtOrder và DetailID)
CREATE TABLE OrderDetail (
    DetailID INT PRIMARY KEY AUTO_INCREMENT,
    OrderID INT NOT NULL,
    ProductID INT NOT NULL,
    Quantity INT NOT NULL DEFAULT 1,
    PriceAtOrder DECIMAL(10, 2) NOT NULL, -- Giá tại thời điểm đặt để chống sai lệch doanh thu
    FOREIGN KEY (OrderID) REFERENCES `Order`(OrderID) ON DELETE CASCADE,
    FOREIGN KEY (ProductID) REFERENCES Product(ProductID) ON DELETE CASCADE
);