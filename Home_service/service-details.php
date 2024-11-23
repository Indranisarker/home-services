<?php
include 'DBconnect.php';

// Check if `service_id` is provided in the URL

$service_id = filter_var($_GET['service_id'], FILTER_VALIDATE_INT);
if ($service_id === false) {
    echo "Invalid service ID.";
    exit;
}

if (isset($_GET['service_id'])) {
    $service_id = $_GET['service_id'];

    // Fetch service details
    $stmt_service = $conn->prepare("SELECT service_name, description, estimated_duration, price, image_path FROM services WHERE service_id = ?");
    $stmt_service->bind_param("i", $service_id);
    $stmt_service->execute();
    $service_result = $stmt_service->get_result();
    $service = $service_result->fetch_assoc();

    $stmt_reviews = $conn->prepare("
    SELECT users.name AS customer_name, reviews.rating, reviews.review_text, reviews.created_at 
    FROM reviews 
    INNER JOIN users ON reviews.user_id = users.id 
    WHERE reviews.service_id = ? 
    ORDER BY reviews.created_at DESC
");
$stmt_reviews->bind_param("i", $service_id);
$stmt_reviews->execute();
$reviews_result = $stmt_reviews->get_result();

} else {
    echo "Service ID not provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Details</title>
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
    <h1>HomeService - Service Details and Reviews</h1>
</header>

<div class="service-details-container">
    <!-- Service Details Card -->
    <div class="service-card">
        <?php if ($service): ?>
            <img src="<?php echo $service['image_path']; ?>" alt="<?php echo $service['service_name']; ?>" class="service-image">
            <h2><?php echo $service['service_name']; ?></h2>
            <ul class="service-description">
                <?php foreach (explode("\n", $service['description']) as $desc): ?>
                    <li><?php echo $desc; ?></li>
                <?php endforeach; ?>
            </ul>
            <p><strong>Duration:</strong> <?php echo $service['estimated_duration']; ?></p>
            <p><strong>Price:</strong> $<?php echo number_format($service['price'], 2); ?>/day</p>

            <!-- Book Service Button -->
            <a href="book-service.php?service_id=<?php echo $service_id; ?>"><button class="service-btn">Book the Service</button></a>
        <?php else: ?>
            <p>Service not found.</p>
        <?php endif; ?>
    </div>
    
<div class="reviews-container">
<h2>Customer Reviews</h2>
    <?php if ($reviews_result->num_rows > 0): ?>
        <?php while ($review = $reviews_result->fetch_assoc()): ?>
            <div class="review-card">
                <h4>Rated By <?php echo htmlspecialchars($review['customer_name']); ?></h4>
                <p><strong> Rating :</strong> <?php echo str_repeat('⭐', $review['rating']); ?> Out of 5</p>
                <p><?php echo nl2br(htmlspecialchars($review['review_text'])); ?></p>
                <small>Reviewed on: <?php echo date('F j, Y', strtotime($review['created_at'])); ?></small>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No reviews yet for this service. Be the first to leave a review!</p>
    <?php endif; ?>
</div>
</div>



<footer>
    <p>Contact us at support@homeservice.com | Call: +123 456 7890</p>
</footer>
</body>
</html>

<?php
$stmt_service->close();
$stmt_reviews->close();
$conn->close();
?>
