<?php
include_once 'header.php';
?>


<!-- composant carte boutique (gérant)  -->

<div class="div_carte">
  <img class="img_poubelle" src="../assets/images/icone_poubelle.svg" alt="image poubelle"/>
  <br>
  <img class="img_carte" src="../assets/images/icone_boutique.svg" alt="image d'une boutique"/>
  <h3 class="titre_carte">Blablabla</h3>
  <p class="texte_info">Adresse</p>

  <form action="" class="btn_centre">
    <input type="hidden" value="btn" name="btn"/>
    <button type="submit" class="btn btn_rose btn_petit">Voir le catalogue</button>
  </form>

</div>


<br>


<!-- composant carte boutique (client)  -->

<div class="div_carte">
  <img class="img_carte" src="../assets/images/icone_boutique.svg" alt="image d'une boutique"/>
  <h3 class="titre_carte">Blablabla</h3>
  <p class="texte_info">Adresse</p>

  <form action="" class="btn_centre">
    <input type="hidden" value="btn" name="btn"/>
    <button type="submit" class="btn btn_rose btn_petit">Voir le catalogue</button>
  </form>

</div>


<br>


<!-- composant carte bonbon (gérant)  -->

<div class="div_carte">
  <img class="img_poubelle" src="../assets/images/icone_poubelle.svg" alt="image poubelle"/>
  <br>
  <img class="img_carte" src="../assets/images/icone_bonbon.svg" alt="image d'un bonbon"/>
  <h3 class="titre_carte">Blablabla</h3>
  <p class="texte_info">kjhgfdfghjko</p>

  <form action="" class="btn_centre">
    <input type="hidden" value="btn" name="btn"/>
    <button type="submit" class="btn btn_rose btn_petit">Détails</button>
  </form>

  <hr class="hr_carte">

  <form class="div_gestion_qte_bonbon">
    <input type="number" value="" placeholder="1" class="rectangle_qte nbr_add_del"/>
    <button type="submit" class="add_del">Ajouter</button>
    <button type="submit" class="add_del">Supprimer</button>
  </form>

</div>



<br>

<!-- composant carte bonbon (client)  -->

<div class="div_carte">
  <img class="img_carte" src="../assets/images/icone_bonbon.svg" alt="image d'un bonbon"/>
  <h3 class="titre_carte">Blablabla</h3>
  <p class="texte_info">En stock</p>

  <form action="" class="btn_centre">
    <input type="hidden" value="btn" name="btn"/>
    <button type="submit" class="btn btn_rose btn_petit">Détails</button>
  </form>

</div>









 <?php
 include_once 'footer.php';
 ?>
