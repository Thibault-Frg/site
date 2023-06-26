<div class="div_nav">
  <h1 class="h1_nav">Confiz</h1>

<?php

if($_SESSION["user_type"] == 'gerant'){
?>
<div class="div_droite_nav">
<button class="btn_gestion">
  <a href="gestion.php">
  <img class="img_gestion" src="../assets/images/parametres.png"/>
</a>
</button>
<?php
}

?>

  <form action="" class="form_nav">
    <input type="hidden" value="btn" name="btn"/>
    <a type="submit" class="btn btn_blanc btn_petit btn_nav" href="../login/logout.php">Déconnexion</a>
  </form>
</div>


</div>
