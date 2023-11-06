<?php
  include 'modele.php';
  if(isset($_POST['envoyer'])){
    Ajouter($bdd);
  }
  if (isset($_POST['enregistrer'])){
    mofifier($bdd);
  }
  if (isset($_POST['supprimer'])){
    supprimer($bdd);
  }

?>
