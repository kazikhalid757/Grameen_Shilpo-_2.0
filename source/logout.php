<?php
session_start(); // Starts the session
session_destroy(); // Destroys the session, effectively logging the user out
header("Location: ../login-system/admin_login.php"); // Redirects the user to the login page
exit(); // Ensures the script stops executing after the redirect
?>
