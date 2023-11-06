<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=voiture', 'root', '');
}catch (Exception $exception){
    die('erreur'.$exception->getMessage());
}

function Ajouter($bdd){
    $voiture_Ajoute=$bdd->prepare('INSERT INTO voiture(matricule,couleur,chevaux,types) 
    VALUES(:matricule, :couleur, :chevaux, :types)');
    $voiture_Ajoute->execute(array(
        'matricule'=>$_POST ['matricule'],
        'couleur'=>$_POST ['couleur'],
        'chevaux'=>$_POST ['chevaux'],
        'types'=>$_POST ['types']
    ));
header('location:index.php');
}
function mofifier($bdd){
    $voiture_Ajoute=$bdd->prepare('UPDATE voiture SET matricule=:matricule,couleur=:couleur,chevaux=:chevaux,types=:types WHERE id=:id');
    $voiture_Ajoute->execute(array(
        'matricule'=>$_POST ['matricule'],
        'couleur'=>$_POST ['couleur'],
        'chevaux'=>$_POST ['chevaux'],
        'types'=>$_POST ['types'],
        'id'=>$_POST['id']
    ));
    header('location:index.php');
}
function Afficher($bdd){
    $afficher=$bdd->query('SELECT * FROM voiture ');
    $affichage=$afficher->fetchAll();?>

    <div style="display:grid;grid-template-columns:repeat(6,1fr);" class="border-primary border text-center ">
        <span class="btn-primary text-center">id</span>
        <span class="btn-primary text-center">Matricule</span>
        <span class="btn-primary text-center">Couleur</span>
        <span class="btn-primary text-center">Chevaux</span>
        <span class="btn-primary text-center">Types</span>
        <span class="btn-primary text-center"></span>
        <?php
           foreach($affichage as $valeur){?>
               <script>
                   function modifier<?php  echo $valeur['id']?>(){
                       var affiche_ajouter =document.getElementById('ajouter_voiture<?php  echo $valeur['id']?>');
                       affiche_ajouter.style.display='block';
                   }
                   function fermer<?php  echo $valeur['id']?>(){
                       var affiche_ajouter =document.getElementById('ajouter_voiture<?php  echo $valeur['id']?>');
                       affiche_ajouter.style.display='none';
                   }
               </script>
            <span id="id<?php  echo $valeur['id']?>" class="border border-primary"><?php  echo $valeur['id']?></span>
            <span id="matricule<?php  echo $valeur['id']?>" class="border border-primary"><?php  echo $valeur['matricule']?></span>
            <span id="couleur<?php  echo $valeur['id']?>" class="border border-primary"><?php  echo $valeur['couleur']?></span>
            <span id="chevaux<?php  echo $valeur['id']?>" class="border border-primary"><?php  echo $valeur['chevaux']?></span>
            <span id="types<?php  echo $valeur['id']?>" class="border border-primary"><?php  echo $valeur['types']?></span>
            <div class="border border-primary" style="display: grid; grid-template-columns: 1fr 1fr;">
                <div>
                    <button  onclick="modifier<?php  echo $valeur['id']?>()" class="form-control btn btn-success">Modifier</button>
                    <input type="hidden" name="id" value="<?php  echo $valeur['id']?>"   id="" >
                </div>
                <form method="post"  action="controleur.php">
                    <input type="submit" name="supprimer" value="Supprimer" id="" class="form-control btn btn-danger ">
                    <input type="hidden" name="id" value="<?php  echo $valeur['id']?>"   id="">
                </form>
            </div>
               <div id="ajouter_voiture<?php  echo $valeur['id']?>" style="display: none; z-index: 2; position: absolute; left: 50%" >
                   <form action="controleur.php" method="post" class="form-control-lg form-control border-primary">
                       <!--ty tanana Edwino ah -->
                       <input type="text" name="matricule" placeholder="matricule" value="<?php  echo $valeur['matricule']?>" class="form-control form-control-plaintext border-primary"><br>
                       <input type="text" name="couleur" placeholder="couleur" value="<?php  echo $valeur['couleur']?>" class="form-control form-control-plaintext border-primary"><br>
                       <input type="number" name="chevaux" placeholder="chevaux" value="<?php  echo $valeur['chevaux']?>" class="form-control form-control-plaintext border-primary"><br>
                       <input type="text" name="types" placeholder="type du voiture" value="<?php  echo $valeur['types']?>" class="form-control form-control-plaintext border-primary"><br>
                       <input type="hidden" name="id" value="<?php echo $valeur['id']?>">
                       <input type="submit" name="enregistrer" value="Envoyer" class="btn btn-primary" style="position: relative; left: -60px;">
                   </form>
                   <button onclick="fermer<?php  echo $valeur['id']?>()" class="btn-close btn btn-danger" style="position: relative; left: 90px; top: -55px"></button>
               </div>
            <?php
           }
        ?>
    </div>
    <?php
}

function formulmaire_inserer_voiture(){
    ?>
        <div >
            <button onclick="ajouter()" class="btn btn-primary" style="margin-bottom: 20px">Ajouter</button>
            <div id="ajouter_voiture" style="max-width: 300px; position: absolute; left: 50%;">
                <form action="controleur.php" method="post" class="form-control-lg form-control border-primary">
                    <!--ty tanana Edwino ah -->
                    <input type="text" name="matricule" placeholder="matricule" value="" class="form-control form-control-plaintext border-primary"><br>
                    <input type="text" name="couleur" placeholder="couleur" value="" class="form-control form-control-plaintext border-primary"><br>
                    <input type="number" name="chevaux" placeholder="chevaux" value="" class="form-control form-control-plaintext border-primary"><br>
                    <input type="text" name="types" placeholder="type du voiture" value="" class="form-control form-control-plaintext border-primary"><br>
                    <input type="submit" name="envoyer" value="Envoyer" class="btn btn-primary">
                </form>
                <button onclick="fermer()" class="btn btn-danger btn-close" style="position: relative; left: 190px; top: -55px"></button>
            </div>
        </div>
    <?php
}

function supprimer($bdd){
    $supprimer = $bdd->prepare('DELETE FROM voiture WHERE id=:id');
    $supprimer->execute(array('id'=>$_POST['id']));
    header('location:index.php');
}
?>