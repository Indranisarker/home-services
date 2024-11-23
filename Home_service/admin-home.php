<?php
session_start();
require_once('DBconnect.php');

// Handle accepting or rejecting requests
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['status']) && isset($_POST['request_id'])) {
    $request_id = $_POST['request_id'];
    $status = $_POST['status'];
    
    // Update the status of the request
    $stmt = $conn->prepare("UPDATE booking_requests SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $request_id);
    $stmt->execute();
    $stmt->close();
}

// Fetch pending requests
$pending_sql = "SELECT * FROM booking_requests WHERE status = 'Pending'";
$pending_result = $conn->query($pending_sql);

// Fetch accepted requests
$accepted_sql = "SELECT * FROM booking_requests WHERE status = 'Accepted'";
$accepted_result = $conn->query($accepted_sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Booking Requests</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav class="navbar">
    <div class="nav-brand">HomeService Admin</div>
    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="admin_login.php">Logout</a>
    </div>
</nav>

<header class="page-header">
    <h1>HomeService - Manage Booking Requests</h1>
</header>

<div class="admin-container">
    <section>
        <h2 class="text-center">Pending Requests</h2>
        <?php if ($pending_result->num_rows > 0): ?>
            <table class="table table-striped">
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Service Type</th>
                    <th>Preferred Date</th>
                    <th>Vaccine Status</th>
                    <th>Other Details</th>
                    <th>Action</th>
                </tr>
                <?php while ($row = $pending_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['service_type']; ?></td>
                        <td><?php echo $row['preferred_date']; ?></td>
                        <td><?php echo $row['covid_vaccine_status']; ?></td>
                        <td><?php echo $row['other_details']; ?></td>
                        <td>
    <div class="action-buttons">
        <!-- Accept Button -->
        <form method="post" action="" style="display: inline;">
            <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
            <button type="submit" name="status" value="Accepted" class="btn btn-success">Accept</button>
        </form>

        <!-- Reject Button -->
        <form method="post" action="" style="display: inline;">
            <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
            <button type="submit" name="status" value="Rejected" class="btn btn-danger">Reject</button>
        </form>
    </div>
</td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No pending requests found.</p>
        <?php endif; ?>
    </section>

    <section>
        <h2 class="text-center">Accepted Requests</h2>
        <?php if ($accepted_result->num_rows > 0): ?>
            <table class="table table-striped">
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Service Type</th>
                    <th>Preferred Date</th>
                    <th>Vaccine Status</th>
                    <th>Other Details</th>
                </tr>
                <?php while ($row = $accepted_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['service_type']; ?></td>
                        <td><?php echo $row['preferred_date']; ?></td>
                        <td><?php echo $row['covid_vaccine_status']; ?></td>
                        <td><?php echo $row['other_details']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No accepted requests found.</p>
        <?php endif; ?>
    </section>
</div>

<footer>
    <p>Contact us at support@homeservice.com | Call: +123 456 7890</p>
</footer>
</body>
</html>

<?php
$conn->close();
?>
