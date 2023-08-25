<?php // Connection à la base de données
error_reporting(0);
include '../connexion/connectpg.php';
include '../connexion/function.php';

if (isset($_POST['codel']) ) {

    $i = 0;
    $del=$_POST['codel'];

?>


    <option  >selectionner</option>
    <?php
    $i=1;
    $rsdel = $bdd->prepare('select * from departements where delegation_code = :p  ');
    $rsdel->execute(array('p'=>$del));
    while($rowdep = $rsdel->fetch()) {

        ?>
        <option value="<?php echo $rowdep['code_departement'] ?>"><?php echo $rowdep['designation'] ?></option>

    <?php }  ?>
<?php }