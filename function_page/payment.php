<?php
// Database connection
$host = "localhost";
$user = "root"; // change if not root
$pass = "";     // your MySQL password
$dbname = "payment_system";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// When form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO payments (full_name, email, address, city, state, zip_code, card_name, card_number, exp_month, exp_year, cvv) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssss", $full_name, $email, $address, $city, $state, $zip, $card_name, $card_num, $exp_month, $exp_year, $cvv);

    if ($stmt->execute()) {
        echo "<h3>Payment recorded successfully!</h3>";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>
<form action="payment.php" method="POST">
    <head><link rel="stylesheet" href="style/style.css"></head>

    <div class="row">

        <div class="col">
            <h3 class="title">Billing Address</h3>

            <div class="inputBox">
                <label>Full Name:</label>
                <input type="text" name="full_name" placeholder="Enter your full name" required>
            </div>

            <div class="inputBox">
                <label>Email:</label>
                <input type="email" name="email" placeholder="Enter email address" required>
            </div>

            <div class="inputBox">
                <label>Address:</label>
                <input type="text" name="address" placeholder="Enter address" required>
            </div>

            <div class="inputBox">
                <label>City:</label>
                <input type="text" name="city" placeholder="Enter city" required>
            </div>

            <div class="flex">
                <div class="inputBox">
                    <label>State:</label>
                    <input type="text" name="state" placeholder="Enter state" required>
                </div>
                <div class="inputBox">
                    <label>Zip Code:</label>
                    <input type="text" name="zip" placeholder="123 456" required>
                </div>
            </div>
        </div>

        <div class="col">
            <h3 class="title">Payment</h3>

            <div class="inputBox">
                <label>Card Accepted:</label>
                <img src="https://media.geeksforgeeks.org/wp-content/uploads/20240715140014/Online-Payment-Project.webp" alt="credit card">
            </div>

            <div class="inputBox">
                <label>Name On Card:</label>
                <input type="text" name="card_name" placeholder="Enter card name" required>
            </div>

            <div class="inputBox">
                <label>Credit Card Number:</label>
                <input type="text" name="card_num" placeholder="1111-2222-3333-4444" maxlength="19" required>
            </div>

            <div class="inputBox">
                <label>Exp Month:</label>
                <select name="exp_month" required>
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

            <div class="flex">
                <div class="inputBox">
                    <label>Exp Year:</label>
                    <select name="exp_year" required>
                        <option value="">Choose Year</option>
                        <option>2023</option>
                        <option>2024</option>
                        <option>2025</option>
                        <option>2026</option>
                        <option>2027</option>
                    </select>
                </div>
                <div class="inputBox">
                    <label>CVV</label>
                    <input type="number" name="cvv" placeholder="1234" required>
                </div>
            </div>
        </div>
    </div>

    <input type="submit" value="Proceed to Checkout" class="submit_btn">
</form>
