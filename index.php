<?php
session_start();
$isLoggedIn = isset($_SESSION['username']);
$username = $isLoggedIn ? $_SESSION['username'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cardex - Premium Vehicle & Lifestyle Rentals</title>
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
</head>
<body>
  <!-- Header with Auth Buttons -->
  <header class="header" data-header>
    <div class="container">
      <a href="./index.php" class="logo">
        <img src="./assets/images/Logo_2.png" alt="Ridex logo">
      </a>
      
      <nav class="navbar" data-navbar>
        <ul class="navbar-list">
          <li>
            <a href="#hero-section" class="navbar-link" data-nav-link>Home</a>
          </li>
          <li>
            <a href="#car-section" class="navbar-link" data-nav-link>Explore cars</a>
          </li>
          <li>
            <a href="#customer-section" class="navbar-link" data-nav-link>Customers</a>
          </li>
          <li>
            <a href="#about-us" class="navbar-link" data-nav-link>About Us</a>
          </li>
        </ul>
      </nav>

      <div class="currency-dropdown">
        <div class="currency-selected" data-value="MYR">
          <img src="https://flagcdn.com/w20/my.png" alt="MY">
          MYR
        </div>
        <div class="currency-list">
          <div data-value="MYR">
            <img src="https://flagcdn.com/w20/my.png" alt="MY">
            MYR
          </div>
          <div data-value="IDR">
            <img src="https://flagcdn.com/w20/id.png" alt="ID">
            IDR
          </div>
          <div data-value="SGD">
            <img src="https://flagcdn.com/w20/sg.png" alt="SG">
            SGD
          </div>
        </div>
      </div>

      <div class="header-actions">
        <?php if ($isLoggedIn): ?>
          <div class="profile-menu">
            <img src="/car_rental/assets/images/profile_pic.png" alt="Profile" class="profile-icon" id="profileIcon" style="cursor:pointer; width:40px; height:40px; border-radius:50%;">
            <div class="dropdown" id="profileDropdown" style="display:none;">
              <p style="padding: 10px; margin: 0; font-weight: bold; border-bottom: 1px solid #ccc;">Hello, <?= htmlspecialchars($username) ?></p>
              <a href="/car_rental/assets/php/logout.php">Sign Out</a>
            </div>
          </div>
        <?php else: ?>
          <a href="/car_rental/assets/php/login.php" class="btn user-btn">Login</a>
          <a href="/car_rental/assets/php/register.php" class="btn">Sign Up</a>
        <?php endif; ?>

        <button class="nav-toggle-btn" data-nav-toggle-btn>
          <span class="one"></span>
          <span class="two"></span>
          <span class="three"></span>
        </button>
      </div>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="hero" id="hero-section">
    <div class="container">
      <div class="hero-content">
        <h1 class="h1 hero-title">Drive Your Dream Car Today</h1>
        <p class="hero-text">
          We've got every car you need for an unforgettable experience. <br>
          Flexible plans starting at just RM199/month.
        </p>
        <div class="hero-banner"></div>
          <form action="" class="hero-form">
            <div class="input-wrapper">
              <label for="input-1" class="input-label">Car, model, or brand</label>
              <input type="text" name="car-model" id="input-1" class="input-field"placeholder="What car are you looking?">
            </div>
            <div class="input-wrapper">
              <label for="input-2" class="input-label">Max. monthly payment</label>
              <input type="text" name="monthly-pay" id="input-2" class="input-field" placeholder="Add an amount in RM">
            </div>
            <div class="input-wrapper">
              <label for="input-3" class="input-label">Make Year</label>
              <input type="text" name="year" id="input-3" class="input-field" placeholder="Add a minimal make year">
            </div>
            <button type="submit" class="btn">Search</button>
          </form>
        </div>
    </div>
  </section>

  <!-- Featured Categories -->
<section class="section featured-car" id="car-section">
  <div class="container">
    <div class="title-wrapper">
      <h2 class="h2 section-title">Featured Cars</h2>
    </div>

    <ul class="featured-car-list">
      <!-- Car 1 -->
      <li>
        <div class="featured-car-card">
          <figure class="card-banner">
            <img src="./assets/images/car-1.jpg" alt="Toyota RAV4">
          </figure>
          <div class="card-content">
            <div class="card-title-wrapper">
              <h3 class="h3 card-title">Toyota RAV4</h3>
              <span class="year">2020-2024</span>
            </div>
            <ul class="card-list">
              <li><i class="fas fa-car"></i> 50+ Models</li>
              <li><i class="fas fa-gas-pump"></i> Fuel Included</li>
            </ul>
            <div class="card-price-wrapper">
              <p class="price" data-price="439">RM439 /month</p>
              <a href="<?php 
                    echo isset($_SESSION['user_id']) 
                    ? '/car_rental/assets/php/payment.php' 
                    : '/car_rental/assets/php/login.php'; 
              ?>" class="btn">Rent Now</a>
            </div>
          </div>
        </div>
      </li>

      <!-- Car 2 -->
      <li>
        <div class="featured-car-card">
          <figure class="card-banner">
            <img src="./assets/images/car-2.jpg" alt="BMW 3 Series">
          </figure>
          <div class="card-content">
            <div class="card-title-wrapper">
              <h3 class="h3 card-title">BMW 3 Series</h3>
              <span class="year">2021-2024</span>
            </div>
            <ul class="card-list">
              <li><i class="fas fa-car"></i> 30+ Models</li>
              <li><i class="fas fa-gas-pump"></i> Fuel Included</li>
            </ul>
            <div class="card-price-wrapper">
              <p class="price" data-price="349">RM349 /month</p>
              <a href="<?php 
                    echo isset($_SESSION['user_id']) 
                    ? '/car_rental/assets/php/payment.php' 
                    : '/car_rental/assets/php/login.php'; 
              ?>" class="btn">Rent Now</a>
            </div>
          </div>
        </div>
      </li>

      <li>
        <div class="featured-car-card">
          <figure class="card-banner">
            <img src="./assets/images/car-3.jpg" alt="Volkswagen T-Cross">
          </figure>
          <div class="card-content">
            <div class="card-title-wrapper">
              <h3 class="h3 card-title">Volkswagen T-Cross</h3>
              <span class="year">2019-2024</span>
            </div>
            <ul class="card-list">
              <li><i class="fas fa-car"></i> 40+ Models</li>
              <li><i class="fas fa-gas-pump"></i> Fuel Included</li>
            </ul>
            <div class="card-price-wrapper">
              <p class="price" data-price="399">RM399 /month</p>
              <a href="<?php 
                    echo isset($_SESSION['user_id']) 
                    ? '/car_rental/assets/php/payment.php' 
                    : '/car_rental/assets/php/login.php'; 
              ?>" class="btn">Rent Now</a>
            </div>
          </div>
        </div>
      </li>

      <li>
        <div class="featured-car-card">
          <figure class="card-banner">
            <img src="./assets/images/car-4.jpg" alt="Cadillac Escalade">
          </figure>
          <div class="card-content">
            <div class="card-title-wrapper">
              <h3 class="h3 card-title">Cadillac Escalade</h3>
              <span class="year">2020-2023</span>
            </div>
            <ul class="card-list">
              <li><i class="fas fa-car"></i> 60+ Models</li>
              <li><i class="fas fa-gas-pump"></i> Fuel Included</li>
            </ul>
            <div class="card-price-wrapper">
              <p class="price" data-price="619">RM619 /month</p>
              <a href="<?php 
                    echo isset($_SESSION['user_id']) 
                    ? '/car_rental/assets/php/payment.php' 
                    : '/car_rental/assets/php/login.php'; 
              ?>" class="btn">Rent Now</a>
            </div>
          </div>
        </div>
      </li>

      <li>
        <div class="featured-car-card">
          <figure class="card-banner">
            <img src="./assets/images/car-5.jpg" alt="BMW 4 Series GTI">
          </figure>
          <div class="card-content">
            <div class="card-title-wrapper">
              <h3 class="h3 card-title">BMW 4 Series GTI</h3>
              <span class="year">2019-2024</span>
            </div>
            <ul class="card-list">
              <li><i class="fas fa-car"></i> 30+ Models</li>
              <li><i class="fas fa-gas-pump"></i> Fuel Included</li>
            </ul>
            <div class="card-price-wrapper">
              <p class="price" data-price="529">RM529 /month</p>
              <a href="<?php 
                    echo isset($_SESSION['user_id']) 
                    ? '/car_rental/assets/php/payment.php' 
                    : '/car_rental/assets/php/login.php'; 
              ?>" class="btn">Rent Now</a>
            </div>
          </div>
        </div>
      </li>

      <li>
        <div class="featured-car-card">
          <figure class="card-banner">
            <img src="./assets/images/car-6.jpg" alt="BMW 4 Series">
          </figure>
          <div class="card-content">
            <div class="card-title-wrapper">
              <h3 class="h3 card-title">BMW 4 Series</h3>
              <span class="year">2018-2022</span>
            </div>
            <ul class="card-list">
              <li><i class="fas fa-car"></i> 20+ Models</li>
              <li><i class="fas fa-gas-pump"></i> Fuel Included</li>
            </ul>
            <div class="card-price-wrapper">
              <p class="price" data-price="489">RM489 /month</p>
              <a href="<?php 
                    echo isset($_SESSION['user_id']) 
                    ? '/car_rental/assets/php/payment.php' 
                    : '/car_rental/assets/php/login.php'; 
              ?>" class="btn">Rent Now</a>
            </div>
          </div>
        </div>
      </li>
    </ul>
  </div>
</section>


  <!-- Testimonials -->
  <section class="section testimonials" id="customer-section">
    <div class="container">
        <h2 class="h2 section-title">What Our Customers Say</h2>
        <ul class="get-start-list">
          <li>
            <div class="get-start-card">
              <div class="card-icon icon-1">
                <img src="/car_rental/assets/images/customer_pic.jpg" alt="customer">
              </div>
              <h3 class="card-title">Siti Aisha</h3>
              <p class="card-text">
                This is the best car rental website I have ever seen! I really suggest you use this website.
            </div>
          </li>
          <li>
            <div class="get-start-card">
              <div class="card-icon icon-2">
                <img src="./assets/images/customer_pic_2.jpg" alt="customer">
              </div>
              <h3 class="card-title">Mohamad Adam</h3>
              <p class="card-text">
                Booking a car was so quick and easy! The whole process was smooth, and the prices were unbeatable.
              </p>
            </div>
          </li>
          <li>
            <div class="get-start-card">
              <div class="card-icon icon-3">
                <img src="./assets/images/customer_pic_3.jpg" alt="customer">
              </div>
              <h3 class="card-title">Punitha A/P Muthu</h3>
              <p class="card-text">
                I’ve rented from many places before, but this site offers the friendliest service and the newest cars.
              </p>
            </div>
          </li>
          <li>
            <div class="get-start-card">
              <div class="card-icon icon-4">
                <img src="./assets/images/customer_pic_4.jpg" alt="customer">
              </div>
              <h3 class="card-title">Nicholas Ong</h3>
              <p class="card-text">
                Fantastic experience from start to finish — I’ll definitely be using this website again for my future trips!
              </p>
            </div>
          </li>
        </ul>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer" id="about-us">
    <div class="container">
      <div class="footer-top">
        <div class="footer-brand">
          <a href="index.php" class="logo">Cardex</a>
          <p class="footer-text">
            Your premium rental solution for vehicles and lifestyle products since 2018.
          </p>
        </div>

        <ul class="footer-list">
          <li><p class="footer-list-title">Company</p></li>
          <li><a href="index.php" class="footer-link">About Us</a></li>
          <li><a href="index.php" class="footer-link">Careers</a></li>
          <li><a href="index.php" class="footer-link">Blog</a></li>
        </ul>

        <ul class="footer-list">
          <li><p class="footer-list-title">Support</p></li>
          <li><a href="index.php" class="footer-link">Contact Us</a></li>
          <li><a href="index.php" class="footer-link">FAQs</a></li>
          <li><a href="index.php" class="footer-link">Insurance</a></li>
        </ul>

        <ul class="footer-list">
          <li><p class="footer-list-title">Legal</p></li>
          <li><a href="index.php" class="footer-link">Terms</a></li>
          <li><a href="index.php" class="footer-link">Privacy</a></li>
          <li><a href="index.php" class="footer-link">Cookie Policy</a></li>
        </ul>
      </div>

      <div class="footer-bottom">
        <ul class="social-list">
          <li><a href="https://www.facebook.com/" class="social-link"><i class="fab fa-facebook"></i></a></li>
          <li><a href="https://twitter.com/" class="social-link"><i class="fab fa-twitter"></i></a></li>
          <li><a href="https://www.instagram.com/" class="social-link"><i class="fab fa-instagram"></i></a></li>
        </ul>
        <p class="copyright">&copy; 2025 Cardex. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <script src="./assets/js/script.js"></script>
</body>
</html>