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
                $_SESSION['date'] = $result['date'];

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
