# 🚗 Car Rental Website

A responsive and interactive car rental platform that allows users to browse available cars, check rental prices in multiple currencies, and log in before booking.

---

## 📂 Project Structure

├── index.html # Homepage with car listings and search bar
├── login.php # PHP login script with simple authentication
├── dashboard.php # (Optional) Redirect page after successful login
├── style.css # Main stylesheet for the website
├── script.js # JavaScript for search, currency change, and UI features
├── assets/
│ ├── images/ # Car and UI images
│ ├── flags/ # Flag icons for currency dropdown
│ └── css/ # Extra CSS (if any)
└── README.md # Project documentation


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
- **Responsive Design**
  - Works on desktop, tablet, and mobile

---

## 🛠 Technologies Used

- **HTML5**
- **CSS3**
- **JavaScript (Vanilla JS)**
- **PHP** (for login system)
- **Font Awesome** (icons)
- **Flag Icons** (for currency selector)

---

## 💻 Installation & Setup

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/car-rental-website.git
   cd car-rental-website
2. **Move to a local PHP server**
    If you’re using XAMPP, place the files inside htdocs
    Start Apache server in XAMPP
3. **Access the website**
    Open your browser and go to:
    /localhost/car_rental
