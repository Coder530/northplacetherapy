<?php
// process-online-contact.php
session_start();

// Database configuration
$db_host = 'localhost';
$db_user = 'thecoder530';
$db_pass = 'Jsckike123@gmail.com'; // CHANGE THIS!
$db_name = 'contact_data';

// Initialize response
$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate inputs
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    // Basic validation
    if (empty($name) || empty($email) || empty($message)) {
        $_SESSION['contact_error'] = 'All fields are required.';
        header('Location: online.php');
        exit;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['contact_error'] = 'Please provide a valid email address.';
        header('Location: online.php');
        exit;
    }
    
    // Connect to database
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    
    if ($conn->connect_error) {
        error_log("Database connection failed: " . $conn->connect_error);
        $_SESSION['contact_error'] = 'Sorry, there was a technical issue. Please try again later or email directly.';
        header('Location: online.php');
        exit;
    }
    
    // Prepare and execute insert
    $stmt = $conn->prepare("INSERT INTO online_enquiries (name, email, message) VALUES (?, ?, ?)");
    
    if ($stmt) {
        $stmt->bind_param("sss", $name, $email, $message);
        
        if ($stmt->execute()) {
            $_SESSION['contact_success'] = 'Thank you for your enquiry. We will get back to you within 2-3 days.';
            
            // Optional: Send email notification to admin
            $to = 'nick@northplacetherapy.com';
            $subject = 'New Online Therapy Enquiry from ' . $name;
            $email_message = "Name: $name\nEmail: $email\n\nMessage:\n$message";
            $headers = "From: noreply@northplacetherapy.com\r\n";
            $headers .= "Reply-To: $email\r\n";
            
            mail($to, $subject, $email_message, $headers);
        } else {
            error_log("Database insert failed: " . $stmt->error);
            $_SESSION['contact_error'] = 'Sorry, there was an issue submitting your enquiry. Please email us directly.';
        }
        
        $stmt->close();
    } else {
        error_log("Statement preparation failed: " . $conn->error);
        $_SESSION['contact_error'] = 'Sorry, there was a technical issue. Please email us directly.';
    }
    
    $conn->close();
    
} else {
    $_SESSION['contact_error'] = 'Invalid request method.';
}

header('Location: online.php');
exit;
?>