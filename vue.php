
<?php
  include 'modele.php';
  if (isset($_POST['modifier'])){
      formulmaire_modifier_voiture($bdd);
  }
  else{
      formulmaire_inserer_voiture();
      Afficher($bdd);
  }
?>