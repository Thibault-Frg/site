<?php
session_start();
include_once '../pages/header.php';
include_once '../pages/nav.php';
 ?>


  <form action="">
    <input type="hidden" value="btn" name="btn"/>
    <a onclick="history.go(-1)" class="btn btn_rose btn_moyen btn_retour">
         <img src="../assets/images/chevron.png" class="chevron"/>
         Retour
     </a>
  </form>

  <h1 class="h1_titre_page">Ajouter un bonbon :</h1>

 <div class="encadre_rose espace_bas espace_haut">


   <form class="centrer espace_haut form_boutique" action="register_bonbon.php" method="post">
    <label class="label_form">Nom du bonbon :</label>
   	<input type="text" class="encadre_texte p_gestion_stock div_input" name="nom" placeholder="Nom du bonbon" required />

    <label class="label_form">Type :</label>
   	<input type="text" class="encadre_texte p_gestion_stock div_input" name="type" placeholder="type" required />

    <label class="label_form">Prix :</label>
   	<input type="text" class="encadre_texte p_gestion_stock div_input" name="prix" placeholder="Prix" required />

    <button type="submit" name="submit" value="Ajouter"  class="btn btn_rose btn_moyen btn_ajout_boutique" >Ajouter</button>
   </form>


 </div>



<?php
include_once '../pages/footer.php';
 ?>
