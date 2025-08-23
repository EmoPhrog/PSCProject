# 🚗 Car Rental Website

A responsive and interactive car rental platform that allows users to browse available cars, check rental prices in multiple currencies, and log in before booking.

---

## ✨ Features

- **User Login**
  - PHP-based authentication
  - Prevents users from renting a car without signing in
- **Car Listings**
  - Each listing shows an image, name, and price
- **Currency Changer**
  - Switch between **MYR**, **IDR**, and **SGD**
  - Prices update instantly without page reload
  - Country flags shown beside currency in dropdown
- **Search Bar**
  - Search cars by name
  - Includes a search icon inside the input box
- **Admin Page**
  - Username: admin
  - Password: admin123
  - Admin page for managing listings and site content

---

## 🛠 Technologies Used

- **HTML5**
- **CSS3**
- **JavaScript (Vanilla JS)**
- **PHP** (for login system)

---

## Setup & Installation (Localhost with PHP)
If you want to use the **Sign In / Sign Up** features, you must run the project on a PHP server.

### Requirements
- [XAMPP](https://www.apachefriends.org/index.html)
- PHP 7.4 or above
- MySQL Database
- A web browser

### Steps
1. **Install XAMPP**  
   - Download and install the tools above.
   - Rename it from **"PSCProject-main"** to **"car_rental"**

2. **Move the Project to Server Folder**  
   - Move the `car_rental` folder to `htdocs`.  
     Example:  
     ```
     C:\xampp\htdocs\car_rental
     ```

3. **Start Server**
   - Open XAMPP
   - Start **Apache**.
   - Start **MySQL**.

4. **Create Database**
   - Go to:
     ```
     http://localhost/phpmyadmin
     ```
   - Create **database**:
     ```
     Create user and payment_system database
     ```
   - Click **Import** and Press **Choose File** for both database:
     ```
     Choose user.sql and payment_system.sql
     ```

5. **Access the Site**
   - Open:
     ```
     localhost/car_rental
     ```

6. **Updating Database Connection**
   - In `login.php` and `register.php`, set:
     ```php
     $host = "localhost";
     $user = "root";
     $pass = "";
     $db   = "user";;
     ```
   - In `payment.php`, set:
     ```php
     $host = "localhost";
     $user = "root";
     $pass = "";
     $db   = "payment_system";;
     ```

---
