<!DOCTYPE html>
<html>

<head>
	<title>Test - Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
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

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form p-l-55 p-r-55 p-t-178">
					<span class="login100-form-title">
						Test - Garde corps
					</span>

					<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter username">
						<!-- <input class="input100" type="text" name="username" placeholder="Nom d'utilisateur"> -->
						<input class="input100" type="email" name="email" id="email" placeholder="Votre Email" required>
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter password">
						<!-- <input class="input100" type="password" name="pass" placeholder="Mot de passe"> -->
						<input class="input100" type="password" name="password" id="password"
							placeholder="Entrez votre mot de passe" required>
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter password">
						<!-- <input class="input100" type="password" name="pass" placeholder="Mot de passe"> -->
						<input class="input100" type="password" name="cpassword" id="cpassword"
							placeholder="Confirmez votre mot de passe" required>
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn">
						<input class="login100-form-btn m-b-16" type="submit" name="formsend" id="formsend" value="Ok">
					</div>

					<div class="flex-col-c p-t-170 p-b-30">
						<span class="txt1 p-b-9">
							Déja un compte ?
						</span>

						<a href="index.php" class="txt3">
							Retour à la page de connexion
						</a>
					</div>
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

				$q = $db->prepare("INSERT INTO users (email,password) VALUES(:email,:password)");
				$q->execute([
					'email' => $email,
					'password' => $hashpass

				]);


			}

		} else {
			echo "les champs ne sont pas tous remplis";
		}
	}

	?>

</body>

</html>