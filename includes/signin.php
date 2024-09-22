<?php

if (isset($_POST['formsend'])) {
    // Using filter_input for better security
    $semail = filter_input(INPUT_POST, 'semail', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password');
    $cpassword = filter_input(INPUT_POST, 'cpassword');

    // Check if necessary fields are filled
    if ($password && $cpassword && $semail) {
        if ($password === $cpassword) {
            // Secure password hashing with cost
            $hashpass = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

            // Prepared statement to check existing email
            $query = $db->prepare("SELECT email FROM users WHERE email = :email");
            $query->execute(['email' => $semail]);

            if ($query->rowCount() === 0) {
                // Prepared statement to insert new user
                $insertQuery = $db->prepare("INSERT INTO users (email, password) VALUES(:email, :password)");
                $insertQuery->execute(['email' => $semail, 'password' => $hashpass]);
                echo "Le compte a été créé";
            } else {
                echo "Erreur: l'adresse e-mail existe déjà.";  
            }
        } else {
            echo "Les mots de passe ne correspondent pas.";
        }
    } else {
        echo "Veuillez remplir tous les champs requis.";
    }
} else {
    header('Location: index.php');
    exit;
}

?>
