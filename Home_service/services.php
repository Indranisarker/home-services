<?php
session_start(); // Start the session

include 'DBconnect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomeService App - Service Packages</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
// Check if the user is logged in
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    // If the user is logged in, show the logged-in navbar
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
    <?php
}
 else {
    // If the user is not logged in, show the guest navbar
    ?>
    <nav class="navbar">
        <div class="nav-brand">HomeService</div>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="user-login.php">Login</a>
            <a href="user-signup.php">Sign Up</a>
            <a href="about-us.php">About Us</a>
        </div>
    </nav>
    <?php
}
?>
<header class="page-header">
    <h1>HomeService - COVID-19 Care Packages</h1>
</header>

<div class="service-container">
<?php
include 'DBconnect.php';

// Fetch all services from the database
$sql ="SELECT service_id, service_name, estimated_duration, price, image_path FROM services" ;
$result = $conn->query($sql);

// Check if any services exist
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display each service as a card
        ?>
        <div class="package-card">
            <!-- Display the image -->
            <img src="<?php echo $row['image_path']; ?>" alt="<?php echo htmlspecialchars($row['service_name']); ?>" class="service-image">

            <!-- Display the service name and description -->
            <h3><?php echo htmlspecialchars($row['service_name']); ?></h3>
            
            <!-- Display the estimated duration -->
            <p><strong>Duration:</strong> <?php echo htmlspecialchars($row['estimated_duration']); ?></p>
            
            <!-- Display customer ratings (dummy ratings for now) -->
            <div class="button-container">
                <p>Customer ratings:</p>
                <div class="review-rating" style="color: orange; font-size:20px; margin-top:-5px; margin-left:10px">
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">☆</span>
                </div>
            </div>
            
            <!-- Display the price -->
            <p><strong>Price:</strong> $<?php echo number_format($row['price'], 2); ?>/day</p>


            <!-- Book Service Button -->
            <a href="service-details.php?service_id=<?php echo $row['service_id']; ?>"><button class="book-service-btn">View Details</button></a>
        </div>
        <?php
    }
} else {
    echo "<p>No services available at the moment.</p>";
}

$conn->close();
?>
</div>
 <section class="experience-section">
        <h2>Our Experience</h2>
        <p>With over 5 years of experience in providing care services, we have helped thousands of families ensure safety and hygiene during the COVID-19 pandemic.</p>
    </section>

    <section class="renovation-section">
        <h2>Upcoming Renovation Plans</h2>
        <p>We are upgrading our facilities with better air purification systems and larger isolation rooms to provide even more comfort and safety during the ongoing pandemic.</p>
    </section>
</body>
<footer>
    <p>Contact us at support@homeservice.com | Call: +123 456 7890</p>
</footer>
</html>
