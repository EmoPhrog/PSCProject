<?php
session_start();

$isLoggedIn = isset($_SESSION['username']);
$username = $isLoggedIn ? $_SESSION['username'] : "";

// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "payment_system";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // You might want to add validation and sanitization here for production
    $full_name  = $_POST['full_name'];
    $email      = $_POST['email'];
    $address    = $_POST['address'];
    $city       = $_POST['city'];
    $state      = $_POST['state'];
    $zip        = $_POST['zip'];
    $card_name  = $_POST['card_name'];
    $card_num   = $_POST['card_num'];
    $exp_month  = $_POST['exp_month'];
    $exp_year   = $_POST['exp_year'];
    $cvv        = $_POST['cvv'];

    $stmt = $conn->prepare("INSERT INTO payments (full_name, email, address, city, state, zip_code, card_name, card_number, exp_month, exp_year, cvv) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssss", $full_name, $email, $address, $city, $state, $zip, $card_name, $card_num, $exp_month, $exp_year, $cvv);

    if ($stmt->execute()) {
        $message = "Payment recorded successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cardex - Payment</title>
  <link rel="stylesheet" href="/car_rental/assets/css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="shortcut icon" href="/car_rental/favicon.svg" type="image/svg+xml" />

  <script>
    // Profile dropdown toggle
    document.addEventListener('DOMContentLoaded', () => {
      const profileIcon = document.getElementById('profileIcon');
      const dropdown = document.getElementById('profileDropdown');
      if (profileIcon) {
        profileIcon.addEventListener('click', () => {
          dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });
        document.addEventListener('click', (e) => {
          if (!profileIcon.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.style.display = 'none';
          }
        });
      }
    });
  </script>
</head>
<body>
  <header class="header" data-header>
    <div class="container">
      <a href="/car_rental/index.php" class="logo">
        <img src="/car_rental/assets/images/Logo_2.png" alt="Cardex logo" />
      </a>
      <nav class="navbar" data-navbar>
        <ul class="navbar-list">
          <li><a href="/car_rental/index.php#hero-section" class="navbar-link">Home</a></li>
          <li><a href="/car_rental/index.php#car-section" class="navbar-link">Explore cars</a></li>
          <li><a href="/car_rental/index.php#customer-section" class="navbar-link">Customers</a></li>
          <li><a href="/car_rental/index.php#about-us" class="navbar-link">About Us</a></li>
        </ul>
      </nav>
      <div class="header-actions">
        <?php if ($isLoggedIn): ?>
          <div class="profile-menu">
            <img src="/car_rental/assets/images/profile_pic.png" alt="Profile" class="profile-icon" id="profileIcon" style="cursor:pointer; width:40px; height:40px; border-radius:50%;" />
            <div class="dropdown" id="profileDropdown">
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

  <main class="main auth-page">
    <section class="section auth-section">
      <div class="container">
        <div class="auth-card">
          <h2 class="section-title">Payment Information</h2>

          <?php if ($message): ?>
            <p style="color: green; font-weight: bold; margin-bottom: 1rem;"><?php echo htmlspecialchars($message); ?></p>
          <?php endif; ?>

          <form method="POST" action="" class="auth-form">
            <h3>Billing Address</h3>

            <div class="input-wrapper input-with-icon">
              <label for="full_name" class="input-label">Full Name</label>
              <div class="input-icon-wrapper">
                <i class="fas fa-user"></i>
                <input type="text" name="full_name" id="full_name" class="input-field" placeholder="Enter your full name" required />
              </div>
            </div>

            <div class="input-wrapper input-with-icon">
              <label for="email" class="input-label">Email</label>
              <div class="input-icon-wrapper">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" class="input-field" placeholder="Enter your email" required />
              </div>
            </div>

            <div class="input-wrapper input-with-icon">
              <label for="address" class="input-label">Address</label>
              <div class="input-icon-wrapper">
                <i class="fas fa-map-marker-alt"></i>
                <input type="text" name="address" id="address" class="input-field" placeholder="Enter your address" required />
              </div>
            </div>

            <div class="input-wrapper input-with-icon">
              <label for="city" class="input-label">City</label>
              <div class="input-icon-wrapper">
                <i class="fas fa-city"></i>
                <input type="text" name="city" id="city" class="input-field" placeholder="Enter your city" required />
              </div>
            </div>

            <div class="input-row">
              <div class="input-wrapper input-with-icon">
                <label for="state" class="input-label">State</label>
                <div class="input-icon-wrapper">
                  <i class="fas fa-flag-usa"></i>
                  <input type="text" name="state" id="state" class="input-field" placeholder="Enter your state" required />
                </div>
              </div>

              <div class="input-wrapper input-with-icon">
                <label for="zip" class="input-label">Zip Code</label>
                <div class="input-icon-wrapper">
                  <i class="fas fa-mail-bulk"></i>
                  <input type="text" name="zip" id="zip" class="input-field" placeholder="123 456" required />
                </div>
              </div>
            </div>

            <h3>Payment Details</h3>

            <div class="card-accepted" aria-label="Accepted credit cards">
              <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Visa_Logo.png" alt="Visa" />
              <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Mastercard-logo.png" alt="MasterCard" />
            </div>

            <div class="input-wrapper input-with-icon">
              <label for="card_name" class="input-label">Name on Card</label>
              <div class="input-icon-wrapper">
                <i class="fas fa-id-card"></i>
                <input type="text" name="card_name" id="card_name" class="input-field" placeholder="Enter card name" required />
              </div>
            </div>

            <div class="input-wrapper input-with-icon">
              <label for="card_num" class="input-label">Credit Card Number</label>
              <div class="input-icon-wrapper">
                <i class="fas fa-credit-card"></i>
                <input type="text" name="card_num" id="card_num" maxlength="19" class="input-field" placeholder="1111-2222-3333-4444" required />
              </div>
            </div>

            <div class="input-row">
              <div class="input-wrapper input-with-icon">
                <label for="exp_month" class="input-label">Exp Month</label>
                <div class="input-icon-wrapper">
                  <i class="fas fa-calendar-alt"></i>
                  <select name="exp_month" id="exp_month" class="input-field" required>
                    <option value="">Choose month</option>
                    <option>January</option>
                    <option>February</option>
                    <option>March</option>
                    <option>April</option>
                    <option>May</option>
                    <option>June</option>
                    <option>July</option>
                    <option>August</option>
                    <option>September</option>
                    <option>October</option>
                    <option>November</option>
                    <option>December</option>
                  </select>
                </div>
              </div>

              <div class="input-wrapper input-with-icon">
                <label for="exp_year" class="input-label">Exp Year</label>
                <div class="input-icon-wrapper">
                  <i class="fas fa-calendar-alt"></i>
                  <select name="exp_year" id="exp_year" class="input-field" required>
                    <option value="">Choose Year</option>
                    <option>2023</option>
                    <option>2024</option>
                    <option>2025</option>
                    <option>2026</option>
                    <option>2027</option>
                  </select>
                </div>
              </div>

              <div class="input-wrapper input-with-icon">
                <label for="cvv" class="input-label">CVV</label>
                <div class="input-icon-wrapper">
                  <i class="fas fa-lock"></i>
                  <input type="password" name="cvv" id="cvv" maxlength="4" class="input-field" placeholder="123" required />
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-primary">Proceed to Checkout</button>
          </form>
        </div>
      </div>
    </section>
  </main>
</body>
</html>
