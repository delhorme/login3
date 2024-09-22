<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['formsend'])) {
    $semail = $_POST['semail'] ?? '';
    $password = $_POST['password'] ?? '';
    $cpassword = $_POST['cpassword'] ?? '';

    // Check if inputs are not empty
    if (!empty($password) && !empty($cpassword) && !empty($semail)) {
        if ($password === $cpassword) {
            // Hash the password
            $hashpass = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

            // Check if email already exists
            $stmt = $db->prepare("SELECT email FROM users WHERE email = :email");
            $stmt->execute(['email' => $semail]);

            if ($stmt->rowCount() === 0) {
                // Insert new user
                $stmt = $db->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
                $stmt->execute([
                    'email' => $semail,
                    'password' => $hashpass
                ]);
                echo "Le compte a été créé"; // Account created message
            } else {
                echo "L'email est déjà utilisé"; // Email in use message
            }
        } else {
            echo "Les mots de passe ne correspondent pas"; // Passwords do not match message
        }
    } else {
        echo "Tous les champs sont requis"; // All fields required message
    }
} else {
    header('Location: page1.php');
    exit;
}

?>
