-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 07, 2025 at 11:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoes_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `excerpt` text DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `slug`, `image`, `excerpt`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Top 10 đôi giày thể thao đáng mua nhất 2025', 'top-10-giay-the-thao-2025', 'img/nike-alphafly.jpg', 'Năm 2025, công nghệ giày chạy bộ lên tầm cao mới. Đây là 10 mẫu đáng sở hữu nhất!', '<p>2025 là năm bùng nổ của giày thể thao với hàng loạt công nghệ đỉnh cao từ Nike, Adidas, Puma...</p>\n <h3>1. Nike Air Zoom Alphafly NEXT% 3</h3>\n <p>Siêu nhẹ, đế carbon đầy đủ, giúp phá kỷ lục marathon. Giá: <strong>7.800.000đ</strong></p>\n <h3>2. Adidas Adizero Adios Pro 4</h3>\n <p>Đối thủ nặng ký của Alphafly, cực kỳ êm ái. Giá: <strong>6.500.000đ</strong></p>\n <p>Và còn 8 mẫu hot khác đang chờ bạn khám phá!</p>', '2025-12-07 05:58:04', '2025-12-07 15:22:45'),
(2, 'Cách chọn giày phù hợp với dáng chân', 'cach-chon-giay-phu-hop-dang-chan', 'img/select-shoes.jpg', 'Chọn sai size không chỉ đau chân mà còn gây hại lâu dài. Học ngay 3 mẹo đơn giản!', '<p>Không phải đôi giày nào đẹp cũng hợp với bạn. Dưới đây là cách chọn chuẩn nhất:</p>\r\n <ul>\r\n   <li><strong>Chân bè:</strong> Chọn giày form Wide (Nike Wide, New Balance Wide)</li>\r\n   <li><strong>Chân cao vòm:</strong> Cần đế hỗ trợ vòm tốt (Asics Gel-Kayano)</li>\r\n   <li><strong>Chân bẹt:</strong> Ưu tiên giày Motion Control (Brooks Beast)</li>\r\n </ul>\r\n <p>Đo chân vào buổi chiều và thử cả hai chân là mẹo hay nhất!</p>', '2025-12-07 05:58:04', '2025-12-07 05:58:04'),
(3, 'Xu hướng giày Chunky Sneakers có còn hot 2025?', 'xu-huong-chunky-sneakers-2025', 'img/chunky-2025.jpg', 'Chunky không còn “đô con” nữa! Năm nay chúng thanh thoát và cực kỳ dễ phối đồ.', '<p>Sau 5 năm thống trị, Chunky Sneakers 2025 đã lột xác:</p>\r\n <ul>\r\n   <li>Đế mỏng hơn, nhẹ hơn</li>\r\n   <li>Màu pastel và phối màu gradient đang lên ngôi</li>\r\n   <li>Balenciaga Triple S, Louis Vuitton Archlight vẫn dẫn đầu</li>\r\n </ul>\r\n <p>Kết luận: Chunky vẫn HOT, nhưng giờ đã “sang” hơn rất nhiều!</p>', '2025-12-07 05:58:04', '2025-12-07 05:58:04'),
(4, 'Review chi tiết Adidas Ultraboost 25 – Đáng nâng cấp?', 'review-adidas-ultraboost-25', 'img/ultraboost25.jpg', 'Sau 2 tuần chạy bộ và đi bộ hàng ngày, đây là nhận xét chân thật nhất.', '<p>Ultraboost 25 có gì mới?</p>\r\n <ul>\r\n   <li>Đế Boost dày hơn 15%, êm ái hơn hẳn</li>\r\n   <li>Primeknit upper thoáng khí, ôm chân tốt</li>\r\n   <li>Đi cả ngày không mỏi, chạy 10km vẫn thoải mái</li>\r\n </ul>\r\n <p><strong>Đáng nâng cấp?</strong> Có! Giá <strong>4.800.000đ</strong> hoàn toàn xứng đáng.</p>', '2025-12-07 05:58:04', '2025-12-07 05:58:04'),
(5, '5 cách phối đồ với giày trắng siêu nổi bật', 'phoi-do-voi-giay-trang', 'img/white-shoes.jpg', 'Giày trắng chưa bao giờ lỗi thời. Áp dụng ngay 5 công thức sau để luôn nổi bật!', '<p>1. Quần jeans + áo thun trắng + giày trắng (classic)<br>\r\n   2. Váy maxi hoa + giày trắng (nữ tính)<br>\r\n   3. Suit xám + giày trắng (phá cách công sở)<br>\r\n   4. Đồ thể thao màu neon + giày trắng (năng động)<br>\r\n   5. Đầm đen + giày trắng (đơn giản mà sang)</p>\r\n <p>Bí quyết: Giữ giày luôn sạch để outfit luôn đẹp!</p>', '2025-12-07 05:58:04', '2025-12-07 05:58:04'),
(6, 'Giày chạy bộ dưới 1 triệu đáng mua nhất 2025', 'giay-chay-bo-duoi-1-trieu', 'img/running-budget.jpg', 'Không cần chi nhiều, bạn vẫn sở hữu đôi giày chất lượng để chạy bộ mỗi ngày.', '<p>Top 5 mẫu dưới 1 triệu đáng tiền nhất:<br>\r\n   1. Biti’s Hunter Running – 799k<br>\r\n   2. Peak E-Dong – 890k<br>\r\n   3. Xiaomi FreeTie – 950k<br>\r\n   4. Decathlon Kalenji Run Cushion – 790k<br>\r\n   5. Ananas Track 6 – 850k</p>\r\n <p>Tất cả đều nhẹ, êm, thoáng khí – đủ để chạy 5–10km thoải mái!</p>', '2025-12-07 05:58:04', '2025-12-07 05:58:04'),
(7, 'Hướng dẫn vệ sinh giày da lộn tại nhà', 've-sinh-giay-da-luon', 'img/suede-clean.jpg', 'Chỉ 4 món đồ trong nhà là đôi giày da lộn lại đẹp như mới!', '<p>Chuẩn bị: bàn chải lông mềm, giấm trắng, baking soda, khăn microfiber.</p>\r\n <ol>\r\n   <li>Chải bụi khô</li>\r\n   <li>Dùng giấm trắng lau vết bẩn</li>\r\n   <li>Rắc baking soda khử mùi</li>\r\n   <li>Phơi chỗ thoáng, tránh nắng trực tiếp</li>\r\n </ol>\r\n <p>Làm 1 lần/tuần, giày da lộn của bạn sẽ bền tới 3–4 năm!</p>', '2025-12-07 05:58:04', '2025-12-07 05:58:04'),
(8, 'Giày bóng rổ nào NBA player đang mang 2025?', 'giay-bong-ro-nba-2025', 'img/nba-shoes.jpg', 'LeBron, Curry, Giannis, Luka… đang mang gì trên sân mùa này?', '<p>Cập nhật mới nhất:<br>\r\n   • LeBron 22 – LeBron James<br>\r\n   • Curry 12 – Stephen Curry<br>\r\n   • Freak 6 – Giannis Antetokounmpo<br>\r\n   • Luka 4 – Luka Dončić<br>\r\n   • Sabrina 2 – Sabrina Ionescu (nữ)</p>\r\n <p>Tất cả đều có bản bán lẻ tại Việt Nam, giá từ 3.5–5 triệu.</p>', '2025-12-07 05:58:04', '2025-12-07 05:58:04'),
(9, 'Phân biệt giày chính hãng và hàng fake', 'phan-biet-giay-that-gia', 'img/real-vs-fake.jpg', '10 điểm khác biệt dễ thấy nhất, giúp bạn không mất tiền oan!', '<p>1. Mùi keo (fake thường nồng)<br>\r\n   2. Đường may (thật đều, fake lệch)<br>\r\n   3. Logo in sắc nét<br>\r\n   4. Mã code trong lưỡi gà<br>\r\n   5. Trọng lượng (fake thường nhẹ hơn)<br>\r\n   …và 5 mẹo nữa trong bài!</p>\r\n <p>Mẹo cuối: Luôn mua ở store chính hãng hoặc Shopee Mall!</p>', '2025-12-07 05:58:04', '2025-12-07 05:58:04'),
(10, 'Top thương hiệu giày Việt Nam đang vươn tầm quốc tế', 'thuong-hieu-giay-viet-nam', 'img/vietnam-brands.jpg', 'Biti’s, Ananas, Vascara không còn là “dép tổ ong” nữa!', '<p>Thành tựu nổi bật:<br>\r\n   • Biti’s Hunter xuất khẩu sang 40 nước<br>\r\n   • Ananas mở cửa hàng tại Thái Lan, Singapore<br>\r\n   • Vascara đạt 1 triệu đôi bán ra năm 2024</p>\r\n <p>Giày Việt giờ chất lượng ngang tầm quốc tế, giá lại siêu hợp lý!</p>', '2025-12-07 05:58:04', '2025-12-07 05:58:04');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `country` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `country`) VALUES
(1, 'Nike', 'USA'),
(2, 'Adidas', 'Germany'),
(3, 'Puma', 'Germany'),
(4, 'New Balance', 'USA'),
(5, 'Converse', 'USA'),
(6, 'Vans', 'USA'),
(7, 'Asics', 'Japan'),
(8, 'Reebok', 'UK');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `created_at`) VALUES
(1, 1, '2025-12-07 15:27:26');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `cart_item_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(10) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`cart_item_id`, `cart_id`, `product_id`, `size`, `quantity`) VALUES
(1, 1, 2, '38', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `description`) VALUES
(1, 'Men', 'Giày thời trang dành cho nam giới'),
(2, 'Women', 'Giày thời trang dành cho nữ giới'),
(3, 'Kid', 'Giày thời trang dành cho trẻ em'),
(4, 'Sport', 'Giày thể thao');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `content` text NOT NULL,
  `rating` tinyint(1) DEFAULT 5,
  `created_at` datetime DEFAULT current_timestamp(),
  `is_approved` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `article_id`, `user_id`, `name`, `email`, `content`, `rating`, `created_at`, `is_approved`) VALUES
(16, 1, NULL, 'Minh Tuấn', 'tuan@gmail.com', 'Bài viết rất chi tiết, cảm ơn shop! Mình đang phân vân giữa Alphafly và Vaporfly đây ạ.', 5, '2025-12-07 05:59:37', 1),
(17, 1, NULL, 'Hà Anh', NULL, 'Mình mới mua Alphafly 3, chạy 5km mà nhẹ tênh luôn!', 5, '2025-12-07 05:59:37', 1),
(18, 2, NULL, 'Lan Nguyễn', 'lan@gmail.com', 'Cảm ơn bài viết, mình bị chân bè nên hay đau. Giờ biết chọn giày Wide rồi!', 5, '2025-12-07 05:59:37', 1),
(19, 3, NULL, 'Khoa Phạm', NULL, 'Chunky giờ nhìn đỡ “đô con” hơn thật, mình vẫn thích Balenciaga Triple S', 5, '2025-12-07 05:59:37', 1),
(20, 4, NULL, 'Vũ Hoàng', 'hoang@gmail.com', 'Ultraboost 25 đế Boost dày hơn hẳn, đi cả ngày không mỏi chân luôn!', 5, '2025-12-07 05:59:37', 1),
(23, 1, 1, 'vu minh khoa', NULL, '213', NULL, '2025-12-07 06:26:38', 1),
(24, 1, 1, 'vu minh khoa', NULL, '444', NULL, '2025-12-07 06:30:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `contact_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `message` text NOT NULL,
  `status` enum('new','read','replied') DEFAULT 'new',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `faq_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`faq_id`, `category_id`, `question`, `answer`) VALUES
(1, 1, 'Tôi có thể thanh toán bằng hình thức nào?', 'Bạn có thể thanh toán bằng COD, chuyển khoản hoặc ví điện tử.'),
(2, 1, 'Thanh toán có an toàn không?', 'Chúng tôi sử dụng cổng thanh toán bảo mật SSL 100%.'),

(3, 2, 'Thời gian giao hàng mất bao lâu?', 'Thời gian giao hàng từ 2-5 ngày tùy khu vực.'),
(4, 2, 'Tôi có được kiểm tra hàng trước khi thanh toán không?', 'Bạn được kiểm tra hàng trước khi thanh toán cho shipper.'),

(5, 3, 'Tôi có thể đổi trả trong bao lâu?', 'Bạn có thể đổi trả trong vòng 7 ngày kể từ ngày nhận hàng.'),
(6, 3, 'Sản phẩm bị lỗi thì xử lý thế nào?', 'Chúng tôi sẽ đổi mới 100% nếu lỗi do nhà sản xuất.'),

(7, 4, 'Làm sao chọn đúng size giày?', 'Bạn có thể đo chiều dài bàn chân và đối chiếu bảng size.'),
(8, 4, 'Size giày có chuẩn form không?', 'Size giày chuẩn form Việt Nam.'),

(9, 5, 'Giày có phải chính hãng không?', 'Chúng tôi cam kết 100% hàng chính hãng, đầy đủ tag và hóa đơn.'),
(10, 5, 'Làm sao biết sản phẩm còn hàng?', 'Trong trang sản phẩm sẽ hiển thị tình trạng còn hàng theo từng size.'),

(11, 6, 'Voucher áp dụng thế nào?', 'Bạn nhập mã giảm giá ở bước thanh toán để hệ thống tự áp dụng.'),
(12, 6, 'Vì sao mã giảm giá không dùng được?', 'Có thể mã đã hết hạn hoặc không áp dụng cho sản phẩm bạn chọn.'),

(13, 7, 'Tôi có thể đổi mật khẩu không?', 'Bạn có thể đổi mật khẩu trong trang thông tin cá nhân.'),
(14, 7, 'Thông tin cá nhân của tôi có được bảo mật không?', 'Hệ thống của chúng tôi mã hóa toàn bộ dữ liệu và không chia sẻ cho bên thứ ba.'),

(15, 8, 'Làm sao liên hệ chăm sóc khách hàng?', 'Bạn có thể liên hệ qua hotline hoặc email của shop.'),

(16, 9, 'Shop có dịch vụ vệ sinh giày không?', 'Hiện tại shop chưa hỗ trợ vệ sinh giày.');

-- --------------------------------------------------------

--
-- Table structure for table `faq_categories`
--

CREATE TABLE `faq_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq_categories`
--

INSERT INTO `faq_categories` (`id`, `name`) VALUES
(1, 'Đặt hàng & Thanh toán'),
(2, 'Vận chuyển & Giao hàng'),
(3, 'Đổi trả & Bảo hành'),
(4, 'Size & Chọn giày'),
(5, 'Sản phẩm'),
(6, 'Khuyến mãi & Voucher'),
(7, 'Tài khoản & Bảo mật'),
(8, 'Chăm sóc khách hàng'),
(9, 'Câu hỏi khác');


-- --------------------------------------------------------

--
-- Table structure for table `faq_questions`
--

CREATE TABLE `faq_questions` (
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `question` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq_questions`
--

INSERT INTO `faq_questions` (`question_id`, `user_id`, `category_id`, `question`) VALUES
(1, 1, 1, 'Shop có hỗ trợ trả góp không?');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','paid','shipped','completed','cancelled') DEFAULT 'pending',
  `shipping_address` text DEFAULT NULL,
  `payment_method` enum('cod','credit_card','paypal','bank_transfer') DEFAULT 'cod',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total_amount`, `status`, `shipping_address`, `payment_method`, `created_at`) VALUES
(1, 1, 3900000.00, 'shipped', '123123', '', '2025-12-08 05:20:40');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(10) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_detail_id`, `order_id`, `product_id`, `size`, `quantity`, `price`) VALUES
(1, 1, 2, '38', 1, 3900000.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` decimal(5,2) DEFAULT 0.00,
  `description` text DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `category_id`, `brand_id`, `price`, `discount`, `description`, `stock`, `created_at`, `updated_at`) VALUES
(1, 'Nike Air Force 1 White', 1, 1, 2500000.00, 10.00, 'Mẫu sneaker huyền thoại, thiết kế basic dễ phối đồ.', 50, '2025-12-08 04:59:08', '2025-12-08 04:59:08'),
(2, 'Adidas Ultraboost 22', 2, 2, 3900000.00, 5.00, 'Giày chạy bộ cao cấp với bộ đệm Boost êm ái.', 30, '2025-12-08 04:59:08', '2025-12-08 04:59:08'),
(3, 'Puma Training Fuse 2', 3, 3, 2200000.00, 0.00, 'Giày training chuyên dành cho gym và crossfit.', 20, '2025-12-08 04:59:08', '2025-12-08 04:59:08'),
(4, 'Nike Kyrie Flytrap 6', 4, 1, 2700000.00, 15.00, 'Giày bóng rổ nhẹ, linh hoạt dành cho vị trí guard.', 15, '2025-12-08 04:59:08', '2025-12-08 04:59:08'),
(5, 'Adidas Predator Freak .3', 1, 2, 2100000.00, 0.00, 'Giày đá bóng sân cỏ nhân tạo, hỗ trợ kiểm soát bóng.', 25, '2025-12-08 04:59:08', '2025-12-08 04:59:08'),
(6, 'Vans Old Skool Black White', 1, 6, 1600000.00, 0.00, 'Mẫu giày skate cổ điển với đường jazz stripe đặc trưng.', 40, '2025-12-08 04:59:08', '2025-12-08 04:59:08'),
(7, 'Converse Chuck Taylor 70s High', 2, 5, 1900000.00, 0.00, 'Huyền thoại Chuck 70s cao cổ, form đẹp, chất liệu cao cấp.', 35, '2025-12-08 04:59:08', '2025-12-08 04:59:08'),
(8, 'Asics Gel Nimbus 25', 2, 7, 4500000.00, 10.00, 'Giày chạy bộ cao cấp nhất của Asics, siêu êm.', 18, '2025-12-08 04:59:08', '2025-12-08 04:59:08'),
(9, 'New Balance 574 Grey', 3, 4, 2300000.00, 5.00, 'Dòng sneaker casual cổ điển, màu xám iconic.', 28, '2025-12-08 04:59:08', '2025-12-08 04:59:08'),
(10, 'Reebok Nano X3', 4, 8, 3200000.00, 0.00, 'Giày tập gym đa năng dành cho việc nâng tạ và cardio.', 22, '2025-12-08 04:59:08', '2025-12-08 04:59:08');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `image_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `is_main` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`image_id`, `product_id`, `image_url`, `is_main`) VALUES
(1, 1, 'https://static.nike.com/a/images/t_web_pdp_936_v2/f_auto/b7d9211c-26e7-431a-ac24-b0540fb3c00f/AIR+FORCE+1+%2707.png', 1),
(2, 1, 'https://sneakerholicvietnam.vn/wp-content/uploads/2021/07/nike-air-force-1-low-white-315115-112-2.jpg', 0),
(3, 1, 'https://authentic-shoes.com/wp-content/uploads/2023/05/Screenshot_2023.08.16_13.12.15.003.png', 0),
(4, 2, 'https://bizweb.dktcdn.net/thumb/large/100/413/756/products/ultraboost-22-shoes-black-gx9783-1671959897384.jpg?v=1675314269240', 1),
(5, 2, 'https://cdn-images.farfetch-contents.com/19/41/92/92/19419292_42685107_1000.jpg', 0),
(6, 3, 'https://www.gearpatrol.com/wp-content/uploads/sites/2/2022/10/1666363453-puma-fuse-2-0-embed-1666363443-jpg.webp', 1),
(7, 4, 'https://sneakerdaily.vn/wp-content/uploads/2023/09/giay-nike-kyrie-flytrap-6-ep-black-white-dm1126-001.jpg', 1),
(8, 4, 'https://pos.nvncdn.com/80cfbf-41716/ps/20221125_xmiYGePwuSCGE74JPiWbX7Dv.jpg?v=1673515210', 0),
(9, 5, 'https://product.hstatic.net/1000061481/product/4da7c5eeeacc411d9b7b0b5c8f948206_08a0733132fb40d290330804d0bdec80_1024x1024.jpg', 1),
(10, 6, 'https://bizweb.dktcdn.net/100/140/774/products/vans-old-skool-black-white-vn000d3hy28-2.jpg?v=1625905148527', 1),
(11, 6, 'https://bizweb.dktcdn.net/100/140/774/files/giay-vans-skate-old-skool-black-white-vn0a5fcby28-2.jpg?v=1691834912747', 0),
(12, 7, 'https://www.converse.vn/media/catalog/product/0/8/0882-CON162050C000005-1.jpg', 1),
(13, 8, 'https://vietstore365.vn/uploads/f_648049e312c9b5be592031e8/609781ca3bf8556d62b5927d9.png', 1),
(14, 8, 'https://vietstore365.vn/uploads/f_648049e312c9b5be592031e8/81828cc32aa46e7d5d30637d7.jpg', 0),
(15, 9, 'https://saigonsneaker.com/wp-content/uploads/2020/12/574-3.jpg', 1),
(16, 10, 'https://cdn-images.farfetch-contents.com/21/31/59/10/21315910_51202685_600.jpg', 1),
(17, 10, 'https://images-na.ssl-images-amazon.com/images/I/717xN7y3PfL.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `site_content`
--

CREATE TABLE `site_content` (
  `content_id` int(11) NOT NULL,
  `page_name` enum('home','about','contact') NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `content_html` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `site_content` (`page_name`, `title`, `content_html`, `image_url`)
VALUES (
  'about',
  'Về chúng tôi',
  '<p>
    <strong>Shoe Shop</strong> là hệ thống cửa hàng chuyên cung cấp các mẫu giày thời trang, sneaker chính hãng đến từ 
    những thương hiệu uy tín trong và ngoài nước. Được xây dựng với tiêu chí đặt trải nghiệm khách hàng lên hàng đầu, 
    chúng tôi luôn nỗ lực mang đến những sản phẩm chất lượng, đa dạng phong cách, phù hợp với nhiều nhóm khách hàng khác nhau.
  </p>
  <p>
    Tại Shoe Shop, mỗi đôi giày không chỉ là một sản phẩm, mà còn là cách chúng tôi truyền tải sự tự tin, 
    cá tính và phong cách sống hiện đại đến với người mua. Cùng với đội ngũ nhân viên tận tâm, 
    chúng tôi cam kết mang lại một hành trình mua sắm thuận tiện, nhanh chóng và đáng tin cậy.
  </p>

  <h3>Sứ mệnh của chúng tôi</h3>
  <p>
    Sứ mệnh của Shoe Shop là trở thành lựa chọn hàng đầu của những người yêu giày và đam mê thời trang. 
    Chúng tôi không chỉ tập trung vào việc mang đến sản phẩm tốt, mà còn hướng đến xây dựng một cộng đồng khách hàng hài lòng,
    nơi mỗi người đều có thể tìm thấy phong cách phù hợp và thể hiện cá tính riêng.
  </p>
  <p>
    Chúng tôi nỗ lực cập nhật xu hướng mới nhất, cải tiến dịch vụ mỗi ngày và mở rộng sự đa dạng trong bộ sưu tập. 
    Mỗi quyết định đều hướng đến mục tiêu nâng cao trải nghiệm của bạn - từ lúc tìm kiếm sản phẩm, đặt hàng, 
    đến khi nhận được đôi giày yêu thích trên tay.
  </p>

  <h3>Cam kết của chúng tôi</h3>
  <ul>
    <li>100% sản phẩm chính hãng, nguồn gốc rõ ràng</li>
    <li>Hỗ trợ đổi trả dễ dàng và nhanh chóng</li>
    <li>Giao hàng toàn quốc với nhiều hình thức vận chuyển linh hoạt</li>
    <li>Giá cả minh bạch, cạnh tranh và đi kèm nhiều ưu đãi</li>
    <li>Bảo mật tuyệt đối thông tin khách hàng</li>
  </ul>

  <p style="margin-top:20px; font-style:italic; text-align:center;">
    Cảm ơn bạn đã tin tưởng và đồng hành cùng Shoe Shop. Chúng tôi rất hân hạnh được phục vụ bạn!
  </p>',
  'https://t4.ftcdn.net/jpg/03/83/72/35/360_F_383723590_htmZf74auhyhPFvQUGQecrt4ZA7VzuYW.jpg'
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `role` enum('customer','admin') DEFAULT 'customer',
  `status` enum('active','locked') DEFAULT 'active',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `password_hash`, `phone`, `address`, `avatar`, `role`, `status`, `created_at`) VALUES
(1, 'vu minh khoa', 'khoa.vu2424@hcmut.edu.vn', '$2y$10$YhTCKyWEM258OXhQvETdz.6f1OEyBU.Dmh0wseRYLO8.w.RKkgp..', '123456789', '', '', 'admin', 'active', '2025-12-07 06:09:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `idx_slug` (`slug`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_article_comments` (`article_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`faq_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `faq_categories`
--
ALTER TABLE `faq_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq_questions`
--
ALTER TABLE `faq_questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `site_content`
--
ALTER TABLE `site_content`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `faq_categories`
--
ALTER TABLE `faq_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faq_questions`
--
ALTER TABLE `faq_questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `site_content`
--
ALTER TABLE `site_content`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`),
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `faq`
--
ALTER TABLE `faq`
  ADD CONSTRAINT `faq_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `faq_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `faq_questions`
--
ALTER TABLE `faq_questions`
  ADD CONSTRAINT `faq_questions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `faq_questions_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `faq_categories` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`brand_id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
