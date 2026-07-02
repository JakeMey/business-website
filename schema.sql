-- Create database
CREATE DATABASE IF NOT EXISTS business_db;
USE business_db;

-- Create customer requests table
CREATE TABLE IF NOT EXISTS customer_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(30),
    service VARCHAR(100),
    request VARCHAR(1000),
    status ENUM('new', 'in_progress', 'completed') DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create admin users table (to manage requests)
CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert a default admin (password: password - CHANGE THIS!)
INSERT INTO admin_users (username, password_hash) 
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Sample requests for testing
INSERT INTO customer_requests (name, email, phone, service, request, status) VALUES
('John Doe', 'john@example.com', '555-0101', 'Consulting', 'Need business strategy consultation', 'completed'),
('Jane Smith', 'jane@example.com', '555-0102', 'Development', 'Looking for web development services', 'in_progress');