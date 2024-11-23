<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Summary</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
session_start();
include 'DBconnect.php';

// Define encryption key and method (same as in registration)
define('ENCRYPTION_KEY', 'secret_key_012345'); // Must match the key used in registration
define('ENCRYPTION_METHOD', 'AES-256-CBC');

function decryptData($data) {
    $key = hash('sha256', ENCRYPTION_KEY);
    $iv = substr(hash('sha256', 'encryption_iv'), 0, 16); // Initialization vector
    return openssl_decrypt($data, ENCRYPTION_METHOD, $key, 0, $iv);
}

// Check if a booking ID is provided in the URL
if (isset($_GET['id'])) {
    $booking_id = intval($_GET['id']);
    
    // Fetch booking information from the database
    $sql = "SELECT name,mobile,email,service_type, preferred_start_date, duration, notes, cost 
            FROM bookings 
            WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if the booking exists
    if ($result->num_rows > 0) {
        $booking = $result->fetch_assoc();
        $name = decryptData($booking['name']);
        $mobile = decryptData(trim($booking['mobile']));
        $email = decryptData($booking['email']);
        $notes = decryptData($booking['notes']);
    } else {
        echo "<p>Booking not found.</p>";
        exit;
    }
    $stmt->close();
} else {
    echo "<p>No booking selected.</p>";
    exit;
}

$conn->close();
?>


<nav class="navbar">
    <div class="nav-brand">HomeService</div>
    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="services.php">Services</a>
        <a href="feedback.php">Feedback</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>

<header class="page-header">
    <h1>HomeService - Booking Summary</h1>
</header>

<div class="checkout-container">
    <div class="checkout-summary">
    <div class="summary-item">
            <span>Name</span>
            <span><?php echo htmlspecialchars($name); ?></span>
        </div>
        <div class="summary-item">
            <span>Phone No</span>
            <span><?php echo htmlspecialchars($mobile); ?></span>
        </div>
        <div class="summary-item">
            <span>Email</span>
            <span><?php echo htmlspecialchars($email); ?></span>
        </div>
        <div class="summary-item">
            <span>Service Name</span>
            <span><?php echo htmlspecialchars($booking['service_type']); ?></span>
        </div>
        <div class="summary-item">
            <span>Booking Date</span>
            <span><?php echo htmlspecialchars($booking['preferred_start_date']); ?></span>
        </div>
        <div class="summary-item">
            <span>Duration</span>
            <span><?php echo htmlspecialchars($booking['duration']); ?> days</span>
        </div>
        <div class="summary-item">
            <span>Additional Notes</span>
            <span><?php echo htmlspecialchars($notes); ?></span>
        </div>
        <div class="summary-item payable-total">
            <span>Total Cost</span>
            <span>$<?php echo number_format($booking['cost'], 2); ?></span>
        </div>
        <div class="wrapper" style="margin-top: 40px; margin-left:150px">
            <a href="order-confirm.php?id=<?php echo $booking_id; ?>" class="home-link">Confirm Service</a>
        </div>
    </div>
</div>
<footer>
    <p>Contact us at support@homeservice.com | Call: +123 456 7890</p>
</footer>
</body>
</html>
