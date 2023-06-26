<?php
session_start();
include_once 'header.php';
include_once 'nav.php';
require("../login/config.php");

$bout = 'SELECT * FROM `boutiques` WHERE boutique_id='.$_SESSION["id_boutique_encours"];
$boutiques = db_query($bout);
 ?>


 <a href="boutique.php" class="btn btn_rose btn_moyen btn_retour">
      <img src="../assets/images/chevron.png" class="chevron"/>
      Retour
  </a>


 <h1 class="h1_titre_page">Catalogue</h1>
 <h2 class="h2_titre_page"><?php echo $boutiques[0]["nom"];?></h2>


  <?php  if($_SESSION["user_type"] == 'gerant'){ ?>
<div class="div_centre">
 <a class="btn btn_rose btn_moyen btn_ajout_conf" href="../boutique/form_bonbon.php">Ajouter un nouveau bonbon</a>
</div>

 <div class="encadre_rose">
   <h3 class="h3_centre">Gérer les stocks :</h3>
   <div class="div_gestion_stock">
     <p class="p_gestion_stock">Ajouter une confiserie :</p>



     <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
        <select name="choix_confiserie" class="btn btn_rose btn_petit espace_droit"><?php
          $conf = 'SELECT * FROM `confiseries`';
          $confiseries = db_query($conf);
          foreach ($confiseries as $confiserie)  {
          ?>
        		<option value="<?php echo $confiserie['confiserie_id']; ?>"><?php echo $confiserie['nom']; ?></option>
        		<?php
        	}
        ?>
        </select>

        <input type="number" id="choix_nbr" name="choix_nbr" class="espace_droit btn btn_rose btn_petit choix_nbr" value="0" min="0"/>

          <button type="submit" class="btn btn_rose btn_petit espace_gauche">Ajouter</button>
     </form>

     <?php } ?>


     <?php
     if (isset($_POST["choix_nbr"])){
       if ($_POST["choix_nbr"]>0){
         for ($i=0 ; $i<$_POST["choix_nbr"]; $i++){
           $req = $DB->prepare("INSERT INTO stocks (date_de_peremption, date_de_mise_en_stock, boutique_id, confiserie_id) VALUES(NOW() + INTERVAL 14 DAY, NOW(),:boutique_id, :confiserie_id)");
           $req->execute(array(
             "boutique_id" => $_SESSION["id_boutique_encours"],
             "confiserie_id"=>$_POST["choix_confiserie"]
           ));
         }
       }
     }

     if(isset($_POST["choix_nbr_supp"])){
       if ($_POST["choix_nbr_supp"]>0){
           $req = $DB->prepare('DELETE FROM stocks WHERE confiserie_id=:confiserie_id AND boutique_id=:boutique_id LIMIT '.$_POST["choix_nbr_supp"]);
           $req->execute(array(
             "boutique_id" => $_SESSION["id_boutique_encours"],
             "confiserie_id"=>$_POST["choix_confiserie_supp"]
           ));
       }
     }

      ?>





   </div>
 </div>

  <h3 class="h3_titre_page">En stock :</h3>
    <div class="layout_cartes_test">

  <?php
    $req_conf = 'SELECT * FROM confiseries GROUP BY confiserie_id';
  $stocks_conf = db_query($req_conf);



  foreach ($stocks_conf as $stock) {
    $req = $DB->query('SELECT COUNT(*) FROM stocks WHERE boutique_id='.$_SESSION["id_boutique_encours"].' AND confiserie_id='.$stock["confiserie_id"]);
    $compteur= 0;
    while ($data = $req->fetch()){
      $compteur= $data[0];
    }


if($compteur > 0){
  ?>



<div class="div_carte">

  <?php  if($_SESSION["user_type"] == 'gerant'){ ?>
    <form method="post" action ="popup_supp_conf.php">
      <input type="hidden" name="id_confiserie" value="<?php echo $stock['confiserie_id'] ?>"/>
      <button type="submit" class="button_poubelle"><img class="img_poubelle" src="../assets/images/icone_poubelle.svg" alt="image poubelle"/></button>
    </form>

<?php } ?>

    <br>
    <img class="img_carte" src="../assets/images/icone_bonbon.svg" alt="image d'un bonbon"/>
    <h3 class="titre_carte"><?= $stock["nom"] ?></h3>
    <p class="texte_type">Type : <?php echo $stock["type"];?> </p>

    <?php  if($_SESSION["user_type"] == 'gerant'){ ?>
    <p class="texte_info">Quantité : <?php echo $compteur;?> </p>
  <?php }

  if($_SESSION["user_type"] == 'client'){

    if($compteur > 0){
      echo '<p class="texte_info vert">En stock</p>';
    }
    else{
      echo '<p class="texte_info rouge">En rupture de stock</p>';
    }

  } ?>

    <form method="post" action="detail_confiserie.php" class="btn_centre">
      <input type="hidden" value="<?php echo $compteur;?>" name="qte_confi"/>
      <input type="hidden" value="<?php echo $stock['confiserie_id'];?>" name="session_confi"/>
      <button type="submit" class="btn btn_rose btn_petit">Détails</button>
    </form>

<?php  if($_SESSION["user_type"] == 'gerant'){ ?>
    <hr class="hr_carte">

    <form class="div_gestion_qte_bonbon" method="post" action="<?php $_SERVER["PHP_SELF"]; ?>">
      <input type="hidden" name="choix_confiserie" value="<?php echo $stock['confiserie_id'];?>"/>
      <input type="number" name="choix_nbr" value="0" class="rectangle_qte nbr_add_del" min="0" title="Nombre d'article à ajouter"/>
      <button type="submit" class="add_del" action="">Ajouter</button>
    </form>

    <hr class="hr_carte">

    <form class="div_gestion_qte_bonbon" method="post" action="<?php $_SERVER["PHP_SELF"]; ?>">
      <input type="hidden" name="choix_confiserie_supp" value="<?php echo $stock['confiserie_id'];?>"/>
      <input type="number" name="choix_nbr_supp" value="0" class="rectangle_qte nbr_add_del" min="0" max="<?php echo $compteur;?>" title="Nombre d'article à supprimer"/>
      <button type="submit" class="add_del">Supprimer</button>
    </form>
<?php } ?>
  </div>



  <?php
  }
}
?>

</div>
 <h3 class="h3_titre_page">En rupture de stock :</h3>
 <div class="layout_cartes_test">

<?php

foreach ($stocks_conf as $stock) {
  $req = $DB->query('SELECT COUNT(*) FROM stocks WHERE boutique_id='.$_SESSION["id_boutique_encours"].' AND confiserie_id='.$stock["confiserie_id"]);
  $compteur= 0;
  while ($data = $req->fetch()){
    $compteur= $data[0];
  }


if($compteur < 1){
?>

<div class="div_carte">

<?php  if($_SESSION["user_type"] == 'gerant'){ ?>
  <form method="post" action ="popup_supp_conf.php">
    <input type="hidden" name="id_confiserie" value="<?php echo $stock['confiserie_id'] ?>"/>
    <button type="submit" class="button_poubelle"><img class="img_poubelle" src="../assets/images/icone_poubelle.svg" alt="image poubelle"/></button>
  </form>

<?php } ?>

  <br>
  <img class="img_carte" src="../assets/images/icone_bonbon.svg" alt="image d'un bonbon"/>
  <h3 class="titre_carte"><?= $stock["nom"] ?></h3>
  <p class="texte_type">Type : <?php echo $stock["type"];?> </p>

  <?php  if($_SESSION["user_type"] == 'gerant'){ ?>
  <p class="texte_info">Quantité : <?php echo $compteur;?> </p>
<?php }

if($_SESSION["user_type"] == 'client'){

  if($compteur > 0){
    echo '<p class="texte_info vert">En stock</p>';
  }
  else{
    echo '<p class="texte_info rouge">En rupture de stock</p>';
  }

} ?>

  <form method="post" action="detail_confiserie.php" class="btn_centre">
    <input type="hidden" value="<?php echo $compteur;?>" name="qte_confi"/>
    <input type="hidden" value="<?php echo $stock['confiserie_id'];?>" name="session_confi"/>
    <button type="submit" class="btn btn_rose btn_petit">Détails</button>
  </form>

<?php  if($_SESSION["user_type"] == 'gerant'){ ?>
  <hr class="hr_carte">

  <form class="div_gestion_qte_bonbon" method="post" action="<?php $_SERVER["PHP_SELF"]; ?>">
    <input type="hidden" name="choix_confiserie" value="<?php echo $stock['confiserie_id'];?>"/>
    <input type="number" name="choix_nbr" value="0" class="rectangle_qte nbr_add_del" min="0" title="Nombre d'article à ajouter"/>
    <button type="submit" class="add_del" action="">Ajouter</button>
  </form>

  <hr class="hr_carte">

  <form class="div_gestion_qte_bonbon" method="post" action="<?php $_SERVER["PHP_SELF"]; ?>">
    <input type="hidden" name="choix_confiserie_supp" value="<?php echo $stock['confiserie_id'];?>"/>
    <input type="number" name="choix_nbr_supp" value="0" class="rectangle_qte nbr_add_del" min="0" max="<?php echo $compteur;?>" title="Nombre d'article à supprimer"/>
    <button type="submit" class="add_del">Supprimer</button>
  </form>
<?php } ?>

</div>


<?php
}
}
  ?>

  </div>



<?php
include_once 'footer.php'; ?>
