# Local Farm Market

[Live Demo • Visit Site](https://shohancs.com/projects/Local_Farm_Market/)

---

## Overview

Local Farm Market is a simple, secure, and user-friendly marketplace built with raw PHP and MySQL where local farmers and sellers can list dairy products, fresh meat, sweets, and whole-cow deals. Products submitted by sellers require admin verification before they are published on the frontend. Customers can browse category-wise, add items to cart, and complete purchases using SSLCommerz. Delivery is determined based on the user’s location.

---

## Demo & Test Credentials

Use the following links and dummy accounts to test the application:

* Website / Demo: `https://shohancs.com/projects/Local_Farm_Market/`
* User login: `https://shohancs.com/projects/Local_Farm_Market/login.php`

  * Email: `user@gmail.com`
  * Password: `12345`
* Seller login: `https://shohancs.com/projects/Local_Farm_Market/seller.php`

  * Email: `seller@gmail.com`
  * Password: `12345`
* Super Admin panel: `https://shohancs.com/projects/Local_Farm_Market/admin/`

  * Email: `admin@gmail.com`
  * Password: `12345`

---

## Key Features

* Category-based product browsing (Dairy, Pure Meat, Fresh Milk, Whole Cow Deal, etc.)
* Add to cart & checkout with SSLCommerz payment integration
* Location-based delivery assignment
* Three user roles: **User**, **Seller**, **Admin**
* Seller account registration & product submission flow with admin verification
* Admin panel for category management, product approval, role management, and blog posts
* Display of product owner (malik) and farmer information
* Product comments/reviews and order tracking
* Secure handling of payments and order lifecycle

---

## Roles & Flows

**User**

* Browse products by category
* Add items to cart and checkout
* Leave comments/reviews and track orders

**Seller (Local Farmer)**

* Register as a seller and submit product listings (meat, milk, sweets, whole-cow deals)
* Listings remain pending until admin verification

**Admin**

* Review and verify seller-submitted products
* Manage categories, users, roles, and blog posts
* View and manage orders and payments

---

## Tech Stack

* **Back-end:** PHP (raw / procedural)
* **Database:** MySQL
* **Front-end:** HTML, CSS, Bootstrap
* **Payment:** SSLCommerz
* **Hosting:** cPanel / Shared hosting (deployed at `shohancs.com`)

---

## Installation & Setup (Quick)

1. Clone or download the repository to your local machine or server.
2. Create a MySQL database and import the provided `farm_market.sql` (or create tables manually).
3. Update the database credentials in the project configuration file (e.g., `config.php`):

```php
$db_host = 'localhost';
$db_user = 'DB_USERNAME';
$db_pass = 'DB_PASSWORD';
$db_name = 'farm_market';
$base_url = 'https://shohancs.com/projects/Local_Farm_Market/';
```

4. Configure SSLCommerz keys in the payment configuration file (`ssl_config.php` or similar). Use sandbox keys for testing.
5. Ensure upload directories (e.g., `uploads/`, `seller_photos/`) are writable by the webserver.
6. Visit the site URL to test the application and use the demo credentials above.

---

## Admin Approval Flow (Seller Product)

1. Seller submits a product (status: `pending`).
2. Admin inspects product details, owner (malik) and farmer information.
3. If authentic, admin approves and publishes the product (status: `published`).
4. If not authentic, admin rejects the submission and notifies the seller.

---

## Security & Best Practices

* Store passwords using `password_hash()` and verify with `password_verify()`.
* Use prepared statements (mysqli with prepared queries or PDO) to prevent SQL injection.
* Validate and sanitize all user inputs on both client and server sides.
* Restrict upload file types and validate file contents.
* Always use HTTPS in production. For local testing, use ngrok when testing payment callbacks.
* Use SSLCommerz sandbox during development and verify callbacks before switching to live keys.

---

## Project Structure 

```
/ (root)
|-- assets/
|-- uploads/
|-- admin/
|-- seller/
|-- includes/
|   |-- config.php
|   |-- db.php
|-- index.php
|-- login.php
|-- seller.php
|-- cart.php
|-- checkout.php
```

---

## Database Schema (Main tables)

* `users` (id, name, email, password_hash, role, address, location, created_at)
* `categories` (id, name, slug, description)
* `sellers` (id, user_id, shop_name, owner_name, verification_status, phone, address)
* `products` (id, seller_id, category_id, title, description, price, quantity, status, image, created_at)
* `orders` (id, user_id, total_amount, payment_status, delivery_address, created_at)
* `order_items` (id, order_id, product_id, qty, price)
* `comments` (id, product_id, user_id, comment, created_at)
* `blogs` (id, title, body, author, created_at)

---

## Contact

* Official website: `https://shohancs.com/`
* Owner / Maintainer: **Shohanur Rahman Shohan**
* Contact Email: `shohancs.dev@gmail.com`

---

## License

MIT license.       

---

## Contribution

Contributions are welcome. Please open issues or pull requests on the GitHub repository with clear descriptions and reproduction steps.

---

*Thank you for checking out Local Farm Market — built and maintained by Shohanur Rahman Shohan (shohancs.com).*
