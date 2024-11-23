<?php
session_start();
include 'DBconnect.php'; // Include your database connection

// Define encryption key and method (same as in registration)
define('ENCRYPTION_KEY', 'secret_key_012345'); // Must match the key used in registration
define('ENCRYPTION_METHOD', 'AES-256-CBC');

// Function to decrypt data
function decryptData($data) {
    $key = hash('sha256', ENCRYPTION_KEY);
    $iv = substr(hash('sha256', 'encryption_iv'), 0, 16); // Initialization vector
    return openssl_decrypt($data, ENCRYPTION_METHOD, $key, 0, $iv);
}

// Function to check for potential SQL injection patterns
function detect_sql_injection($input) {
    $patterns = ['/(\bor\b|\band\b|=|--|#|\/\*|\*\/|;)/i', '/(\'|"|`|;)/'];
    foreach ($patterns as $pattern) {
        if (preg_match($pattern, $input)) {
            return true;
        }
    }
    return false;
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    header("Location: user-login.php"); // Redirect to login if not logged in
    exit();
}

// Get the user's ID from the session
$user_id = $_SESSION['user_id'];

// Fetch user data from the database
$stmt = $conn->prepare("SELECT name, mobile, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if user data was found
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $name = $user['name'];
    
    // Check for SQL injection patterns in decrypted data
    $mobile = decryptData(trim($user['mobile']));
    $email = decryptData(trim($user['email']));

    if (detect_sql_injection($mobile) || detect_sql_injection($email)) {
        echo "SQL Injection detected!";
        exit();
    }
} else {
    // If no user data is found, set default empty values
    $name = '';
    $mobile = '';
    $email = '';
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomeService App - Book Services</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
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
    <h1>HomeService - Book Service Information Form</h1>
</header>

<div class="container">
<section class="customization-section">
    <h2>Book Your Package</h2>
    <form action="booking.php" method="POST">
        <!-- Name field -->
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>" required>

        <!-- Mobile or Email field -->
        <label for="contact">Mobile:</label>
        <input type="text" name="mobile" id="mobile" value="<?php echo htmlspecialchars($mobile); ?>" required>
        <label for="contact">Email:</label>
        <input type="text" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required>

        <!-- Type of Service field -->
        <label for="service-type">Select a Service Package</label>
        <select name="service-type" id="service-type" required>
        <option value="">--Select a option--</option>
            <option value="Self-Isolation Package">Self-Isolation Package</option>
            <option value="Elderly and Special Needs Care">Elderly and Special Needs Care</option>
            <option value="Home Sanitization and Disinfection Package">Home Sanitization and Disinfection Package </option>
            <option value="COVID-19 Testing and Health Checkups">COVID-19 Testing and Health Checkups</option>
            <option value="Home Security Services">Home Security Services</option>
            <option value="Contactless Delivery Services">Contactless Delivery Services</option>
        </select>

        <!-- Preferred Dates of Service -->
        <label for="preferred-dates">Preferred Start Date:</label>
        <input type="date" name="preferred-start-date" id="preferred-start-date" required>

        <label for="preferred-end-date">Preferred End Date:</label>
        <input type="date" name="preferred-end-date" id="preferred-end-date" required>

        <!-- Preferred Duration field -->
        <label for="duration">Duration (in days):</label>
        <input type="number" name="duration" id="duration" placeholder="Number of days" min="1" required>

        <!-- Preferred Cost field -->
        <label for="cost">Preferred Cost of Service:</label>
        <input type="number" name="cost" id="cost" placeholder="Enter your budget" required>

        <!-- Additional Notes/Requests -->
        <label for="notes">Additional Notes/Requests:</label>
        <textarea name="notes" id="notes" rows="4" placeholder="Any special instructions..."></textarea>

        <!-- Submit button -->
        <input type="submit" value="Book Now" class="book-now-btn">
    </form>
</section>

</div>

</body>
<footer>
    <p>Contact us at support@homeservice.com | Call: +123 456 7890</p>
</footer>
</html>
