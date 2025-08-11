<?php
// admin.php
session_start();

// Optional: Restrict to logged-in admin
// if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
//     header("location: login.php");
//     exit;
// }

// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "payment_system"; // payments table is here
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch payments
$payments_sql = "SELECT id, full_name, email, address, city, state, zip_code, card_name, card_number, exp_month, exp_year, cvv, created_at 
                 FROM payments ORDER BY created_at DESC";
$payments_result = $conn->query($payments_sql);

// Fetch users from `user` database
$user_conn = new mysqli($host, $user, $pass, "user"); // your signup DB
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
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f4f4f4; }
        h2 { margin-top: 40px; }
        table { border-collapse: collapse; width: 100%; background: white; margin-bottom: 40px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #333; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
    </style>
</head>
<body>
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
</body>
</html>
<?php
$conn->close();
$user_conn->close();
?>