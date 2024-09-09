<?php
session_start(); // Démarrer la session pour l'utilisateur

// Vérifier si le formulaire de connexion a été soumis
if (isset($_POST['formlogin'])) {

    // Récupérer les valeurs envoyées depuis le formulaire
    $email = htmlspecialchars($_POST['lemail']);
    $password = htmlspecialchars($_POST['lpassword']);

    // Vérifier que les champs ne sont pas vides
    if (!empty($email) && !empty($password)) {

        // Connexion à la base de données
        include 'database.php';
        global $db;

        // Préparer la requête pour récupérer l'utilisateur
        $q = $db->prepare("SELECT * FROM users WHERE email = :email");
        $q->execute(['email' => $email]);
        $user = $q->fetch();

        // Si un utilisateur est trouvé, vérifier le mot de passe
        if ($user && password_verify($password, $user['password'])) {
            // Les identifiants sont corrects, on stocke l'utilisateur en session
            $_SESSION['user'] = $user['email'];

            // Redirection vers page1.php
            header('Location: ../page1.php');
            exit();
        } else {
            // Si les identifiants sont incorrects, afficher un message d'erreur
            echo "Email ou mot de passe incorrect.";
        }

    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
?>

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


