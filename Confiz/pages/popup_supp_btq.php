<?php
session_start();
include_once 'header.php';
require("../login/config.php");


if(isset($_POST["id_boutique"])){
  $id_boutique = $_POST["id_boutique"];


  $bout = 'SELECT * FROM `boutiques` JOIN `adresses` ON boutiques.adresse_id = adresses.adresse_id WHERE boutique_id =' . $id_boutique;
  $boutiques = db_query($bout);


?>

<div class="espace_haut">
  <a onclick="history.go(-1)" class="btn btn_rose btn_moyen btn_retour espace_haut">
       <img src="../assets/images/chevron.png" class="chevron"/>
       Retour
   </a>
</div>

<?php

  foreach ($boutiques as $boutique){
    echo "<h1 class='h1_titre_page'>Voulez-vous vraiment supprimer ". $boutique['nom']." ?</h1>";
    echo "<p class='text_info p_centrer'>Adresse : ". $boutique['numero_rue'] . " " . $boutique['nom_adresse'] . " " . $boutique['code_postal'] . " " . $boutique['ville'] ."</p>";
    $id_adresse=$boutique['adresse_id'];
  }

 ?>


<div class="div_btn_supp">
 <form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
   <input type="hidden" name="choix_supp" value="<?php echo $id_boutique; ?>"/>
   <input type="hidden" name="id_adresse_suppr" value="<?php echo $id_adresse; ?>"/>
   <button type="submit" class="btn btn_rose btn_moyen">Oui</button>
 </form>

<button type="submit" class="btn btn_rose btn_moyen" onclick="history.go(-1)">Non</button>
</div>


<?php

}

if(isset($_POST["choix_supp"])){
  $suppr_adresse = 'DELETE FROM `adresses` WHERE adresse_id='.$_POST["id_adresse_suppr"];
  db_query($suppr_adresse);
  $suppr_stock = 'DELETE FROM `stocks` WHERE boutique_id='.$_POST["choix_supp"];
  db_query($suppr_stock);
  $suppr_boutique = 'DELETE FROM `boutiques` WHERE boutique_id='.$_POST["choix_supp"];
  db_query($suppr_boutique);

  header("location:boutique.php");

}


include_once 'footer.php';
 ?>
