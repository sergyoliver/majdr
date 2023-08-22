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
    $rsdel = $bdd->prepare("select id_passage_periode from comptage_cafes where an_campagne = :c GROUP BY id_passage_periode ");
    $rsdel->execute(array('c'=>$camp));
    while($rowdel = $rsdel->fetch()) {
        $codedel = $rowdel['id_passage_periode'];
        $rsdel1 = $bdd->prepare("select * from passage_periodes WHERE id = :p  and type_pied='C'  ");
        $rsdel1->execute(array('p'=>$codedel));
        $rowdelg = $rsdel1->fetch();
        ?>
        <option value="<?php echo $rowdelg['id'] ?>"><?php echo $rowdelg['libelle'] ?></option>

    <?php }  ?>
<?php }