<!DOCTYPE html>
<html>

<head>
<title>Horizal - Modural</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>

<body>


    <!-- <form method="post">
        <input type="email" name="email" id="email" placeholder="Votre Email" required><br />
        <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe" required><br />
        <input type="password" name="cpassword" id="cpassword" placeholder="Confirmez votre mot de passe" required><br />
        <input type="submit" name="formsend" id="formsend" value="Ok">
    </form> -->

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form p-l-55 p-r-55 p-t-178">
					<span class="login100-form-title">
						Horizal - Garde corps
					</span>

					<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter username">
						<input class="input100" type="text" name="username" placeholder="Nom d'utilisateur">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Please enter password">
						<input class="input100" type="password" name="pass" placeholder="Mot de passe">
						<span class="focus-input100"></span>
					</div>

					<div class="text-right p-t-13 p-b-23">
						<span class="txt1">
							Vous avez oublié vos
						</span>

						<a href="compte.php" class="txt2">
							Nom d'utilisateur / Mot de passe ?
						</a>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Se connecter
						</button>
					</div>

					<div class="flex-col-c p-t-170 p-b-40">
						<span class="txt1 p-b-9">
							Vous n'avez pas de compte ?
						</span>

						<a href="compte.php" class="txt3">
							S'inscrire maintenant
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

    <?php

    if (isset($_POST['formsend'])) {

        extract($_POST);

        if (!empty($password) && !empty($cpassword) && !empty($email)) {

            if ($password == $cpassword) {
                $options = [
                    'cost' => 12,
                ];

                $hashpass = password_hash($password, PASSWORD_BCRYPT, $options);

                include 'includes/database.php';
                global $db;

                $q=$db->prepare("INSERT INTO users (email,password) VALUES(:email,:password)");
                $q->execute([
                    'email'=> $email,
                    'password'  => $hashpass
                
                ]);


            }

            // if (password_verify($password, $hashpass)) {
            //     echo "le mot de passe est le même";
            // } else {
            //     echo "le mot de passe est différent";
            // }
        } else {
            echo "les champs ne sont pas tous remplis";
        }
    }

    ?>

</body>

</html>