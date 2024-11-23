<?php
session_start();
include 'DBconnect.php'; // Include your database connection

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        die("You must be logged in to submit a review.");
    }

    // Ensure all required fields are set
    if (isset($_POST['service_type'], $_POST['rating'], $_POST['review_text'])) {
        $user_id = $_SESSION['user_id']; // Get the logged-in user ID from the session
        $service_type = $_POST['service_type'];
        $rating = (int)$_POST['rating'];
        $review_text = $_POST['review_text'];

        // Validate the rating (must be between 1 and 5)
        if ($rating < 1 || $rating > 5) {
            echo "Invalid rating.";
            exit;
        }

        // Check for SQL injection patterns in inputs
        $inputs = [$service_type, $review_text];
        foreach ($inputs as $input) {
            if (detect_sql_injection($input)) {
                echo "SQL Injection detected!";
                exit();
            }
        }

        // Fetch the service ID based on the service name
        $stmt_service = $conn->prepare("SELECT service_id FROM services WHERE service_name = ?");
        $stmt_service->bind_param("s", $service_type);
        $stmt_service->execute();
        $service_result = $stmt_service->get_result();

        if ($service_result->num_rows > 0) {
            $service = $service_result->fetch_assoc();
            $service_id = $service['service_id'];

            // Check if the user exists in the database
            $stmt_user = $conn->prepare("SELECT id FROM users WHERE id = ?");
            $stmt_user->bind_param("i", $user_id);
            $stmt_user->execute();
            $user_result = $stmt_user->get_result();

            if ($user_result->num_rows > 0) {
                // Insert the review into the reviews table
                $stmt_review = $conn->prepare("INSERT INTO reviews (user_id, service_id, rating, review_text, created_at) VALUES (?, ?, ?, ?, NOW())");
                $stmt_review->bind_param("iiis", $user_id, $service_id, $rating, $review_text);

                if ($stmt_review->execute()) {
                    echo "Review submitted successfully.";
                    header("Location: service-details.php?service_id=" . $service_id);
                    exit;
                } else {
                    echo "Error submitting review.";
                }
                $stmt_review->close();
            } else {
                echo "User not found.";
            }
            $stmt_user->close();
        } else {
            echo "Service not found.";
        }
        $stmt_service->close();
    } else {
        echo "All fields are required.";
    }
}

$conn->close();
?>
