<?php
session_start();
include_once 'header.php';
 ?>

<div class="div_accueil">
  <img class="icone_candy" src="../assets/images/icone_candy.png"/>
  <h1 class="h1_accueil">Confiz</h1>
</div>


<form action="../login/login.php" class="btn_centre espace_haut">
  <input type="hidden" value="btn" name="btn"/>
  <button type="submit" class="btn btn_rose btn_accueil">
    Se connecter</button>
</form>

<div class="p_centrer espace_haut">
	<a class="lien_subscribe" href="subscribe.php">Ou inscrivez-vous</a>
</div>

 <?php
 include_once 'footer.php';
  ?>
