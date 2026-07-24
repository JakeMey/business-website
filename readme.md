# 🏢 Business Website

A fully dynamic business website with customer request management system built with PHP, MySQL, and Bootstrap 5.

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)

---

## 📋 Table of Contents

- [Features](#-features)
- [Technologies Used](#-technologies-used)
- [Installation](#-installation)
- [Database Setup](#-database-setup)
- [Configuration](#-configuration)
- [Usage](#-usage)
- [Admin Dashboard](#-admin-dashboard)
- [Project Structure](#-project-structure)
- [Security](#-security)
- [Future Enhancements](#-future-enhancements)
- [Contributing](#-contributing)
- [License](#-license)

---

## ✨ Features

### Frontend Features

- **🏠 Homepage** - Professional hero section with animated statistics counters
- **ℹ️ About Page** - Company information, mission, values, and contact details
- **🛠️ Services Page** - Display of all business services with call-to-action buttons
- **📝 Customer Request Form** - Submit inquiries with validation and success messages
- **📊 Animated Statistics** - Scroll-triggered number counters for engagement
- **📱 Fully Responsive** - Works on desktop, tablet, and mobile devices
- **🎨 Modern UI/UX** - Professional design with gradients, shadows, and animations

### Backend Features

- **🔐 Admin Authentication** - Secure login system for managing customer requests
- **📋 Request Management** - View, track, and manage customer submissions
- **📊 Dashboard Analytics** - Summary statistics (total, new, in-progress, completed)
- **🔍 Request Filtering** - Sort and view requests by status
- **📧 Customer Data Storage** - Secure storage of name, email, phone, service type, and request details
- **⏰ Timezone Support** - Configured for Australian/Melbourne timezone
- **🛡️ SQL Injection Protection** - All database queries are sanitized

### User Experience

- **⚡ Fast Loading** - Optimised for quick page loads
- **🎯 Intuitive Navigation** - Clear menu structure
- **✅ Form Validation** - Client-side and server-side validation
- **🔔 User Feedback** - Success/error messages for actions
- **📱 Mobile-First Design** - Optimized for all screen sizes

---

## 🛠️ Technologies Used

| Technology | Purpose |
|------------|---------|
| **PHP 7.4+** | Backend logic and server-side processing |
| **MySQL 5.7+** | Database for storing customer requests and admin users |
| **Bootstrap 5** | Frontend framework for responsive design |
| **Font Awesome 6** | Icon library for visual elements |
| **HTML5** | Website structure |
| **CSS3** | Custom styling and animations |
| **JavaScript** | Interactive elements (counter animations, form validation) |
| **XAMPP** | Local development environment |

---

## 📥 Installation

### Prerequisites

- [XAMPP](https://www.apachefriends.org/) (or any PHP/MySQL environment)
- [Git](https://git-scm.com/) (for cloning the repository)
- Web browser (Chrome, Firefox, Edge, etc.)

### Step 1: Clone the Repository

```bash
git clone https://github.com/YOUR-USERNAME/business-website.git
```

### Step 2: Move to htdocs

```bash
# For Windows
mv business-website C:\xampp\htdocs\

# For Mac/Linux
mv business-website /Applications/XAMPP/htdocs/
```

### Step 3: Start XAMPP

1. Open XAMPP Control Panel
2. Start **Apache** (Web Server)
3. Start **MySQL** (Database)

### Step 4: Set Up Database

1. Open browser and go to: `http://localhost/phpmyadmin`
2. Click **"New"** in the left sidebar
3. Create database: `business_db`
4. Click **"Import"** tab
5. Choose `schema.sql` from the project folder
6. Click **"Go"**

### Step 5: Configure the Website

```bash
# Copy the example configuration
cp config.example.php config.php

# Edit config.php with your database credentials
# Open config.php in your editor and update:
# - DB_HOST: localhost (default)
# - DB_USER: root (default XAMPP)
# - DB_PASS: '' (empty for XAMPP)
# - DB_NAME: business_db
```

### Step 6: Access the Website

Open your browser and go to:
```
http://localhost/business-website/
```

---

## 🗄️ Database Setup

### Database Schema

The database consists of two tables:

#### 1. `customer_requests` - Stores customer inquiries

| Column | Type | Description |
|--------|------|-------------|
| `id` | INT | Primary key, auto-increment |
| `name` | VARCHAR(100) | Customer's full name |
| `email` | VARCHAR(100) | Customer's email address |
| `phone` | VARCHAR(20) | Customer's phone number |
| `service` | VARCHAR(100) | Service type requested |
| `request` | VARCHAR(1000) | Detailed request description |
| `status` | ENUM('new','in_progress','completed') | Request status |
| `created_at` | TIMESTAMP | Submission timestamp |
| `updated_at` | TIMESTAMP | Last update timestamp |

#### 2. `admin_users` - Stores admin credentials

| Column | Type | Description |
|--------|------|-------------|
| `id` | INT | Primary key, auto-increment |
| `username` | VARCHAR(50) | Admin username (unique) |
| `password_hash` | VARCHAR(255) | Hashed password |
| `created_at` | TIMESTAMP | Account creation timestamp |

### Import Database

```sql
-- Run this in phpMyAdmin SQL tab to create tables
CREATE DATABASE IF NOT EXISTS business_db;
USE business_db;

-- Create customer_requests table
CREATE TABLE IF NOT EXISTS customer_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    service VARCHAR(100),
    request VARCHAR(1000),
    status ENUM('new', 'in_progress', 'completed') DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create admin_users table
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

```

---

## ⚙️ Configuration

### Database Configuration (`config.php`)

```php
<?php
// Database credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'business_db');

// Site configuration
define('SITE_NAME', 'My Business');
define('SITE_EMAIL', 'info@mybusiness.com');
define('SITE_PHONE', '(555) 123-4567');
define('SITE_URL', 'http://localhost/business-website');

// Timezone (Australian/Melbourne)
date_default_timezone_set('Australia/Melbourne');
?>
```

### Security Note

**⚠️ IMPORTANT:** Never commit `config.php` to GitHub! The `.gitignore` file already excludes it.

---

## 🚀 Usage

### Website Pages

| Page | URL | Description |
|------|-----|-------------|
| Home | `/index.php` | Landing page with hero section and features |
| About | `/about.php` | Company information and values |
| Services | `/services.php` | List of business services |
| Contact | `/request.php` | Customer request form |
| Admin | `/view_requests.php` | Admin login and dashboard |

### Submitting a Customer Request

1. Navigate to the Contact page
2. Fill in the form with:
   - Full Name (required)
   - Email Address (required)
   - Phone Number (optional)
   - Service Type (select from dropdown)
   - Request Details (required)
3. Click **"Submit Request"**
4. You'll see a success confirmation message

### Admin Dashboard Access

1. Go to: `http://localhost/business-website/view_requests.php`
2. Login with credentials:
   - **Username:** `admin`
   - **Password:** `admin123`
3. After login, you'll see:
   - **Statistics Dashboard** - Overview of all requests
   - **Request Table** - List of all customer submissions
   - **Status Badges** - Visual indicators for request status

### Changing Admin Password

1. Login to phpMyAdmin
2. Navigate to `business_db` → `admin_users` table
3. Edit the admin user
4. Generate a new password hash:
   ```php
   <?php echo password_hash('your_new_password', PASSWORD_DEFAULT); ?>
   ```
5. Update the `password_hash` field with the new hash

---

## 🔐 Admin Dashboard

### Features

- **📊 Summary Stats**: Quick overview of request counts by status
- **📋 Request Table**: All submissions displayed with sorting
- **🎨 Status Labels**: Color-coded badges for easy identification
- **🔍 Easy Monitoring**: Track all customer inquiries in one place

### Dashboard Statistics

| Stat | Description |
|------|-------------|
| **Total Requests** | All submissions |
| **New** | Unread/unprocessed requests |
| **In Progress** | Active requests being worked on |
| **Completed** | Finished requests |

---

## 📁 Project Structure

```
business-website/
├── .gitignore              # Git ignore rules
├── README.md               # Project documentation
├── schema.sql              # Database structure
├── config.example.php      # Configuration template
├── config.php              # Configuration (NOT in Git)
├── index.php               # Homepage
├── about.php               # About page
├── services.php            # Services page
├── request.php             # Customer request form
├── view_requests.php       # Admin dashboard
├── style.css               # Custom styles
├── script.js               # JavaScript functionality
├── includes/
│   ├── navbar.php          # Navigation bar
│   └── footer.php          # Footer section
└── assets/
    └── (images, etc.)
```

---

## 🔒 Security

### Security Features

- ✅ **SQL Injection Prevention** - Uses `mysqli_real_escape_string()`
- ✅ **Password Hashing** - Uses PHP's `password_hash()` and `password_verify()`
- ✅ **Session Management** - Secure session handling for admin
- ✅ **Input Validation** - Client-side and server-side validation
- ✅ **File Protection** - `.gitignore` prevents sensitive file exposure
- ✅ **Error Handling** - Proper error messages without exposing system details

### Recommended Security Practices

1. Change default admin password immediately
2. Use strong passwords (12+ characters)
3. Keep PHP and MySQL updated
4. Regular database backups
5. Use HTTPS in production
6. Monitor admin access logs

---

## 🚀 Future Enhancements

- [ ] Email notifications for new requests
- [ ] Request status update functionality
- [ ] User registration system
- [ ] Request filtering and search
- [ ] Export requests to CSV/PDF
- [ ] Two-factor authentication for admin
- [ ] File uploads for customer requests
- [ ] Request assignment to team members
- [ ] Activity logging
- [ ] Automated response emails
- [ ] Admin user management
- [ ] Request priority levels

---

## 🤝 Contributing

Contributions are welcome! Here's how:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📄 License

This project is licensed under the MIT License - see below for details:

```
MIT License

Copyright (c) 2026 JakeMey

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

---

## 📞 Support

For support, please:
1. Contact me

---

## 🙏 Acknowledgements

- [Bootstrap](https://getbootstrap.com/) - Frontend framework
- [Font Awesome](https://fontawesome.com/) - Icons
- [Google Fonts](https://fonts.google.com/) - Inter font family
- [XAMPP](https://www.apachefriends.org/) - Local development environment

---

**⭐ Star this repo if you found it helpful!**