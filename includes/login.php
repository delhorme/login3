<?php
// Start the session if it hasn't been started yet
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the form has been submitted
if (isset($_POST['formsend'])) {
    // Retrieve and sanitize form data
    $email = filter_var(trim($_POST['lemail']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['lpassword']);

    // Check that the email and password fields are not empty
    if (!empty($email) && !empty($password)) {
        
        // Validate the email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format.";
            exit();
        }

        // Include database connection
        require 'includes/database.php';

        try {
            // Prepare a query to check user credentials
            $query = $db->prepare("SELECT * FROM users WHERE email = :email");
            $query->execute(['email' => $email]);
            $user = $query->fetch();

            // Verify if the user exists and check the password
            if ($user && password_verify($password, $user['password'])) {
                // User authenticated
                $_SESSION['user_id'] = $user['id']; // Store user ID in session
                header("Location: page1.php"); // Redirect to page 1
                exit();
            } else {
                // Show an error message if the email or password is incorrect
                echo "Invalid email or password.";
            }
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    } else {
        echo "Please fill in all fields.";
    }
}
?>
