<?php
session_start();
session_unset();  // Clear session variables
session_destroy();  // Destroy the session
header("Location: login/login.php");  // Redirect to login page
exit();  // Ensure no further code is executed
?>
