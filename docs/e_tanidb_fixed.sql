-- ============================================================
-- e_tanidb_fixed.sql
-- Versi perbaikan dari e_tanidb_fix.sql
-- ============================================================

CREATE DATABASE IF NOT EXISTS e_tanidb;
USE e_tanidb;

-- 1. Table: user
CREATE TABLE `user` (
    `id_user` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name_user` VARCHAR(100) NOT NULL,
    `email_user` VARCHAR(150) NOT NULL,
    `role` ENUM('farmer', 'customer', 'admin') NOT NULL,
    `is_active` BOOLEAN NULL DEFAULT 1,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP(),
    `login_with` ENUM('email', 'google', 'facebook') NOT NULL,
    `password_hash` VARCHAR(255) NOT NULL
);
ALTER TABLE `user` ADD UNIQUE `user_email_user_unique` (`email_user`);

-- 2. Table: admin
CREATE TABLE `admin` (
    `id_admin` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_user` INT NOT NULL,
    `permission_level` ENUM('superadmin', 'staff') NOT NULL
);
ALTER TABLE `admin` ADD UNIQUE `admin_id_user_unique` (`id_user`);
ALTER TABLE `admin` ADD CONSTRAINT `admin_id_user_foreign`
    FOREIGN KEY (`id_user`) REFERENCES `user`(`id_user`) ON DELETE CASCADE;

-- 3. Table: customer
CREATE TABLE `customer` (
    `id_customer` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_user` INT NOT NULL,
    `address` VARCHAR(255) NULL,
    `phone` VARCHAR(20) NULL,
    `profile_photo` VARCHAR(255) NULL
);
ALTER TABLE `customer` ADD UNIQUE `customer_id_user_unique` (`id_user`);
ALTER TABLE `customer` ADD CONSTRAINT `customer_id_user_foreign`
    FOREIGN KEY (`id_user`) REFERENCES `user`(`id_user`) ON DELETE CASCADE;

-- 4. Table: farmer
CREATE TABLE `farmer` (
    `id_farmer` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_user` INT NOT NULL,
    `farm_name` VARCHAR(150) NULL,
    `location` VARCHAR(255) NULL,
    `address` VARCHAR(255) NULL,
    `whatsapp_number` VARCHAR(20) NULL
);
ALTER TABLE `farmer` ADD UNIQUE `farmer_id_user_unique` (`id_user`);
ALTER TABLE `farmer` ADD CONSTRAINT `farmer_id_user_foreign`
    FOREIGN KEY (`id_user`) REFERENCES `user`(`id_user`) ON DELETE CASCADE;

-- 5. Table: farm
CREATE TABLE `farm` (
    `id_farm` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_farmer` INT NOT NULL,
    `name_farm` VARCHAR(100) NULL,
    `location` VARCHAR(255) NULL,
    `photo_farm` VARCHAR(255) NULL
);
ALTER TABLE `farm` ADD CONSTRAINT `farm_id_farmer_foreign`
    FOREIGN KEY (`id_farmer`) REFERENCES `farmer`(`id_farmer`) ON DELETE CASCADE;

-- 6. Table: category
CREATE TABLE `category` (
    `id_category` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name_category` VARCHAR(100) NOT NULL,
    `description` TEXT NULL
);

-- 7. Table: product
CREATE TABLE `product` (
    `id_product` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_farm` INT NOT NULL,
    `id_category` INT NOT NULL,
    `product_image` VARCHAR(255) NULL,
    `product_name` VARCHAR(150) NOT NULL,
    `price_per_kg` DECIMAL(10, 2) NOT NULL,
    `stock_qty` DECIMAL(10, 2) NOT NULL,
    `harvest_date` DATE NULL,
    `description` TEXT NULL,
    `is_available` BOOLEAN NULL DEFAULT 1,
    `type_product` VARCHAR(50) NULL,
    `rating` DECIMAL(2, 1) NULL
);
ALTER TABLE `product` ADD CONSTRAINT `product_id_farm_foreign`
    FOREIGN KEY (`id_farm`) REFERENCES `farm`(`id_farm`) ON DELETE CASCADE;
ALTER TABLE `product` ADD CONSTRAINT `product_id_category_foreign`
    FOREIGN KEY (`id_category`) REFERENCES `category`(`id_category`) ON DELETE RESTRICT;

-- 8. Table: cart
CREATE TABLE `cart` (
    `id_cart` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_customer` INT NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP(),
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP()
);
ALTER TABLE `cart` ADD UNIQUE `cart_id_customer_unique` (`id_customer`);
ALTER TABLE `cart` ADD CONSTRAINT `cart_id_customer_foreign`
    FOREIGN KEY (`id_customer`) REFERENCES `customer`(`id_customer`) ON DELETE CASCADE;

-- 9. Table: cart_item
CREATE TABLE `cart_item` (
    `id_cart_item` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_cart` INT NOT NULL,
    `id_product` INT NOT NULL,
    `qty` DECIMAL(10, 2) NOT NULL DEFAULT 1
);
ALTER TABLE `cart_item` ADD UNIQUE `cart_item_id_cart_id_product_unique` (`id_cart`, `id_product`);
ALTER TABLE `cart_item` ADD CONSTRAINT `cart_item_id_cart_foreign`
    FOREIGN KEY (`id_cart`) REFERENCES `cart`(`id_cart`) ON DELETE CASCADE;
ALTER TABLE `cart_item` ADD CONSTRAINT `cart_item_id_product_foreign`
    FOREIGN KEY (`id_product`) REFERENCES `product`(`id_product`) ON DELETE CASCADE;

-- 10. Table: order
CREATE TABLE `order` (
    `id_order` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_customer` INT NOT NULL,
    `order_number` INT UNSIGNED NULL,
    `order_date` DATE NOT NULL,
    `total_amount` DECIMAL(12, 2) NOT NULL,
    `status` ENUM('pending', 'paid', 'shipped', 'completed', 'cancelled') NULL DEFAULT 'pending',
    `delivery_address` VARCHAR(255) NOT NULL,
    `notes` TEXT NULL,
    `cancelled_at` TIMESTAMP NULL
);
ALTER TABLE `order` ADD CONSTRAINT `order_id_customer_foreign`
    FOREIGN KEY (`id_customer`) REFERENCES `customer`(`id_customer`) ON DELETE RESTRICT;

-- 11. Table: order_item
CREATE TABLE `order_item` (
    `id_order_item` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_order` INT NOT NULL,
    `id_product` INT NOT NULL,
    `qty` DECIMAL(10, 2) NOT NULL,
    `price` DECIMAL(10, 2) NOT NULL,
    `subtotal` DECIMAL(12, 2) NOT NULL
);
ALTER TABLE `order_item` ADD CONSTRAINT `order_item_id_order_foreign`
    FOREIGN KEY (`id_order`) REFERENCES `order`(`id_order`) ON DELETE CASCADE;
ALTER TABLE `order_item` ADD CONSTRAINT `order_item_id_product_foreign`
    FOREIGN KEY (`id_product`) REFERENCES `product`(`id_product`) ON DELETE RESTRICT;

-- 12. Table: payment
CREATE TABLE `payment` (
    `id_payment` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_order` INT NOT NULL,
    `payment_proof` VARCHAR(255) NULL,
    `status` ENUM('pending', 'verified', 'rejected') NULL DEFAULT 'pending'
);
ALTER TABLE `payment` ADD CONSTRAINT `payment_id_order_foreign`
    FOREIGN KEY (`id_order`) REFERENCES `order`(`id_order`) ON DELETE CASCADE;

-- 13. Table: notification
CREATE TABLE `notification` (
    `id_notif` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_user` INT NOT NULL,
    `message` TEXT NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP()
);
ALTER TABLE `notification` ADD CONSTRAINT `notification_id_user_foreign`
    FOREIGN KEY (`id_user`) REFERENCES `user`(`id_user`) ON DELETE CASCADE;

-- 14. Table: bookmark
CREATE TABLE `bookmark` (
    `id_bookmark` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_customer` INT NOT NULL,
    `id_farm` INT NOT NULL
);
ALTER TABLE `bookmark` ADD CONSTRAINT `bookmark_id_customer_foreign`
    FOREIGN KEY (`id_customer`) REFERENCES `customer`(`id_customer`) ON DELETE CASCADE;
ALTER TABLE `bookmark` ADD CONSTRAINT `bookmark_id_farm_foreign`
    FOREIGN KEY (`id_farm`) REFERENCES `farm`(`id_farm`) ON DELETE CASCADE;
