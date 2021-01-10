-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 10, 2021 lúc 06:21 PM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.2.34

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
  `avatar` varchar(255) NOT NULL DEFAULT '/assets/img/avatar.jpg',
  `role` varchar(255) NOT NULL DEFAULT 'member',
  `username` varchar(255) NOT NULL,
  `passwords` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number_phone` varchar(11) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT 1,
  `money` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `table_accounts`
--

INSERT INTO `table_accounts` (`id`, `first_name`, `last_name`, `avatar`, `role`, `username`, `passwords`, `email`, `number_phone`, `gender`, `money`, `status`, `create_time`) VALUES
(3, 'Nguyễn', 'Nguyên', '/assets/img/avatar.jpg', 'admin', 'Ily1606', '6d590d0d8702e8132a77913bf707de45', 'khuonmatdangthuong45@gmail.com', '0328267412', 1, 0, 1, '2020-12-01 13:19:28'),
(4, 'Test1', 'Nguyên', '/assets/img/avatar.jpg', 'member', 'no1.ily1606@gmail.com', 'Login_with_socical', 'no1.ily1606@gmail.com', '0328267412', 1, 0, 1, '2020-12-22 15:44:12'),
(5, 'Nguyễn đức', 'Huy', '/assets/img/avatar.jpg', 'member', 'duchuy.12012001@gmail.com', 'Login_with_socical', 'duchuy.12012001@gmail.com', NULL, 1, 0, 1, '2021-01-10 09:44:34');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_biller`
--

CREATE TABLE `table_biller` (
  `id` int(11) NOT NULL,
  `id_product` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `money` int(11) DEFAULT NULL,
  `soluong` int(11) DEFAULT NULL,
  `single_money` int(11) NOT NULL,
  `money_ship` int(11) DEFAULT NULL,
  `total_money` int(11) NOT NULL,
  `payed` int(11) DEFAULT 0,
  `status` int(11) DEFAULT 1,
  `address` varchar(255) NOT NULL DEFAULT 'IN_GAME',
  `number_phone` varchar(255) NOT NULL DEFAULT 'IN_GAME',
  `create_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `table_biller`
--

INSERT INTO `table_biller` (`id`, `id_product`, `user_id`, `money`, `soluong`, `single_money`, `money_ship`, `total_money`, `payed`, `status`, `address`, `number_phone`, `create_time`) VALUES
(5, 6, 3, 89000, 1, 89000, 50000, 139000, 0, 1, '15 - Nguyễn Đình Hiến - Quận Ngũ Hành Sơn - TP Đà Nẵng', '0328267412', '2020-12-28 17:06:41'),
(7, 5, 3, 20000, 1, 20000, 0, 20000, 1, 1, 'IN_GAME', 'IN_GAME', '2020-12-30 14:15:34'),
(8, 8, 4, 50000, 1, 50000, 0, 50000, 1, 4, 'IN_GAME', 'IN_GAME', '2020-12-30 14:30:25'),
(9, 9, 3, 20000, 1, 20000, 10000, 30000, 1, 0, '15 - Nguyễn Đình Hiến - Quận Ngũ Hành Sơn - TP.Đà Nẵng', '03258267412', '2020-12-31 02:53:45'),
(10, 9, 3, 20000, 1, 20000, 10000, 30000, 0, 0, '15 - Nguyễn Đình Hiến', '0328267412', '2020-12-31 03:39:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_config`
--

CREATE TABLE `table_config` (
  `id` int(11) NOT NULL,
  `maintance` int(11) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `table_config`
--

INSERT INTO `table_config` (`id`, `maintance`, `create_time`) VALUES
(1, 0, '2020-12-23 19:54:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_games`
--

CREATE TABLE `table_games` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `user_create` int(11) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `table_games`
--

INSERT INTO `table_games` (`id`, `name`, `user_create`, `create_time`, `status`) VALUES
(1, 'Liên minh huyền thoại', 3, '2020-12-22 16:52:33', 0),
(2, 'Apex Lengends', 3, '2020-12-22 16:55:16', 0),
(3, 'Liên quân mobile', 3, '2020-12-22 16:55:44', 0),
(4, 'PUBG', 3, '2020-12-22 17:19:20', 0),
(5, 'LOL', 3, '2020-12-23 09:24:18', 0),
(6, 'Liên minh tốc chiến', 3, '2020-12-28 14:05:49', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_history_payemnt`
--

CREATE TABLE `table_history_payemnt` (
  `id` int(11) NOT NULL,
  `vnd` int(11) DEFAULT NULL,
  `from_biller` varchar(255) DEFAULT NULL,
  `from_user` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_medias`
--

CREATE TABLE `table_medias` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `user_upload` int(11) DEFAULT NULL,
  `url_file` varchar(255) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `table_medias`
--

INSERT INTO `table_medias` (`id`, `type`, `user_upload`, `url_file`, `create_time`) VALUES
(1, 'images', 3, '/storage/images/3_71541685831707.jpeg', '2020-12-23 12:31:57'),
(2, 'images', 3, '/storage/images/3_437609059283796.jpeg', '2020-12-23 12:31:58'),
(3, 'images', 3, '/storage/images/3_771660661589788.jpeg', '2020-12-23 13:10:28'),
(4, 'images', 3, '/storage/images/3_1405330983820980.jpeg', '2020-12-23 13:10:31'),
(5, 'images', 3, '/storage/images/3_1498886726776824.jpeg', '2020-12-23 13:12:24'),
(6, 'images', 3, '/storage/images/3_76488635975716.jpeg', '2020-12-23 13:12:26'),
(7, 'images', 3, '/storage/images/3_151651693275328.jpeg', '2020-12-23 13:14:56'),
(8, 'images', 3, '/storage/images/3_759148095093007.jpeg', '2020-12-23 13:15:00'),
(9, 'images', 3, '/storage/images/3_962733055983921.jpeg', '2020-12-23 13:22:28'),
(10, 'images', 3, '/storage/images/3_389381774879250.png', '2020-12-23 13:22:30'),
(11, 'images', 3, '/storage/images/3_200026278075942.png', '2020-12-23 13:27:39'),
(12, 'images', 3, '/storage/images/3_213583299966468.jpeg', '2020-12-23 17:21:27'),
(26, 'images', 3, '/storage/images/3_1349398046667630.png', '2020-12-28 14:27:39'),
(27, 'images', 3, '/storage/images/3_863376917865568.png', '2020-12-28 14:27:44'),
(28, 'images', 3, '/storage/images/3_1475603348738288.jpeg', '2020-12-28 14:28:32'),
(29, 'images', 3, '/storage/images/3_1144326059041292.jpeg', '2020-12-31 02:50:38'),
(30, 'images', 3, '/storage/images/3_929579702819200.jpeg', '2020-12-31 02:52:22'),
(31, 'images', 3, '/storage/images/3_538139105514416.jpeg', '2020-12-31 02:52:46'),
(32, 'images', 5, '/storage/images/5_1290141922310505.jpeg', '2021-01-10 09:47:39'),
(33, 'images', 5, '/storage/images/5_555787017303476.jpeg', '2021-01-10 09:47:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_product`
--

CREATE TABLE `table_product` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `descryption` text DEFAULT NULL,
  `money` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `soluong` int(11) NOT NULL DEFAULT 1,
  `type_game` int(11) NOT NULL,
  `poster` text NOT NULL,
  `banner` text NOT NULL,
  `from_sale` int(11) NOT NULL,
  `end_sale` int(11) NOT NULL,
  `money_sale` int(11) NOT NULL,
  `enable_sale` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `selled` int(11) NOT NULL DEFAULT 0,
  `stats` float NOT NULL DEFAULT 0,
  `count_voted` int(11) DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `enable_ship` int(11) NOT NULL,
  `money_ship` int(11) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `table_product`
--

INSERT INTO `table_product` (`id`, `name`, `descryption`, `money`, `user_id`, `soluong`, `type_game`, `poster`, `banner`, `from_sale`, `end_sale`, `money_sale`, `enable_sale`, `type`, `selled`, `stats`, `count_voted`, `status`, `enable_ship`, `money_ship`, `create_time`) VALUES
(1, 'Gift code Yasuo cao bồi', 'Gift code Yasuo cao bồi giá rẻ', 200000, 3, 1, 1, '[1]', '[2]', 0, 0, 0, 0, 4, 0, 0, 0, 1, 0, 0, '2020-12-23 12:32:00'),
(2, 'Gift code Lessin quyền thái', 'Gift code Lessin quyền thái giá rẻ', 250000, 3, 1, 1, '[3]', '[4]', 0, 0, 0, 0, 4, 0, 0, 0, 1, 0, 0, '2020-12-23 13:10:35'),
(3, 'Gift code Jinx vệ binh tinh tú', 'Gift code Jinx vệ binh tinh tú', 300000, 3, 1, 1, '[5]', '[6]', 0, 0, 0, 0, 4, 0, 3, 3, 1, 0, 0, '2020-12-23 13:12:30'),
(4, 'Gift code garen quân đoàn thép', 'Gift code garen quân đoàn thép giá rẻ', 250000, 3, 1, 1, '[7]', '[8]', 0, 0, 0, 0, 4, 0, 0, 0, 1, 0, 0, '2020-12-23 13:15:01'),
(5, 'Gift code: R-99  Rule of Lawd', 'Gift code: R-99  Rule of Lawd', 20000, 3, 1, 2, '[9]', '[10]', 0, 0, 0, 0, 4, 1, 3.2, 5, 1, 0, 0, '2020-12-23 13:22:31'),
(6, 'Áo thun Yasuo ', 'Áo thun Yasuo', 89000, 3, 10, 1, '[11]', '[]', 0, 0, 0, 0, 3, 0, 0, 0, 1, 1, 50000, '2020-12-23 13:27:41'),
(7, 'Tay cầm chơi game PUGB - Terios T6 hỗ trợ app map phím Shootingplus v3', 'Bộ sản phẩm bao gồm: 1 tay cầm + 1 cáp sạc kết nối bluetooth với android\r\nBạn cần chơi trên PS3, PC, Laptop window 7 trở lên: mua kèm usb trong option\r\nLinkreview: https://youtu.be/P72MiQVM5RU\r\n\r\n==============================================================\r\nHỗ trợ app Shooting Plus V3 chơi trên iOS, Android\r\nHỗ trợ usb wifi chơi trên pc, ps3 hoặc laptop (mua kèm) vì usb theo Terios T6 là usb giả không dùng được\r\nPin sạc dùng lên tới 6-8h\r\nĐế giữ điện thoại 6inch-6.3inch\r\nĐơn giản và dễ sử dụng\r\n===================================\r\n\r\nHỗ trợ chơi trên android, android box, tivi thông minh chạy android\r\nChơi trên iOS: như iPHone, iPad (ios 13.3 trở xuống)\r\nKèm usb wifi đi kèm chơi trên pc, laptop hoặc ps3\r\nChơi PUBG không bị ban nick, chỉ cần map phím (chỉ dùng trên shootingplus v3)\r\nĐế giữ điện thoại lên tới 6inch\r\n=====================================================\r\n\r\nHướng dẫn kết nối tay cầm chơi game Terios T6\r\nAndroid:\r\nKết nối qua ứng dụng Shootingplus V3 Nhấn giữ 2 nút A (HOẶC ANDROID + Nguồn\r\nKết nối thông thường nhấn giữ X + Nguồn (X trước)\r\n\r\nMở điện thoại, tablet hoặc tivi android dò tìm và kết nối. Phần lớn các game trên CH Play có thể chơi trực tiếp không cần map phím.\r\n\r\nXem video hướng dẫn: https://youtu.be/l_qNGINgX3Q\r\n \r\n=================================================\r\niOS: iPhone,iPad (hiện chỉ hỗ trợ ios 13.3 trở xuống)\r\nKết nối qua ứng dụng ShootingPlus V3 Nhấn giữ 2 nút Y (HOẶC IOS) + Nguồn .)\r\nTrên iphone, ipad mở kết nối bluetooth\r\nTrên iOS cần tải ứng dụng shooting plusv3 (tải trên app store)\r\n\r\nVideo online hướng dẫn sử dụng shootingplus v3: https://youtu.be/mW6GdWfyEPI\r\n \r\nVới PS3, PC hoặc window kết nối qua usb:\r\nGắn usb vào máy tính, hoặc PS3 trước\r\nTrên tay game Terios T6 nhấn 2 nút L1+ nguồn (L1 trước)\r\n\r\nXem video hướng dẫn Shootingpllus v3 treen android: https://youtu.be/l_qNGINgX3Q --&gt; chỉ dùng cho tay game có hỗ trợ app\r\nTren ios: https://youtu.be/mW6GdWfyEPI\r\n\r\nLink chơi game online hỗ trợ tay cầm simulator:\r\nhttps://www.crazygames.com/t/sim\r\nhttps://itch.io/games/free/input-gamepad/platform-windows\r\n\r\nChơi game giả lập:\r\nGiả lập N64: https://kenhgiatot.com/blogs/huong-dan-su-dung/huong-dan-gia-lap-nintendon64-choi-tren-window-va-android\r\nGiả lập Nes.emu: https://kenhgiatot.com/blogs/huong-dan-su-dung/huong-dan-choi-game-nes-tren-android-box\r\nGiả lập PPSSPP: https://kenhgiatot.com/blogs/huong-dan-su-dung/huong-dan-choi-ppsspp-tren-android\r\nLink tải game giả lập GBA: https://romsmania.cc/roms/gameboy-advance\r\nLink tải game giả lập PSP: https://downloadgamepsp.com/\r\nLink tải game giả lập: https://romhustler.org/roms/gba\r\n\r\n\r\nHướng dẫn sử dụng tay cầm chơi game\r\nList game hỗ trợ tay cầm trên điện thoại android: kenhgiatot.com/blogs/news/list-game-ho-tro-tay-cam-choi-game-tren-dien-thoai-android-va-ios\r\nList game hỗ trợ tay cầm trên android box: kenhgiatot.com/blogs/diem-game/tong-hop-game-ho-tro-tay-cam-choi-game-tren-android-tv-box\r\nList game hỗ trợ tay cầm trên win', 299000, 3, 1, 4, '[12]', '[]', 0, 0, 0, 0, 6, 0, 0, 0, 0, 0, 0, '2020-12-23 17:21:47'),
(8, 'Gift code Yasuo', 'Gift code Yasuo giá rẻ', 50000, 3, 10, 1, '[26,27]', '[28]', 0, 0, 0, 0, 4, 1, 0, 0, 1, 0, 0, '2020-12-28 14:31:18'),
(9, 'Áo thun leesin', 'Áo thun leesin', 20000, 3, 10, 1, '[31]', '[]', 0, 0, 0, 0, 3, 1, 0, 0, 1, 1, 10000, '2020-12-31 02:52:27'),
(10, 'Ba lô PUBG', 'Thông tin sản phẩm: \r\n- Balo 3D là mẫu balo chiến thuật, có thể tích khoảng 45 lít, phù hợp với dùng hàng ngày hoặc đi du lịch từ 3 đến 5 ngày.\r\n- Balo có kích thước 33cm x 18cm x 46cm\r\n- Balo có một ngăn chính và 2 ngăn phụ, mỗi ngăn đều có khóa kéo 2 chiều và lớp vải nilon chống nước, \r\n- Mặt trước có một miếng velcro để dán patch\r\n- Các hàng molle được bố trí hợp lý và chuẩn size, để gắn thêm các loại phụ kiện, pouch\r\n- Phần lưng được thiết kế đệm mút để giúp nâng đỡ balo cũng như đeo lâu không bị mỏi\r\n- Quai đeo cũng được trang bị đệm mút và dây rút điều chỉnh size nhanh\r\n- Ngoài ra còn có hệ thống dây trợ lực ở ngực và thắt lưng giúp cố định balo và giảm tải trọng lên vai.\r\nLưu ý: Quý khách vui lòng chọn đúng size và màu sắc theo hệ thống. Ko giải quyết các trường hợp đặt 1 màu ghi chú và inbox lại là màu và size khác. Xin cảm ơn.\r\n**************************************************\r\n➡ SHIP COD TOÀN QUỐC \r\n➡ NHẬN HÀNG TRƯỚC - TRẢ TIỀN SAU\r\n*** CAM KẾT: Đổi trả hàng MIỄN PHÍ khi SHOP giao nhầm màu, nhầm size ***\r\n&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;\r\nTHẾ GIỚI THỂ THAO - CHUYÊN ĐỒ PHƯỢT - ĐỒ THỂ THAO DU LỊCH', 199000, 5, 100, 4, '[32]', '[33]', 1610272756, 1611568756, 10, 1, 7, 0, 0, 0, 1, 1, 20000, '2021-01-10 09:53:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_types`
--

CREATE TABLE `table_types` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `user_create` int(11) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `table_types`
--

INSERT INTO `table_types` (`id`, `name`, `user_create`, `create_time`, `status`) VALUES
(1, 'Mũ', 3, '2020-12-23 12:24:50', 0),
(3, 'Áo', 3, '2020-12-23 12:25:34', 0),
(4, 'Giftcode', 3, '2020-12-23 12:25:49', 0),
(5, 'Tất', 3, '2020-12-23 13:46:10', 0),
(6, 'Phụ kiện', 3, '2020-12-23 17:21:14', 0),
(7, 'Ba lô', 5, '2021-01-10 09:46:45', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `table_accounts`
--
ALTER TABLE `table_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_biller`
--
ALTER TABLE `table_biller`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_config`
--
ALTER TABLE `table_config`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_games`
--
ALTER TABLE `table_games`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_history_payemnt`
--
ALTER TABLE `table_history_payemnt`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_medias`
--
ALTER TABLE `table_medias`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_product`
--
ALTER TABLE `table_product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_types`
--
ALTER TABLE `table_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `table_accounts`
--
ALTER TABLE `table_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `table_biller`
--
ALTER TABLE `table_biller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `table_config`
--
ALTER TABLE `table_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `table_games`
--
ALTER TABLE `table_games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `table_history_payemnt`
--
ALTER TABLE `table_history_payemnt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `table_medias`
--
ALTER TABLE `table_medias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `table_product`
--
ALTER TABLE `table_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `table_types`
--
ALTER TABLE `table_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
