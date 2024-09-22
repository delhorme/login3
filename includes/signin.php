<?php

if (isset($_POST['formsend'])) {

    $semail = $_POST['semail'] ?? null;
    $password = $_POST['password'] ?? null;
    $cpassword = $_POST['cpassword'] ?? null;

    if (empty($semail) || empty($password) || empty($cpassword)) {
        echo "Tous les champs sont requis.";
        exit;
    }

    if ($password !== $cpassword) {
        echo "Les mots de passe ne correspondent pas.";
        exit;
    }

    $options = ['cost' => 12];
    $hashpass = password_hash($password, PASSWORD_BCRYPT, $options);

    try {
        $c = $db->prepare("SELECT email FROM users WHERE email = :email");
        $c->execute(['email' => $semail]);
        $result = $c->rowCount();

        if ($result == 0) {
            $q = $db->prepare("INSERT INTO users (email,password) VALUES(:email,:password)");
            $q->execute(['email' => $semail, 'password' => $hashpass]);
            header('Location: page1.php');
            exit;
        } else {
            echo "Erreur: L'email existe déjà.";
        }
    } catch (PDOException $e) {
        echo "Erreur de base de données: " . $e->getMessage();
    }
}
?>
