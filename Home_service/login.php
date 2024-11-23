<?php
session_start();
include 'DBconnect.php';
require_once 'vendor/autoload.php';

// Define encryption key and method (must match the registration code)
define('ENCRYPTION_KEY', 'secret_key_012345'); // Ensure this key is kept secure
define('ENCRYPTION_METHOD', 'AES-256-CBC');


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

function encryptData($data) {
    $key = hash('sha256', ENCRYPTION_KEY);
    $iv = substr(hash('sha256', 'encryption_iv'), 0, 16);
    return openssl_encrypt($data, ENCRYPTION_METHOD, $key, 0, $iv);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check for SQL injection patterns
    if (detect_sql_injection($email) || detect_sql_injection($password)) {
        echo "SQL Injection detected!";
        exit();
    }

    // Encrypt the entered email to match the stored encrypted email
    $encryptedEmail = encryptData($email);

    // Prepare a statement to fetch the user with the provided encrypted email
    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $encryptedEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify the password using password_verify
        if (password_verify($password, $user['password'])) {
            // Successful login, set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            
            // Redirect if a stored redirect URL exists
            if (isset($_SESSION['redirect_url'])) {
                $redirect_url = $_SESSION['redirect_url'];
                unset($_SESSION['redirect_url']);
                header("Location: $redirect_url");
            } else {
                header("Location: services.php");
            }
            exit();
        } else {
            echo "Invalid password. Please try again.";
        }
    } else {
        echo "No account found with that email. Please register first.";
    }

    $stmt->close();
    $conn->close();
}
?>
