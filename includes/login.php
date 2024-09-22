<?php
session_start(); // Démarrer la session pour l'utilisateur
// includes/login.php
if (isset($_POST['formsend'])) {
    // Récupérer les données du formulaire
    $email = $_POST['lemail'];
    $password = $_POST['lpassword'];

    // Vérifiez si les champs ne sont pas vides
    if (!empty($email) && !empty($password)) {
        include 'includes/database.php'; // Inclure la connexion à la base de données

        // Requête pour vérifier les informations de l'utilisateur
        $query = $db->prepare("SELECT * FROM users WHERE email = :email");
        $query->execute(['email' => $email]);
        $user = $query->fetch();

        // Vérifiez si l'utilisateur existe
        if ($user) {
            // Vérifiez le mot de passe
            if (password_verify($password, $user['password'])) {
                // Mot de passe correct, l'utilisateur est authentifié
                // Démarrer la session et rediriger vers page1
                session_start();
                $_SESSION['user_id'] = $user['id']; // Assurez-vous d'avoir un champ ID dans votre table users
                header("Location: page1.php"); // Redirige vers la page1
                exit();
            } else {
                echo "Mot de passe incorrect.";
            }
        } else {
            echo "Aucun utilisateur trouvé avec cet e-mail.";
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
?>
s