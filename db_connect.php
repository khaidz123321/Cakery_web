<?php
$servername = "127.0.0.1";
$username = "root";
$password = ""; // Nếu XAMPP của Khải không đặt pass thì để trống
$dbname = "cakery"; // Tên database thật vừa nhập vào
$port = 3306; // Cổng của XAMPP Khải đang dùng

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>