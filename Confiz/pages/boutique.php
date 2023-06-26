<?php
session_start();
include_once 'header.php';
include_once 'nav.php';
require("../login/config.php");

if (isset($_POST["session_boutique"])){
  $_SESSION["id_boutique_encours"]=$_POST["session_boutique"];
  header('location:catalogue.php');
}

 ?>

<h1 class="h1_titre_page">Boutiques</h1>

<?php
if($_SESSION["user_type"] == 'gerant'){
  ?> <a class="btn btn_rose btn_moyen btn_ajout_btq" href="../boutique/form_boutique.php">Ajouter une boutique</a> <?php
}
?>

<h3 class="h3_titre_page h3_gauche">Boutiques actuelles :</h3>



<div class="layout_cartes_test">


<?php

  $bout = 'SELECT * FROM `boutiques` JOIN `adresses` ON boutiques.adresse_id = adresses.adresse_id';
  $boutiques = db_query($bout);


  foreach ($boutiques as $boutique) {


    ?>
    <div class="div_carte">

      <?php  if($_SESSION["user_type"] == 'gerant'){ ?>
      <form method="post" action ="popup_supp_btq.php">
        <input type="hidden" name="id_boutique" value="<?php echo $boutique['boutique_id']; ?>"/>
        <button type="submit" class="button_poubelle"><img class="img_poubelle" src="../assets/images/icone_poubelle.svg" alt="image poubelle"/></button>
      </form>
    <?php  } ?>

      <br>
      <img class="img_carte" src="../assets/images/icone_boutique.svg" alt="image d'une boutique"/>
      <h3 class="titre_carte"><?php echo $boutique['nom'] ?></h3>
      <p class="texte_info"><?php echo $boutique['numero_rue'] . " " . $boutique['nom_adresse'] . " <br> " . $boutique['code_postal'] . " " . $boutique['ville'] ?></p>

      <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" class="btn_centre">
        <input type="hidden" value="<?php echo $boutique['boutique_id']; ?>" name="session_boutique"/>
        <button type="submit" class="btn btn_rose btn_petit">Voir le catalogue</button>
      </form>
    </div>

<?php
}
 ?>




</div>




 <?php include_once 'footer.php'; ?>
