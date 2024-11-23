<?php
session_start();
include 'DBconnect.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user's ID from the session (if required)
    $user_id = $_SESSION['user_id'];

    // Retrieve form data
    /** $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $service_type = $_POST['service-type'];
    $preferred_start_date = $_POST['preferred-start-date'];
    $preferred_end_date = $_POST['preferred-end-date'];
    $duration = $_POST['duration'];
    $cost = $_POST['cost'];
    $notes = $_POST['notes']; */

    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $service_type = filter_var($_POST['service-type'], FILTER_SANITIZE_STRING);
    $preferred_start_date = filter_var($_POST['preferred-start-date'], FILTER_SANITIZE_STRING);
    $preferred_end_date = filter_var($_POST['preferred-end-date'], FILTER_SANITIZE_STRING);
    $duration = filter_var($_POST['duration'], FILTER_VALIDATE_INT);
    $cost = filter_var($_POST['cost'], FILTER_VALIDATE_INT);
    $notes = filter_var($_POST['notes'], FILTER_SANITIZE_STRING);


    // Prepare an SQL statement to insert the data
    $stmt = $conn->prepare("INSERT INTO bookings (name, mobile, email, service_type, preferred_start_date, preferred_end_date, duration, cost, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssiis", $name, $mobile, $email, $service_type, $preferred_start_date, $preferred_end_date, $duration, $cost, $notes);

    // Execute the statement
    if ($stmt->execute()) {
        // Get the last inserted ID
        $booking_id = $conn->insert_id;

        // Redirect to the booking summary page with the new booking ID
        header("Location: booking-summary.php?id=$booking_id");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
