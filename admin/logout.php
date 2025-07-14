<?php
session_start();
$_SESSION = [];         // Clear all session variables
session_unset();        // Unset session
session_destroy();      // Destroy session

// Avoid redirect caching
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 1 Jan 2000 00:00:00 GMT");

// Redirect to main homepage
header("Location: ../index.html");
exit();
