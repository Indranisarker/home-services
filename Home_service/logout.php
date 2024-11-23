<?php
session_start();
session_unset();
session_destroy();

// Invalidate the session cookie
setcookie(session_name(), '', time() - 3600, '/');

// Redirect to login page
header("Location: index.php");
exit();
?>
