<?php
session_start();
include_once 'header.php';
include_once 'nav.php';
require("../login/config.php");


$id_confi = $_POST["session_confi"];




$qte_confi = $_POST["qte_confi"];


$req = $DB->prepare("SELECT * FROM confiseries WHERE confiserie_id=:confiserie_id");
$req->execute(array(
  "confiserie_id" => $id_confi,
));
$nom ="";
$type ="";
$prix=0;
while ($data=$req->fetch()){
  $nom =$data[1];
  $type =$data[2];
  $prix=$data[3];
}
 ?>


<div class="detail_div">
   <div class="detail_div_gauche">

     <a onclick="history.go(-1)" class="btn btn_rose btn_moyen btn_retour">
          <img src="../assets/images/chevron.png" class="chevron"/>
          Retour
      </a>

     <div class="rond_image">
       <img class="img_detail" src="../assets/images/icone_bonbon.svg" alt="icone bonbon"/>
     </div>

  </div>
  <div class="detail_div_droite">
    <h3 class="h3_detail_nom"><?php echo $nom;?></h3>
    <p class="type"> Type : <?= $type;?> </p>

<?php

if($qte_confi > 0){
  echo '<p class="detail_stock texte_vert">En stock dans cette boutique</p>';
}
if($qte_confi < 1){
  echo '<p class="detail_stock texte_rouge">En rupture dans cette boutique</p>';
}

if($_SESSION["user_type"] == 'gerant'){
  echo '<p class="p_qte"> Quantité : '.$qte_confi.'</p>';
}


 ?>

    <p class="prix"><?= $prix." €";?></p>


<?php

$confiz = $DB->prepare('SELECT COUNT(*) as nombre,date_de_mise_en_stock,date_de_peremption FROM stocks WHERE confiserie_id=:confiserie_id AND boutique_id=:boutique_id GROUP BY date_de_mise_en_stock, date_de_peremption ');
$confiz->execute(array(
  "confiserie_id" => $id_confi,
  "boutique_id" => $_SESSION["id_boutique_encours"]
));


if($_SESSION["user_type"] == 'gerant'){
?>

<table class="table_peremption">

<tr>
  <th>Quantité</th>
  <th>Date de mise en stock</th>
  <th>Jours restants avant péremption</th>
</tr>

<?php
foreach($confiz as $conf){

// Calculs des dates -------------------------------------------------
$date_en_stock = $conf["date_de_mise_en_stock"];
$date_mtn = date('y-m-d');
$date_peremp = $conf["date_de_peremption"];
$dateDifference = abs(strtotime($date_peremp) - strtotime($date_mtn));
$qte_peremption = $conf["nombre"];
$req2 = $DB->prepare("SELECT COUNT(*) FROM stocks WHERE confiserie_id=:confiserie_id AND boutique_id=:boutique_id AND date_de_peremption=:date_de_peremption");
$req2->execute(array(
  "confiserie_id" => $id_confi,
  "boutique_id" => $_SESSION["id_boutique_encours"],
  "date_de_peremption" => $date_peremp
));

  ?>
  <tr>
    <td><?php echo $qte_peremption;?> </td>
    <td> <?php echo $date_en_stock; ?> </td>
    <td> <?php echo ($dateDifference/86400);?> jours </td>
  </tr>
  <br>
<?php
}
?>
</table>





<?php
}










?>


  </div>
</div>




 <?php
 include_once 'footer.php';
  ?>
