<?php
if (isset($_POST['formsend'])) {
    extract($_POST);

    // Vérification si tous les champs sont remplis
    if (!empty($password) && !empty($cpassword) && !empty($email)) {

        // Vérification si les mots de passe correspondent
        if ($password == $cpassword) {
            $options = [
                'cost' => 12,
            ];

            // Hashage du mot de passe
            $hashpass = password_hash($password, PASSWORD_BCRYPT, $options);

            // Inclure la connexion à la base de données
            include 'includes/database.php'; // Inclure le fichier de connexion

            // Vérifier si l'email est valide
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "L'email n'est pas valide.";
            } else {
                try {
                    // Vérifier si l'email existe déjà dans la base de données
                    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
                    $stmt->execute(['email' => $email]);
                    $user = $stmt->fetch();

                    if ($user) {
                        echo "Un compte avec cet email existe déjà.";
                    } else {
                        // Insertion de l'utilisateur dans la base de données
                        $q = $db->prepare("INSERT INTO users (email, password) VALUES(:email, :password)");
                        $q->execute([
                            'email' => $email,
                            'password' => $hashpass
                        ]);
                        echo "Inscription réussie !";
                    }
                } catch (PDOException $e) {
                    // En cas d'erreur d'exécution de la requête
                    echo "Erreur lors de l'enregistrement dans la base de données : " . $e->getMessage();
                }
            }
        } else {
            echo "Les mots de passe ne correspondent pas.";
        }

    } else {
        echo "Les champs ne sont pas tous remplis !";
    }
}
?>
