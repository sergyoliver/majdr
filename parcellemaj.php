<?php // Connection à la base de données
if (isset($_POST['codep'])){
include '../connexion/connectpg.php';
include '../connexion/function.php';

# However the User's Query will be passed to the DB:
$sql = "SELECT *  FROM parcelles WHERE   code_parcelle = :p AND  delegation_code= :d ";
# Try query or error
$rs=$bdd->prepare($sql);

$rs->execute(array("p"=>$_POST['codep'],"d"=>$_POST['zone']));
    $rowpm=$rs->fetch();

    // deartement
    $sqldep = $bdd->prepare("SELECT *  FROM departements WHERE   code_departement = :dp  ");
    $sqldep->execute(array("dp"=>$rowpm['departement_code']));
    $rowdep=$sqldep->fetch();

     $sqlsp = $bdd->prepare("SELECT *  FROM sous_prefectures WHERE   code_sous_prefecture = :dp  ");
    $sqlsp->execute(array("dp"=>$rowpm['code_sous_prefecture']));
    $rowsp=$sqlsp->fetch();

    $sqlv = $bdd->prepare("SELECT *  FROM villages WHERE   code_village = :dp  ");
    $sqlv->execute(array("dp"=>$rowpm['village_code']));
    $rowv=$sqlv->fetch();



?>
<div class="col-lg-2 input_field_sections">
    <h5>Code de la parcelle</h5>

    <div class="input-group">
        <input type="text" style="background-color: #8fdf82; font-weight: bold;color: black" class="form-control" name="codep" value="<?php echo $rowpm['code_parcelle'] ?>">
        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
    </div>
</div>

<div class="col-lg-4 input_field_sections">
    <h5>Nom du site</h5>

    <div class="input-group">
        <input type="text" class="form-control" name="nomsite" value="<?php echo $rowpm['nom_parcelle'] ?>">
        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
    </div>
</div>
    <div class="col-lg-6 input_field_sections">
    <h5>Departement/Sous prefecture - Village</h5>

    <div class="input-group">
        <input type="text" class="form-control" name="nomsite" value="<?php echo $rowdep['designation'].' / '.$rowsp['designation'].' - '.$rowv['designation'] ?>">
        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
    </div>
</div>

<?php }