<?php

if (isset($_POST['formlogin'])) {
    extract($_POST);

    if (!empty($lemail) && !empty($lpassword)) {

        $q = $db->prepare("SELECT * FROM users WHERE email = :email");
        $q->execute(['email' => $lemail]);
        $result = $q->fetch();

        if ($result == TRUE) {
            //le compte existe bien

            if (password_verify($lpassword, $result['password'])) {
                echo "Le mot de passe est bon, connexion en cours";
                $_SESSION['email'] = $result['email'];
                $_SESSION['password'] = $result['password'];

            } else {
                echo "Le mot de passe n'est pas correct";
            }
        } else {
            echo "Le compte portant l'email " . $lemail . " n'existe pas";
        }
    } else {
        echo "Veuillez compléter l'ensemble des champs";
    }
}
<?php
session_start(); // Démarre une session

// Vérifier si le formulaire a été soumis
if (isset($_POST['formlogin'])) {

    // Récupérer les valeurs du formulaire
    $email = htmlspecialchars($_POST['lemail']);
    $password = htmlspecialchars($_POST['lpassword']);

    // Vérifier que les champs ne sont pas vides
    if (!empty($email) && !empty($password)) {
        
        // Inclure le fichier de connexion à la base de données
        include 'database.php';
        global $db;

        // Préparer et exécuter la requête pour vérifier l'utilisateur
        $q = $db->prepare("SELECT * FROM users WHERE email = :email");
        $q->execute(['email' => $email]);
        $user = $q->fetch();

        // Si un utilisateur est trouvé, vérifier le mot de passe
        if ($user && password_verify($password, $user['password'])) {
            // Le mot de passe est correct, démarrer une session utilisateur
            $_SESSION['user'] = $user['email'];

            // Redirection vers la page1.php
            header('Location: ../page1.php');
            exit();
        } else {
            // Mauvais identifiants
            echo "Email ou mot de passe incorrect.";
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
?>
