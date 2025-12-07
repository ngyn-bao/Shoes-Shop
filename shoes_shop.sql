CREATE DATABASE IF NOT EXISTS shoes_shop;

USE shoes_shop;

-- ===========================================================
-- BẢNG NGƯỜI DÙNG
-- ===========================================================
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    address TEXT,
    avatar VARCHAR(255),
    role ENUM('customer', 'admin') DEFAULT 'customer',
    status ENUM('active', 'locked') DEFAULT 'active',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- ===========================================================
-- BẢNG LOẠI GIÀY
-- ===========================================================
CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL,
    description TEXT
);

-- ===========================================================
-- BẢNG THƯƠNG HIỆU
-- ===========================================================
CREATE TABLE brands (
    brand_id INT AUTO_INCREMENT PRIMARY KEY,
    brand_name VARCHAR(100) NOT NULL,
    country VARCHAR(100)
);

-- ===========================================================
-- BẢNG SẢN PHẨM
-- ===========================================================
CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(150) NOT NULL,
    category_id INT,
    brand_id INT,
    price DECIMAL(10,2) NOT NULL,
    discount DECIMAL(5,2) DEFAULT 0,
    description TEXT,
    stock INT DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(category_id),
    FOREIGN KEY (brand_id) REFERENCES brands(brand_id)
);

-- ===========================================================
-- BẢNG ẢNH SẢN PHẨM
-- ===========================================================
CREATE TABLE product_images (
    image_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    is_main BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);

-- ===========================================================
-- BẢNG GIỎ HÀNG
-- ===========================================================
CREATE TABLE cart (
    cart_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- ===========================================================
-- BẢNG CHI TIẾT GIỎ HÀNG
-- ===========================================================
CREATE TABLE cart_items (
    cart_item_id INT AUTO_INCREMENT PRIMARY KEY,
    cart_id INT NOT NULL,
    product_id INT NOT NULL,
    size VARCHAR(10),
    quantity INT DEFAULT 1,
    FOREIGN KEY (cart_id) REFERENCES cart(cart_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);

-- ===========================================================
-- BẢNG ĐƠN HÀNG
-- ===========================================================
CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'paid', 'shipped', 'completed', 'cancelled') DEFAULT 'pending',
    shipping_address TEXT,
    payment_method ENUM('cod', 'credit_card', 'paypal', 'bank_transfer') DEFAULT 'cod',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- ===========================================================
-- BẢNG CHI TIẾT ĐƠN HÀNG
-- ===========================================================
CREATE TABLE order_details (
    order_detail_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    size VARCHAR(10),
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);

-- ===========================================================
-- BẢNG NỘI DUNG TRANG (DÙNG CHO TRANG HOME, GIỚI THIỆU, LIÊN HỆ)
-- ===========================================================
CREATE TABLE site_content (
    content_id INT AUTO_INCREMENT PRIMARY KEY,
    page_name ENUM('home', 'about', 'contact') NOT NULL,
    title VARCHAR(150),
    content_html TEXT,
    image_url VARCHAR(255),
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ===========================================================
-- BẢNG LIÊN HỆ KHÁCH HÀNG
-- ===========================================================
CREATE TABLE contacts (
    contact_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'replied') DEFAULT 'new',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- ===========================================================
-- BẢNG FAQ (HỎI ĐÁP)
-- ===========================================================
CREATE TABLE faq (
    faq_id INT AUTO_INCREMENT PRIMARY KEY,
    question TEXT NOT NULL,
    answer TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- --------------------------------------------------------
-- Table: articles
-- --------------------------------------------------------
CREATE TABLE articles (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    title       VARCHAR(255) NOT NULL,
    slug        VARCHAR(255) UNIQUE,
    image       VARCHAR(500),
    excerpt     TEXT,
    content     TEXT NOT NULL,
    created_at  DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at  DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table: comments
-- --------------------------------------------------------
CREATE TABLE comments (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    article_id  INT NOT NULL,
    name        VARCHAR(100) NOT NULL,
    email       VARCHAR(150),
    content     TEXT NOT NULL,
    created_at  DATETIME DEFAULT CURRENT_TIMESTAMP,
    is_approved TINYINT(1) DEFAULT 1,           
    FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- SAMPLE DATA INSERTION
-- ============================================================

INSERT INTO articles (title, slug, image, excerpt, content) VALUES
('Top 10 đôi giày thể thao đáng mua nhất 2025', 'top-10-giay-the-thao-2025',
 'img/nike-alphafly.jpg',
 'Năm 2025, công nghệ giày chạy bộ lên tầm cao mới. Đây là 10 mẫu đáng sở hữu nhất!',
 '<p>2025 là năm bùng nổ của giày thể thao với hàng loạt công nghệ đỉnh cao từ Nike, Adidas, Puma...</p>
 <h3>1. Nike Air Zoom Alphafly NEXT% 3</h3>
 <p>Siêu nhẹ, đế carbon đầy đủ, giúp phá kỷ lục marathon. Giá: <strong>7.800.000đ</strong></p>
 <h3>2. Adidas Adizero Adios Pro 4</h3>
 <p>Đối thủ nặng ký của Alphafly, cực kỳ êm ái. Giá: <strong>6.500.000đ</strong></p>
 <p>Và còn 8 mẫu hot khác đang chờ bạn khám phá!</p>'),

('Cách chọn giày phù hợp với dáng chân', 'cach-chon-giay-phu-hop-dang-chan',
 'img/select-shoes.jpg',
 'Chọn sai size không chỉ đau chân mà còn gây hại lâu dài. Học ngay 3 mẹo đơn giản!',
 '<p>Không phải đôi giày nào đẹp cũng hợp với bạn. Dưới đây là cách chọn chuẩn nhất:</p>
 <ul>
   <li><strong>Chân bè:</strong> Chọn giày form Wide (Nike Wide, New Balance Wide)</li>
   <li><strong>Chân cao vòm:</strong> Cần đế hỗ trợ vòm tốt (Asics Gel-Kayano)</li>
   <li><strong>Chân bẹt:</strong> Ưu tiên giày Motion Control (Brooks Beast)</li>
 </ul>
 <p>Đo chân vào buổi chiều và thử cả hai chân là mẹo hay nhất!</p>'),

('Xu hướng giày Chunky Sneakers có còn hot 2025?', 'xu-huong-chunky-sneakers-2025',
 'img/chunky-2025.jpg',
 'Chunky không còn “đô con” nữa! Năm nay chúng thanh thoát và cực kỳ dễ phối đồ.',
 '<p>Sau 5 năm thống trị, Chunky Sneakers 2025 đã lột xác:</p>
 <ul>
   <li>Đế mỏng hơn, nhẹ hơn</li>
   <li>Màu pastel và phối màu gradient đang lên ngôi</li>
   <li>Balenciaga Triple S, Louis Vuitton Archlight vẫn dẫn đầu</li>
 </ul>
 <p>Kết luận: Chunky vẫn HOT, nhưng giờ đã “sang” hơn rất nhiều!</p>'),

('Review chi tiết Adidas Ultraboost 25 – Đáng nâng cấp?', 'review-adidas-ultraboost-25',
 'img/ultraboost25.jpg',
 'Sau 2 tuần chạy bộ và đi bộ hàng ngày, đây là nhận xét chân thật nhất.',
 '<p>Ultraboost 25 có gì mới?</p>
 <ul>
   <li>Đế Boost dày hơn 15%, êm ái hơn hẳn</li>
   <li>Primeknit upper thoáng khí, ôm chân tốt</li>
   <li>Đi cả ngày không mỏi, chạy 10km vẫn thoải mái</li>
 </ul>
 <p><strong>Đáng nâng cấp?</strong> Có! Giá <strong>4.800.000đ</strong> hoàn toàn xứng đáng.</p>'),

('5 cách phối đồ với giày trắng siêu nổi bật', 'phoi-do-voi-giay-trang',
 'img/white-shoes.jpg',
 'Giày trắng chưa bao giờ lỗi thời. Áp dụng ngay 5 công thức sau để luôn nổi bật!',
 '<p>1. Quần jeans + áo thun trắng + giày trắng (classic)<br>
   2. Váy maxi hoa + giày trắng (nữ tính)<br>
   3. Suit xám + giày trắng (phá cách công sở)<br>
   4. Đồ thể thao màu neon + giày trắng (năng động)<br>
   5. Đầm đen + giày trắng (đơn giản mà sang)</p>
 <p>Bí quyết: Giữ giày luôn sạch để outfit luôn đẹp!</p>'),

('Giày chạy bộ dưới 1 triệu đáng mua nhất 2025', 'giay-chay-bo-duoi-1-trieu',
 'img/running-budget.jpg',
 'Không cần chi nhiều, bạn vẫn sở hữu đôi giày chất lượng để chạy bộ mỗi ngày.',
 '<p>Top 5 mẫu dưới 1 triệu đáng tiền nhất:<br>
   1. Biti’s Hunter Running – 799k<br>
   2. Peak E-Dong – 890k<br>
   3. Xiaomi FreeTie – 950k<br>
   4. Decathlon Kalenji Run Cushion – 790k<br>
   5. Ananas Track 6 – 850k</p>
 <p>Tất cả đều nhẹ, êm, thoáng khí – đủ để chạy 5–10km thoải mái!</p>'),

('Hướng dẫn vệ sinh giày da lộn tại nhà', 've-sinh-giay-da-luon',
 'img/suede-clean.jpg',
 'Chỉ 4 món đồ trong nhà là đôi giày da lộn lại đẹp như mới!',
 '<p>Chuẩn bị: bàn chải lông mềm, giấm trắng, baking soda, khăn microfiber.</p>
 <ol>
   <li>Chải bụi khô</li>
   <li>Dùng giấm trắng lau vết bẩn</li>
   <li>Rắc baking soda khử mùi</li>
   <li>Phơi chỗ thoáng, tránh nắng trực tiếp</li>
 </ol>
 <p>Làm 1 lần/tuần, giày da lộn của bạn sẽ bền tới 3–4 năm!</p>'),

('Giày bóng rổ nào NBA player đang mang 2025?', 'giay-bong-ro-nba-2025',
 'img/nba-shoes.jpg',
 'LeBron, Curry, Giannis, Luka… đang mang gì trên sân mùa này?',
 '<p>Cập nhật mới nhất:<br>
   • LeBron 22 – LeBron James<br>
   • Curry 12 – Stephen Curry<br>
   • Freak 6 – Giannis Antetokounmpo<br>
   • Luka 4 – Luka Dončić<br>
   • Sabrina 2 – Sabrina Ionescu (nữ)</p>
 <p>Tất cả đều có bản bán lẻ tại Việt Nam, giá từ 3.5–5 triệu.</p>'),

('Phân biệt giày chính hãng và hàng fake', 'phan-biet-giay-that-gia',
 'img/real-vs-fake.jpg',
 '10 điểm khác biệt dễ thấy nhất, giúp bạn không mất tiền oan!',
 '<p>1. Mùi keo (fake thường nồng)<br>
   2. Đường may (thật đều, fake lệch)<br>
   3. Logo in sắc nét<br>
   4. Mã code trong lưỡi gà<br>
   5. Trọng lượng (fake thường nhẹ hơn)<br>
   …và 5 mẹo nữa trong bài!</p>
 <p>Mẹo cuối: Luôn mua ở store chính hãng hoặc Shopee Mall!</p>'),

('Top thương hiệu giày Việt Nam đang vươn tầm quốc tế', 'thuong-hieu-giay-viet-nam',
 'img/vietnam-brands.jpg',
 'Biti’s, Ananas, Vascara không còn là “dép tổ ong” nữa!',
 '<p>Thành tựu nổi bật:<br>
   • Biti’s Hunter xuất khẩu sang 40 nước<br>
   • Ananas mở cửa hàng tại Thái Lan, Singapore<br>
   • Vascara đạt 1 triệu đôi bán ra năm 2024</p>
 <p>Giày Việt giờ chất lượng ngang tầm quốc tế, giá lại siêu hợp lý!</p>');

-- --------------------------------------------------------
-- Sample comments
-- --------------------------------------------------------
INSERT INTO comments (article_id, name, email, content) VALUES
(1, 'Minh Tuấn', 'tuan@gmail.com', 'Bài viết rất chi tiết, cảm ơn shop! Mình đang phân vân giữa Alphafly và Vaporfly đây ạ.'),
(1, 'Hà Anh', NULL, 'Mình mới mua Alphafly 3, chạy 5km mà nhẹ tênh luôn!'),
(2, 'Lan Nguyễn', 'lan@gmail.com', 'Cảm ơn bài viết, mình bị chân bè nên hay đau. Giờ biết chọn giày Wide rồi!'),
(3, 'Khoa Phạm', NULL, 'Chunky giờ nhìn đỡ “đô con” hơn thật, mình vẫn thích Balenciaga Triple S'),
(4, 'Vũ Hoàng', 'hoang@gmail.com', 'Ultraboost 25 đế Boost dày hơn hẳn, đi cả ngày không mỏi chân luôn!');

-- Optional: Add indexes for better performance
CREATE INDEX idx_slug ON articles(slug);
CREATE INDEX idx_article_comments ON comments(article_id);

CREATE TABLE faq_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE faq_questions (
    question_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    category_id INT NULL,
    question TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (category_id) REFERENCES faq_categories(id)
);