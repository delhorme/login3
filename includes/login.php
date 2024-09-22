<?php
session_start(); // Démarrer la session pour l'utilisateur


// Vérifiez si le formulaire a été soumis

if (isset($_POST['formsend'])) {
    // Récupérer les données du formulaire

    $email = trim($_POST['lemail']);
    $password = trim($_POST['lpassword']);

    // Vérifiez que les champs ne sont pas vides

    if (!empty($email) && !empty($password)) {
        require 'includes/database.php'; // Utilisez require pour vous assurer que le fichier est inclus


        // Préparer une requête pour vérifier les informations utilisateur

        $query = $db->prepare("SELECT * FROM users WHERE email = :email");
        $query->execute(['email' => $email]);
        $user = $query->fetch();

        // Vérifier si l'utilisateur existe

        if ($user && password_verify($password, $user['password'])) {
            // Le mot de passe est correct, l'utilisateur est authentifié

            $_SESSION['user_id'] = $user['id']; // Stocker l'ID utilisateur en session

            header("Location: page1.php"); // Rediriger vers la page 1

            exit();
        }

        // Afficher les messages d'erreur

        $errorMessage = $user ? "Incorrect password." : "No user found with this email.";
        echo $errorMessage;
    } else {
        echo "Please fill in all fields.";
    }
}
?>
