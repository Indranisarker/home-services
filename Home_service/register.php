<?php
// Include the database connection
include 'DBconnect.php';

// Define the encryption key and method (keep this key secret!)
define('ENCRYPTION_KEY', 'secret_key_012345'); // Change this to a strong, secure key
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
    $iv = substr(hash('sha256', 'encryption_iv'), 0, 16); // Initialization vector
    return openssl_encrypt($data, ENCRYPTION_METHOD, $key, 0, $iv);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'] ?? "--";
    $age = $_POST['age'] ?? "--";
    $mobile = $_POST['mobile'] ?? "--";
    $email = $_POST['email'] ?? "--";
    $citizenship = $_POST['citizenship'] ?? "--";
    $vaccinated = ($_POST['service-type'] == 'tracing') ? 'Yes' : 'No';
    $profession = $_POST['profession'] ?? "--";
    $language = $_POST['language'] ?? "--";
    $password = $_POST['password'] ?? "--";

    // Check for SQL injection patterns in each input
    $inputs = [$name, $age, $mobile, $email, $citizenship, $profession, $language, $password];
    foreach ($inputs as $input) {
        if (detect_sql_injection($input)) {
            echo "SQL Injection detected!";
            exit();
        }
    }

    // Encrypt the mobile number and email after validation
    $encryptedMobile = encryptData($mobile);
    $encryptedEmail = encryptData($email);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password

    // Prepare and execute the SQL query for user registration
    $stmt = $conn->prepare("INSERT INTO users (name, age, mobile, email, citizenship, vaccinated, profession, language, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisssssss", $name, $age, $encryptedMobile, $encryptedEmail, $citizenship, $vaccinated, $profession, $language, $hashedPassword);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();

    // Prepare the pending request insertion
    $username = $name;
    $address = $_POST['address'] ?? "--";
    $phoneNumber = $encryptedMobile ?? "--";
    $pending = "True";
    $covidInfected = $_POST['covidInfected'] ?? "--";
    $other = $_POST['other'] ?? "--";
    $phone = $encryptedMobile ?? "--";

    // Insert into pending_requests table
    $stmt = $conn->prepare("INSERT INTO pending_requests (Username, Email, Address, Phone_Number, Pending, Covid_vaccine_status, Covid_infected, Other, Phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $username, $encryptedEmail, $address, $phoneNumber, $pending, $vaccinated, $covidInfected, $other, $phone);

    if ($stmt->execute()) {
        echo "Pending request submitted successfully!";
        header("Location: user-login.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the connection
    $stmt->close();
    $conn->close();
}
?>
