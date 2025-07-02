-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 02, 2025 lúc 05:57 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `da1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Áo Nam ', 1, NULL, '2025-02-15'),
(3, 'Áo Nữ', 1, '2025-02-14', '2025-02-15'),
(4, 'Áo trẻ em', 0, '2025-02-14', '2025-02-15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cus`
--

CREATE TABLE `cus` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cus`
--

INSERT INTO `cus` (`id`, `id_user`, `name`, `address`, `tel`, `created_at`, `updated_at`) VALUES
(9, 10, 'Nhà giả kim', 'sfsdfad', '0987654321', '2025-02-21', '2025-02-21'),
(10, 15, 'Nhà giả kim', 'eqw', '0987654321', '2025-02-21', '2025-02-21'),
(11, 9, 'Nhà giả kim', 't k có nhà ok', '0987654321', '2025-02-25', '2025-02-25'),
(18, 11, 'Nhà giả kim', '02937123', '1', '2025-02-26', '2025-02-26'),
(19, 11, 'ádfasdfasd', 'ádfafasdfgsa', '0987654321', '2025-02-26', '2025-02-26'),
(20, 14, 'Nhà giả kim', 'sfsdfad', '0987654323', '2025-03-04', '2025-03-04'),
(21, 19, 'admin', 'sứa', '0987654321', '2025-03-05', '2025-03-05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_cus` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `payment` int(11) NOT NULL COMMENT '1:thanh toán sau khi nhận hàng 2:thanh toán onl',
  `payment_status` int(11) NOT NULL DEFAULT 1 COMMENT '1 là chưa thanh toán ,2 là đã thanh toán',
  `status` enum('1','2','3','4','5','6') NOT NULL DEFAULT '1' COMMENT '1:chờ xác nhận 2:đã xác nhận 3:đang vận chuyển ,4 :giao hàng thành công 5:đã hủy',
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `order_code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `id_user`, `id_cus`, `total_price`, `payment`, `payment_status`, `status`, `created_at`, `updated_at`, `order_code`) VALUES
(37, 10, 9, 200000, 1, 2, '4', '2025-02-21', '2025-02-21', 'ORD20250221-00037'),
(38, 15, 10, 240000, 1, 2, '4', '2025-02-21', '2025-02-21', 'ORD20250221-00038'),
(39, 9, 11, 200000, 1, 1, '5', '2025-02-25', '2025-02-25', 'ORD20250225-00039'),
(40, 11, 12, 40000, 1, 1, '1', '2025-02-26', '2025-02-26', 'ORD20250226-00040'),
(41, 11, 11, 120000, 1, 2, '4', '2025-02-26', '2025-02-26', 'ORD20250226-00041'),
(42, 9, 11, 120000, 1, 2, '4', '2025-02-26', '2025-02-26', 'ORD20250226-00042'),
(43, 9, 11, 40000, 1, 2, '4', '2025-02-26', '2025-02-26', 'ORD20250226-00043'),
(44, 11, 19, 130000, 1, 1, '5', '2025-02-27', '2025-02-27', 'ORD20250227-00044'),
(45, 11, 19, 90000, 1, 1, '5', '2025-02-27', '2025-02-27', 'ORD20250227-00045'),
(46, 11, 19, 310000, 1, 1, '5', '2025-02-27', '2025-02-27', 'ORD20250227-00046'),
(47, 11, 19, 130000, 1, 2, '6', '2025-02-27', '2025-02-27', 'ORD20250227-00047'),
(48, 11, 19, 169000, 1, 1, '2', '2025-02-27', '2025-02-27', 'ORD20250227-00048'),
(49, 14, 20, 180000, 1, 2, '4', '2025-03-04', '2025-03-04', 'ORD20250304-00049'),
(50, 14, 20, 90000, 1, 2, '4', '2025-03-04', '2025-03-04', 'ORD20250304-00050'),
(51, 14, 20, 220000, 1, 1, '5', '2025-03-05', '2025-03-05', 'ORD20250305-00051'),
(52, 19, 11, 130000, 1, 2, '4', '2025-03-05', '2025-03-05', 'ORD20250305-00002'),
(53, 19, 21, 170000, 1, 2, '4', '2025-03-05', '2025-03-05', 'ORD20250305-00003');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`id`, `id_order`, `product_id`, `quantity`, `price`, `subtotal`, `created_at`, `updated_at`) VALUES
(28, 37, 13, 5, 40000, 200000, '2025-02-21', '2025-02-21'),
(29, 38, 13, 6, 40000, 240000, '2025-02-21', '2025-02-21'),
(30, 39, 13, 5, 40000, 200000, '2025-02-25', '2025-02-25'),
(31, 40, 13, 1, 40000, 40000, '2025-02-26', '2025-02-26'),
(32, 41, 13, 3, 40000, 120000, '2025-02-26', '2025-02-26'),
(33, 42, 13, 3, 40000, 120000, '2025-02-26', '2025-02-26'),
(34, 43, 13, 1, 40000, 40000, '2025-02-26', '2025-02-26'),
(35, 44, 12, 1, 90000, 90000, '2025-02-27', '2025-02-27'),
(36, 44, 13, 1, 40000, 130000, '2025-02-27', '2025-02-27'),
(37, 45, 12, 1, 90000, 90000, '2025-02-27', '2025-02-27'),
(38, 46, 12, 3, 90000, 270000, '2025-02-27', '2025-02-27'),
(39, 46, 13, 1, 40000, 310000, '2025-02-27', '2025-02-27'),
(40, 47, 12, 1, 90000, 90000, '2025-02-27', '2025-02-27'),
(41, 47, 13, 1, 40000, 130000, '2025-02-27', '2025-02-27'),
(42, 48, 12, 1, 90000, 90000, '2025-02-27', '2025-02-27'),
(44, 49, 12, 2, 90000, 180000, '2025-03-04', '2025-03-04'),
(45, 50, 12, 1, 90000, 90000, '2025-03-04', '2025-03-04'),
(46, 51, 12, 2, 90000, 180000, '2025-03-05', '2025-03-05'),
(47, 51, 13, 1, 40000, 220000, '2025-03-05', '2025-03-05'),
(48, 52, 12, 1, 90000, 90000, '2025-03-05', '2025-03-05'),
(49, 52, 13, 1, 40000, 130000, '2025-03-05', '2025-03-05'),
(50, 53, 12, 1, 90000, 90000, '2025-03-05', '2025-03-05'),
(51, 53, 13, 2, 40000, 80000, '2025-03-05', '2025-03-05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `img_thumbnail` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `price_sale` int(11) NOT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `stastus` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` date DEFAULT NULL,
  `update_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `product_code`, `price`, `img_thumbnail`, `description`, `content`, `price_sale`, `view`, `stastus`, `quantity`, `created_at`, `update_at`) VALUES
(12, 'Nhà giả kim', 1, 'M123', '100000', 'assets/image/uploads/products/1740099057_default.jpg', 'ko', 'ko', 90000, 42, ' 0', 97, '2025-02-17', '2025-02-27'),
(13, 'Áo siêu cấp', 3, 'AAAAA', '60000', 'assets/image/uploads/products/1740099042_gallery-06.jpg', 'aaaaaa', 'sfasgsdgdsg', 40000, 23, ' 0', 44, '2025-02-17', '2025-02-21'),
(14, 'Áo xương rồng', 3, 'Mqqqqq', '99000', 'assets/image/uploads/products/1740644333_product-08.jpg', 'Áo thun mát mẻ vào mùa hè', 'Áo với họa tiết xương rồng đẹp đẽ không bị phai hình', 79000, 2, '0', 110, '2025-02-27', '2025-02-27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT '0' COMMENT '1:nhân viên 3:admintong 0:user',
  `ban` int(11) DEFAULT 0 COMMENT '1:bị ban 0:bình thường',
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `pass`, `email`, `image`, `address`, `tel`, `role`, `ban`, `created_at`, `updated_at`) VALUES
(11, 'Nhà giả kim', '11111111', 'progame1900@gmail.com', NULL, NULL, NULL, '0', 0, '2025-02-17', '2025-03-03'),
(13, 'admin', 'aaaaaaaa', 'a@gmail.com', NULL, NULL, NULL, '0', 0, '2025-02-21', '2025-03-03'),
(14, 'aaaa', '11111111', 'abc@gmail.com', NULL, NULL, NULL, '0', 0, '2025-02-21', '2025-02-21'),
(16, 'admin', '11111111', 'admin@gmail.com', NULL, NULL, NULL, '3', 0, '2025-03-03', '2025-03-03'),
(18, 'Nhà giả kim', '11111111', 'vanchuyen@gmail.com', NULL, NULL, NULL, '2', 0, '2025-03-03', '2025-03-03'),
(19, 'Nhà giả kim', '11111111', 'nhanvien@gmail.com', NULL, NULL, NULL, '1', 0, '2025-03-04', '2025-03-04');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cus`
--
ALTER TABLE `cus`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_code` (`order_code`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `cus`
--
ALTER TABLE `cus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
