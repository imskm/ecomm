SET FOREIGN_KEY_CHECKS=0;


INSERT INTO product_categories (category) VALUES
('Kurti');

INSERT INTO materials (material) VALUES
('Cotton');

INSERT INTO sizes (size) VALUES
('S'),
('M');

INSERT INTO users(first_name, last_name, gender, email, password, photo, verified_at, role) VALUES
('Test', 'Test', 1, 'user@ecomm.com', '$2y$10$m10VlTg6o2yYt3SRW92AZOJBIoPNmAWP2/x7nuzt17rgqVhWWzMbW', 'avatar-male.jpg', '2020-09-26 00:00:01', 2);

INSERT INTO coupons(coupon, value) VALUES
('DECOFF15', 15);

SET FOREIGN_KEY_CHECKS=1;