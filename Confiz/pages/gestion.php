<?php
session_start();
include_once 'header.php';
include_once 'nav.php';
require("../login/config.php");


if(isset($_POST["id_user"])){
  $id_user = $_POST["id_user"];
  $req = 'UPDATE utilisateurs SET type = REPLACE(type, "client", "gerant") WHERE id = '. $id_user;
  $req = db_query($req);
}


?>


<a href="boutique.php" class="btn btn_rose btn_moyen btn_retour">
     <img src="../assets/images/chevron.png" class="chevron"/>
     Retour
 </a>


<?php
if($_SESSION["user_type"]=='gerant'){
  ?>

<h1 class="h1_titre_page">Gestion des droits</h1>


<?php

$users = 'SELECT id, username, type, nom, prenom FROM utilisateurs';
$users = db_query($users);


?>
<table class="table_gestion">

  <tr>
    <th>Username</th>
    <th>Type</th>
    <th>Nom</th>
    <th>Prénom</th>
    <th>Action</th>
  </tr>

<?php
foreach ($users as $user) {
?>

  <tr>
    <td> <?= $user["username"]; ?> </td>
    <td> <?= $user["type"]; ?> </td>
    <td> <?= $user["nom"]; ?> </td>
    <td> <?= $user["prenom"]; ?> </td>
    <td>

<?php
if($user["type"] == 'client'){
  ?>

<form method="post" action="<?php $_SERVER["PHP_SELF"];?>">
  <input type="hidden" value="<?= $user["username"];?>" name="username_user"/>
  <input type="hidden" value="<?= $user["id"];?>" name="id_user"/>
  <button type="submit" name="btn_promouvoir" class="add_del">Promouvoir en gérant</button>
</form>

<?php
}
?>

     </td>
  <tr>

<?php
}


 ?>

<table>

<?php
}


if($_SESSION["user_type"]=='client'){
  echo "<p class='texte_pas_acces'> Vous n'avez pas les droits pour accéder à cette page.</p>";
}

?>




<?php
include_once 'footer.php';
 ?>
