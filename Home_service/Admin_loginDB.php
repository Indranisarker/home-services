<?php
// Connecting with database
require_once('DBconnect.php');

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

// Check input form
if (isset($_POST['email']) && isset($_POST['password'])) {
    $e = trim($_POST['email']);
    $f = trim($_POST['password']);

    // Check for SQL injection patterns
    if (detect_sql_injection($e) || detect_sql_injection($f)) {
        echo "SQL Injection detected!";
        exit();
    }

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM admin WHERE Email = ? AND Password = ?");
    $stmt->bind_param("ss", $e, $f);

    // Execute query
    $stmt->execute();
    $res = $stmt->get_result();

    // Check return set
    if ($res->num_rows != 0) {
        echo "All okay, enter";
        header("Location: admin-home.php");
        exit();
    } else {
        echo "Incorrect ID or password";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
