<?php // Connection à la base de données

//error_reporting(0);
include '../connexion/connectpg.php';
include '../connexion/function.php';

if (isset($_POST['camp']) ) {

    ?>
    <div class="row">
        <div  class="col-lg-12 input_field_sections">
            <?php if ($_POST['pa']!=='Tous'){
                // on recherche la donnée avant la mise à jour
                $sqlverif = $bdd->prepare("SELECT *  from comptage_cacaos WHERE  an_campagne = :an AND  departement_code = :dp AND id_passage_periode = :p and parcelle_code = :par and valider=0");
                $sqlverif->execute(array("an" => $_POST['camp'],"dp" => $_POST['dep'],"p" => $_POST['idpa'],"par" => $_POST['pa']));
                $nbreverifie = $sqlverif->rowCount();

                if ($nbreverifie>0){

                    ?>
                    <div>
                        <a href="#valider<?php echo $_POST['pa']  ?>"  data-toggle="modal" class="btn btn-outline-danger layout_btn_prevent">Valider les données de la parcelle </a>
                    </div>
                <?php } }  ?>
        </div>
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
                    <th>Pied</th>
                    <th>CLASSE A</th>
                    <th>CLASSE B</th>
                    <th>CLASSE C</th>
                    <th>CLASSE D</th>
                    <th>PERTE A</th>
                    <th>PERTE B</th>
                    <th>FE</th>
                    <th>FLO </th>
                    <th>NOUE </th>
                    <th>OBSERVATIONS </th>
                    <th>enregistré le </th>
                    <th>Par </th>
                    <th>Position X Y </th>
                    <th>Actions</th>

                </tr>
                </thead>

                <tbody>
                <?php

                $i=1;

                if ($_POST['pa']=='Tous' ){
                    if ($_POST['vil']=='Tous' or $_POST['vil']=='vide'){
                        $sqlcp = $bdd->prepare("SELECT *  from comptage_cacaos WHERE  an_campagne = :an AND  departement_code = :dp AND id_passage_periode = :p ");
                        $sqlcp->execute(array("an" => $_POST['camp'],"dp" => $_POST['dep'],"p" => $_POST['idpa']));
                    }else{
                        $sqlcp = $bdd->prepare("SELECT *  from comptage_cacaos WHERE  an_campagne = :an AND  departement_code = :dp AND village_code = :v  AND id_passage_periode = :p  ");
                        $sqlcp->execute(array("an" => $_POST['camp'],"dp" => $_POST['dep'],"v" => $_POST['vil'],"p" => $_POST['idpa']));

                    }

                }else{

                    if ($_POST['idpa']=='Tous') {
                        if ($_POST['vil'] == 'Tous' or $_POST['vil'] == 'vide') {
                            $sqlcp = $bdd->prepare("SELECT *  FROM comptage_cacaos WHERE  an_campagne = :an AND departement_code = :dp AND  parcelle_code = :par ");
                            $sqlcp->execute(array("an" => $_POST['camp'], "dp" => $_POST['dep'],  "par" => $_POST['pa']));
                        } else {
                            $sqlcp = $bdd->prepare("SELECT *  FROM comptage_cacaos WHERE  an_campagne = :an  AND departement_code = :dp AND village_code = :v  AND parcelle_code = :par ");
                            $sqlcp->execute(array("an" => $_POST['camp'], "dp" => $_POST['dep'], "v" => $_POST['vil'],  "par" => $_POST['pa']));

                        }
                    }else{

                        if ($_POST['vil'] == 'Tous' or $_POST['vil'] == 'vide') {
                            $sqlcp = $bdd->prepare("SELECT *  FROM comptage_cacaos WHERE  an_campagne = :an AND departement_code = :dp AND id_passage_periode = :p AND parcelle_code = :par ");
                            $sqlcp->execute(array("an" => $_POST['camp'],"dp" => $_POST['dep'], "p" => $_POST['idpa'], "par" => $_POST['pa']));
                        } else {
                            $sqlcp = $bdd->prepare("SELECT *  FROM comptage_cacaos WHERE  an_campagne = :an AND departement_code = :dp AND village_code = :v  AND id_passage_periode = :p AND parcelle_code = :par ");
                            $sqlcp->execute(array("an" => $_POST['camp'],  "dp" => $_POST['dep'], "v" => $_POST['vil'], "p" => $_POST['idpa'], "par" => $_POST['pa']));

                        }

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
                    if (!empty($vilc)){
                        $sqlvil = $bdd->prepare("SELECT *  from villages WHERE code_village= :c  ");
                        $sqlvil->execute(array("c" => $vilc));
                        $rowvil = $sqlvil->fetch();
                    }


                    $codepar= $row['parcelle_code'];
                    $sqlparcelle = $bdd->prepare("SELECT *  from parcelles WHERE code_parcelle= :c  ");
                    $sqlparcelle->execute(array("c" => $codepar));
                    $rowpar = $sqlparcelle->fetch();
                    $idpassage = $row['id_passage_periode'];
                    $rsp = $bdd->prepare("select * from passage_periodes WHERE id = :p  and type_pied='K'  ");
                    $rsp->execute(array('p'=>$idpassage));
                    $rowpa = $rsp->fetch();
                    ?>
                    <tr>
                        <td> <?php echo $i;  ?></td>
                        <td><?php echo $rowdel['designation'];  ?></td>
                        <td><?php if (isset($rowdep['designation'])) echo $rowdep['designation'];  ?></td>
                        <td><?php if (isset( $rowvil['designation']) ) echo $rowvil['designation'];  ?></td>
                        <td><?php if (isset( $rowpa['libelle']) ) echo $rowpa['libelle'];  ?></td>
                        <td><?php if (isset($rowpar['nom_parcelle'])) echo $rowpar['nom_parcelle'];  ?></td>
                        <td><?php echo $rowp['numero_pied'];  ?></td>
                        <td><?php echo $row['fruit_a'];  ?></td>
                        <td><?php echo $row['fruit_b'];  ?></td>
                        <td><?php echo $row['fruit_c'];  ?></td>
                        <td><?php echo $row['fruit_d'];  ?></td>
                        <td><?php echo $row['pertes_a'];  ?></td>
                        <td><?php echo $row['pertes_b'];  ?></td>
                        <td><?php echo $row['fe'];  ?></td>
                        <td><?php echo $row['flo'];  ?></td>
                        <td><?php echo $row['Noue'];  ?></td>
                        <td><?php if (isset($row['raison_supp'])) echo $row['raison_supp']  ?></td>
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
                            <?php if ($row['valider']==0) {?> &nbsp; &nbsp; <a href="#"> <i class="fa fa-check-square-o" style="font-size: 15px; color: #FF0000"></i></a>
                            <?php }else{?>
                                <a href="#"> &nbsp; &nbsp;<i class="fa fa-check-square-o"  style="font-size: 15px; color: #16ac11"></i></a>
                            <?php    } ?>
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

                                        <div class="col-lg-3 input_field_sections">
                                            <h5> Classe A </h5>
                                            <div class="input-group">
                                                <input type="text" class="form-control"  name="fa<?php echo $row['id']  ?>" id="fa<?php echo $row['id']  ?>" value="<?php echo $row['fruit_a']  ?>">
                                                <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i>
                                        </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 input_field_sections">
                                            <h5> Classe B </h5>
                                            <div class="input-group">
                                                <input type="text" class="form-control"  name="fb<?php echo $row['id']  ?>" id="fb<?php echo $row['id']  ?>" value="<?php echo $row['fruit_b']  ?>">
                                                <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i>
                                        </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 input_field_sections">
                                            <h5> Classe C </h5>
                                            <div class="input-group">
                                                <input type="text" class="form-control"  name="fc<?php echo $row['id']  ?>" id="fc<?php echo $row['id']  ?>" value="<?php echo $row['fruit_c']  ?>">
                                                <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i>
                                        </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 input_field_sections">
                                            <h5> Classe D </h5>
                                            <div class="input-group">
                                                <input type="text" class="form-control"  name="fd<?php echo $row['id']  ?>" id="fd<?php echo $row['id']  ?>" value="<?php echo $row['fruit_d']  ?>">
                                                <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i>
                                        </span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">

                                        <div class="col-lg-3 input_field_sections">
                                            <h5> Perte A </h5>
                                            <div class="input-group">
                                                <input type="text" class="form-control"  name="pa<?php echo $row['id']  ?>" id="pa<?php echo $row['id']  ?>" value="<?php echo $row['pertes_a']  ?>">
                                                <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i>
                                        </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 input_field_sections">
                                            <h5> Perte B </h5>
                                            <div class="input-group">
                                                <input type="text" class="form-control"  name="pb<?php echo $row['id']  ?>" id="pb<?php echo $row['id']  ?>" value="<?php echo $row['pertes_b']  ?>">
                                                <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i>
                                        </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 input_field_sections">
                                            <h5> Fe </h5>
                                            <div class="input-group">
                                                <input type="text" class="form-control"  name="fe<?php echo $row['id']  ?>" id="fe<?php echo $row['id']  ?>" value="<?php echo $row['fe']  ?>">
                                                <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i>
                                        </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 input_field_sections">
                                            <h5> Flo </h5>
                                            <div class="input-group">
                                                <input type="text" class="form-control"  name="flo<?php echo $row['id']  ?>" id="flo<?php echo $row['id']  ?>" value="<?php echo $row['flo']  ?>">
                                                <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i>
                                        </span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 input_field_sections">
                                            <h5> Nouaison </h5>
                                            <div class="input-group">
                                                <input type="text" class="form-control"  name="noue<?php echo $row['id']  ?>" id="noue<?php echo $row['id']  ?>" value="<?php echo $row['Noue']  ?>">
                                                <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i>
                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="display: none">

                                        <div class="col-lg-3 input_field_sections">
                                            <h5> Aspect A </h5>
                                            <div class="input-group">
                                                <input type="text" class="form-control"  name="aspa<?php echo $row['id']  ?>" id="aspa<?php echo $row['id']  ?>" value="<?php echo $row['aspect_a']  ?>">
                                                <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i>
                                        </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 input_field_sections">
                                            <h5> Aspect B </h5>
                                            <div class="input-group">
                                                <input type="text" class="form-control"  name="aspb<?php echo $row['id']  ?>" id="aspb<?php echo $row['id']  ?>" value="<?php echo $row['aspect_b']  ?>">
                                                <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i>
                                        </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 input_field_sections">
                                            <h5>Aspect C </h5>
                                            <div class="input-group">
                                                <input type="text" class="form-control"  name="aspc<?php echo $row['id']  ?>" id="aspc<?php echo $row['id']  ?>" value="<?php echo $row['aspect_c']  ?>">
                                                <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i>
                                        </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 input_field_sections">
                                            <h5> Aspect D </h5>
                                            <div class="input-group">
                                                <input type="text" class="form-control"  name="aspd<?php echo $row['id']  ?>" id="aspd<?php echo $row['id']  ?>" value="<?php echo $row['aspect_d']  ?>">
                                                <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i>
                                        </span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 input_field_sections">
                                            <h5> Pesé </h5>
                                            <div class="input-group">
                                                <input type="text" class="form-control"  name="pesef<?php echo $row['id']  ?>" id="pesef<?php echo $row['id']  ?>" value="<?php echo $row['pese_f']  ?>">
                                                <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i>
                                        </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 input_field_sections">
                                            <h5> Production_oct_mars </h5>
                                            <div class="input-group">
                                                <input type="text" class="form-control"  name="prodom<?php echo $row['id']  ?>" id="prodom<?php echo $row['id']  ?>" value="<?php echo $row['Production_oct_mars']  ?>">
                                                <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i>
                                        </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 input_field_sections">
                                            <h5> Production_avril_sept </h5>
                                            <div class="input-group">
                                                <input type="text" class="form-control"  name="prodom<?php echo $row['id']  ?>" id="prodas<?php echo $row['id']  ?>" value="<?php echo $row['Production_avril_sept']  ?>">
                                                <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i>
                                        </span>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 input_field_sections">
                                            <h5>Observations</h5>
                                            <div class="input-group">
                                                <select class="form-control chzn-select" name="obsr<?php echo $row['id']  ?>" id="obsr<?php echo $row['id']  ?>" >
                                                    <option selected disabled></option>
                                                    <?php

                                                    $rsdepo = $bdd->prepare("select * from tab_observation ");
                                                    $rsdepo->execute();
                                                    while($rowdepo = $rsdepo->fetch()) {
                                                        ?>
                                                        <option value="<?php echo $rowdepo['param'] ?>" <?php if (isset($row['obsr']) && $row['obsr']==$rowdepo['param']){ echo  'selected'; } ?> ><?php echo $rowdepo['libelleobs'] ?></option>

                                                    <?php }  ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 input_field_sections">
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
    <div class="modal fade bs-example-modal-sm" id="valider<?php echo $_POST['pa']  ?>" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="false" style="z-index: 3000000">
        <div class="modal-dialog modal-sm rounded">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-white">Valider les comptages  <?php
                        if ($_POST['pa']!=='Tous') {
                            $sqlparcelle1 = $bdd->prepare("SELECT *  from parcelles WHERE code_parcelle= :c  ");
                            $sqlparcelle1->execute(array("c" => $_POST['pa']));
                            $rowparn = $sqlparcelle1->fetch();

                        }

                        ?></h4>
                </div>
                <div class="modal-body">

                    <div class="row">

                        <h3 style="color: green; text-align: center"> Parcelle: <?php echo  $rowparn['nom_parcelle']; ?></h3>

                        <input type="text" value="<?php echo  $_POST['dep']; ?>" id="departement" hidden>
                        <input type="text" value="<?php echo  $_POST['vil']; ?>" id="village" hidden>
                        <input type="text" value="<?php echo  $_POST['del']; ?>" id="delegation" hidden>
                    </div>

                    <br>
                    <hr>

                    <div class="input-group d-flex">
                        &nbsp;<a href="javascript:void(0);" data-dismiss="modal" type="button" class="btn btn-danger pull-right" onclick="validerp('<?php echo $_POST['pa']  ?>','<?php echo $_POST['camp']  ?>','<?php echo $_POST['idpa']  ?>')">Valider</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
}
?>