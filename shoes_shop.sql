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

INSERT INTO categories (category_name, description) VALUES
('Men', 'Giày thời trang dành cho nam giới'),
('Women', 'Giày thời trang dành cho nữ giới'),
('Kid', 'Giày thời trang dành cho trẻ em'),
('Sport', 'Giày thể thao');

INSERT INTO brands (brand_name, country) VALUES
('Nike', 'USA'),
('Adidas', 'Germany'),
('Puma', 'Germany'),
('New Balance', 'USA'),
('Converse', 'USA'),
('Vans', 'USA'),
('Asics', 'Japan'),
('Reebok', 'UK');


INSERT INTO products (product_name, category_id, brand_id, price, discount, description, stock) VALUES
('Nike Air Force 1 White', 1, 1, 2500000, 10, 'Mẫu sneaker huyền thoại, thiết kế basic dễ phối đồ.', 50),
('Adidas Ultraboost 22', 2, 2, 3900000, 5, 'Giày chạy bộ cao cấp với bộ đệm Boost êm ái.', 30),
('Puma Training Fuse 2', 3, 3, 2200000, 0, 'Giày training chuyên dành cho gym và crossfit.', 20),
('Nike Kyrie Flytrap 6', 4, 1, 2700000, 15, 'Giày bóng rổ nhẹ, linh hoạt dành cho vị trí guard.', 15),
('Adidas Predator Freak .3', 1, 2, 2100000, 0, 'Giày đá bóng sân cỏ nhân tạo, hỗ trợ kiểm soát bóng.', 25),
('Vans Old Skool Black White', 1, 6, 1600000, 0, 'Mẫu giày skate cổ điển với đường jazz stripe đặc trưng.', 40),
('Converse Chuck Taylor 70s High', 2, 5, 1900000, 0, 'Huyền thoại Chuck 70s cao cổ, form đẹp, chất liệu cao cấp.', 35),
('Asics Gel Nimbus 25', 2, 7, 4500000, 10, 'Giày chạy bộ cao cấp nhất của Asics, siêu êm.', 18),
('New Balance 574 Grey', 3, 4, 2300000, 5, 'Dòng sneaker casual cổ điển, màu xám iconic.', 28),
('Reebok Nano X3', 4, 8, 3200000, 0, 'Giày tập gym đa năng dành cho việc nâng tạ và cardio.', 22);


INSERT INTO product_images (product_id, image_url, is_main) VALUES
-- Nike Air Force 1 White
(1, 'https://static.nike.com/a/images/t_web_pdp_936_v2/f_auto/b7d9211c-26e7-431a-ac24-b0540fb3c00f/AIR+FORCE+1+%2707.png', TRUE),
(1, 'https://sneakerholicvietnam.vn/wp-content/uploads/2021/07/nike-air-force-1-low-white-315115-112-2.jpg', FALSE),
(1, 'https://authentic-shoes.com/wp-content/uploads/2023/05/Screenshot_2023.08.16_13.12.15.003.png', FALSE),

-- Adidas Ultraboost 22
(2, 'https://bizweb.dktcdn.net/thumb/large/100/413/756/products/ultraboost-22-shoes-black-gx9783-1671959897384.jpg?v=1675314269240', TRUE),
(2, 'https://cdn-images.farfetch-contents.com/19/41/92/92/19419292_42685107_1000.jpg', FALSE),

-- Puma Training Fuse 2
(3, 'https://www.gearpatrol.com/wp-content/uploads/sites/2/2022/10/1666363453-puma-fuse-2-0-embed-1666363443-jpg.webp', TRUE),

-- Nike Kyrie Flytrap 6
(4, 'https://sneakerdaily.vn/wp-content/uploads/2023/09/giay-nike-kyrie-flytrap-6-ep-black-white-dm1126-001.jpg', TRUE),
(4, 'https://pos.nvncdn.com/80cfbf-41716/ps/20221125_xmiYGePwuSCGE74JPiWbX7Dv.jpg?v=1673515210', FALSE),

-- Adidas Predator Freak .3
(5, 'https://product.hstatic.net/1000061481/product/4da7c5eeeacc411d9b7b0b5c8f948206_08a0733132fb40d290330804d0bdec80_1024x1024.jpg', TRUE),

-- Vans Old Skool Black White
(6, 'https://bizweb.dktcdn.net/100/140/774/products/vans-old-skool-black-white-vn000d3hy28-2.jpg?v=1625905148527', TRUE),
(6, 'https://bizweb.dktcdn.net/100/140/774/files/giay-vans-skate-old-skool-black-white-vn0a5fcby28-2.jpg?v=1691834912747', FALSE),

-- Converse Chuck Taylor 70s High
(7, 'https://www.converse.vn/media/catalog/product/0/8/0882-CON162050C000005-1.jpg', TRUE),

-- Asics Gel Nimbus 25
(8, 'https://vietstore365.vn/uploads/f_648049e312c9b5be592031e8/609781ca3bf8556d62b5927d9.png', TRUE),
(8, 'https://vietstore365.vn/uploads/f_648049e312c9b5be592031e8/81828cc32aa46e7d5d30637d7.jpg', FALSE),

-- New Balance 574 Grey
(9, 'https://saigonsneaker.com/wp-content/uploads/2020/12/574-3.jpg', TRUE),

-- Reebok Nano X3
(10, 'https://cdn-images.farfetch-contents.com/21/31/59/10/21315910_51202685_600.jpg', TRUE),
(10, 'https://images-na.ssl-images-amazon.com/images/I/717xN7y3PfL.jpg', FALSE);
