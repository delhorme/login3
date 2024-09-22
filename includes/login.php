<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Démarrer la session si ce n'est déjà fait

}

// Vérifiez si le formulaire a été soumis

if (isset($_POST['formsend'])) {
    // Récupérer et découper les données du formulaire

    $email = trim($_POST['lemail']);
    $password = trim($_POST['lpassword']);

    // Vérifiez que les champs ne sont pas vides

    if (!empty($email) && !empty($password)) {
        
        // Valider le format de l'e-mail

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format.";
            exit();
        }

        try {
            require 'includes/database.php'; // Assurez-vous que la connexion à la base de données est établie

        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }

        // Préparer une requête pour vérifier les informations utilisateur

        $query = $db->prepare("SELECT * FROM users WHERE email = :email");
        $query->execute(['email' => $email]);
        $user = $query->fetch();

        // Vérifiez si l'utilisateur existe et vérifiez le mot de passe

        if ($user && password_verify($password, $user['password'])) {
            // Utilisateur authentifié

            $_SESSION['user_id'] = $user['id']; // Stocker l'ID utilisateur en session

            header("Location: page1.php"); // Rediriger vers la page 1

            exit();
        }

        // Afficher un message d'erreur générique

        echo "Invalid email or password.";
    } else {
        echo "Please fill in all fields.";
    }
}
?>
