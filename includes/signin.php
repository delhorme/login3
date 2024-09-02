<?php

if (isset($_POST['formsend'])) {

    extract($_POST);

    if (!empty($password) && !empty($cpassword) && !empty($semail)) {

        if ($password == $cpassword) {

            $options = [
                'cost' => 12,
            ];

            $hashpass = password_hash($password, PASSWORD_BCRYPT, $options);

            $c = $db->prepare("SELECT email FROM users WHERE email = :email");
            $c->execute([
                'email' => $semail
            ]);
            $result = $c->rowCount();

             echo $result;

            if ($result == 0) {
                $q = $db->prepare("INSERT INTO users (email,password) VALUES(:email,:password)");
                $q->execute([
                    'email' => $semail,
                    'password'  => $hashpass
                ]);
                echo "Le compte a été créé";
            } else {
                echo "erreur";
            }
        }

    } else {
        echo "Le compte a été créé";

    }
}

?>