<?php // Connection à la base de données
error_reporting(0);
include '../connexion/connectpg.php';
include '../connexion/function.php';

if (isset($_POST['del']) ) {

    $i = 0;
    $del=$_POST['del'];

?>


    <option  >Tous</option>
    <?php
    $i=1;
    $rsdel = $bdd->prepare('select * from departements WHERE delegation_code = :dep ');
    $rsdel->execute(array('dep'=>$del));
    while($rowdel = $rsdel->fetch()) {

        ?>
        <option value="<?php echo $rowdel['code_departement'] ?>"><?php echo $rowdel['designation'] ?></option>

    <?php }  ?>
<?php }