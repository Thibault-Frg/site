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

  <h1 class="h1_titre_page">Ajouter une boutique</h1>

 <div class="encadre_rose espace_bas espace_haut">


   <form class="centrer espace_haut form_boutique" action="register.php" method="post">
    <label class="label_form">Nom de la boutique :</label>
   	<input type="text" class="encadre_texte p_gestion_stock div_input" name="nom" placeholder="Nom de la boutique" required />

    <label class="label_form">Numéro de la rue :</label>
   	<input type="text" class="encadre_texte p_gestion_stock div_input" name="numero_rue" placeholder="Numéro de la rue" required />

    <label class="label_form">Nom de l'adresse :</label>
   	<input type="text" class="encadre_texte p_gestion_stock div_input" name="nom_adresse" placeholder="Nom de l'adresse" required />

    <label class="label_form">Code postal :</label>
   	<input type="number" class="encadre_texte p_gestion_stock div_input" name="code_postal" placeholder="Code postal" required />

    <label class="label_form">Ville :</label>
   	<input type="text" class="encadre_texte p_gestion_stock div_input" name="ville" placeholder="Ville" required />

    <label class="label_form">Pays :</label>
   	<input type="text" class="encadre_texte p_gestion_stock div_input petit_espace_bas" name="pays" placeholder="Pays" required />

    <button type="submit" name="submit" value="Ajouter"  class="btn btn_rose btn_moyen btn_ajout_boutique" >Ajouter</button>
   </form>


 </div>



<?php
include_once '../pages/footer.php';
 ?>
