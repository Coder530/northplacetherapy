<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'thecoder530'); // Replace with your DB username
define('DB_PASSWORD', 'Jsckike123@gmail.com'); // Replace with your DB password
define('DB_NAME', 'contact_data');     // As per your provided schema

/* Attempt to connect to MySQL database */
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($mysqli === false){
    // Don't die loudly in production, but useful for development
    // die("ERROR: Could not connect. " . $mysqli->connect_error);
    // For now, let's store a generic error and allow scripts to handle it
    $_SESSION['form_status'] = 'error';
    $_SESSION['form_message'] = 'Error: Database connection failed. Please try again later.';
    // Potentially redirect or include an error display logic here if not handled by calling script
    // header("location: contact.php"); // Example redirect
    // exit;
}

// Set charset to utf8mb4 for full Unicode support
$mysqli->set_charset("utf8mb4");
?>
