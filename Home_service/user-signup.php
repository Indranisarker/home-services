<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomeService App - Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
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
    <h1>HomeService - Sign Up</h1>
</header>

<div class="container">
<section class="customization-section">
    <form action="register.php" method="POST">
        <!-- Name field -->
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" placeholder="Enter your name" required>

		<label for="name">Age:</label>
        <input type="text" name="age" id="age" placeholder="Enter your age" required>

		<label for="name">Phone No:</label>
        <input type="text" name="mobile" id="mobile" placeholder="Enter your phone number" required>

		<label for="name">Email:</label>
        <input type="email" name="email" id="email" placeholder="Enter your email address" required>

		<label for="name">Country of Citizenship:</label>
        <input type="text" name="citizenship" id="citizenship" placeholder="Enter your citizenship" required>

		<label for="service-type">Covid-19 vaccinated:</label>
        <select name="service-type" id="service-type" required>
            <option value="isolation">Select a option</option>
            <option value="tracing">Yes</option>
            <option value="sanitization">No</option>
        </select>

		<label for="name">Profession:</label>
        <input type="text" name="profession" id="profession" placeholder="Enter your profession" required>

		<label for="name">Language Prefered:</label>
        <input type="text" name="language" id="language" placeholder="Enter your prefered language" required>
		
        <!-- Mobile or Email field -->
        <label for="contact">Set a Password:</label>
        <input type="password" name="password" id="password" placeholder="Enter your password" required>
		
        <!-- Submit button -->
        <div class="button-container">
        <input type="submit" value="Sign Up" class="sign-in-btn" style="margin-right: 310px;margin-left:0">
        <p class="text-right"> Already Registered? <a href="user-login.php"> Login </a></p>
         </div>
    </form>
</section>

    </section>
</div>


</body>
<footer>
    <p>Contact us at support@homeservice.com | Call: +123 456 7890</p>
</footer>
</html>
