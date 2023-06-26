<?php
session_start();
include_once '../pages/header.php';
require('config.php');



if(isset($_POST["lastname"])){

$req=$DB->prepare("INSERT INTO utilisateurs(username, password, type, prenom, nom, ddn) VALUES(:username, :password, :type, :prenom, :nom, :ddn)");
$req->execute(array(
  "username" => $_POST['username'],
  "password" => md5('1234'),
  "type" => "client",
  "nom" => $_POST['lastname'],
  "prenom" => $_POST['name'],
  "ddn" => "1946-03-06"
));

$_SESSION["user_type"] = 'client';
header ("location:../pages/boutique.php");


}



?>


<body class="div_login">

<h1 class="h1_login">Confiz</h1>

<div class="div_form_login">
  <h2 class="p_centrer h2_login">S'inscrire :</h2>

  <form class="box" action="<?php $_SERVER["PHP_SELF"];?>" method="post" name="login">

  	<h2 class="box-title">Nom :</h2>
  	<input type="text" class="box-input" name="lastname" value="" placeholder="Nom" required>

    <h2 class="box-title">Prénom :</h2>
    <input type="text" class="box-input" name="name" value="" placeholder="Prénom" required>

    <h2 class="box-title">Nom d'utilisateur :</h2>
    <input type="text" class="box-input" name="username" value="" placeholder="Nom d'utilisateur" required>

  	<input type="submit" value="S'inscrire" name="submit" class="btn btn_rose btn_moyen btn_centre_login">

  	<a class="lien_subscribe" href="login.php">Déjà un compte ? Connectez-vous</a>

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
