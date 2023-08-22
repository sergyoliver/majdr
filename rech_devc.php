<?php // Connection à la base de données
error_reporting(0);
include '../connexion/connectpg.php';
include '../connexion/function.php';

if (isset($_POST['dp']) ) {

    $i = 0;
    $dep=$_POST['dp'];
    //$del=$_POST['del'];
    $camp=$_POST['camp'];
    $pas=$_POST['idpa'];
?>


    <option  >Tous</option>
    <option value="vide" >Aucun</option>
    <?php
    $i=1;
    $rsdel = $bdd->prepare('select village_code from comptage_cafes where  an_campagne = :c and  departement_code = :dp and id_passage_periode = :p GROUP BY village_code ');
    $rsdel->execute(array('c'=>$camp,'dp'=>$dep,'p'=>$pas));
    while($rowdel = $rsdel->fetch()) {
        $codedev = $rowdel['village_code'];
        $rsdel1 = $bdd->prepare('select * from villages WHERE code_village = :vil  ');
        $rsdel1->execute(array('vil'=>$codedev));
        $rowdelg = $rsdel1->fetch();
        ?>
        <option value="<?php echo $rowdelg['code_village'] ?>"><?php echo $rowdelg['designation'] ?></option>

    <?php }  ?>
<?php }