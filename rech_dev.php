<?php // Connection à la base de données
session_start();
error_reporting(0);
include '../connexion/connectpg.php';
include '../connexion/function.php';

if (isset($_POST['dp']) ) {

    $i = 0;
    $dep=$_POST['dp'];


    ?>


    <option  >Tous</option>

    <?php
    $i=1;
    $rsdel = $bdd->prepare('select code_village,villages.designation as lib  from villages,sous_prefectures 
where sous_prefecture_code=code_sous_prefecture and  departement_code = :dp  ORDER BY villages.designation asc ');
    $rsdel->execute(array('dp'=>$dep));
    while($rowdel = $rsdel->fetch()) {

        ?>
        <option value="<?php echo $rowdel['code_village'] ?>"><?php echo $rowdel['code_village']."-". $rowdel['lib'] ?></option>

    <?php }  ?>
<?php }