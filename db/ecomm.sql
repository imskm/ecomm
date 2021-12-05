SET FOREIGN_KEY_CHECKS=0;

--
-- addresses table
--
DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	title VARCHAR(64) NOT NULL,
	full_name VARCHAR(64) NOT NULL,
	phone VARCHAR(12) NOT NULL,
	address_line_1 VARCHAR(128) NOT NULL,
	town_id INT UNSIGNED NOT NULL,
	user_id INT UNSIGNED NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

	PRIMARY KEY(id),
	FOREIGN KEY(town_id) REFERENCES towns(id),
	FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- users table
--
-- Role = 1 --> admin
-- Role = 2 --> user
-- Role = 3 --> NOT USED
-- token = Email Varification token
--
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	first_name VARCHAR(32) NOT NULL,
	last_name VARCHAR(32) NOT NULL,
	gender TINYINT(1) NOT NULL,
	address_id INT UNSIGNED,
	phone VARCHAR(12),
	email VARCHAR(64) UNIQUE NOT NULL,
	password VARCHAR(255) NOT NULL,
	is_blocked TINYINT DEFAULT 0,
	photo VARCHAR(255),
	token VARCHAR(256) DEFAULT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	verified_at TIMESTAMP NULL DEFAULT NULL,

	role TINYINT NOT NULL,

	INDEX(first_name, last_name),
	INDEX(phone),
	INDEX(email),
	INDEX(token),

	PRIMARY KEY(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

-- 
-- password_resets table
--
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	token VARCHAR(256) NOT NULL,
	user_id INT UNSIGNED UNIQUE NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

	INDEX(token),
	INDEX(user_id),

	PRIMARY KEY(id),
	FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- products table
-- price is in paise (Re. 1 = 100 Pe.)
-- is_returnable => 0 = non-returnable, 1 = returnable
--
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	code VARCHAR(16) NOT NULL UNIQUE,
	title VARCHAR(256) NOT NULL,
	description VARCHAR(512),
	price_mp INT UNSIGNED NOT NULL DEFAULT 0,
	price_sp INT UNSIGNED NOT NULL DEFAULT 0,
	category_id INT UNSIGNED NOT NULL,
	material_id INT UNSIGNED NOT NULL,
	is_returnable TINYINT(1) DEFAULT 0,

	INDEX(code),
	INDEX(category_id),
	INDEX(title, description),

	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	deleted_at DATETIME DEFAULT NULL,

	PRIMARY KEY (id),
	FOREIGN KEY(category_id) REFERENCES product_categories(id),
	FOREIGN KEY(material_id) REFERENCES materials(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- product_categories table
--
DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE `product_categories` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	category VARCHAR(64) NOT NULL,

	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	deleted_at DATETIME DEFAULT NULL,

	PRIMARY KEY (id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- product_images table
-- image = filename of the image
-- is_default = 1 means product image is default product image
--
DROP TABLE IF EXISTS `product_images`;
CREATE TABLE `product_images` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	product_id INT UNSIGNED NOT NULL,
	color_id INT UNSIGNED NOT NULL,
	image VARCHAR(64) NOT NULL,
	is_default TINYINT(1) DEFAULT 1,

	INDEX(product_id),

	PRIMARY KEY (id),
	FOREIGN KEY (product_id) REFERENCES products(id),
	FOREIGN KEY (color_id) REFERENCES colors(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- colors table
-- stores all colors the brand produces products in
--
DROP TABLE IF EXISTS `colors`;
CREATE TABLE `colors` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	color VARCHAR(64),
	code CHAR(6) NOT NULL,

	PRIMARY KEY (id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- sizes table
-- stores all sizes of the brand products
--
DROP TABLE IF EXISTS `sizes`;
CREATE TABLE `sizes` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`size` VARCHAR(10),

	PRIMARY KEY (id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- materials table
--
DROP TABLE IF EXISTS `materials`;
CREATE TABLE `materials` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`material` VARCHAR(16),

	PRIMARY KEY (id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- product_available_colors table
--
DROP TABLE IF EXISTS `product_available_colors`;
CREATE TABLE `product_available_colors` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	product_id INT UNSIGNED NOT NULL,
	color_id INT UNSIGNED NOT NULL,

	INDEX(product_id),
	INDEX(color_id),

	PRIMARY KEY (id),
	FOREIGN KEY(product_id) REFERENCES products(id),
	FOREIGN KEY(color_id) REFERENCES colors(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- product_available_sizes table
--
DROP TABLE IF EXISTS `product_available_sizes`;
CREATE TABLE `product_available_sizes` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	product_id INT UNSIGNED NOT NULL,
	size_id INT UNSIGNED NOT NULL,

	INDEX(product_id),
	INDEX(product_id, size_id),

	PRIMARY KEY (id),
	FOREIGN KEY(product_id) REFERENCES products(id),
	FOREIGN KEY(size_id) REFERENCES sizes(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- product_stocks table
--
DROP TABLE IF EXISTS `product_stocks`;
CREATE TABLE `product_stocks` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	product_id INT UNSIGNED NOT NULL,
	size_id INT UNSIGNED NOT NULL,
	stock INT UNSIGNED DEFAULT 0,

	INDEX(product_id),
	INDEX(size_id),

	PRIMARY KEY (id),
	FOREIGN KEY(product_id) REFERENCES products(id),
	FOREIGN KEY(size_id) REFERENCES sizes(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- product_reviews table
--
DROP TABLE IF EXISTS `product_reviews`;
CREATE TABLE `product_reviews` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	rate INT NOT NULL,
	review VARCHAR(1024),
	product_id INT UNSIGNED NOT NULL,
	user_id INT UNSIGNED NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

	INDEX(product_id),
	INDEX(user_id),

	PRIMARY KEY(id),
	FOREIGN KEY(product_id) REFERENCES products(id),
	FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- coupons table
--
DROP TABLE IF EXISTS `coupons`;
CREATE TABLE `coupons` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	coupon VARCHAR(16),
	value INT UNSIGNED NOT NULL,
	is_active TINYINT(1) DEFAULT 0,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

	PRIMARY KEY(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- applied_coupons table
--
DROP TABLE IF EXISTS `applied_coupons`;
CREATE TABLE `applied_coupons` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	coupon_id INT UNSIGNED NOT NULL,
	order_id INT UNSIGNED NOT NULL,
	user_id INT UNSIGNED NOT NULL,

	INDEX(user_id),
	INDEX(order_id),

	PRIMARY KEY(id),
	FOREIGN KEY(user_id) REFERENCES users(id),
	FOREIGN KEY(order_id) REFERENCES orders(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- storages table
-- a storage place where application can dump contnet with key as indentifier
-- multiple storage can be handled
--
DROP TABLE IF EXISTS `storages`;
CREATE TABLE `storages` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	storage VARCHAR(64) NOT NULL UNIQUE, 

	PRIMARY KEY(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- store_items table
-- place for each storage to store items in the storage
-- multiple storage can be handled
--
DROP TABLE IF EXISTS `store_items`;
CREATE TABLE `store_items` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`storage_id` INT UNSIGNED NOT NULL,
	`skey` VARCHAR(64) NOT NULL,
	`value` VARCHAR(8192),

	INDEX(storage_id, `skey`),
	UNIQUE KEY(`storage_id`, `skey`),

	PRIMARY KEY(id),
	FOREIGN KEY (storage_id) REFERENCES storages(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- orders table
-- order_hash is for razory pay receipt id
-- status = 0 = created, 1 = success, 2 = failed, 3 = processed
--
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	amount INT UNSIGNED NOT NULL,
	tax INT UNSIGNED DEFAULT 0,
	rzp_order_id VARCHAR(64),
	status INT DEFAULT 0,
	user_id INT UNSIGNED NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

	INDEX(rzp_order_id),
	INDEX(created_at),
	INDEX(status),
	INDEX(user_id),

	PRIMARY KEY(id),
	FOREIGN KEY (user_id) REFERENCES users(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- order_items table
-- status: 1 = created, 2 = cancellation requested, 4 = cancelled, 8 = shipped
--         16 = delivered, 32 = return requested, 64 = returned
--         128 = refund requested, 256 = refunded, 512 = finished processing
-- flags: contains all the state an order_item went through
--
DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	order_id INT UNSIGNED NOT NULL,
	product_id INT UNSIGNED NOT NULL,
	user_id INT UNSIGNED NOT NULL,
	qty INT NOT NULL,
	color_id INT UNSIGNED NOT NULL,
	size_id INT UNSIGNED NOT NULL,
	price_mp INT NOT NULL,
	price_sp INT NOT NULL,
	status SMALLINT UNSIGNED DEFAULT 0,
	flags SMALLINT UNSIGNED DEFAULT 0,
	shipped_at DATETIME DEFAULT NULL,
	delivered_at DATETIME DEFAULT NULL,
	cancellation_requested_at DATETIME DEFAULT NULL,
	cancelled_at DATETIME DEFAULT NULL,
	return_requested_at DATETIME DEFAULT NULL,
	returned_at DATETIME DEFAULT NULL,
	refund_requested_at DATETIME DEFAULT NULL,
	refunded_at DATETIME DEFAULT NULL,

	INDEX(order_id),
	INDEX(product_id),
	INDEX(user_id),
	INDEX(status),

	PRIMARY KEY(id),
	FOREIGN KEY (order_id) REFERENCES orders(id),
	FOREIGN KEY (product_id) REFERENCES products(id),
	FOREIGN KEY (color_id) REFERENCES colors(id),
	FOREIGN KEY (user_id) REFERENCES users(id),
	FOREIGN KEY (size_id) REFERENCES sizes(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;



--
-- payments table
-- status = 1 = success, 2 = failure
--
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	order_id INT UNSIGNED NOT NULL,
	rzp_payment_id VARCHAR(64),
	rzp_signature VARCHAR(256),
	status INT DEFAULT 0,
	user_id INT UNSIGNED NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

	INDEX(order_id),
	INDEX(rzp_payment_id),
	INDEX(user_id),

	PRIMARY KEY(id),
	FOREIGN KEY (order_id) REFERENCES orders(id),
	FOREIGN KEY (user_id) REFERENCES users(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- refunds table
-- amount in Indian paise
--
DROP TABLE IF EXISTS `refunds`;
CREATE TABLE `refunds` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id INT UNSIGNED NOT NULL,
	order_id INT UNSIGNED NOT NULL,
	order_item_id INT UNSIGNED NOT NULL,
	payment_id INT UNSIGNED NOT NULL,
	amount INT NULL NULL,
	rzp_refund_id VARCHAR(256) NOT NULL,
	rzp_status VARCHAR(32) NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

	INDEX(order_id),
	INDEX(order_item_id),
	INDEX(user_id),
	INDEX(rzp_refund_id),
	INDEX(created_at),

	PRIMARY KEY(id),
	FOREIGN KEY (order_id) REFERENCES orders(id),
	FOREIGN KEY (order_item_id) REFERENCES order_items(id),
	FOREIGN KEY (payment_id) REFERENCES payments(id),
	FOREIGN KEY (user_id) REFERENCES users(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- shippings table
-- method INT NOT NULL,
-- method: 1 = Ground, 2 = Air, 3 = Water
-- state: 0 = init, 1 = shipped, 2 = delivered, 3 = recepient not found
--        4 = returned
--
DROP TABLE IF EXISTS `shippings`;
CREATE TABLE `shippings` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	charge INT DEFAULT 0,
	state INT DEFAULT 0,
	ship_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	order_id INT UNSIGNED NOT NULL,
	address_id INT UNSIGNED NOT NULL,
	user_id INT UNSIGNED NOT NULL,

	INDEX(state),
	INDEX(ship_date),
	INDEX(order_id),
	INDEX(user_id),

	PRIMARY KEY(id),
	FOREIGN KEY (order_id) REFERENCES orders(id),
	FOREIGN KEY (address_id) REFERENCES addresses(id),
	FOREIGN KEY (user_id) REFERENCES users(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- transactions table
-- type 1 = dr, 2 = cr
-- in the book of customer
--
DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id INT UNSIGNED NOT NULL,
	narration VARCHAR(250),
	type TINYINT(1) NOT NULL,
	amount DOUBLE(10, 2) NOT NULL DEFAULT 0,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

	INDEX(created_at),
	INDEX(type),
	INDEX(user_id),

	PRIMARY KEY(id),
	FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- carts table
--
DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id INT UNSIGNED NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

	INDEX(user_id),

	PRIMARY KEY(id),
	FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;

--
-- cart_items table
--
DROP TABLE IF EXISTS `cart_items`;
CREATE TABLE `cart_items` (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	qty INT NOT NULL,
	cart_id INT UNSIGNED NOT NULL,
	product_id INT UNSIGNED NOT NULL,
	size_id INT UNSIGNED NOT NULL,
	color_id INT UNSIGNED NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

	INDEX(cart_id),

	PRIMARY KEY(id),
	FOREIGN KEY(cart_id) REFERENCES carts(id),
	FOREIGN KEY(product_id) REFERENCES products(id),
	FOREIGN KEY(size_id) REFERENCES sizes(id),
	FOREIGN KEY(color_id) REFERENCES colors(id)
)ENGINE=InnoDB CHARACTER SET=utf8mb4;


--
-- users table data
--
INSERT INTO users(first_name, last_name, gender, email, password, photo, verified_at, role) VALUES
('Admin', 'User', 1, 'admin@ecomm.com', '$2y$10$m10VlTg6o2yYt3SRW92AZOJBIoPNmAWP2/x7nuzt17rgqVhWWzMbW', 'avatar-male.jpg', '2020-06-01 00:00:01', 1);


SET FOREIGN_KEY_CHECKS=1;
