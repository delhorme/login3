
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
        $q = $db->prepare("SELECT * FROM user WHERE email = :email");
        $q->execute(['email' => $email]);
        $user = $q->fetch();

        // Si un utilisateur est trouvé, vérifier le mot de passe
        if ($user && password_verify($password, $user['password'])) {
            // Les identifiants sont corrects, on stocke l'utilisateur en session
            $_SESSION['user'] = $user['email'];

            // Redirection vers page1.php
            header('Location: https://sitedetest.store/page1.php');
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
