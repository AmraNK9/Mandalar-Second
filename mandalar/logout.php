<?php

session_start();

// Destroy the session
session_unset();
session_destroy();

// Redirect to home.php or any other desired page
header("Location:Home.php");
exit;


?>
