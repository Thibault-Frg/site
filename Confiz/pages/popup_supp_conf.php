<?php
session_start();
include_once 'header.php';
require("../login/config.php");


if(isset($_POST["id_confiserie"])){
  $id_conf = $_POST["id_confiserie"];

//  $conf = 'SELECT * FROM `stocks` JOIN `confiseries` ON stocks.confiserie_id = confiseries.confiserie_id WHERE confiserie_id='.$id_conf;
  $conf = 'SELECT * FROM `confiseries` WHERE confiserie_id='.$id_conf;
  $confiseries = db_query($conf);

?>

<div class="espace_haut">
  <a onclick="history.go(-1)" class="btn btn_rose btn_moyen btn_retour espace_haut">
       <img src="../assets/images/chevron.png" class="chevron"/>
       Retour
   </a>
</div>

<?php

foreach ($confiseries as $confiserie){
 echo '<h1 class="h1_titre_page">Voulez-vous vraiment supprimer la confiserie "'. $confiserie["nom"].'" ?</h1>';
  //  echo '<h1 class="h1_titre_page">Voulez-vous vraiment supprimer la confiserie ?</h1>';
}


 ?>

  <p class="p_centrer p_largeur">Attention, cela supprimera <strong>définitivement</strong> cette confiserie dans tous les magasins. Tous les stocks liés à cette confiserie seront également supprimés.</p>


<div class="div_btn_supp">
 <form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
   <input type="hidden" name="id_conf_suppr" value="<?php echo $_POST["id_confiserie"]; ?>"/>
   <button type="submit" class="btn btn_rose btn_moyen">Oui</button>
 </form>

 <button type="submit" class="btn btn_rose btn_moyen" onclick="history.go(-1)">Non</button>
</div>


<?php

}


if(isset($_POST["id_conf_suppr"])){
  $suppr_conf = 'DELETE FROM `confiseries` WHERE confiserie_id='.$_POST["id_conf_suppr"];
  db_query($suppr_conf);
  $suppr_stock = 'DELETE FROM `stocks`WHERE confiserie_id='.$_POST["id_conf_suppr"];
  db_query($suppr_stock);

  header("location:catalogue.php");
}


include_once 'footer.php';
 ?>
