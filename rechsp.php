<?php // Connection à la base de données
error_reporting(0);
include '../connexion/connectpg.php';
include '../connexion/function.php';

if (isset($_POST['codep']) ) {

    $i = 0;
    $dep=$_POST['codep'];

?>


    <option  >selectionner</option>
    <?php
    $i=1;
    $rsdel = $bdd->prepare('select * from sous_prefectures where departement_code = :p  ');
    $rsdel->execute(array('p'=>$dep));
    while($rowdep = $rsdel->fetch()) {

        ?>
        <option value="<?php echo $rowdep['code_sous_prefecture'] ?>"><?php echo $rowdep['designation'] ?></option>

    <?php }  ?>
<?php }