<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>HomeService App - Login</title>
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
        <a href="about-us.php">About Us</a>
    </div>
</nav>
<header class="page-header">
    <h1>HomeService - Login</h1>
</header>
<?php
session_start();
?>


<div class="container">
<section class="customization-section">
    <form action="login.php" method="POST">
        <!-- Name field -->
        <label for="name">UserName:</label>
        <input type="text" name="email" id="email" placeholder="Enter your username" required>

        <!-- Mobile or Email field -->
        <label for="contact">Password:</label>
        <input type="password" name="password" id="password" placeholder="Enter your password" required>
        
        <!-- Submit button -->
         <div class="button-container">
        <input type="submit" value="Login" class="sign-in-btn">
        <p style="text-align: center; margin: 10px">Or</p>
    <a href="#"class="google-btn" >
                    <img src="images/google.jpg" alt="Google Logo" width="20" height="21" style="border-radius: 40px"> Login with Google
    </a>
         </div>
         <p class="text-center"> Not Registered Yet? <a href="user-signup.php"> Sign Up </a></p>
    </form>
</section>
</div>
<footer style="margin-top: 160px;">
    <p>Contact us at support@homeservice.com | Call: +123 456 7890</p>
</footer>
</body>
</html>
