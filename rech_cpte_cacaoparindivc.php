<?php // Connection à la base de données
error_reporting(0);
include '../connexion/connectpg.php';
include '../connexion/function.php';

if (isset($_POST['camp']) ) {

    $sqldep = $bdd->prepare("SELECT *  from departements WHERE  code_departement = :cd  ");
    $sqldep->execute(array("cd" => $_POST['dep']));
    $rowdep = $sqldep->fetch();
    ?>
    <div class="row">
        <div class="col-lg-12 input_field_sections">

            <table id="example2" class="table table-striped  table-bordered table_res dataTable  ">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Delegation</th>
                    <th>Departement</th>
                    <th>Village</th>
                    <th>Passage</th>
                    <th>Parcelle</th>
                    <th>Arbre</th>
                    <th>Couleur</th>
                    <th>Grappe</th>
                    <th>Fruit</th>
                    <th>Observation </th>
                    <th>enregistré le </th>
                    <th>Par </th>
                    <th>Position X Y </th>
                    <th>Actions</th>

                </tr>
                </thead>

                <tbody>
                <?php
                $dt = gmdate('Y');
                $dt_1 = gmdate('Y')+1;
                $camp = $dt.'-'.$dt_1;
                $i=1;


                if ($_POST['pa']=='Tous' ){
                    if ($_POST['vil']=='Tous' or $_POST['vil']=='vide'){
                        $sqlcp = $bdd->prepare("SELECT *  from comptage_cafes WHERE  an_campagne = :an AND delegation_code = :dl AND departement_code = :dp AND id_passage_periode = :p ");
                        $sqlcp->execute(array("an" => $_POST['camp'],"dl" => $rowdep['delegation_code'],"dp" => $_POST['dep'],"p" => $_POST['idpa']));
                    }else{
                        $sqlcp = $bdd->prepare("SELECT *  from comptage_cafes WHERE  an_campagne = :an AND delegation_code = :dl AND departement_code = :dp AND village_code = :v  AND id_passage_periode = :p  ");
                        $sqlcp->execute(array("an" => $_POST['camp'],"dl" => $rowdep['delegation_code'],"dp" => $_POST['dep'],"v" => $_POST['vil'],"p" => $_POST['idpa']));

                    }

                }else{
                    if ($_POST['vil']=='Tous' or $_POST['vil']=='vide'){
                        $sqlcp = $bdd->prepare("SELECT *  from comptage_cafes WHERE  an_campagne = :an AND delegation_code = :dl AND departement_code = :dp AND id_passage_periode = :p and parcelle_code = :par ");
                        $sqlcp->execute(array("an" => $_POST['camp'],"dl" => $rowdep['delegation_code'],"dp" => $_POST['dep'],"p" => $_POST['idpa'],"par" => $_POST['pa']));
                    }else{
                        $sqlcp = $bdd->prepare("SELECT *  from comptage_cafes WHERE  an_campagne = :an AND delegation_code = :dl AND departement_code = :dp AND village_code = :v  AND id_passage_periode = :p and parcelle_code = :par ");
                        $sqlcp->execute(array("an" => $_POST['camp'],"dl" => $rowdep['delegation_code'],"dp" => $_POST['dep'],"v" => $_POST['vil'],"p" => $_POST['idpa'],"par" => $_POST['pa']));

                    }


                }


                while ($row = $sqlcp->fetch()) {
                    $code_pied = $row['pied_code'];

                    $sqlp = $bdd->prepare("SELECT *  from pieds WHERE code_pied= :c  ");
                    $sqlp->execute(array("c" => $code_pied));
                    $rowp = $sqlp->fetch();

                    $del = $row['delegation_code'];
                    $sqldel = $bdd->prepare("SELECT *  from delegations WHERE code_delegation= :c  ");
                    $sqldel->execute(array("c" => $del));
                    $rowdel = $sqldel->fetch();


                    $depa = $row['departement_code'];
                    $sqldep = $bdd->prepare("SELECT *  from departements WHERE code_departement= :c  ");
                    $sqldep->execute(array("c" => $depa));
                    $rowdep = $sqldep->fetch();


                    $vilc= $row['village_code'];
                    $sqlvil = $bdd->prepare("SELECT *  from villages WHERE code_village= :c  ");
                    $sqlvil->execute(array("c" => $vilc));
                    $rowvil = $sqlvil->fetch();

                    $codepar= $row['parcelle_code'];
                    $sqlparcelle = $bdd->prepare("SELECT *  from parcelles WHERE code_parcelle= :c  ");
                    $sqlparcelle->execute(array("c" => $codepar));
                    $rowpar = $sqlparcelle->fetch();

                    $idpass= $row['id_passage_periode'];
                    $sqlp = $bdd->prepare("SELECT *  from passage_periodes WHERE id= :c  ");
                    $sqlp->execute(array("c" => $idpass));
                    $rowpass = $sqlp->fetch();
                    ?>
                    <tr>
                        <td> <?php echo $i;  ?></td>
                        <td><?php echo $rowdel['designation'];  ?></td>
                        <td><?php echo $rowdep['designation'];  ?></td>
                        <td><?php echo $rowvil['designation'];  ?></td>
                        <td><?php echo $rowpass['libelle'];  ?></td>
                        <td><?php echo $rowpar['nom_parcelle'];  ?></td>
                        <td><?php echo $rowp['numero_pied'];  ?></td>
                        <td><?php echo $rowp['couleur'];  ?></td>
                        <td><?php echo $row['grappe'];  ?></td>
                        <td><?php echo $row['fruit'];  ?></td>

                        <td><?php if (isset($row['observation'])) echo $row['observation']  ?></td>
                        <td><?php if (isset($row['date_creation'])) echo format_date($row['date_creation']);  ?></td>
                        <td><?php if (isset($row['agent_id'])) {
                                $sqla = $bdd->prepare("SELECT *  FROM agents WHERE id= :c  ");
                                $sqla->execute(array("c" => $row['agent_id']));
                                $rowag = $sqla->fetch();
                                echo $rowag['matricule'];
                            }
                            ?></td>
                        <td><?php if (isset($row['posX'])) echo $row['posX'] ." ". $row['posY'];  ?></td>
                        <td> <a  href="#modif<?php echo $row['id']  ?>"  data-toggle="modal"> <span class="fa fa-pencil" style="font-size: 15px;"></span></a>
                            &nbsp;<a href="#"> <span class="fa fa-trash" style="font-size: 15px;"></span></a>
                        </td>
                    </tr>

                    <div class="modal fade bs-example-modal-lg" id="modif<?php echo $row['id']  ?>" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="false" style="z-index: 3000000">
                        <div class="modal-dialog modal-lg rounded">
                            <div class="modal-content">
                                <div class="modal-header bg-success">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title text-white">Mise à jour du comptage du pied:  <?php echo $rowp['numero_pied']  ?></h4>
                                </div>
                                <div class="modal-body">

                                    <div class="row">

                                        <div class="col-lg-6 input_field_sections">
                                            <h5> Grappe </h5>
                                            <div class="input-group">
                                                <input type="text" class="form-control"  name="fa<?php echo $row['id']  ?>" id="gp<?php echo $row['id']  ?>" value="<?php echo $row['grappe']  ?>">
                                                <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i>
                                        </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 input_field_sections">
                                            <h5> Fruits </h5>
                                            <div class="input-group">
                                                <input type="text" class="form-control"  name="fb<?php echo $row['id']  ?>" id="fr<?php echo $row['id']  ?>" value="<?php echo $row['fruit']  ?>">
                                                <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i>
                                        </span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 input_field_sections">
                                            <h5>Observation </h5>
                                            <div class="input-group">
                                                <textarea  class="form-control"  name="obs<?php echo $row['id']  ?>" id="obs<?php echo $row['id']  ?>" ><?php echo $row['raison_supp']  ?></textarea>

                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <hr>

                                    <div class="input-group d-flex">
                                        &nbsp;<a href="javascript:void(0);" data-dismiss="modal" type="button" class="btn btn-success pull-right" onclick="majcacao(<?php echo $row['id']  ?>)">Valider la mise à jour</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php $i++;} ?>
                </tbody>

            </table>


        </div>
    </div>
    <?php
}
?>