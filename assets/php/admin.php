<?php
session_start();

$isLoggedIn = isset($_SESSION['username']);
$username = $isLoggedIn ? $_SESSION['username'] : '';

// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "payment_system";
$conn = new mysqli($host, $user, $pass, $dbname);

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: /car_rental/assets/php/login.php");
    exit;
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch payments
$payments_sql = "SELECT id, full_name, email, address, city, state, zip_code, card_name, card_number, exp_month, exp_year, cvv, created_at 
                 FROM payments ORDER BY created_at DESC";
$payments_result = $conn->query($payments_sql);

// Fetch users from `user` database
$user_conn = new mysqli($host, $user, $pass, "user");
if ($user_conn->connect_error) {
    die("User DB connection failed: " . $user_conn->connect_error);
}

$users_sql = "SELECT id, username, created_at FROM users ORDER BY created_at DESC";
$users_result = $user_conn->query($users_sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="shortcut icon" href="/car_rental/favicon.svg" type="image/svg+xml">
</head>
<body>
    <header class="header" data-header>
        <div class="container">
            <a href="/car_rental/index.php" class="logo">
                <img src="/car_rental/assets/images/Logo_2.png" alt="Ridex logo">
            </a>
            <nav class="navbar" data-navbar>
                <ul class="navbar-list">
                    <li><a href="/car_rental/index.php#hero-section" class="navbar-link" data-nav-link>Home</a></li>
                    <li><a href="/car_rental/index.php#car-section" class="navbar-link" data-nav-link>Explore cars</a></li>
                    <li><a href="/car_rental/index.php#customer-section" class="navbar-link" data-nav-link>Customers</a></li>
                    <li><a href="/car_rental/index.php#about-us" class="navbar-link" data-nav-link>About Us</a></li>
                </ul>
            </nav>
            <div class="header-actions">
                <?php if ($isLoggedIn): ?>
                <div class="profile-menu">
                    <img src="/car_rental/assets/images/profile_pic.png" alt="Profile" class="profile-icon" id="profileIcon" style="cursor:pointer; width:40px; height:40px; border-radius:50%;">
                    <div class="dropdown" id="profileDropdown" style="display:none;">
                        <p style="padding: 10px; margin: 0; font-weight: bold; border-bottom: 1px solid #ccc;">
                            Hello, <?= htmlspecialchars($username) ?>
                        </p>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                            <a href="/car_rental/assets/php/admin.php">Admin Page</a>
                        <?php endif; ?>
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

    <h1>Admin Dashboard</h1>

    <h2>Payment Records</h2>
    <table>
        <tr>
            <th>ID</th><th>Full Name</th><th>Email</th><th>Address</th><th>City</th>
            <th>State</th><th>Zip</th><th>Card Name</th><th>Card Number</th>
            <th>Exp Month</th><th>Exp Year</th><th>CVV</th><th>Created At</th>
        </tr>
        <?php if ($payments_result->num_rows > 0): ?>
            <?php while($row = $payments_result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['full_name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['address']) ?></td>
                    <td><?= htmlspecialchars($row['city']) ?></td>
                    <td><?= htmlspecialchars($row['state']) ?></td>
                    <td><?= htmlspecialchars($row['zip_code']) ?></td>
                    <td><?= htmlspecialchars($row['card_name']) ?></td>
                    <td><?= htmlspecialchars($row['card_number']) ?></td>
                    <td><?= htmlspecialchars($row['exp_month']) ?></td>
                    <td><?= htmlspecialchars($row['exp_year']) ?></td>
                    <td><?= htmlspecialchars($row['cvv']) ?></td>
                    <td><?= htmlspecialchars($row['created_at']) ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="13">No payment records found.</td></tr>
        <?php endif; ?>
    </table>

    <h2>Registered Users</h2>
    <table>
        <tr>
            <th>ID</th><th>Username</th><th>Created At</th>
        </tr>
        <?php if ($users_result->num_rows > 0): ?>
            <?php while($user = $users_result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['created_at']) ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="3">No users found.</td></tr>
        <?php endif; ?>
    </table>

    <script>
    // Toggle dropdown on profile icon click
    document.getElementById('profileIcon').addEventListener('click', function() {
        const dropdown = document.getElementById('profileDropdown');
        if (dropdown.style.display === 'none' || dropdown.style.display === '') {
        dropdown.style.display = 'block';
        } else {
        dropdown.style.display = 'none';
        }
    });

    // Optional: close dropdown if clicked outside
    document.addEventListener('click', function(event) {
        const profileIcon = document.getElementById('profileIcon');
        const dropdown = document.getElementById('profileDropdown');
        if (!profileIcon.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.style.display = 'none';
        }
    });
    </script>
</body>
</html>

<?php
$conn->close();
$user_conn->close();
?>