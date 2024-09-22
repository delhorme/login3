<?php
session_start(); // Start session for the user

// Check if form has been submitted
if (isset($_POST['formsend'])) {
    // Retrieve form data
    $email = trim($_POST['lemail']);
    $password = trim($_POST['lpassword']);

    // Validate that fields are not empty
    if (!empty($email) && !empty($password)) {
        require 'includes/database.php'; // Use require to ensure the file is included

        // Prepare query to check user information
        $query = $db->prepare("SELECT * FROM users WHERE email = :email");
        $query->execute(['email' => $email]);
        $user = $query->fetch();

        // Check if user exists
        if ($user && password_verify($password, $user['password'])) {
            // Password is correct, user is authenticated
            $_SESSION['user_id'] = $user['id']; // Store user ID in session
            header("Location: page1.php"); // Redirect to page1
            exit();
        }

        // Display error messages
        $errorMessage = $user ? "Incorrect password." : "No user found with this email.";
        echo $errorMessage;
    } else {
        echo "Please fill in all fields.";
    }
}
?>
