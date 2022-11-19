-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 19, 2022 lúc 09:21 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shop_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(8, 32, 'Ẩn danh', 'noname@hot.com', '0842333666', 'Giao hàng rất nhanh, giá cả hợp lý!!'),
(9, 33, 'abc', 'nvcam@gmail.com', '1231231234', 'Cần thêm sản phẩm thịt Dê');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'Chờ duyệt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(15, 32, 'XYZ', '0369369963', 'huhu@gmail.com', 'Tiền mặt', 'Số xx, yy, zz, ww, Trà Vinh', ', Thịt bò (Kg) ( 1 ), Cải chip (Kg) ( 1 )', 159000, '19/11/2022', 'Đã duyệt'),
(17, 33, 'Hưng', '0398031130', 'haha@gmail.com', 'Tiền mặt', 'Số aa, bb, cc, dd, ee', ', Cá hồi (Kg) ( 3 )', 540000, '19/11/2022', 'Chờ duyệt'),
(18, 32, 'huhu', '0396369369', 'huhu@gmail.com', 'Thẻ ATM', 'Số zz, zz, zz, zz, Cần Thơ', ', Cam Mỹ (Kg) ( 2 )', 154000, '19/11/2022', 'Chờ duyệt');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(20) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `details`, `price`, `image`) VALUES
(25, 'Bắp cải (500g)', 'Rau củ', 'Bắp cải là một loại thực phẩm đặc biệt tốt cho sức khỏe. Nó có thành phần dinh dưỡng vượt trội và đặc biệt là hàm lượng vitamin C và K.', 25000, 'bapcai.png'),
(26, 'Thịt bò (Kg)', 'Thịt', 'Thịt bò là nguyên liệu giàu dinh dưỡng. Ngoài lượng chất đạm cao, thịt bò còn cung cấp chất sắt, kẽm và các vitamin B2, B6, B12 ...', 120000, 'thitbo.png'),
(29, 'Cải chip (Kg)', 'Rau củ', 'Cải chíp rất tốt cho sức khỏe gồm protein, chất xơ, cholesterol bệnh tim mạch miễn dịch giảm huyết áp ung thư vitamin K vitamin C.', 39000, 'caichip.png'),
(30, 'Cá BaSa (Kg)', 'Cá', 'Cá basa là một nguồn cung cấp protein chất lượng cao, nó bổ sung 9 loại axit amin thiết yếu mà cơ thể không thể tự tổng hợp được.', 67000, 'capasa.png'),
(34, 'Lựu Hàn Quốc (Kg)', 'Trái cây', 'Lựu giúp giảm huyết áp cũng nhờ việc nó cung cấp kali. 100 gram lựu chứa 236 gram kali, một chất giúp duy trì sức khỏe của xương.', 39000, 'luu.jpg'),
(35, 'Dâu tây (Kg)', 'Trái cây', 'Dâu tây rất giàu chất xơ và vitamin C, một cặp chất dinh dưỡng tuyệt vời để giảm stress oxy hóa, có thể hỗ trợ làm giảm nguy cơ mắc bệnh tim.', 89000, 'dautay.png'),
(36, 'Cherry Mỹ (Kg)', 'Trái cây', 'Quả cherry chứa nhiều chất chống oxy hóa và các hợp chất chống viêm. Nhờ vậy, tác dụng của cherry giúp làm chậm quá trình lão hóa.', 380000, 'cherryMy.png'),
(37, 'Cam Mỹ (Kg)', 'Trái cây', 'Cam là loại quả giàu các chất dinh dưỡng như: vitamin C, chất xơ, folate, chất chống oxy hóa nhưng rất ít calo và đường.', 77000, 'cam.png'),
(38, 'Nho Ninh Thuận (Kg)', 'Trái cây', 'Nho chứa đầy chất dinh dưỡng, đặc biệt là vitamin C, E nhiều axit hữu cơ, Cellulose và đường giúp giảm nguy cơ bị táo bón và chữa táo bón hiệu quả.', 65000, 'nhoden.png'),
(39, 'Táo đỏ Mỹ', 'Trái cây', 'Táo có chứa pectin. Đây là loại chất xơ hoạt động như một prebiotic; giúp nuôi các vi khuẩn có lợi trong hệ thống đường ruột.', 115000, 'tao.png'),
(40, 'Thịt heo (Kg)', 'Thịt', 'Thịt lợn giúp đóng góp vào cơ thể rất nhiều loại vitamin và khoáng chất khác nhau như photpho, kali, nicaxin, vitamin B6, vitamin B12, kẽm...', 100000, 'heo.png'),
(42, 'Gà nguyên con', 'Thịt', 'Theo đông y, thịt gà có vị ngọt, tính ẩm, không độc, lành mạnh phổi, có tác dụng làm ôn trung ích khí, bổ tinh tủy giúp bồi bổ cơ thể.', 108000, 'ganguyencon.jpg'),
(43, 'Thịt trâu (Kg)', 'Thịt', 'hịt trâu vị ngọt, tính mát, không độc, tác dụng bổ tỳ vị, mạnh gân cốt, ích huyết. Hàm lượng dinh dưỡng trong thịt trâu khá cao.', 200000, 'thittrau.png'),
(44, 'Đùi gà (Lốc 6 cái)', 'Thịt', 'Đùi gà có thể được sử dụng theo tất cả các cách tương tự như ức gà. Chúng chứa nhiều chất béo và ít protein hơn so với phần ức gà.', 45000, 'duiga.png'),
(45, 'Cá hồi (Kg)', 'Cá', 'Cá hồi có những lợi ích bất ngờ cho sức khoẻ, giúp bổ sung protein, hỗ trợ giảm cân. Ăn cá hồi giúp giảm nguy cơ mắc bệnh tim.', 180000, 'cahoi.png'),
(47, 'Cá tuyết (Kg)', 'Cá', 'Cá tuyết cung cấp nguồn protein dồi dào và ít axit béo, giảm nguy cơ mắc bệnh tim mạch và tương đối ít calo vì là cá nạc.', 50000, 'catuyet.jpg'),
(66, 'Bí đỏ (Kg)', 'Rau củ', 'Bí đỏ có hàm lượng dinh dưỡng cao nhưng lại chứa không quá nhiều calo. Trung bình 1kg bí đỏ chỉ có chứa khoảng 40 calo.', 10000, 'bido.jpg'),
(67, 'Bông cải trắng (Kg)', 'Rau củ', 'Ăn bông cải trắng sẽ rất tốt cho xương của bạn vì nó có chứa nhiều vitamin C. Vitamin C giúp tăng cường sản xuất collagen để bảo vệ xương và khớp.', 35000, 'bongcaitrang.png'),
(68, 'Cà chua (Kg)', 'Rau củ', 'Giá trị dinh dưỡng của cà chua đến từ thành phần giàu vitamin, khoáng chất và các loại dưỡng chất quan trọng bao gồm vitamin A , vitamin C.', 22000, 'cachua.png'),
(70, 'Cà rốt (Kg)', 'Rau củ', 'Cà rốt có tác dụng giảm nguy cơ ung thư, giảm cholesterol trong máu, giảm cân, bảo vệ mắt, giúp hỗ trợ sức khỏe tim và cải thiện hệ tiêu hóa.\r\n', 18000, 'carrot.png'),
(71, 'Ớt chuông (500g)', 'Rau củ', 'Ớt chuông giàu vitamin A, vitamin C và chất dinh dưỡng khác. Ớt chuông giàu chất chống oxy hóa và có tác dụng chống viêm hiệu quả.', 25000, 'otchuong.png'),
(72, 'Khoai lang (Kg)', 'Rau củ', 'Khoai lang, thực phẩm rẻ tiền tốt cho sức khỏe là nguồn cung cấp rất nhiều vitamin, khoáng chất, riboflavin, thiamine, niacin và carotenoid.', 15000, 'khoailang.jpg'),
(73, 'Ớt (100g)', 'Rau củ', 'Ớt chứa nhiều vitamin tốt cho sức khỏe. Ớt là một loại rau gia vị giúp tăng mùi vị món ăn hoặc đơn giản là do sở thích cá nhân.', 5000, 'ot.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `image`) VALUES
(31, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'logo2m.PNG'),
(32, 'i&#39;m huhu', 'huhu@gmail.com', 'f3c2cefc1f3b082a56f52902484ca511', 'user', 'vcs.PNG'),
(33, 'haha', 'haha@gmail.com', '4e4d6c332b6fe62a63afe56171fd3725', 'user', 'WIN_20220725_22_13_48_Pro (2).jpg'),
(35, 'Nguyễn Văn Cam', 'nvc@gmail.com', '51ec797e647dd66d43a0101ccce411d8', 'user', 'cam.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `pid`, `name`, `price`, `image`) VALUES
(52, 33, 73, 'Ớt (100g)', 5000, 'ot.png'),
(53, 33, 68, 'Cà chua (Kg)', 22000, 'cachua.png'),
(54, 33, 40, 'Thịt heo (Kg)', 100000, 'heo.png'),
(55, 32, 35, 'Dâu tây (Kg)', 89000, 'dautay.png'),
(56, 32, 26, 'Thịt bò (Kg)', 120000, 'thitbo.png');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT cho bảng `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
