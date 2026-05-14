-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3307
-- Thời gian đã tạo: Th5 14, 2026 lúc 04:33 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cakery`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `AccountID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `Phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`AccountID`, `Username`, `Password`, `FullName`, `Phone`) VALUES
(1, 'admin', '123456', 'Vũ Quốc Khải', '0846271105'),
(2, 'admin02', '123456', 'Duyên Phạm', '0765431777'),
(3, 'admin03', '123456', 'Chị An Vũ', '0753928220'),
(4, 'admin04', '123456', 'Linh Trần', '0939189107'),
(5, 'admin05', '123456', 'Quý cô Nhật Vũ', '0392130536');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryName`) VALUES
(1, 'Bánh Sinh Nhật'),
(2, 'Bánh Ngọt'),
(3, 'Bánh Cookies');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `OrderID` int(11) NOT NULL,
  `OrderDate` datetime DEFAULT current_timestamp(),
  `CustomerName` varchar(255) NOT NULL,
  `CustomerPhone` varchar(20) NOT NULL,
  `TotalAmount` decimal(10,2) NOT NULL,
  `Status` varchar(50) DEFAULT 'Pending',
  `Address` text DEFAULT NULL,
  `Note` text DEFAULT NULL,
  `AdminID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`OrderID`, `OrderDate`, `CustomerName`, `CustomerPhone`, `TotalAmount`, `Status`, `Address`, `Note`, `AdminID`) VALUES
(1, '2026-03-06 15:10:22', 'Hà Hữu Trần', '0556973326', 35000.00, 'Processing', '6/9/21, Yên Xá, Tân Triều, Hà Nội', '', NULL),
(2, '2026-03-15 15:10:22', 'Quý cô Khoa Phạm', '0973811934', 935000.00, 'Processing', 'Số 12, Chùa Bộc, Đống Đa, Hà Nội', '', NULL),
(3, '2026-04-14 15:10:22', 'Nhật Phú Vũ', '0530375024', 1275000.00, 'Pending', '102 Trần Phú, Hà Đông, Hà Nội', 'Bánh ít đường', NULL),
(4, '2026-04-06 15:10:22', 'Minh Hải Nguyễn', '0511475413', 470000.00, 'Pending', 'Số 12, Chùa Bộc, Đống Đa, Hà Nội', 'Giao giờ hành chính', NULL),
(5, '2026-03-28 15:10:22', 'Kim Phú Dương', '0858189176', 1150000.00, 'Pending', 'Số 12, Chùa Bộc, Đống Đa, Hà Nội', 'Giao giờ hành chính', NULL),
(6, '2026-03-08 15:10:22', 'Trọng Bảo Trần', '0977547036', 435000.00, 'Processing', '6/9/21, Yên Xá, Tân Triều, Hà Nội', 'Gọi trước khi giao 15p', NULL),
(7, '2026-04-06 15:10:22', 'Phương Quang Mai', '0734016891', 990000.00, 'Processing', 'Số 5, Ngõ 175 Xuân Thủy, Cầu Giấy, Hà Nội', 'Tặng kèm nến sinh nhật', NULL),
(8, '2026-03-30 15:10:22', 'Chi Trần', '0385833125', 825000.00, 'Processing', 'Số 12, Chùa Bộc, Đống Đa, Hà Nội', 'Giao giờ hành chính', NULL),
(9, '2026-04-16 15:10:22', 'Quang Nguyễn', '0746695684', 1600000.00, 'Completed', '102 Trần Phú, Hà Đông, Hà Nội', 'Giao giờ hành chính', 4),
(10, '2026-03-11 15:10:22', 'Quang Đức Hoàng', '0717118416', 350000.00, 'Completed', 'P1204 Tòa nhà PTIT, Hà Đông, Hà Nội', '', 1),
(11, '2026-04-27 15:10:22', 'Phương Bùi', '0393301237', 1600000.00, 'Processing', '102 Trần Phú, Hà Đông, Hà Nội', '', NULL),
(12, '2026-03-03 15:10:22', 'Quý cô Vân Trần', '0987676142', 475000.00, 'Pending', 'Số 12, Chùa Bộc, Đống Đa, Hà Nội', 'Tặng kèm nến sinh nhật', NULL),
(13, '2026-04-06 15:10:22', 'Quý cô Nhật Dương', '0391520049', 50000.00, 'Pending', 'Số 12, Chùa Bộc, Đống Đa, Hà Nội', 'Tặng kèm nến sinh nhật', NULL),
(14, '2026-03-23 15:10:22', 'Hưng Xuân Phạm', '0572587040', 50000.00, 'Processing', 'Số 5, Ngõ 175 Xuân Thủy, Cầu Giấy, Hà Nội', 'Giao giờ hành chính', NULL),
(15, '2026-04-26 15:10:22', 'Trọng Đặng', '0749941179', 485000.00, 'Processing', '6/9/21, Yên Xá, Tân Triều, Hà Nội', 'Tặng kèm nến sinh nhật', NULL),
(16, '2026-03-22 15:10:22', 'Hải Đặng', '0925616861', 70000.00, 'Processing', '102 Trần Phú, Hà Đông, Hà Nội', 'Giao giờ hành chính', NULL),
(17, '2026-04-08 15:10:22', 'Bà Vi Phạm', '0583871699', 1200000.00, 'Processing', 'P1204 Tòa nhà PTIT, Hà Đông, Hà Nội', 'Gọi trước khi giao 15p', NULL),
(18, '2026-04-07 15:10:22', 'Ông Nhiên Dương', '0962257473', 1250000.00, 'Cancelled', 'Số 5, Ngõ 175 Xuân Thủy, Cầu Giấy, Hà Nội', '', 1),
(19, '2026-03-12 15:10:22', 'Dương Dương', '0827574276', 90000.00, 'Completed', '6/9/21, Yên Xá, Tân Triều, Hà Nội', 'Gọi trước khi giao 15p', 1),
(20, '2026-04-24 15:10:22', 'Minh Mai', '0977997888', 700000.00, 'Completed', '6/9/21, Yên Xá, Tân Triều, Hà Nội', 'Tặng kèm nến sinh nhật', 1),
(21, '2026-04-26 15:10:22', 'Trọng Phú Mai', '0390154105', 470000.00, 'Cancelled', 'Số 12, Chùa Bộc, Đống Đa, Hà Nội', '', 1),
(22, '2026-03-18 15:10:22', 'Hải Hải Trần', '0866991412', 1725000.00, 'Pending', 'P1204 Tòa nhà PTIT, Hà Đông, Hà Nội', 'Tặng kèm nến sinh nhật', NULL),
(23, '2026-03-12 15:10:22', 'Hải Trí Dương', '0972921102', 45000.00, 'Completed', 'Số 5, Ngõ 175 Xuân Thủy, Cầu Giấy, Hà Nội', 'Gọi trước khi giao 15p', 2),
(24, '2026-04-10 15:10:22', 'Thành Trần', '0948727299', 860000.00, 'Pending', '102 Trần Phú, Hà Đông, Hà Nội', '', NULL),
(25, '2026-04-25 15:10:22', 'Phương Hoàng Trần', '0303047248', 140000.00, 'Completed', 'Số 5, Ngõ 175 Xuân Thủy, Cầu Giấy, Hà Nội', 'Tặng kèm nến sinh nhật', 4),
(26, '2026-04-29 15:10:22', 'Thành Thị Phạm', '0517954895', 900000.00, 'Pending', 'Số 12, Chùa Bộc, Đống Đa, Hà Nội', '', NULL),
(27, '2026-04-11 15:10:22', 'Nhiên Hoàng', '0356098764', 1320000.00, 'Pending', 'Số 12, Chùa Bộc, Đống Đa, Hà Nội', 'Bánh ít đường', NULL),
(28, '2026-04-24 15:10:22', 'Thành Thế Hoàng', '0754810262', 1600000.00, 'Completed', '102 Trần Phú, Hà Đông, Hà Nội', 'Gọi trước khi giao 15p', 1),
(29, '2026-03-09 15:10:22', 'Bà Xuân Hoàng', '0555760214', 2120000.00, 'Cancelled', 'Số 12, Chùa Bộc, Đống Đa, Hà Nội', 'Gọi trước khi giao 15p', 4),
(30, '2026-03-13 15:10:22', 'Trọng Xuân Đặng', '0925481341', 450000.00, 'Processing', 'P1204 Tòa nhà PTIT, Hà Đông, Hà Nội', 'Bánh ít đường', NULL),
(31, '2026-03-24 15:10:22', 'Nhiên Bùi', '0975374658', 1995000.00, 'Processing', 'Số 12, Chùa Bộc, Đống Đa, Hà Nội', '', NULL),
(32, '2026-04-08 15:10:22', 'Cô An Trần', '0504281400', 735000.00, 'Processing', 'Số 12, Chùa Bộc, Đống Đa, Hà Nội', 'Bánh ít đường', NULL),
(33, '2026-04-01 15:10:22', 'Phương Mai', '0721028776', 60000.00, 'Completed', '6/9/21, Yên Xá, Tân Triều, Hà Nội', 'Bánh ít đường', 4),
(34, '2026-03-22 15:10:22', 'Cô Ánh Nguyễn', '0787181083', 890000.00, 'Completed', 'Số 5, Ngõ 175 Xuân Thủy, Cầu Giấy, Hà Nội', 'Giao giờ hành chính', 5),
(35, '2026-02-28 15:10:22', 'Bảo Vũ', '0305895193', 1680000.00, 'Completed', 'Số 12, Chùa Bộc, Đống Đa, Hà Nội', 'Gọi trước khi giao 15p', 1),
(36, '2026-03-18 15:10:22', 'Nhiên Bùi', '0922103132', 2095000.00, 'Cancelled', '102 Trần Phú, Hà Đông, Hà Nội', '', 2),
(37, '2026-04-28 15:10:22', 'Quang Trần', '0507143721', 1645000.00, 'Processing', '102 Trần Phú, Hà Đông, Hà Nội', 'Bánh ít đường', NULL),
(38, '2026-04-04 15:10:22', 'Bà Phương Nguyễn', '0366255162', 1725000.00, 'Cancelled', 'Số 12, Chùa Bộc, Đống Đa, Hà Nội', 'Bánh ít đường', 1),
(39, '2026-04-04 15:10:22', 'Bà Linh Mai', '0383341722', 35000.00, 'Processing', '102 Trần Phú, Hà Đông, Hà Nội', 'Gọi trước khi giao 15p', NULL),
(40, '2026-03-13 15:10:22', 'Trung Hoàng', '0997956923', 450000.00, 'Pending', 'Số 12, Chùa Bộc, Đống Đa, Hà Nội', 'Tặng kèm nến sinh nhật', NULL),
(41, '2026-03-19 15:10:22', 'Nhiên Nguyễn', '0301085202', 35000.00, 'Pending', '102 Trần Phú, Hà Đông, Hà Nội', 'Bánh ít đường', NULL),
(42, '2026-03-08 15:10:22', 'Trung Thế Mai', '0548014019', 1600000.00, 'Pending', 'P1204 Tòa nhà PTIT, Hà Đông, Hà Nội', 'Giao giờ hành chính', NULL),
(43, '2026-03-07 15:10:22', 'Quang Trí Vũ', '0582646318', 1500000.00, 'Cancelled', 'Số 12, Chùa Bộc, Đống Đa, Hà Nội', 'Gọi trước khi giao 15p', 3),
(44, '2026-03-20 15:10:22', 'Quý ông Nhiên Trần', '0567743973', 1600000.00, 'Pending', 'Số 5, Ngõ 175 Xuân Thủy, Cầu Giấy, Hà Nội', 'Bánh ít đường', NULL),
(45, '2026-04-06 15:10:22', 'Khoa Thế Mai', '0890754746', 825000.00, 'Completed', '6/9/21, Yên Xá, Tân Triều, Hà Nội', 'Tặng kèm nến sinh nhật', 3),
(46, '2026-04-29 15:10:22', 'Anh Huy Bùi', '0745280979', 1535000.00, 'Cancelled', 'Số 5, Ngõ 175 Xuân Thủy, Cầu Giấy, Hà Nội', 'Bánh ít đường', 5),
(47, '2026-03-31 15:10:22', 'Thành Trần', '0551936976', 50000.00, 'Completed', 'P1204 Tòa nhà PTIT, Hà Đông, Hà Nội', '', 2),
(48, '2026-03-18 15:10:22', 'Phúc Vũ', '0310938826', 1525000.00, 'Pending', 'P1204 Tòa nhà PTIT, Hà Đông, Hà Nội', 'Gọi trước khi giao 15p', NULL),
(49, '2026-04-22 15:10:22', 'Chị Khoa Nguyễn', '0565850862', 725000.00, 'Processing', '102 Trần Phú, Hà Đông, Hà Nội', 'Bánh ít đường', NULL),
(50, '2026-03-11 15:10:22', 'Thảo Trần', '0324732096', 140000.00, 'Completed', 'Số 5, Ngõ 175 Xuân Thủy, Cầu Giấy, Hà Nội', 'Giao giờ hành chính', 3),
(51, '2026-04-17 15:10:22', 'Quý cô Lâm Dương', '0788426148', 2075000.00, 'Processing', 'P1204 Tòa nhà PTIT, Hà Đông, Hà Nội', 'Gọi trước khi giao 15p', NULL),
(52, '2026-04-26 15:10:22', 'Hải Dương', '0329745320', 970000.00, 'Cancelled', 'Số 5, Ngõ 175 Xuân Thủy, Cầu Giấy, Hà Nội', 'Giao giờ hành chính', 3),
(53, '2026-03-12 15:10:22', 'Lâm Phạm', '0955071656', 540000.00, 'Processing', 'Số 12, Chùa Bộc, Đống Đa, Hà Nội', '', NULL),
(54, '2026-04-02 15:10:22', 'Quý cô Bảo Lê', '0713500462', 745000.00, 'Cancelled', '102 Trần Phú, Hà Đông, Hà Nội', 'Gọi trước khi giao 15p', 1),
(55, '2026-03-21 15:10:22', 'Cô Thành Phạm', '0509553924', 25000.00, 'Processing', '102 Trần Phú, Hà Đông, Hà Nội', 'Bánh ít đường', NULL),
(56, '2026-03-09 15:10:22', 'Hạnh Bảo Phạm', '0335470254', 385000.00, 'Cancelled', 'P1204 Tòa nhà PTIT, Hà Đông, Hà Nội', 'Bánh ít đường', 4),
(57, '2026-04-02 15:10:22', 'An Mai Hoàng', '0812340815', 845000.00, 'Completed', '6/9/21, Yên Xá, Tân Triều, Hà Nội', '', 3),
(58, '2026-03-17 15:10:22', 'Yến Bùi', '0877221850', 2075000.00, 'Cancelled', 'P1204 Tòa nhà PTIT, Hà Đông, Hà Nội', 'Giao giờ hành chính', 4),
(59, '2026-04-26 15:10:22', 'Hải Đặng', '0566815081', 375000.00, 'Cancelled', '102 Trần Phú, Hà Đông, Hà Nội', '', 1),
(60, '2026-04-11 15:10:22', 'Tùng Dương', '0832133445', 745000.00, 'Completed', 'P1204 Tòa nhà PTIT, Hà Đông, Hà Nội', 'Tặng kèm nến sinh nhật', 1),
(61, '2026-04-12 15:10:22', 'Khoa Bùi', '0544680701', 2400000.00, 'Cancelled', 'P1204 Tòa nhà PTIT, Hà Đông, Hà Nội', 'Giao giờ hành chính', 2),
(62, '2026-04-07 15:10:22', 'Quý ông Hoàng Hoàng', '0867819136', 1275000.00, 'Cancelled', '102 Trần Phú, Hà Đông, Hà Nội', 'Giao giờ hành chính', 5),
(63, '2026-04-07 15:10:22', 'Quý cô Lâm Đặng', '0799791734', 450000.00, 'Cancelled', '102 Trần Phú, Hà Đông, Hà Nội', 'Giao giờ hành chính', 5),
(64, '2026-04-27 15:10:22', 'Anh Trọng Phạm', '0950786996', 50000.00, 'Cancelled', 'P1204 Tòa nhà PTIT, Hà Đông, Hà Nội', 'Giao giờ hành chính', 1),
(65, '2026-03-18 15:10:22', 'Thành Hải Nguyễn', '0951483650', 565000.00, 'Pending', 'Số 12, Chùa Bộc, Đống Đa, Hà Nội', 'Tặng kèm nến sinh nhật', NULL),
(66, '2026-04-16 15:10:22', 'Yến Đặng', '0758854645', 1975000.00, 'Processing', '6/9/21, Yên Xá, Tân Triều, Hà Nội', '', NULL),
(67, '2026-03-17 15:10:22', 'Hạnh Hữu Bùi', '0508248011', 1500000.00, 'Pending', 'Số 5, Ngõ 175 Xuân Thủy, Cầu Giấy, Hà Nội', 'Giao giờ hành chính', NULL),
(68, '2026-03-31 15:10:22', 'Nhật Đặng', '0926925147', 350000.00, 'Cancelled', 'P1204 Tòa nhà PTIT, Hà Đông, Hà Nội', 'Bánh ít đường', 4),
(69, '2026-04-22 15:10:22', 'Quý ông Hưng Mai', '0875474310', 1670000.00, 'Processing', 'Số 5, Ngõ 175 Xuân Thủy, Cầu Giấy, Hà Nội', 'Tặng kèm nến sinh nhật', NULL),
(70, '2026-04-21 15:10:22', 'Hà Hải Lê', '0504363111', 2100000.00, 'Cancelled', '6/9/21, Yên Xá, Tân Triều, Hà Nội', 'Tặng kèm nến sinh nhật', 4),
(71, '2026-04-29 15:10:22', 'Hoàng Phạm', '0742992326', 1525000.00, 'Completed', 'Số 12, Chùa Bộc, Đống Đa, Hà Nội', '', 4),
(72, '2026-04-18 15:10:22', 'Bà Duyên Lê', '0937987547', 140000.00, 'Cancelled', 'Số 12, Chùa Bộc, Đống Đa, Hà Nội', 'Bánh ít đường', 4),
(73, '2026-03-22 15:10:22', 'Cô Chi Lê', '0922866444', 700000.00, 'Completed', '6/9/21, Yên Xá, Tân Triều, Hà Nội', 'Giao giờ hành chính', 2),
(74, '2026-02-28 15:10:22', 'Cô Phương Nguyễn', '0570654251', 1670000.00, 'Pending', '6/9/21, Yên Xá, Tân Triều, Hà Nội', 'Bánh ít đường', NULL),
(75, '2026-03-01 15:10:22', 'Ông Minh Mai', '0761287148', 45000.00, 'Processing', 'Số 5, Ngõ 175 Xuân Thủy, Cầu Giấy, Hà Nội', 'Tặng kèm nến sinh nhật', NULL),
(76, '2026-04-29 15:10:22', 'Anh Trung Mai', '0388960934', 800000.00, 'Cancelled', 'Số 5, Ngõ 175 Xuân Thủy, Cầu Giấy, Hà Nội', 'Tặng kèm nến sinh nhật', 1),
(77, '2026-03-28 15:10:22', 'Bà Vân Nguyễn', '0538487699', 440000.00, 'Cancelled', '6/9/21, Yên Xá, Tân Triều, Hà Nội', 'Tặng kèm nến sinh nhật', 2),
(78, '2026-03-10 15:10:22', 'Thành Bảo Nguyễn', '0377516537', 420000.00, 'Cancelled', '6/9/21, Yên Xá, Tân Triều, Hà Nội', '', 2),
(79, '2026-04-10 15:10:22', 'Anh Khoa Vũ', '0845629444', 880000.00, 'Processing', 'P1204 Tòa nhà PTIT, Hà Đông, Hà Nội', 'Giao giờ hành chính', NULL),
(80, '2026-04-20 15:10:22', 'Cô Nhật Vũ', '0504060029', 25000.00, 'Processing', 'P1204 Tòa nhà PTIT, Hà Đông, Hà Nội', 'Bánh ít đường', NULL),
(81, '2026-04-27 15:10:22', 'Nhật Quang Hoàng', '0861389564', 1695000.00, 'Pending', 'Số 12, Chùa Bộc, Đống Đa, Hà Nội', '', NULL),
(82, '2026-04-15 15:10:22', 'Bà Thành Mai', '0382628142', 950000.00, 'Pending', 'Số 12, Chùa Bộc, Đống Đa, Hà Nội', 'Tặng kèm nến sinh nhật', NULL),
(83, '2026-03-26 15:10:22', 'Bảo Mai Bảo Đặng', '0881718898', 1750000.00, 'Pending', 'P1204 Tòa nhà PTIT, Hà Đông, Hà Nội', '', NULL),
(84, '2026-03-13 15:10:22', 'Phương Đặng', '0899158554', 385000.00, 'Pending', 'P1204 Tòa nhà PTIT, Hà Đông, Hà Nội', 'Tặng kèm nến sinh nhật', NULL),
(85, '2026-04-27 15:10:22', 'Quý cô Thành Vũ', '0351226466', 870000.00, 'Pending', '102 Trần Phú, Hà Đông, Hà Nội', 'Bánh ít đường', NULL),
(86, '2026-03-29 15:10:22', 'Phương Hải Phạm', '0775291320', 1600000.00, 'Completed', 'P1204 Tòa nhà PTIT, Hà Đông, Hà Nội', 'Giao giờ hành chính', 1),
(87, '2026-03-09 15:10:22', 'Thành Hải Đặng', '0575585619', 50000.00, 'Cancelled', '6/9/21, Yên Xá, Tân Triều, Hà Nội', 'Giao giờ hành chính', 1),
(88, '2026-03-15 15:10:22', 'Kim Bùi', '0546544678', 535000.00, 'Cancelled', '102 Trần Phú, Hà Đông, Hà Nội', 'Gọi trước khi giao 15p', 1),
(89, '2026-04-14 15:10:22', 'Vũ Mai', '0345576675', 825000.00, 'Completed', 'Số 12, Chùa Bộc, Đống Đa, Hà Nội', 'Giao giờ hành chính', 1),
(90, '2026-04-02 15:10:22', 'Linh Phạm', '0345905902', 450000.00, 'Completed', 'Số 5, Ngõ 175 Xuân Thủy, Cầu Giấy, Hà Nội', 'Giao giờ hành chính', 3),
(91, '2026-03-23 15:10:22', 'Bác Quang Vũ', '0773983801', 1700000.00, 'Cancelled', 'P1204 Tòa nhà PTIT, Hà Đông, Hà Nội', '', 5),
(92, '2026-04-07 15:10:22', 'Bà Hạnh Đặng', '0345142875', 1340000.00, 'Processing', '102 Trần Phú, Hà Đông, Hà Nội', '', NULL),
(93, '2026-03-21 15:10:22', 'Nhật Vũ', '0576860900', 800000.00, 'Cancelled', '6/9/21, Yên Xá, Tân Triều, Hà Nội', 'Giao giờ hành chính', 5),
(94, '2026-04-20 15:10:22', 'Bảo Hoàng', '0898331068', 590000.00, 'Completed', '102 Trần Phú, Hà Đông, Hà Nội', 'Giao giờ hành chính', 4),
(95, '2026-03-08 15:10:22', 'Nhật Bảo Lê', '0767030234', 1600000.00, 'Completed', 'P1204 Tòa nhà PTIT, Hà Đông, Hà Nội', 'Gọi trước khi giao 15p', 3),
(96, '2026-03-11 15:10:22', 'Quý cô Kim Nguyễn', '0993612603', 70000.00, 'Completed', '102 Trần Phú, Hà Đông, Hà Nội', 'Bánh ít đường', 4),
(97, '2026-03-10 15:10:22', 'Xuân Đặng', '0379408834', 835000.00, 'Cancelled', '6/9/21, Yên Xá, Tân Triều, Hà Nội', 'Giao giờ hành chính', 2),
(98, '2026-04-20 15:10:22', 'Ông Trọng Lê', '0861642827', 1195000.00, 'Cancelled', '102 Trần Phú, Hà Đông, Hà Nội', '', NULL),
(99, '2026-03-05 15:10:22', 'Minh Thị Bùi', '0999244076', 1625000.00, 'Processing', 'Số 5, Ngõ 175 Xuân Thủy, Cầu Giấy, Hà Nội', 'Giao giờ hành chính', NULL),
(100, '2026-03-03 15:10:22', 'Tú Văn Nguyễn', '0961387105', 90000.00, 'Completed', 'P1204 Tòa nhà PTIT, Hà Đông, Hà Nội', '', 1),
(101, '2026-04-29 11:51:35', 'Công chúa Điện Biên', '0123456789', 385000.00, 'Processing', '101 trần phú hà đông', 'nhiều đường ít ngọt', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderdetail`
--

CREATE TABLE `orderdetail` (
  `DetailID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL DEFAULT 1,
  `PriceAtOrder` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orderdetail`
--

INSERT INTO `orderdetail` (`DetailID`, `OrderID`, `ProductID`, `Quantity`, `PriceAtOrder`) VALUES
(1, 1, 5, 1, 35000.00),
(2, 2, 4, 2, 450000.00),
(3, 2, 5, 1, 35000.00),
(4, 3, 4, 1, 450000.00),
(5, 3, 1, 1, 800000.00),
(6, 3, 6, 1, 25000.00),
(7, 4, 5, 2, 35000.00),
(8, 4, 2, 1, 350000.00),
(9, 4, 6, 2, 25000.00),
(10, 5, 4, 1, 450000.00),
(11, 5, 2, 2, 350000.00),
(12, 6, 5, 1, 35000.00),
(13, 6, 2, 1, 350000.00),
(14, 6, 6, 2, 25000.00),
(15, 7, 3, 2, 45000.00),
(16, 7, 4, 2, 450000.00),
(17, 8, 1, 1, 800000.00),
(18, 8, 6, 1, 25000.00),
(19, 9, 1, 2, 800000.00),
(20, 10, 2, 1, 350000.00),
(21, 11, 1, 2, 800000.00),
(22, 12, 6, 1, 25000.00),
(23, 12, 4, 1, 450000.00),
(24, 13, 6, 2, 25000.00),
(25, 14, 6, 2, 25000.00),
(26, 15, 5, 1, 35000.00),
(27, 15, 4, 1, 450000.00),
(28, 16, 5, 2, 35000.00),
(29, 17, 6, 2, 25000.00),
(30, 17, 2, 2, 350000.00),
(31, 17, 4, 1, 450000.00),
(32, 18, 2, 1, 350000.00),
(33, 18, 4, 2, 450000.00),
(34, 19, 3, 2, 45000.00),
(35, 20, 2, 2, 350000.00),
(36, 21, 2, 1, 350000.00),
(37, 21, 6, 2, 25000.00),
(38, 21, 5, 2, 35000.00),
(39, 22, 4, 2, 450000.00),
(40, 22, 6, 1, 25000.00),
(41, 22, 1, 1, 800000.00),
(42, 23, 3, 1, 45000.00),
(43, 24, 3, 2, 45000.00),
(44, 24, 5, 2, 35000.00),
(45, 24, 2, 2, 350000.00),
(46, 25, 6, 2, 25000.00),
(47, 25, 3, 2, 45000.00),
(48, 26, 4, 2, 450000.00),
(49, 27, 2, 1, 350000.00),
(50, 27, 4, 2, 450000.00),
(51, 27, 5, 2, 35000.00),
(52, 28, 1, 2, 800000.00),
(53, 29, 5, 2, 35000.00),
(54, 29, 4, 1, 450000.00),
(55, 29, 1, 2, 800000.00),
(56, 30, 4, 1, 450000.00),
(57, 31, 3, 1, 45000.00),
(58, 31, 2, 1, 350000.00),
(59, 31, 1, 2, 800000.00),
(60, 32, 5, 1, 35000.00),
(61, 32, 2, 2, 350000.00),
(62, 33, 5, 1, 35000.00),
(63, 33, 6, 1, 25000.00),
(64, 34, 3, 2, 45000.00),
(65, 34, 1, 1, 800000.00),
(66, 35, 5, 1, 35000.00),
(67, 35, 3, 1, 45000.00),
(68, 35, 1, 2, 800000.00),
(69, 36, 3, 1, 45000.00),
(70, 36, 1, 2, 800000.00),
(71, 36, 4, 1, 450000.00),
(72, 37, 2, 2, 350000.00),
(73, 37, 4, 2, 450000.00),
(74, 37, 3, 1, 45000.00),
(75, 38, 5, 1, 35000.00),
(76, 38, 1, 2, 800000.00),
(77, 38, 3, 2, 45000.00),
(78, 39, 5, 1, 35000.00),
(79, 40, 4, 1, 450000.00),
(80, 41, 5, 1, 35000.00),
(81, 42, 1, 2, 800000.00),
(82, 43, 1, 1, 800000.00),
(83, 43, 2, 2, 350000.00),
(84, 44, 2, 2, 350000.00),
(85, 44, 4, 2, 450000.00),
(86, 45, 1, 1, 800000.00),
(87, 45, 6, 1, 25000.00),
(88, 46, 2, 2, 350000.00),
(89, 46, 1, 1, 800000.00),
(90, 46, 5, 1, 35000.00),
(91, 47, 6, 2, 25000.00),
(92, 48, 1, 1, 800000.00),
(93, 48, 6, 1, 25000.00),
(94, 48, 2, 2, 350000.00),
(95, 49, 6, 1, 25000.00),
(96, 49, 2, 2, 350000.00),
(97, 50, 3, 2, 45000.00),
(98, 50, 6, 2, 25000.00),
(99, 51, 6, 1, 25000.00),
(100, 51, 1, 2, 800000.00),
(101, 51, 4, 1, 450000.00),
(102, 52, 5, 2, 35000.00),
(103, 52, 4, 2, 450000.00),
(104, 53, 4, 1, 450000.00),
(105, 53, 3, 2, 45000.00),
(106, 54, 3, 1, 45000.00),
(107, 54, 2, 2, 350000.00),
(108, 55, 6, 1, 25000.00),
(109, 56, 5, 1, 35000.00),
(110, 56, 2, 1, 350000.00),
(111, 57, 1, 1, 800000.00),
(112, 57, 3, 1, 45000.00),
(113, 58, 1, 2, 800000.00),
(114, 58, 6, 1, 25000.00),
(115, 58, 4, 1, 450000.00),
(116, 59, 2, 1, 350000.00),
(117, 59, 6, 1, 25000.00),
(118, 60, 3, 1, 45000.00),
(119, 60, 2, 2, 350000.00),
(120, 61, 2, 1, 350000.00),
(121, 61, 4, 1, 450000.00),
(122, 61, 1, 2, 800000.00),
(123, 62, 2, 1, 350000.00),
(124, 62, 6, 1, 25000.00),
(125, 62, 4, 2, 450000.00),
(126, 63, 4, 1, 450000.00),
(127, 64, 6, 2, 25000.00),
(128, 65, 3, 2, 45000.00),
(129, 65, 6, 1, 25000.00),
(130, 65, 4, 1, 450000.00),
(131, 66, 2, 1, 350000.00),
(132, 66, 6, 1, 25000.00),
(133, 66, 1, 2, 800000.00),
(134, 67, 1, 1, 800000.00),
(135, 67, 2, 2, 350000.00),
(136, 68, 2, 1, 350000.00),
(137, 69, 6, 1, 25000.00),
(138, 69, 1, 2, 800000.00),
(139, 69, 3, 1, 45000.00),
(140, 70, 4, 1, 450000.00),
(141, 70, 6, 2, 25000.00),
(142, 70, 1, 2, 800000.00),
(143, 71, 1, 1, 800000.00),
(144, 71, 6, 1, 25000.00),
(145, 71, 2, 2, 350000.00),
(146, 72, 6, 1, 25000.00),
(147, 72, 5, 2, 35000.00),
(148, 72, 3, 1, 45000.00),
(149, 73, 2, 2, 350000.00),
(150, 74, 5, 2, 35000.00),
(151, 74, 1, 2, 800000.00),
(152, 75, 3, 1, 45000.00),
(153, 76, 1, 1, 800000.00),
(154, 77, 2, 1, 350000.00),
(155, 77, 3, 2, 45000.00),
(156, 78, 2, 1, 350000.00),
(157, 78, 5, 2, 35000.00),
(158, 79, 3, 1, 45000.00),
(159, 79, 5, 1, 35000.00),
(160, 79, 1, 1, 800000.00),
(161, 80, 6, 1, 25000.00),
(162, 81, 3, 1, 45000.00),
(163, 81, 6, 2, 25000.00),
(164, 81, 1, 2, 800000.00),
(165, 82, 4, 2, 450000.00),
(166, 82, 6, 2, 25000.00),
(167, 83, 1, 1, 800000.00),
(168, 83, 6, 2, 25000.00),
(169, 83, 4, 2, 450000.00),
(170, 84, 5, 1, 35000.00),
(171, 84, 2, 1, 350000.00),
(172, 85, 2, 1, 350000.00),
(173, 85, 4, 1, 450000.00),
(174, 85, 5, 2, 35000.00),
(175, 86, 2, 2, 350000.00),
(176, 86, 4, 2, 450000.00),
(177, 87, 6, 2, 25000.00),
(178, 88, 4, 1, 450000.00),
(179, 88, 6, 2, 25000.00),
(180, 88, 5, 1, 35000.00),
(181, 89, 1, 1, 800000.00),
(182, 89, 6, 1, 25000.00),
(183, 90, 4, 1, 450000.00),
(184, 91, 4, 2, 450000.00),
(185, 91, 1, 1, 800000.00),
(186, 92, 3, 2, 45000.00),
(187, 92, 2, 1, 350000.00),
(188, 92, 4, 2, 450000.00),
(189, 93, 1, 1, 800000.00),
(190, 94, 4, 1, 450000.00),
(191, 94, 6, 2, 25000.00),
(192, 94, 3, 2, 45000.00),
(193, 95, 1, 2, 800000.00),
(194, 96, 5, 2, 35000.00),
(195, 97, 2, 1, 350000.00),
(196, 97, 5, 1, 35000.00),
(197, 97, 4, 1, 450000.00),
(198, 98, 2, 1, 350000.00),
(199, 98, 1, 1, 800000.00),
(200, 98, 3, 1, 45000.00),
(201, 99, 1, 2, 800000.00),
(202, 99, 6, 1, 25000.00),
(203, 100, 3, 2, 45000.00),
(204, 101, 2, 1, 350000.00),
(205, 101, 5, 1, 35000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Price` decimal(10,2) NOT NULL,
  `CategoryID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`ProductID`, `ProductName`, `Description`, `Image`, `Price`, `CategoryID`) VALUES
(1, 'Blue Dream Art Cake', 'Tuyệt tác bánh kem Starry Night huyền bí.', 'img/1778081852_p7.jpg', 800000.00, 2),
(2, 'Merry Berry Tiramisu', 'Sự kết hợp hoàn hảo giữa vị cà phê và dâu tây.', 'img/p2.jpg', 350000.00, 2),
(3, 'Cookies Hạnh Nhân', 'Giòn rụm, tan ngay trong miệng với vị bùi của hạt.', 'img/p3.jpg', 45000.00, 3),
(4, 'Puppy Oreo Cake', 'Cốt bánh socola hòa quyện cùng kem phô mai.', 'img/p4.jpg', 450000.00, 1),
(5, 'Bánh Cuộn Quế', 'Cốt bánh mềm xốp nướng vàng thơm lừng.', 'img/p5.jpg', 35000.00, 2),
(6, 'Cookies Marshmallow', 'Bánh quy giòn rụm điểm xuyết kẹo dẻo.', 'img/p6.jpg', 25000.00, 3);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`AccountID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `AdminID` (`AdminID`);

--
-- Chỉ mục cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`DetailID`),
  ADD KEY `OrderID` (`OrderID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `AccountID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `DetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `account` (`AccountID`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `order` (`OrderID`) ON DELETE CASCADE,
  ADD CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
