-- Buat database jika belum ada
CREATE DATABASE IF NOT EXISTS coffee_shop_db;
USE coffee_shop_db;

-- Buat tabel menus
CREATE TABLE IF NOT EXISTS menus (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    price INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Masukkan beberapa data contoh
INSERT INTO menus (name, category, price) VALUES 
('Caffe Latte', 'Coffee', 25000),
('Matcha Latte', 'Non-Coffee', 28000),
('Americano', 'Coffee', 20000),
('French Fries', 'Snack', 15000);
