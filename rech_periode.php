<?php // Connection à la base de données
error_reporting(0);
include '../connexion/connectpg.php';
include '../connexion/function.php';

if (isset($_POST['codecam']) ) {

    $i = 0;
    $camp=$_POST['codecam'];
    ?>


    <option  >Tous</option>
    <?php
    $i=1;
    $rsdel = $bdd->prepare("select type_periode from passage_periodes where campagne = :c and type_pied='K' GROUP BY type_periode ");
    $rsdel->execute(array('c'=>$camp));
    while($rowdel = $rsdel->fetch()) {

        ?>
        <option value="<?php echo $rowdel['type_periode'] ?>"><?php echo $rowdel['type_periode'] ?></option>

    <?php }  ?>
<?php }