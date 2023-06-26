<?php
include_once 'header.php';
?>

<!-- Centrer un bouton : mettre la classe "btn_centre" dans le form -->





<!-- Bouton voir qqchose (détails et voir le catalogue) // fond rose -->
<form action="">
  <input type="hidden" value="btn" name="btn"/>
  <button type="submit" class="btn btn_rose btn_petit">Texte</button>
</form>


<br>


<!-- Bouton voir qqchose (détails et voir le catalogue) // arrière fond rose -->
<form action="">
  <input type="hidden" value="btn" name="btn"/>
  <button type="submit" class="btn btn_rose btn_moyen">Texte</button>
</form>


<br>



<!-- Bouton retour arrière // fond rose -->
<a onclick="history.go(-1)" class="btn btn_rose btn_moyen btn_retour">
     <img src="../assets/images/chevron.png" class="chevron"/>
     Retour
 </a>


<br>


<!-- Bouton retour arrière // fond rose -->
<form action="" class="">
  <input type="hidden" value="btn" name="btn"/>

  <button type="submit" class="btn btn_rose btn_accueil">
    Se connecter</button>
</form>


<br>



<div class="test_fond_couleur">

<!-- Bouton déconnexion  -->
<form action="">
  <input type="hidden" value="btn" name="btn"/>
  <button type="submit" class="btn btn_blanc btn_petit">Déconnexion</button>
</form>


</div>




<br>




<div class="test_fond_couleur">

<!-- Bouton connexion -->
<form action="">
  <input type="hidden" value="btn" name="btn"/>
  <button type="submit" class="btn btn_blanc btn_grand">Connexion</button>
</form>


</div>


<?php
include_once 'footer.php';
?>
