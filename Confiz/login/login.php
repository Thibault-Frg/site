<?php
session_start();
include_once '../pages/header.php';
require('config.php');



if (isset($_POST['username'])){
	$username = ($_POST['username']);
	$_SESSION['username'] = $username;
	$password = ($_POST['password']);
	$query = "SELECT * FROM `utilisateurs` WHERE username='$username' and password='".md5($password)."'";
	$result = db_query($query);

	 // or die(mysql_error())

	if (count($result) == 1) {
		$user = $result;
		// vérifier si l'utilisateur est un administrateur ou un utilisateur
		if ($user[0]['type'] == 'gerant') {
			$_SESSION["user_type"] = 'gerant';
			header('location: ../pages/boutique.php');
		}else if ($user[0]['type'] == 'client'){
			$_SESSION["user_type"] = 'client';
			header('location: ../pages/boutique.php');
		}
	}else{
		?>
		<script>
alert("Le nom d'utilisateur ou le mot de passe que vous avez saisi est incorrect.");
		</script>
		<?php
	}
}


?>

<body class="div_login">

<h1 class="h1_login">Confiz</h1>

<div class="div_form_login">
	<h2 class="p_centrer h2_login">Se connecter :</h2>
<form class="box" action="<?php $_SERVER["PHP_SELF"];?>" method="post" name="login">
	<h2 class="box-title">Nom d'utilisateur :</h2>
	<input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur">

	<h2 class="box-title">Mot de passe :</h2>
	<input type="password" class="box-input" name="password" placeholder="Mot de passe">

	<input type="submit" value="Connexion " name="submit" class="btn btn_rose btn_moyen btn_centre_login">

	<a class="lien_subscribe" href="subscribe.php">Pas de compte ? Inscrivez-vous</a>

	<?php if (! empty($message)) { ?>
	    <p class="errorMessage"><?php echo $message; ?></p>
	<?php
			}
	?>
</form>
</div>


</body>

<?php
include_once '../pages/footer.php';
 ?>
