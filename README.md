# Local Farm Market – Full-Stack E-Commerce Marketplace for Local Farmers

**Live Demo** → [https://shohancs.com/projects/Local_Farm_Market/](https://shohancs.com/projects/Local_Farm_Market/)  
**GitHub Repository** → [github.com/shohancs/Local_Farm_Market](https://github.com/shohancs/Local_Farm_Market)

![Project Banner](https://github.com/user-attachments/assets/e22ff68c-d729-4456-b653-833af917f672)

> A production-ready, secure, and scalable online marketplace that connects local farmers directly with customers. Built from scratch using raw PHP & MySQL – no frameworks – proving deep understanding of core web technologies.

---

## Why This Project Stands Out (For Recruiters & Clients)

- Clean, maintainable code structure with proper separation of concerns
- Complete user role system: Customer → Seller → Admin  
- Real payment gateway integration (SSLCommerz – supports sandbox & live)  
- Admin approval workflow for seller products (prevents fake listings)  
- Location-based delivery logic  
- Secure authentication, prepared statements, password hashing, file validation  
- Responsive UI with Bootstrap 5 + custom CSS  
- Fully functional cart, checkout, order tracking & review system  
- Deployed on real shared hosting (cPanel) – not just localhost  

**This is not a tutorial project – it's a real-world deployable application.**

---

## Instant Demo Access (No signup needed)

| Role            | Direct Link                                                                 | Credentials                  |
|-----------------|-----------------------------------------------------------------------------|------------------------------|
| Public Website  | [Open Site](https://shohancs.com/projects/Local_Farm_Market/)              | –                            |
| Customer        | [Customer Login](https://shohancs.com/projects/Local_Farm_Market/login.php) | `user@gmail.com` / `12345`   |
| Seller Dashboard| [Seller Panel](https://shohancs.com/projects/Local_Farm_Market/seller.php)  | `seller@gmail.com` / `12345` |
| Admin Panel     | [Admin Panel](https://shohancs.com/projects/Local_Farm_Market/admin/)       | `admin@gmail.com` / `12345`  |

> Feel free to place orders, add products (as seller), approve/reject listings (as admin) – everything works end-to-end.

---

## Core Features

| Feature                        | Description                                                                 |
|--------------------------------|-----------------------------------------------------------------------------|
| Category-wise Product Browsing | Dairy, Pure Meat, Fresh Milk, Sweets, Whole-Cow Deals, etc.                |
| Shopping Cart & Checkout       | Session-based cart with real-time total calculation                        |
| SSLCommerz Payment Gateway     | Sandbox + Live mode ready (BD's most popular gateway)                      |
| Location-based Delivery        | Delivery area determined from user's address                               |
| Seller Product Approval Flow   | All listings stay `pending` → Admin verifies authenticity → `published`   |
| Multi-role Dashboard           | Separate panels for Customer, Seller & Super Admin                        |
| Order Tracking & Reviews       | Customers can track orders and leave ratings/comments                      |
| Blog Management                | Admin can create and publish articles                                      |
| Secure File Uploads            | Only allowed image types, renamed files, size limits                       |

---

## Technology Stack

| Layer          | Technology                                          |
|----------------|-----------------------------------------------------|
| Backend        | PHP 8+                |
| Database       | MySQL (optimized schema with proper relationships) |
| Frontend       | HTML5, CSS3, Bootstrap 5, Vanilla JS                |
| Payment        | SSLCommerz (Bangladesh) – Sandbox + Live            |
| Security       | `sha1()`, prepared statements, input sanitization, CSRF-ready structure |
| Deployment     | cPanel Shared Hosting (real production environment) |

---

## Security Best Practices Implemented

- Passwords hashed with `PASSWORD_DEFAULT`
- All queries use prepared statements (MySQLi)
- Input validation + sanitization (client + server side)
- Restricted file uploads (type, size, renaming)
- Session management with regeneration
- HTTPS enforced in production

---

## Project Structure (Clean & Organized)
/
├── assets/                  # CSS, JS, images
├── uploads/                 # Product & seller images
├── admin/                   # Full admin panel
├── seller/                  # Seller dashboard
├── includes/
│   ├── config.php
│   ├── db.php
│   └── functions.php
├── index.php                # Homepage
├── login.php
├── register.php
├── cart.php
├── checkout.php
└── farm_market.sql          # Database dump
text---

## Quick Local Setup

```bash
1. Clone the repo
2. Import farm_market.sql into MySQL
3. Update config.php with your DB credentials
4. Set SSLCommerz sandbox keys (provided in code comments)
5. Make uploads/ and seller_photos/ writable
6. Visit http://localhost/Local_Farm_Market/

Database Overview (Key Tables)

users → role-based authentication
sellers → extended profile for farmers
categories & products → with pending/published status
orders + order_items → complete order lifecycle
comments → product reviews
blogs → content management


Developer / Owner
Shohanur Rahman Shohan
Full-Stack PHP Developer | Available for Remote/Freelance/Full-time Roles

Portfolio: https://shohancs.com
Email: shohancs.dev@gmail.com
LinkedIn: linkedin.com/in/shohancs
Location: Bangladesh (UTC+6) – Fluent in English

Open to opportunities in PHP, Laravel, MySQL, WordPress, and full-stack web development.

License
MIT License – feel free to fork, study, or use commercially.

Built with passion by Shohanur Rahman Shohan © 2025
Looking forward to working together! 🚀
