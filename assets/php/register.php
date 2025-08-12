<?php
// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$db   = "user";
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm  = trim($_POST['confirm_password']);

    if ($password !== $confirm) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        // Check if user exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username=? LIMIT 1");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<script>alert('Username already taken!');</script>";
        } else {
            // Hash password
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hash);

            if ($stmt->execute()) {
                echo "<script>alert('Registration successful! You can now log in.'); window.location.href='login.php';</script>";
            } else {
                echo "<script>alert('Error: Could not register.');</script>";
            }
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cardex - Register</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="shortcut icon" href="/car_rental/favicon.svg" type="image/svg+xml">
</head>
<body>

  <!-- Header -->
  <header class="header" data-header>
    <div class="container">
      <a href="/car_rental/index.php" class="logo">
        <img src="/car_rental/assets/images/Logo_2.png" alt="Cardex logo">
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
        <a href="login.php" class="btn user-btn">Login</a>
        <a href="register.php" class="btn active">Sign Up</a>
        <button class="nav-toggle-btn" data-nav-toggle-btn>
          <span class="one"></span>
          <span class="two"></span>
          <span class="three"></span>
        </button>
      </div>
    </div>
  </header>

  <!-- Register Section -->
  <main class="main auth-page">
    <section class="section auth-section">
      <div class="container">
        <div class="auth-card">
          <h2 class="h2 section-title">Create Account</h2>
          <p class="section-text">Join us and enjoy our premium services</p>
          
          <form class="auth-form" method="POST" action="">
            <div class="input-wrapper">
              <label for="username" class="input-label">Username</label>
              <input type="text" name="username" id="username" class="input-field" placeholder="Choose a username" required>
              <i class="fas fa-user input-icon"></i>
            </div>

            <div class="input-wrapper">
              <label for="password" class="input-label">Password</label>
              <input type="password" name="password" id="password" class="input-field" placeholder="••••••••" required>
              <i class="fas fa-lock pass-icon"></i>
              <button type="button" class="password-toggle"><i class="fas fa-eye"></i></button>
            </div>

            <div class="input-wrapper">
              <label for="confirm_password" class="input-label">Confirm Password</label>
              <input type="password" name="confirm_password" id="confirm_password" class="input-field" placeholder="••••••••" required>
              <i class="fas fa-lock pass-icon"></i>
              <button type="button" class="password-toggle"><i class="fas fa-eye"></i></button>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
          </form>

          <p class="auth-footer">
            Already have an account? <a href="login.php">Login</a>
          </p>
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="footer-top">
        <div class="footer-brand">
          <a href="index.html" class="logo">Cardex</a>
          <p class="footer-text">Your premium rental solution for vehicles and lifestyle products since 2018.</p>
        </div>
        <ul class="footer-list">
          <li><p class="footer-list-title">Company</p></li>
          <li><a href="about.html" class="footer-link">About Us</a></li>
          <li><a href="careers.html" class="footer-link">Careers</a></li>
          <li><a href="blog.html" class="footer-link">Blog</a></li>
        </ul>
        <ul class="footer-list">
          <li><p class="footer-list-title">Support</p></li>
          <li><a href="contact.html" class="footer-link">Contact Us</a></li>
          <li><a href="faq.html" class="footer-link">FAQs</a></li>
          <li><a href="insurance.html" class="footer-link">Insurance</a></li>
        </ul>
        <ul class="footer-list">
          <li><p class="footer-list-title">Legal</p></li>
          <li><a href="terms.html" class="footer-link">Terms</a></li>
          <li><a href="privacy.html" class="footer-link">Privacy</a></li>
          <li><a href="cookie.html" class="footer-link">Cookie Policy</a></li>
        </ul>
      </div>
      <div class="footer-bottom">
        <ul class="social-list">
          <li><a href="#" class="social-link"><i class="fab fa-facebook"></i></a></li>
          <li><a href="#" class="social-link"><i class="fab fa-twitter"></i></a></li>
          <li><a href="#" class="social-link"><i class="fab fa-instagram"></i></a></li>
        </ul>
        <p class="copyright">&copy; 2025 Cardex. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <script>
    document.querySelectorAll('.password-toggle').forEach(toggle => {
        toggle.addEventListener('click', () => {
            // Find the input inside the same input-wrapper
            const wrapper = toggle.closest('.input-wrapper');
            const input = wrapper.querySelector('input.input-field');
            
            if (input.type === 'password') {
            input.type = 'text';
            toggle.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
            input.type = 'password';
            toggle.innerHTML = '<i class="fas fa-eye"></i>';
            }
        });
    });
  </script>

</body>
</html>
