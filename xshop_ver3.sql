-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2024 at 05:26 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xshop_ver4`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `province` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `ward` varchar(255) NOT NULL,
  `address_detail` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `user_id` bigint(20) NOT NULL,
  `product_size_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `slug` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `slug`) VALUES
(1, 'Áo thể thao', 'ao-the-thao'),
(2, 'Quần Jeans', 'quan-jeans'),
(3, 'Quần thể thao', 'quan-the-thao'),
(4, 'Quần shorts', 'quan-shorts'),
(5, 'Áo Polo', 'ao-polo');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) NOT NULL,
  `color_name` varchar(100) NOT NULL,
  `img` varchar(255) NOT NULL,
  `slug` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `color_name`, `img`, `slug`) VALUES
(1, 'Gray', './images/product_colors/gray.jpg', 'gray'),
(2, 'Black', './images/product_colors/black.jpg', 'black'),
(3, 'White', './images/product_colors/white.webp', 'white'),
(4, 'Orange', './images/product_colors/orange.webp', 'orange'),
(5, 'Violet', './images/product_colors/violet.webp', 'violet'),
(6, 'Xanh wash', './images/product_colors/mau23CMCW.JE006.4.webp', 'xanh-wash'),
(7, 'Blue', './images/product_colors/graphic.special.18_25.webp', 'blue'),
(8, 'Xanh nhạt', './images/product_colors/Coolmate_x_Copper_Denim__Quan_Jeans_dang_Slim_Fit13.webp', 'xanh-nhat'),
(9, 'Xanh rêu', './images/product_colors/mauCotton_Short_6in_Reu_4.webp', 'xanh-reu'),
(10, 'Đỏ', './images/product_colors/24CMAW.QS008.8d.webp', 'do'),
(11, 'Nâu', './images/product_colors/APoL100-mau2-2.webp', 'nau'),
(12, 'Be', './images/product_colors/BEE_XAM_COLOR.webp', 'be');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `user_id`, `product_id`, `rating`, `content`) VALUES
(1, 1, 2, 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `payment_method` enum('online','offline') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_status` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `order_id` bigint(20) NOT NULL,
  `product_size_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `unit_price` double NOT NULL,
  `discount_percentage` float DEFAULT 0,
  `product_desc` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`product_desc`)),
  `slug` text NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `main_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `unit_price`, `discount_percentage`, `product_desc`, `slug`, `category_id`, `main_img`) VALUES
(2, 'Áo Polo Thể Thao Pro Active 1595', 239000, 0.1, '[\"Chất liệu 100% Recycled Polyester\", \"Vải dệt Knit Interlock\", \"Công nghệ ExDry thấm hút tốt, nhanh khô, thoáng khí\", \"Vải co giãn thoải mái\", \"Form áo vừa vặn, tôn dáng\"]', 'ao-polo-the-thao-pro-active-1595', 1, './images/products/24CMAW.PL004.7_17.webp'),
(3, 'Quần Jeans Nam siêu nhẹ', 499000, 0.05, '[\"Chất liệu Denim 8.5 Oz mỏng nhẹ\", \"Thành phần: 80% Cotton, 18% Polyester, 2% Spandex\", \"Vải Denim được wash trước khi may, không rút và hạn chế ra màu sau khi giặt\", \"Dáng Straight rộng phóng thoáng, thoải mái, không thùng thình\", \"Lưu ý: Sản phẩm vẫn sẽ bạc màu sau một thời gian dài sử dụng theo tính chất tự nhiên\"]', 'quan-jeans-name-sieu-nhe', 2, './images/products/23CMCW.JE006.2_45.webp'),
(4, 'Áo Thun Nam Chạy Bộ Graphic Special', 199000, 0, '[\"Chất liệu 100% Recycled Polyester\", \"Vải dệt Knit Interlock\", \"Công nghệ ExDry thấm hút tốt, nhanh khô, thoáng khí\", \"Vải co giãn thoải mái\", \"Form áo vừa vặn, tôn dáng\"]', 'ao-thun-nam-chay-bo-graphic-special', 1, './images/products/GRAPHICS.AGANIN.10.webp'),
(5, 'Áo Thun Nam Chạy Bộ Graphic Heartbeat', 199000, 0, '[\"Chất liệu 100% Recycled Polyester\", \"Vải dệt Knit Interlock\", \"Công nghệ ExDry thấm hút tốt, nhanh khô, thoáng khí\", \"Vải co giãn thoải mái\", \"Form áo vừa vặn, tôn dáng\"]', 'ao-thun-nam-chay-bo-graphic-heart-beat', 1, './images/products/23CMAW.AT003.20.webp'),
(6, 'Áo Polo Thể Thao Active Premium', 295000, 0.1, '[\"Chất liệu 100% Recycled Polyester\", \"Vải dệt Knit Interlock\", \"Công nghệ ExDry thấm hút tốt, nhanh khô, thoáng khí\", \"Vải co giãn thoải mái\", \"Form áo vừa vặn, tôn dáng\"]', 'ao-polo-the-thao-active-premium', 1, './images/products/24CMAW.PL001.1_23.webp'),
(7, 'Áo Singlet Nam Chạy Bộ Graphic Photic Zone', 189000, 0, '[\"Chất liệu 100% Recycled Polyester\", \"Vải dệt Knit Interlock\", \"Công nghệ ExDry thấm hút tốt, nhanh khô, thoáng khí\", \"Vải co giãn thoải mái\", \"Form áo vừa vặn, tôn dáng\"]', 'ao-singlet-nam-chay-bo-graphic-photic-zone', 1, './images/products/24CMAW.TT07.1_64.webp'),
(8, 'Áo Thun Nam Chạy Bộ Graphic Photic Zone', 199000, 0, '[\"Chất liệu 100% Recycled Polyester\", \"Vải dệt Knit Interlock\", \"Công nghệ ExDry thấm hút tốt, nhanh khô, thoáng khí\", \"Vải co giãn thoải mái\", \"Form áo vừa vặn, tôn dáng\"]', 'ao-thun-nam-chay-bo-graphic-photic-zone', 1, './images/products/24CMAW.AT011.1_91.webp'),
(9, 'Áo Thun Nam Gym Powerfit', 299000, 0.15, '[\"Chất liệu: 86% Polyester Recycled + 14% Spandex\", \"Co giãn 4 chiều mang lại sự thoải mái để bạn vận động hết mình\", \"Thiết kế công thái học, cải tiến giữ các đường may không bị mài mòn và tăng độ bền\", \"Chất liệu thấm mồ hôi và khô nhanh, thoáng khí mang lại khả năng khô thoáng vượt trội\", \"Form áo: Slim fit\"]', 'ao-thun-nam-gym-powerfit', 1, './images/products/ao-thun-gym-powerfit-18.webp'),
(10, 'Áo Thun Thể Thao Active Basics', 159000, 0, '[\"Chất liệu: 86% Polyester Recycled + 14% Spandex\", \"Co giãn 4 chiều mang lại sự thoải mái để bạn vận động hết mình\", \"Thiết kế công thái học, cải tiến giữ các đường may không bị mài mòn và tăng độ bền\", \"Chất liệu thấm mồ hôi và khô nhanh, thoáng khí mang lại khả năng khô thoáng vượt trội\", \"Form áo: Slim fit\"]', 'ao-thun-the-thao-active-basics', 1, './images/products/24CMAW.AT005.9.webp'),
(11, 'Áo Thun Nam chạy bộ Essential', 159000, 0, '[\"Chất liệu: 97% Poly + 3% Spandex\", \"Xử lý hoàn thiện vải: Quick-Dry + Wicking + Stretc\", \"Công nghệ Chafe-Free hạn chế tối đa ma sát trong quá trình vận động từ các đường may tối giản hoá\", \"Sản phẩm được đánh giá phù hợp với hoạt động chạy bộ bởi các Runner chuyên nghiệp\", \"Form áo: Slim fit\"]', 'ao-thun-nam-chay-bo-essential', 1, './images/products/DSC04870_copy.webp'),
(12, 'Áo Khoác Nam Thể Thao Pro Active', 499000, 0.2, '[\"Thành phần: 100% Polyester\", \"Chất liệu áo khoác thể thao có khả năng giữ ấm\", \"Hạn chế xù lông và chống nhăn\", \"Form áo: Regular, ôm nhẹ\"]', 'ao-khoac-nam-the-thao-pro-active', 1, './images/products/QD001.20_38.webp'),
(13, 'Áo Khoác Nam có mũ Daily Wear', 499000, 0.2, '[\"Thành phần: 100% Polyester\", \"Chất liệu áo khoác thể thao có khả năng giữ ấm\", \"Hạn chế xù lông và chống nhăn\", \"Form áo: Regular, ôm nhẹ\"]', 'ao-khoac-nam-co-mu-daily-wear', 1, './images/products/CM006.thumb1.2_74.webp'),
(14, 'Áo Polo Nam Thể Thao Promax-S1', 239000, 0.06, '[\"Chất liệu: 100% Poly, định lượng vải 155gsm siêu nhẹ\", \"Xử lý hoàn thiện vải: Quick-Dry và Wicking\", \"Phù hợp với: đi làm, đi chơi, mặc ở nhà\", \"Kiểu dáng: Regular fit dáng suông\"]', 'ao-polo-nam-the-thao-promax-s1', 1, './images/products/apl.pm.lg.trg3.jfif'),
(15, 'Áo Polo Nam Dài Tay Thể Thao Essentials', 279000, 0.1, '[\"Chất liệu: 100% Poly, định lượng vải 155gsm siêu nhẹ\", \"Kiểu dệt: Interlock\", \"Kiểu dệt Interlock giúp bề mặt vải thoáng khí, độ bền cao vẫn giữ sự độ mềm mại\", \"Vải hoàn thiện công nghệ Nhanh khô (ExDry) và thấm hút (Wicking)\", \"Form: Regular, ôm vừa\"]', 'ao-polo-nam-dai-tay-the-thao-essentials', 1, './images/products/23CMAW.PL001.1s6_74.webp'),
(16, 'Áo Tanktop Nam Thể Thao Active V2', 159000, 0, '[\"Chất liệu: 100% Poly, định lượng vải 155gsm siêu nhẹ\", \"Kiểu dệt: Interlock\", \"Kiểu dệt Interlock giúp bề mặt vải thoáng khí, độ bền cao vẫn giữ sự độ mềm mại\", \"Vải hoàn thiện công nghệ Nhanh khô (ExDry) và thấm hút (Wicking)\", \"Form: Regular, ôm vừa\"]', 'ao-tanktop-nam-the-thao-active-v2', 1, './images/products/ATT.TT.A.5.webp'),
(17, 'Quần Jeans Nam Basics dáng Slim fit', 499000, 0.05, '[\"Chất liệu: Denim\", \"Thành phần: 98% Cotton + 2% Spandex\", \"Công nghệ Laser Marking tạo các vệt hiệu ứng chuẩn xác trên sản phẩm\", \"Vải Denim được wash trước khi may nên không rút và hạn chế ra màu sau khi giặt\", \"Bề mặt quần không thô ráp\", \"Co giãn tốt giúp quần ôm vừa vặn, thoải mái\", \"Dáng Slim Fit ôm tôn dáng, giúp bạn hack đôi chân dài và gọn đẹp\"]', 'quan-jeans-nam-basics-dang-slim-fit', 2, './images/products/23CMCW.JE002.7_72.webp'),
(18, 'Quần Jeans Nam Copper Denim Straight', 599000, 0.1, '[\"Chất liệu: Denim\", \"Thành phần: 98% Cotton + 2% Spandex\", \"Công nghệ Laser Marking tạo các vệt hiệu ứng chuẩn xác trên sản phẩm\", \"Vải Denim được wash trước khi may nên không rút và hạn chế ra màu sau khi giặt\", \"Bề mặt quần không thô ráp\", \"Co giãn tốt giúp quần ôm vừa vặn, thoải mái\", \"Dáng Slim Fit ôm tôn dáng, giúp bạn hack đôi chân dài và gọn đẹp\"]', 'quan-jeans-nam-copper-denim-straight', 2, './images/products/copperstraightdenim10.webp'),
(19, 'Quần Jeans Nam Copper Denim OG Slim', 599000, 0.08, '[\"Chất liệu: Denim\", \"Thành phần: 98% Cotton + 2% Spandex\", \"Công nghệ Laser Marking tạo các vệt hiệu ứng chuẩn xác trên sản phẩm\", \"Vải Denim được wash trước khi may nên không rút và hạn chế ra màu sau khi giặt\", \"Bề mặt quần không thô ráp\", \"Co giãn tốt giúp quần ôm vừa vặn, thoải mái\", \"Dáng Slim Fit ôm tôn dáng, giúp bạn hack đôi chân dài và gọn đẹp\"]', 'quan-jeans-nam-copper-denim-og-slim', 2, './images/products/Quan_Jeans_dang_OG_Slim-thuumb-1.webp'),
(20, 'Quần Jeans Nam Copper Denim Slim Fit', 599000, 0.08, '[\"Chất liệu: Denim\", \"Thành phần: 98% Cotton + 2% Spandex\", \"Công nghệ Laser Marking tạo các vệt hiệu ứng chuẩn xác trên sản phẩm\", \"Vải Denim được wash trước khi may nên không rút và hạn chế ra màu sau khi giặt\", \"Bề mặt quần không thô ráp\", \"Co giãn tốt giúp quần ôm vừa vặn, thoải mái\", \"Dáng Slim Fit ôm tôn dáng, giúp bạn hack đôi chân dài và gọn đẹp\"]', 'quan-jeans-nam-copper-denim-slim-fit', 2, './images/products/Quan_Jeans_dang_Slim_Fit-thumb-1.webp'),
(21, 'Quần Jeans Nam dáng Slim Fit V2', 459000, 0.04, '[\"Chất liệu: Denim\", \"Thành phần: 98% Cotton + 2% Spandex\", \"Công nghệ Laser Marking tạo các vệt hiệu ứng chuẩn xác trên sản phẩm\", \"Vải Denim được wash trước khi may nên không rút và hạn chế ra màu sau khi giặt\", \"Bề mặt quần không thô ráp\", \"Co giãn tốt giúp quần ôm vừa vặn, thoải mái\", \"Dáng Slim Fit ôm tôn dáng, giúp bạn hack đôi chân dài và gọn đẹp\"]', 'quan-jeans-nam-dang-slim-fit-v2', 2, './images/products/_CMM0081.webp'),
(22, 'Quần Jogger Nam UT đa năng', 499000, 0.01, '[\"Thành phần: 90% Polyamide + 10% Spandex\", \"Vải Polyamide dày dặn, có độ bền và chịu ma sát tốt, phù hợp hoạt động ngoài trời\", \"Vải được xử lí công nghệ Trượt nước (Water Repellent C6)\", \"Chất liệu co giãn thoải mái vận động\", \"Co giãn tốt giúp quần ôm vừa vặn, thoải mái\", \"Thiết kế nhiều túi lớn, tiện lợi đựng đồ\"]', 'quan-joggeer-nam-ut-da-nang', 3, './images/products/utdanangthumb231.webp'),
(23, 'Quần Dài Nam Thể Thao Pro Active', 399000, 0.35, '[\"Thành phần: 100% Polyester\", \"Chất liệu quần dài thể thao có khả năng giữ ấm\", \"Vải được xử lí công nghệ Trượt nước (Water Repellent C6)\", \"Chất liệu co giãn thoải mái vận động\", \"Co giãn tốt giúp quần ôm vừa vặn, thoải mái\", \"Thiết kế nhiều túi lớn, tiện lợi đựng đồ\"]', 'quan-dai-name-the-thao-pro-active', 3, './images/products/QD001.1_67.webp'),
(24, 'Quần Shorts Nam Thể Thao 7\"', 239000, 0.33, '[\"Chất liệu: 100% sợi Recycled Polyester\", \"Xử lý hoàn thiện vải: Quick-Dry + Wicking + Stretch\", \"Vải Recycle dệt kiểu Double Weaving mang lại cảm giác Cooling khi mặc\", \"Chất liệu co giãn thoải mái vận động\", \"Co giãn tốt giúp quần ôm vừa vặn, thoải mái\", \"Thiết kế nhiều túi lớn, tiện lợi đựng đồ\"]', 'quan-shorts-nam-the-thao-7', 3, './images/products/7recycle.den5.webp'),
(25, 'Quần Shorts Nam Chạy Bộ Coolmate Basics', 99000, 0, '[\"Chất liệu: 100% Polyester thoáng mát\", \"Thiết kế dáng xẻ tà tăng cường thoải mái khi vận động\", \"Vải Recycle dệt kiểu Double Weaving mang lại cảm giác Cooling khi mặc\", \"Chất liệu co giãn thoải mái vận động\", \"Co giãn tốt giúp quần ôm vừa vặn, thoải mái\", \"Thiết kế nhiều túi lớn, tiện lợi đựng đồ\"]', 'quan-shorts-nam-chay-bo-coolmate-basics', 3, './images/products/QSBCBS3D.1_4.webp'),
(26, 'Quần Short Nam Thể Thao Promax-S1', 189000, 0, '[\"Chất liệu: 100% Poly\", \"Xử lý hoàn thiện vải: Quick-Dry và Wicking\", \"Phù hợp với: chơi thể thao, mặc ở nhà\", \"Chất liệu co giãn thoải mái vận động\", \"Co giãn tốt giúp quần ôm vừa vặn, thoải mái\", \"Thiết kế nhiều túi lớn, tiện lợi đựng đồ\"]', 'quan-short-nam-the-thao-promax-s1', 3, './images/products/qtt.pm.v2.1.webp'),
(27, 'Quần Shorts Nam Gym Power 2 lớp', 399000, 0, '[\"Vải chính: 100% Polyester\", \"Co giãn 4 chiều mang lại sự thoải mái để bạn vận động hết mình\", \"Phù hợp với: chơi thể thao, mặc ở nhà\", \"Chất liệu co giãn thoải mái vận động\", \"Co giãn tốt giúp quần ôm vừa vặn, thoải mái\", \"Thiết kế nhiều túi lớn, tiện lợi đựng đồ\"]', 'quan-shorts-nam-gym-power-2-lop', 3, './images/products/qs2l..gp.5.webp'),
(28, 'Quần Shorts Nam chạy bộ Advanced', 349000, 0, '[\"Chất liệu: 89% Recycled Polyester - 11% Spandex\", \"Công nghệ Chafe-Free hạn chế tối đa ma sát trong quá trình vận động từ các đường may tối giản hoá\", \"Phù hợp với: chơi thể thao, mặc ở nhà\", \"Chất liệu co giãn thoải mái vận động\", \"Co giãn tốt giúp quần ôm vừa vặn, thoải mái\", \"Thiết kế nhiều túi lớn, tiện lợi đựng đồ\"]', 'quan-shorts-nam-chay-bo-advanced', 3, './images/products/CMQST.RN002.XBD.3.webp'),
(30, 'Quần Shorts Nam Chạy Bộ 2 lớp Essentials III', 399000, 0.09, '[\"Vải chính: 45% Polyester + 55% Recycle Polyester\", \"Công nghệ ExDry thấm hút tốt, nhanh khô, thoáng khí\", \"Phù hợp với: chơi thể thao, mặc ở nhà\", \"Chất liệu co giãn thoải mái vận động\", \"Co giãn tốt giúp quần ôm vừa vặn, thoải mái\", \"Thiết kế nhiều túi lớn, tiện lợi đựng đồ\"]', 'quan-shorts-nam-chay-bo-2-lop-esentials-III', 4, './images/products/24CMAW.QS019.22_56.webp'),
(31, 'Quần Shorts thể thao 7 inch đa năng', 198000, 0.09, '[\"Chất liệu: 86% Polyester + 14% Spandex, định lượng vải 125gsm\", \"Công nghệ ExDry thấm hút tốt, nhanh khô, thoáng khí\", \"Quần co giãn thoải mái\", \"Chất liệu co giãn thoải mái vận động\", \"Co giãn tốt giúp quần ôm vừa vặn, thoải mái\", \"Thiết kế nhiều túi lớn, tiện lợi đựng đồ\"]', 'quan-shorts-the-thao-7-inch-da-nang', 4, './images/products/thumb7indanan2_81_copy.webp'),
(32, 'Quần Shorts Nam chạy bộ Essentials 5\"', 189000, 0.09, '[\"Chất liệu 100% Polyester\", \"Công nghệ ExDry thấm hút tốt, nhanh khô, thoáng khí\", \"Công nghệ ExDry thấm hút tốt, nhanh khô, thoáng khí\", \"Vải dệt co giãn độ bền cao\", \"Định lượng vải 84gsm siêu nhẹ thoải mái vận động\"]', 'quan-shorts-nam-chay-bo-essentials', 4, './images/products/24CMAW.QS008.4_100.webp'),
(33, 'Quần Shorts Nam Daily Short', 269000, 0, '[\"Chất liệu 100% Polyester\", \"Công nghệ ExDry thấm hút tốt, nhanh khô, thoáng khí\", \"Công nghệ ExDry thấm hút tốt, nhanh khô, thoáng khí\", \"Vải dệt co giãn độ bền cao\", \"Định lượng vải 84gsm siêu nhẹ thoải mái vận động\"]', 'quan-shorts-nam-daily-short', 4, './images/products/QS.DP.15_68.webp'),
(35, 'Quần Shorts Nam Chạy Bộ Ultra Fast II', 229000, 0, '[\"Chất liệu 100% Polyester\", \"Công nghệ ExDry thấm hút tốt, nhanh khô, thoáng khí\", \"Công nghệ ExDry thấm hút tốt, nhanh khô, thoáng khí\", \"Vải dệt co giãn độ bền cao\", \"Định lượng vải 84gsm siêu nhẹ thoải mái vận động\"]', 'quan-shorts-nam-chay-bo-ultra-fast-II', 3, './images/products/24CMAW.QS018.3_95.webp'),
(36, 'Quần Shorts Nam Mặc Nhà', 99000, 0, '[\"Chất liệu 100% Polyester\", \"Công nghệ ExDry thấm hút tốt, nhanh khô, thoáng khí\", \"Công nghệ ExDry thấm hút tốt, nhanh khô, thoáng khí\", \"Vải dệt co giãn độ bền cao\", \"Định lượng vải 84gsm siêu nhẹ thoải mái vận động\"]', 'quan-short-nam-mac-nha', 3, './images/products/24CMHU.BX010.DOO1.3d_92.webp'),
(37, 'Quần Shorts Nam Thể Thao 7\"', 159000, 0, '[\"Chất liệu 100% Polyester\", \"Công nghệ ExDry thấm hút tốt, nhanh khô, thoáng khí\", \"Công nghệ ExDry thấm hút tốt, nhanh khô, thoáng khí\", \"Vải dệt co giãn độ bền cao\", \"Định lượng vải 84gsm siêu nhẹ thoải mái vận động\"]', 'quan-shorts-nam-the-thao-7', 3, './images/products/7recycle.xchi6.webp'),
(38, 'Áo Polo Nam Pique Cotton', 299000, 0, '[\"Chất liệu 100% Cotton\", \"Xử lí hoàn thiện giúp bề mặt vải ít xù lông, mềm mịn và bền màu hơn\", \"Kiểu dệt Pique giúp áo thoáng mát\", \"Độ dày vải vừa phải giúp áo tôn dáng\"]', 'ao-polo-nam-pique-cotton', 5, './images/products/poloapl220.11.jpg'),
(39, 'Áo Polo Nam dài tay Essentials', 399000, 0, '[\"Thành phần: 95% Cotton + 5% Spandex\", \"Xử lí hoàn thiện giúp bề mặt vải ít xù lông, mềm mịn và bền màu hơn\", \"Co giãn 4 chiều, mang đến sự thoải mái trong hoạt động\", \"Chất liệu Cotton tự nhiên thấm hút mồ hôi tốt\"]', 'ao-polo-nam-dai-tay-essentials', 5, './images/products/_CMM0071_62.webp'),
(40, 'Áo Polo Thể Thao Active Pique', 233000, 0, '[\"Thành phần: 95% Cotton + 5% Spandex\", \"Xử lí hoàn thiện giúp bề mặt vải ít xù lông, mềm mịn và bền màu hơn\", \"Co giãn 4 chiều, mang đến sự thoải mái trong hoạt động\", \"Chất liệu Cotton tự nhiên thấm hút mồ hôi tốt\"]', 'ao-polo-the-thao-active-pique', 5, './images/products/24CMAW.PL003.BEE6_58.webp'),
(41, 'Áo Polo Nam Cafe Bo Kẻ', 329000, 0, '[\"Thành phần: 95% Cotton + 5% Spandex\", \"Xử lí hoàn thiện giúp bề mặt vải ít xù lông, mềm mịn và bền màu hơn\", \"Co giãn 4 chiều, mang đến sự thoải mái trong hoạt động\", \"Chất liệu Cotton tự nhiên thấm hút mồ hôi tốt\"]', 'ao-polo-nam-cafe-bo-ke', 5, './images/products/24CMCW.PL001.THUMB1_41.webp'),
(42, 'Áo Polo Nam phối Jeans', 399000, 0, '[\"Thành phần: 95% Cotton + 5% Spandex\", \"Xử lí hoàn thiện giúp bề mặt vải ít xù lông, mềm mịn và bền màu hơn\", \"Co giãn 4 chiều, mang đến sự thoải mái trong hoạt động\", \"Chất liệu Cotton tự nhiên thấm hút mồ hôi tốt\"]', 'ao-polo-nam-phoi-jeans', 5, './images/products/thumbPolo_Copper_1A1.webp'),
(43, 'Áo Polo Nam Graphene', 165000, 0, '[\"Thành phần: 95% Cotton + 5% Spandex\", \"Xử lí hoàn thiện giúp bề mặt vải ít xù lông, mềm mịn và bền màu hơn\", \"Co giãn 4 chiều, mang đến sự thoải mái trong hoạt động\", \"Chất liệu Cotton tự nhiên thấm hút mồ hôi tốt\"]', 'ao-polo-nam-dai-tay-essentials', 5, './images/products/polographene.2.webp');

-- --------------------------------------------------------

--
-- Table structure for table `products_color`
--

CREATE TABLE `products_color` (
  `id` bigint(20) NOT NULL,
  `color_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_color`
--

INSERT INTO `products_color` (`id`, `color_id`, `product_id`) VALUES
(2, 4, 2),
(3, 2, 2),
(4, 3, 2),
(5, 6, 3),
(6, 7, 4),
(7, 2, 5),
(8, 5, 5),
(9, 1, 6),
(10, 2, 6),
(11, 7, 7),
(12, 7, 8),
(13, 1, 9),
(14, 2, 9),
(15, 1, 10),
(16, 2, 11),
(17, 4, 11),
(18, 5, 11),
(19, 1, 12),
(20, 2, 12),
(21, 3, 13),
(22, 2, 13),
(23, 3, 14),
(24, 2, 14),
(25, 3, 15),
(26, 2, 15),
(27, 2, 16),
(28, 2, 17),
(29, 6, 18),
(30, 2, 18),
(31, 6, 19),
(32, 6, 20),
(33, 8, 20),
(34, 8, 21),
(35, 2, 22),
(36, 6, 23),
(37, 2, 24),
(38, 4, 25),
(39, 7, 26),
(40, 9, 27),
(41, 7, 28),
(42, 7, 30),
(43, 3, 31),
(44, 10, 32),
(47, 1, 33),
(48, 7, 35),
(49, 3, 36),
(50, 7, 36),
(51, 1, 37),
(52, 11, 38),
(53, 2, 38),
(54, 2, 39),
(55, 12, 40),
(56, 7, 40),
(57, 11, 41),
(58, 9, 41),
(59, 2, 42),
(60, 2, 43);

-- --------------------------------------------------------

--
-- Table structure for table `products_color_picture`
--

CREATE TABLE `products_color_picture` (
  `product_color_id` bigint(20) NOT NULL,
  `product_color_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_color_picture`
--

INSERT INTO `products_color_picture` (`product_color_id`, `product_color_img`) VALUES
(2, './images/products/24CMAW.PL004.1_64.webp'),
(2, './images/products/24CMAW.PL004.4_2.webp'),
(2, './images/products/24CMAW.PL004.6.webp'),
(3, './images/products/24CMAW.PL004.24_53.webp'),
(3, './images/products/24CMAW.PL004.29_44.webp'),
(5, './images/products/23CMCW.JE006.2_45.webp'),
(5, './images/products/thum2423CMCW.JE006_copy.webp'),
(6, './images/products/GRAPHICS.AGANIN.6.webp'),
(6, './images/products/23CMAW.AT001.vaimoi.2_35.webp'),
(6, './images/products/GRAPHICS.AGANIN.9.webp'),
(6, './images/products/GRAPHICS.AGANIN.10.webp'),
(7, './images/products/23CMAW.AT003.20.webp'),
(7, './images/products/23CMAW.AT003.3D.1_33.webp'),
(7, './images/products/23CMAW.AT003.21_78.webp'),
(8, './images/products/23CMAW.AT003.33.webp'),
(8, './images/products/23CMAW.AT003.3D.3_84.webp'),
(8, './images/products/23CMAW.AT003.36_42.webp'),
(8, './images/products/23CMAW.AT003.39.webp'),
(9, './images/products/24CMAW.PL001.1_23.webp'),
(9, './images/products/24CMAW.PL001.5_50.webp'),
(9, './images/products/24CMAW.PL001.3.webp'),
(9, './images/products/24CMAW.PL001.8z.webp'),
(10, './images/products/24CMAW.PL001.9_13.webp'),
(10, './images/products/24CMAW.PL001.13_39.webp'),
(10, './images/products/24CMAW.PL001.11.webp'),
(10, './images/products/24CMAW.PL001.17.webp'),
(11, './images/products/24CMAW.TT07.1_64.webp'),
(11, './images/products/photic3d.2_76.webp'),
(11, './images/products/24CMAW.TT07.2.webp'),
(11, './images/products/24CMAW.TT07.9_2.webp'),
(12, './images/products/24CMAW.AT011.1_91.webp'),
(12, './images/products/photic3d.4.webp'),
(12, './images/products/24CMAW.AT011.2.webp'),
(12, './images/products/24CMAW.AT011.9_95.webp'),
(13, './images/products/ao-thun-gym-powerfit-18.webp'),
(13, './images/products/ao-thun-gym-powerfit-17.webp'),
(14, './images/products/ao-thun-gym-powerfit-21.webp'),
(14, './images/products/ao-thun-gym-powerfit-14.webp'),
(14, './images/products/ao-thun-gym-powerfit-13.webp'),
(15, './images/products/24CMAW.AT005.9.webp'),
(15, './images/products/24CMAW.AT005_copy-2.webp'),
(15, './images/products/24CMAW.AT005.8.webp'),
(16, './images/products/DSC04870_copy.webp'),
(16, './images/products/ATS.RN.EF-2_copy.webp'),
(16, './images/products/DSC04933_copy.webp'),
(16, './images/products/DSC04969_copy.webp'),
(17, './images/products/DSC04764_copy.webp'),
(17, './images/products/ATS.RN.EF-3_copy.webp'),
(17, './images/products/DSC04808_copy.webp'),
(18, './images/products/_CMM2689.webp'),
(18, './images/products/ATS.RN.EF.TI.S3D_essential.webp'),
(18, './images/products/_CMM2721.webp'),
(19, './images/products/QD001.20_38.webp'),
(19, './images/products/QD001.24_53.webp'),
(19, './images/products/QD001.21.webp'),
(19, './images/products/proac.akpk.2.webp'),
(20, './images/products/QD001.15_46.webp'),
(20, './images/products/QD001.18_80.webp'),
(20, './images/products/QD001.19.webp'),
(20, './images/products/proac.akpk.1.webp'),
(21, './images/products/CM006.thumb1.2_74.webp'),
(21, './images/products/CM006.thumb1.3_60.webp'),
(21, './images/products/CMAWCM006.6_20.webp'),
(22, './images/products/ao-khoac-mu-daily-wear-den-5_17.webp'),
(22, './images/products/ao-khoac-mu-daily-wear-den-7_87.webp'),
(22, './images/products/ao-khoac-mu-daily-wear-den-8_1.webp'),
(22, './images/products/ao-khoac-mu-daily-wear-den-9_1.webp'),
(23, './images/products/apl.pm.lg.trg3.jfif'),
(23, './images/products/apl.pm.lg.trg4.jfif'),
(23, './images/products/apl.pm.lg.trg5.jfif'),
(23, './images/products/apl.pm.lg.trg2.jfif'),
(24, './images/products/apl.pm.lg.den4.jfif'),
(24, './images/products/apl.pm.lg.den5.jfif'),
(24, './images/products/apl.pm.lg.den1.jfif'),
(24, './images/products/apl.pm.lg.den2.webp'),
(25, './images/products/23CMAW.PL001.1s6_74.webp'),
(25, './images/products/23CMAW.PL001.1s7_47.webp'),
(25, './images/products/23CMAW.PL001.13.webp'),
(25, './images/products/23CMAW.PL001.17.webp'),
(25, './images/products/_CMM1815__(2)_2.webp'),
(26, './images/products/23CMAW.PL001.1s1_55.webp'),
(26, './images/products/23CMAW.PL001.1s3_98.webp'),
(26, './images/products/23CMAW.PL001.1s2.webp'),
(26, './images/products/23CMAW.PL001.1s5.webp'),
(27, './images/products/ATT.TT.A.5.webp'),
(27, './images/products/ATT.TT.A.17.webp'),
(27, './images/products/ATT.TT.A.6.webp'),
(27, './images/products/ATT.TT.A.12.webp'),
(28, './images/products/23CMCW.JE002.7_72.webp'),
(28, './images/products/23CMCW.JE002.9_33.webp'),
(28, './images/products/23CMCW.JE002.8.webp'),
(28, './images/products/23CMCW.JE002.10.webp'),
(29, './images/products/copperstraightdenim10.webp'),
(29, './images/products/Straight-Garment-frontlight1.webp'),
(29, './images/products/copperstraightdenim9.webp'),
(29, './images/products/Coolmate_x_Copper_Jeans_-_Straight_-_Xanh_nhat___3.webp'),
(29, './images/products/copperstraightdenim11.webp'),
(30, './images/products/copperstraightdenim4.webp'),
(30, './images/products/copperstraightdenim3.webp'),
(30, './images/products/CCC.QJ.ST.D.5.webp'),
(30, './images/products/CCC.QJ.ST.D.8.webp'),
(30, './images/products/copperstraightdenim2.webp'),
(30, './images/products/copperstraightdenim1.webp'),
(31, './images/products/Quan_Jeans_dang_OG_Slim-thuumb-1.webp'),
(31, './images/products/Coolmate_x_Copper_Denim__Quan_Jeans_dang_OG_Slim10.webp'),
(31, './images/products/Coolmate_x_Copper_Jeans_-_OG_Slim__-_Xanh_dam_2_copy.webp'),
(31, './images/products/Coolmate_x_Copper_Jeans_-_OG_Slim__-_Xanh_dam_4_copy.webp'),
(32, './images/products/Quan_Jeans_dang_Slim_Fit-thumb-1.webp'),
(32, './images/products/Coolmate_x_Copper_Denim__Quan_Jeans_dang_Slim_Fit10.webp'),
(32, './images/products/Coolmate_x_Copper_Jeans_-_Slimfit__-_Xanh_dam_5.webp'),
(33, './images/products/Quan_Jeans_dang_Slim_Fit-thumb-2.webp'),
(33, './images/products/Coolmate_x_Copper_Denim__Quan_Jeans_dang_Slim_Fit7.webp'),
(33, './images/products/Coolmate_x_Copper_Jeans_-_Slimfit__-_Xanh_nhat_3.webp'),
(34, './images/products/_CMM0081.webp'),
(34, './images/products/_CMM0085.webp'),
(34, './images/products/_CMM0077.webp'),
(34, './images/products/_CMM0052.webp'),
(35, './images/products/23CMCW.QJ003.16.webp'),
(35, './images/products/23CMCW.QJ003.17.webp'),
(35, './images/products/joggerutdanang5.webp'),
(36, './images/products/QD001.1_67.webp'),
(36, './images/products/QD001.2_17.webp'),
(36, './images/products/QD001.8_87.webp'),
(37, './images/products/7recycle.den5.webp'),
(37, './images/products/7recycle.den4.webp'),
(37, './images/products/7recycle.den3.webp'),
(38, './images/products/QSBCBS3D.1_4.webp'),
(38, './images/products/maxcool_chay_bo_-_cam-1.webp'),
(39, './images/products/qtt.pm.v2.6.webp'),
(39, './images/products/qtt.pm.v2.1.webp'),
(40, './images/products/qs2l..gp.5.webp'),
(40, './images/products/qs2l..gp.6.webp'),
(40, './images/products/Short_hai_lop_Power_-_Reu_4.webp'),
(41, './images/products/CMQST.RN002.XCB.4_39.webp'),
(41, './images/products/xcbadvance6.913_copy_copy_2.webp'),
(41, './images/products/CMQST.RN002.XCB.6.webp'),
(42, './images/products/24CMAW.QS019.22_56.webp'),
(42, './images/products/24CMAW.QS019.3d1.webp'),
(42, './images/products/24CMAW.QS019.26.webp'),
(42, './images/products/24CMAW.QS019.30.webp'),
(43, './images/products/thumb7indanan2_81_copy.webp'),
(43, './images/products/24CMAW.QS007.3D1_51.webp'),
(43, './images/products/_CMM3076.webp'),
(44, './images/products/24CMAW.QS008.4_100.webp'),
(44, './images/products/Untitled-1_copy5_copydoo.webp'),
(44, './images/products/24CMAW.QS008.5.webp'),
(47, './images/products/QS.DP.15_68.webp'),
(47, './images/products/Quan_nam_Daily_Shorts_xam_xanh_copy.webp'),
(47, './images/products/QS.DP.16_37.webp'),
(48, './images/products/24CMAW.QS018.3_95.webp'),
(48, './images/products/ultrashortiirun2_48.webp'),
(48, './images/products/24CMAW.QS018.10_60.webp'),
(49, './images/products/24CMHU.BX010.DOO1.3d_92.webp'),
(49, './images/products/24CMHU.BX010.DOO1.1_76.webp'),
(49, './images/products/24CMHU.BX010.DOO1.2_92.webp'),
(50, './images/products/24cmhubx010xdg1_13.webp'),
(50, './images/products/24CMHU.BX010.Xdg11_23.webp'),
(50, './images/products/24CMHU.BX010.Xdg13.webp'),
(51, './images/products/7recycle.xchi6.webp'),
(51, './images/products/7recycle.xchi5.webp'),
(51, './images/products/7recycle.xchi2.webp'),
(52, './images/products/poloapl220.11.jpg'),
(52, './images/products/APL100-thumb-6.webp'),
(52, './images/products/poloapl220.12.webp'),
(53, './images/products/poloapl220.2.webp'),
(53, './images/products/APL100-thumb-4.webp'),
(53, './images/products/poloapl220.21.webp'),
(54, './images/products/_CMM0071_62.webp'),
(54, './images/products/_CMM0092_55.webp'),
(54, './images/products/_CMM0103.webp'),
(55, './images/products/24CMAW.PL003.BEE1_60.webp'),
(55, './images/products/24CMAW.PL003.BEE6_58.webp'),
(55, './images/products/24CMAW.PL003.BEE2.webp'),
(56, './images/products/24CMAW.PL003.XDG1_72.webp'),
(56, './images/products/24CMAW.PL003.XDG6_83.webp'),
(56, './images/products/24CMAW.PL003.XDG2.webp'),
(57, './images/products/24CMCW.PL001.THUMB1_41.webp'),
(57, './images/products/24CMCW.PL001.THUMB2_100.webp'),
(57, './images/products/24CMCW.PL001.NAU.3.webp'),
(58, './images/products/24CMCW.PL001.THUMB4_78.webp'),
(58, './images/products/24CMCW.PL001.THUMB5_31.webp'),
(58, './images/products/24CMCW.PL001.REU.4.webp'),
(59, './images/products/thumbPolo_Copper_1A1.webp'),
(59, './images/products/Polo_Copper_1B1.webp'),
(59, './images/products/thumb2Polo_Copper_1A2-2.webp'),
(60, './images/products/polographene.2.webp'),
(60, './images/products/polographene.6.webp'),
(60, './images/products/polographene.5.webp');

-- --------------------------------------------------------

--
-- Table structure for table `products_size`
--

CREATE TABLE `products_size` (
  `id` bigint(20) NOT NULL,
  `product_color_id` bigint(20) NOT NULL,
  `size_id` bigint(20) NOT NULL,
  `remaining_quantity` int(11) DEFAULT NULL,
  `sold_quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_size`
--

INSERT INTO `products_size` (`id`, `product_color_id`, `size_id`, `remaining_quantity`, `sold_quantity`) VALUES
(1, 4, 1, 30, 10),
(2, 4, 2, 30, 10),
(3, 4, 3, 50, 23),
(4, 2, 2, 50, 23),
(5, 2, 3, 40, 13),
(6, 2, 4, 30, 23),
(7, 3, 1, 17, 23),
(8, 3, 2, 34, 2),
(9, 3, 4, 17, 23),
(10, 5, 1, 30, 12),
(11, 5, 2, 50, 12),
(12, 6, 1, 17, 21),
(13, 6, 2, 7, 3),
(14, 6, 3, 7, 18),
(15, 7, 1, 30, 1),
(16, 7, 2, 3, 1),
(17, 7, 3, 3, 2),
(18, 7, 4, 9, 2),
(19, 7, 5, 9, 30),
(20, 8, 1, 9, 30),
(21, 8, 2, 9, 4),
(22, 8, 3, 9, 4),
(23, 8, 4, 9, 5),
(24, 9, 1, 10, 15),
(25, 9, 2, 46, 85),
(26, 9, 3, 86, 79),
(27, 10, 1, 34, 34),
(28, 10, 2, 71, 53),
(29, 10, 3, 51, 97),
(30, 10, 4, 34, 78),
(31, 11, 1, 89, 13),
(32, 11, 2, 96, 45),
(33, 11, 3, 34, 36),
(34, 11, 4, 80, 92),
(35, 12, 1, 21, 28),
(36, 12, 2, 80, 15),
(37, 12, 3, 38, 42),
(38, 12, 4, 98, 66),
(39, 12, 5, 35, 76),
(40, 12, 6, 77, 57),
(41, 13, 1, 56, 9),
(42, 13, 2, 76, 52),
(43, 13, 3, 35, 20),
(44, 13, 4, 93, 9),
(45, 14, 3, 64, 93),
(46, 14, 4, 74, 93),
(47, 14, 5, 43, 37),
(48, 14, 6, 54, 60),
(49, 15, 2, 41, 24),
(50, 15, 3, 97, 15),
(51, 15, 4, 85, 82),
(52, 16, 2, 53, 20),
(53, 16, 3, 40, 40),
(54, 16, 4, 83, 94),
(55, 16, 5, 21, 26),
(56, 17, 2, 66, 54),
(57, 17, 3, 74, 5),
(58, 17, 4, 5, 11),
(59, 17, 5, 41, 72),
(60, 18, 1, 39, 78),
(61, 18, 2, 74, 37),
(62, 18, 3, 63, 4),
(63, 18, 4, 32, 50),
(64, 18, 5, 55, 25),
(65, 19, 1, 59, 19),
(66, 19, 2, 22, 53),
(67, 19, 3, 97, 29),
(68, 19, 4, 53, 80),
(69, 20, 1, 42, 71),
(70, 20, 2, 27, 22),
(71, 20, 3, 32, 94),
(72, 20, 4, 73, 85),
(73, 21, 1, 5, 71),
(74, 21, 2, 40, 86),
(75, 21, 3, 14, 9),
(76, 21, 4, 5, 0),
(77, 22, 1, 84, 21),
(78, 22, 2, 52, 1),
(79, 22, 3, 46, 28),
(80, 22, 4, 4, 35),
(81, 23, 1, 66, 24),
(82, 23, 2, 21, 36),
(83, 23, 3, 17, 76),
(84, 23, 4, 31, 28),
(85, 23, 5, 46, 45),
(86, 24, 1, 90, 16),
(87, 24, 2, 10, 4),
(88, 24, 3, 88, 29),
(89, 24, 4, 83, 30),
(90, 25, 1, 98, 3),
(91, 25, 2, 20, 94),
(92, 25, 3, 9, 64),
(93, 25, 4, 94, 80),
(94, 25, 5, 16, 42),
(95, 26, 1, 64, 93),
(96, 26, 2, 73, 87),
(97, 26, 3, 19, 31),
(98, 26, 4, 98, 0),
(99, 26, 5, 4, 23),
(100, 27, 1, 2, 41),
(101, 27, 2, 99, 74),
(102, 27, 3, 72, 41),
(103, 27, 4, 89, 22),
(104, 27, 5, 43, 51),
(105, 28, 1, 25, 72),
(106, 28, 2, 88, 23),
(107, 28, 3, 50, 83),
(108, 28, 4, 66, 82),
(109, 28, 5, 12, 14),
(110, 29, 1, 37, 41),
(111, 29, 2, 93, 45),
(112, 29, 3, 47, 98),
(113, 29, 4, 50, 55),
(114, 29, 5, 28, 75),
(115, 30, 1, 90, 27),
(116, 30, 2, 66, 48),
(117, 30, 3, 42, 69),
(118, 30, 4, 18, 84),
(119, 30, 5, 67, 84),
(120, 31, 1, 58, 83),
(121, 31, 2, 43, 65),
(122, 31, 3, 97, 91),
(123, 31, 4, 66, 55),
(124, 31, 5, 79, 29),
(125, 32, 1, 9, 57),
(126, 32, 2, 58, 22),
(127, 32, 3, 35, 11),
(128, 32, 4, 52, 25),
(129, 32, 5, 70, 74),
(130, 34, 1, 62, 88),
(131, 34, 2, 56, 13),
(132, 34, 3, 1, 67),
(133, 34, 4, 32, 58),
(134, 34, 5, 93, 94),
(135, 35, 2, 92, 76),
(136, 35, 3, 5, 97),
(137, 35, 4, 69, 56),
(138, 35, 5, 75, 9),
(139, 36, 1, 17, 60),
(140, 36, 2, 49, 65),
(141, 36, 3, 77, 93),
(142, 36, 4, 32, 84),
(143, 37, 2, 22, 60),
(144, 37, 3, 34, 89),
(145, 37, 4, 43, 49),
(146, 38, 1, 18, 45),
(147, 38, 2, 69, 12),
(148, 38, 3, 54, 33),
(149, 38, 4, 2, 14),
(150, 39, 1, 62, 71),
(151, 39, 2, 69, 34),
(152, 39, 3, 61, 2),
(153, 39, 4, 31, 48),
(154, 40, 1, 47, 94),
(155, 40, 2, 28, 57),
(156, 40, 3, 1, 37),
(157, 40, 4, 81, 94),
(158, 40, 5, 29, 62),
(159, 41, 1, 23, 30),
(160, 41, 2, 80, 13),
(161, 41, 3, 24, 80),
(162, 41, 4, 32, 19),
(163, 41, 5, 99, 38),
(164, 42, 1, 95, 60),
(165, 42, 2, 14, 92),
(166, 42, 3, 19, 20),
(167, 42, 4, 45, 63),
(168, 42, 5, 81, 16),
(169, 43, 1, 39, 47),
(170, 43, 2, 17, 45),
(171, 43, 3, 73, 31),
(172, 44, 1, 39, 1),
(173, 44, 2, 88, 36),
(174, 44, 3, 17, 77),
(175, 44, 4, 37, 52),
(176, 44, 5, 50, 96),
(177, 47, 1, 29, 28),
(178, 47, 2, 95, 2),
(179, 47, 3, 44, 2),
(180, 47, 4, 92, 24),
(181, 47, 5, 61, 32),
(182, 48, 1, 37, 46),
(183, 48, 2, 55, 48),
(184, 48, 3, 18, 0),
(185, 48, 4, 50, 25),
(186, 48, 5, 2, 28),
(187, 49, 1, 37, 11),
(188, 49, 2, 5, 27),
(189, 49, 3, 60, 18),
(190, 49, 4, 2, 0),
(191, 49, 5, 94, 36),
(192, 50, 1, 81, 44),
(193, 50, 2, 3, 23),
(194, 50, 3, 25, 44),
(195, 50, 4, 62, 24),
(196, 50, 5, 56, 18),
(197, 52, 1, 77, 12),
(198, 52, 2, 90, 39),
(199, 52, 3, 19, 30),
(200, 52, 4, 46, 25),
(201, 52, 5, 15, 12),
(202, 53, 1, 81, 15),
(203, 53, 2, 12, 34),
(204, 53, 3, 7, 15),
(205, 53, 4, 33, 36),
(206, 53, 5, 64, 2),
(207, 54, 1, 30, 18),
(208, 54, 2, 90, 21),
(209, 54, 3, 43, 45),
(210, 54, 4, 22, 20),
(211, 54, 5, 40, 37),
(212, 55, 1, 54, 24),
(213, 55, 2, 77, 21),
(214, 55, 3, 82, 42),
(215, 55, 4, 74, 8),
(216, 55, 5, 62, 30),
(217, 56, 2, 21, 10),
(218, 56, 3, 41, 21),
(219, 56, 4, 95, 23),
(220, 56, 5, 43, 40),
(221, 57, 1, 71, 7),
(222, 57, 2, 57, 22),
(223, 57, 3, 48, 5),
(224, 57, 4, 8, 4),
(225, 57, 5, 21, 38),
(226, 58, 1, 25, 46),
(227, 58, 2, 91, 39),
(228, 58, 3, 16, 23),
(229, 58, 4, 83, 38),
(230, 58, 5, 37, 27),
(231, 59, 1, 66, 31),
(232, 59, 2, 17, 49),
(233, 59, 3, 45, 13),
(234, 59, 4, 0, 10),
(235, 59, 5, 4, 29),
(236, 60, 1, 82, 17),
(237, 60, 2, 23, 6),
(238, 60, 3, 95, 20),
(239, 60, 4, 12, 22),
(240, 60, 5, 81, 38);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) NOT NULL,
  `size_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size_name`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(4, 'XL'),
(5, '2XL'),
(6, '3XL');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `user_role` enum('admin','customer') DEFAULT NULL,
  `fullname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `email`, `user_password`, `phone`, `user_role`, `fullname`) VALUES
(1, 'dduongdev', 'kyvalaxz2021@gmail.com', 'k@buto2021//', '0385216798', 'customer', 'Nguyễn Đông Dương');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`user_id`,`product_size_id`),
  ADD KEY `product_size_id` (`product_size_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`order_id`,`product_size_id`),
  ADD KEY `product_size_id` (`product_size_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `products_color`
--
ALTER TABLE `products_color`
  ADD PRIMARY KEY (`id`),
  ADD KEY `color_id` (`color_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products_color_picture`
--
ALTER TABLE `products_color_picture`
  ADD KEY `product_color_id` (`product_color_id`);

--
-- Indexes for table `products_size`
--
ALTER TABLE `products_size`
  ADD PRIMARY KEY (`id`),
  ADD KEY `size_id` (`size_id`),
  ADD KEY `product_color_id` (`product_color_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `products_color`
--
ALTER TABLE `products_color`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `products_size`
--
ALTER TABLE `products_size`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_size_id`) REFERENCES `products_size` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `feedbacks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `feedbacks_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD CONSTRAINT `orders_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_detail_ibfk_2` FOREIGN KEY (`product_size_id`) REFERENCES `products_size` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products_color`
--
ALTER TABLE `products_color`
  ADD CONSTRAINT `products_color_ibfk_1` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_color_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products_color_picture`
--
ALTER TABLE `products_color_picture`
  ADD CONSTRAINT `products_color_picture_ibfk_1` FOREIGN KEY (`product_color_id`) REFERENCES `products_color` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products_size`
--
ALTER TABLE `products_size`
  ADD CONSTRAINT `products_size_ibfk_1` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_size_ibfk_2` FOREIGN KEY (`product_color_id`) REFERENCES `products_color` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
