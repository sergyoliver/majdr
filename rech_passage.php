<?php // Connection à la base de données
session_start();
error_reporting(0);
include '../connexion/connectpg.php';
include '../connexion/function.php';

if (isset($_POST['codecam']) ) {

    $i = 0;
    $camp=$_POST['codecam'];
    $tp=$_POST['periode'];
    ?>


    <option  >Tous</option>
    <?php
    $i=1;
    $rsdel = $bdd->prepare("select id,libelle from passage_periodes where type_periode = :tp and campagne = :c and type_pied='K' GROUP BY id,libelle ");
    $rsdel->execute(array('c'=>$camp,'tp'=>$tp));
    while($rowdel = $rsdel->fetch()) {

        ?>
        <option value="<?php echo $rowdel['id'] ?>"><?php echo $rowdel['libelle'] ?></option>

    <?php }  ?>
<?php }