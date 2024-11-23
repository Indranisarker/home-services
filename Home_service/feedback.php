<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Feedback</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
    <h1>Service Feedback Form</h1>
</header>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to submit a review.");
}
?>
    <div class="feedback-container">
       
    <form action="submit-review.php" method="POST">
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">

    <label for="service-type">Select a Service Package</label>
    <select name="service_type" id="service-type" required>
        <option value="">--Select an option--</option>
        <option value="Self-Isolation Package">Self-Isolation Package</option>
        <option value="Elderly and Special Needs Care">Elderly and Special Needs Care</option>
        <option value="Home Sanitization and Disinfection Package">Home Sanitization and Disinfection Package</option>
        <option value="COVID-19 Testing and Health Checkups">COVID-19 Testing and Health Checkups</option>
        <option value="Home Security Services">Home Security Services</option>
        <option value="Contactless Delivery Services">Contactless Delivery Services</option>
    </select>

    <label for="rating">Rate the Service:</label>
    <div class="star-rating" id="starRating">
        <i class="far fa-star" data-value="1"></i>
        <i class="far fa-star" data-value="2"></i>
        <i class="far fa-star" data-value="3"></i>
        <i class="far fa-star" data-value="4"></i>
        <i class="far fa-star" data-value="5"></i>
    </div>
    <input type="hidden" id="rating" name="rating" required>

    <label for="comments">Your Feedback:</label>
    <textarea id="comments" name="review_text" rows="5" required></textarea>

    <input type="submit" value="Submit Feedback" class="submit-btn">
</form>

<script>
    // JavaScript to handle star rating
    const stars = document.querySelectorAll('.star-rating i');
    const ratingInput = document.getElementById('rating');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const ratingValue = star.getAttribute('data-value');
            ratingInput.value = ratingValue;

            // Highlight stars based on rating
            stars.forEach(s => {
                s.classList.remove('fas');
                s.classList.add('far');
            });
            for (let i = 0; i < ratingValue; i++) {
                stars[i].classList.remove('far');
                stars[i].classList.add('fas');
            }
        });
    });
</script>


        <!-- Feedback Confirmation Message -->
        <div id="confirmationMessage" class="hidden">
            <h3>Thank you for your feedback!</h3>
            <p>Your feedback has been successfully submitted.</p>
        </div>
    </div>
</body>
</html>
