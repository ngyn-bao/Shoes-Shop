USE shoes_shop;

-- User (Test) --

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    full_name VARCHAR(255) NOT NULL
);

-- About (Test) --

CREATE TABLE site_content (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page VARCHAR(50),
    title VARCHAR(255),
    content TEXT
);

INSERT INTO site_content (page, title, content)
VALUES ('about', 'Giới thiệu', 'Nội dung trang giới thiệu');

-- FAQ --

CREATE TABLE faq_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE faq (
    faq_id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    question TEXT NOT NULL,
    answer TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (category_id) REFERENCES faq_categories(id)
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

INSERT INTO users (email, full_name) VALUES
('an.nguyen@gmail.com', 'Nguyễn Văn An'),
('binh.tran@gmail.com', 'Trần Thị Bình'),
('cuong.le@gmail.com', 'Lê Quốc Cường');

INSERT INTO faq_categories (name) VALUES
('Đặt hàng & Thanh toán'),
('Vận chuyển & Giao hàng'),
('Đổi trả & Bảo hành'),
('Size & Chọn giày');

INSERT INTO faq (category_id, question, answer) VALUES
(1, 'Tôi có thể thanh toán bằng hình thức nào?', 'Bạn có thể thanh toán bằng COD, chuyển khoản hoặc ví điện tử.'),
(1, 'Thanh toán có an toàn không?', 'Chúng tôi sử dụng cổng thanh toán bảo mật SSL 100%.'),

(2, 'Thời gian giao hàng mất bao lâu?', 'Thời gian giao hàng từ 2-5 ngày tùy khu vực.'),
(2, 'Tôi có được kiểm tra hàng trước khi thanh toán không?', 'Bạn được kiểm tra hàng trước khi thanh toán cho shipper.'),

(3, 'Tôi có thể đổi trả trong bao lâu?', 'Bạn có thể đổi trả trong vòng 7 ngày kể từ ngày nhận hàng.'),
(3, 'Sản phẩm bị lỗi thì xử lý thế nào?', 'Chúng tôi sẽ đổi mới 100% nếu lỗi do nhà sản xuất.'),

(4, 'Làm sao chọn đúng size giày?', 'Bạn có thể đo chiều dài bàn chân và đối chiếu bảng size.'),
(4, 'Size giày có chuẩn form không?', 'Size giày chuẩn form Việt Nam.');

INSERT INTO faq_questions (user_id, category_id, question) VALUES
(1, 1, 'Shop có hỗ trợ trả góp không?'),
(2, 2, 'Giao hàng về tỉnh mất mấy ngày?'),
(3, 3, 'Giày mang 1 lần có được đổi không?'),
(1, 4, 'Chân bè có mang được mấy mẫu này không?');
