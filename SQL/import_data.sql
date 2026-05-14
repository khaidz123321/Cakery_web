-- -----------------------------------------------------
-- LỆNH IMPORT TOÀN BỘ FILE CSV VÀO DATABASE CAKERY
-- -----------------------------------------------------

SET FOREIGN_KEY_CHECKS = 0;

-- 1. Import Bảng Danh mục (Category)
LOAD DATA INFILE 'C:/MSQLALL/Uploads/ltw_data/categories.csv'
REPLACE INTO TABLE Category
CHARACTER SET utf8mb4
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS
(CategoryID, CategoryName);

-- 2. Import Bảng Tài khoản (Account) - Đã XÓA cột Role
LOAD DATA INFILE 'C:/MSQLALL/Uploads/ltw_data/accounts.csv'
REPLACE INTO TABLE Account
CHARACTER SET utf8mb4
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS
(AccountID, Username, Password, FullName, Phone);

-- 3. Import Bảng Sản phẩm (Product)
LOAD DATA INFILE 'C:/MSQLALL/Uploads/ltw_data/products.csv'
REPLACE INTO TABLE Product
CHARACTER SET utf8mb4
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS
(ProductID, ProductName, Description, Image, Price, CategoryID);

-- 4. Import Bảng Đơn hàng (Order) - CẬP NHẬT: CustomerName, CustomerPhone, AdminID
LOAD DATA INFILE 'C:/MSQLALL/Uploads/ltw_data/orders.csv'
REPLACE INTO TABLE `Order`
CHARACTER SET utf8mb4
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS
(OrderID, OrderDate, CustomerName, CustomerPhone, TotalAmount, Status, Address, Note, AdminID);

-- 5. Import Bảng Chi tiết Đơn hàng (OrderDetail)
LOAD DATA INFILE 'C:/MSQLALL/Uploads/ltw_data/orderdetails.csv'
REPLACE INTO TABLE OrderDetail
CHARACTER SET utf8mb4
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS
(DetailID, OrderID, ProductID, Quantity, PriceAtOrder);

SET FOREIGN_KEY_CHECKS = 1;