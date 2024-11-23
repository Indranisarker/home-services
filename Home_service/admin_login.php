<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Admin Login - Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- Navigation Bar -->
<nav class="navbar">
    <div class="nav-brand">HomeService</div>
    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="user-login.php">Login</a>
        <a href="user-signup.php">Sign Up</a>
        <a href="about-us">About Us</a>
    </div>
</nav>
<header class="page-header">
    <h1>HomeService - Admin Login</h1>
</header>
<div class="container">
<section class="customization-section">
    <form action="Admin_loginDB.php" method="POST">
        <!-- Name field -->
        <label for="name">Email:</label>
        <input type="text" name="email" id="email" placeholder="Enter your Email" required>

        <!-- Mobile or Email field -->
        <label for="contact">Password:</label>
        <input type="password" name="password" id="password" placeholder="Enter your password" required>
        
        <!-- Submit button -->
         <div class="button-container">
        <input type="submit" value="Login" class="sign-in-btn" style="width:40%; margin-left:210px">
         </div>
    </form>
</section>
    </section>
</div>
<footer style="margin-top: 160px;">
    <p>Contact us at support@homeservice.com | Call: +123 456 7890</p>
</footer>
</body>
</html>
