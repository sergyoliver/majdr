<?php // Connection à la base de données
error_reporting(0);
include '../connexion/connectpg.php';
include '../connexion/function.php';

if (isset($_POST['vil']) ) {

    $i = 0;
    $dep=$_POST['dep'];
    $del=$_SESSION['zone'];
    $camp=$_POST['camp'];
    $vil=$_POST['vil'];
    $pas=$_POST['idpa'];
    ?>

    <option  >Tous</option>
    <?php
    $i=1;
    if ($vil=='vide'){
        $rsdel = $bdd->prepare('select parcelle_code from comptage_cacaos where  an_campagne = :c  and departement_code = :dp  and id_passage_periode = :p  GROUP BY parcelle_code ');
        $rsdel->execute(array('c'=>$camp,'dp'=>$dep,'p'=>$pas));
    }else{
        $rsdel = $bdd->prepare('select parcelle_code from comptage_cacaos where  an_campagne = :c and departement_code = :dp and village_code = :v  and id_passage_periode = :p  GROUP BY parcelle_code ');
        $rsdel->execute(array('c'=>$camp,'dp'=>$dep,'v'=>$vil,'p'=>$pas));
    }

    while($rowdel = $rsdel->fetch()) {
        $codepar = $rowdel['parcelle_code'];
        $rsdel1 = $bdd->prepare('select * from parcelles WHERE code_parcelle = :vil  ');
        $rsdel1->execute(array('vil'=>$codepar));
        $rowdelg = $rsdel1->fetch();
        ?>
        <option value="<?php echo $rowdelg['code_parcelle'] ?>"><?php echo $rowdelg['code_parcelle']. " - ". $rowdelg['nom_parcelle'] ?></option>

    <?php }  ?>
<?php }