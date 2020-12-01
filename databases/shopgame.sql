-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 01, 2020 lúc 04:11 PM
-- Phiên bản máy phục vụ: 10.4.13-MariaDB
-- Phiên bản PHP: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shopgame`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_accounts`
--

CREATE TABLE `table_accounts` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'member',
  `username` varchar(255) NOT NULL,
  `passwords` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number_phone` varchar(11) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT 1,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `table_accounts`
--

INSERT INTO `table_accounts` (`id`, `first_name`, `last_name`, `role`, `username`, `passwords`, `email`, `number_phone`, `gender`, `create_time`) VALUES
(3, 'Nguyễn', 'Nguyên', 'member', 'Ily1606', '6d590d0d8702e8132a77913bf707de45', 'khuonmatdangthuong45@gmail.com', '0328267412', 1, '2020-12-01 13:19:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_product`
--

CREATE TABLE `table_product` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `descryption` text DEFAULT NULL,
  `money` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_type`
--

CREATE TABLE `table_type` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `descryption` text DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `table_accounts`
--
ALTER TABLE `table_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_product`
--
ALTER TABLE `table_product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_type`
--
ALTER TABLE `table_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `table_accounts`
--
ALTER TABLE `table_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `table_product`
--
ALTER TABLE `table_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `table_type`
--
ALTER TABLE `table_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
