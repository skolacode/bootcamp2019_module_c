<?php
session_start();

// Unset all of the session variables
session_unset();

// Destroy the session data that is currently stored on the server
session_destroy();

// Redirect the user to the login page
header('Location: login.php');
exit;
?>
