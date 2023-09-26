<?php
if (isset($_GET['idel'])){

     $codedel = $_GET['idel'];
     $camp = $_GET['camp'];
     $pas = $_GET['pas'];
     $codev = $_GET['vil'];

    $rsdel = $bdd->prepare('select * from delegations where code_delegation= :d ');
    $rsdel->execute(array('d' => $codedel  ));
    $rowdel = $rsdel->fetch();

    $rsdelv = $bdd->prepare('select * from villages where code_village= :d ');
    $rsdelv->execute(array('d' => $codev  ));
    $rowdelv = $rsdelv->fetch();
}
$i=1;


?>
<div class="wrapper" style=" min-height: 606px;">
    <div id="content" class="bg-container">

        <header class="head">
            <div class="main-bar row">
                <div class="col-sm-5 col-lg-6 skin_txt">
                    <h4 class="nav_top_align">
                        <i class="fa fa-pencil"></i>
                        Details des comptages de la zone de : <?php echo $rowdel['designation']?>
                    </h4>
                </div>
                <div class="col-sm-7 col-lg-6">
                    <ol class="breadcrumb float-xs-right nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                            <a href="?page=milieu">
                                <i class="fa fa-home" data-pack="default" data-tags=""></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="?page=detail_comptage&idel=<?php echo $rowdel['id'] ?>&camp=<?php echo $camp ?>&pas=<?php echo $pas ?>">
                                Listes des villages
                            </a>
                        </li>


                        <li class="active breadcrumb-item">Details des données transferées  du village : <?php echo $rowdelv['designation']?> </li>
                    </ol>
                </div>
            </div>
        </header>

        <div class="row">
            <div class="col-lg-12">
                <div class="card m-t-35">

                        <div class="card-block m-t-35" id="retour_table">

                            <table id="example2"  class="table2excel display table table-stripped table-bordered">
                                <thead>

                                <tr>
                                    <th>#</th>
                                    <th>Departement</th>
                                    <th>Village</th>
                                    <th>Passage</th>
                                    <th>Parcelle</th>
                                    <th>Actions</th>

                                </tr>
                                </thead>


                                <tbody>
                                <?php
                                $i=1;
                               // echo $rowdel['code_delegation'];
                               //var_dump(array("an" => $camp,"p" =>$pas,"dl" => $rowdel['code_delegation'],"vc" => $rowdelv['code_village']));
                                 $sqlccacao_dr = $bdd->prepare("SELECT count(id) as a, parcelle_code  from comptage_cacaos WHERE  an_campagne = :an  and id_passage_periode = :p and supp=0 and delegation_code = :dl and  village_code = :vc   group by parcelle_code ");
                                $sqlccacao_dr->execute(array("an" => $camp,"p" =>$pas,"dl" => $rowdel['code_delegation'],"vc" => $rowdelv['code_village']));

                                while($row = $sqlccacao_dr->fetch()) {
                                   
                                    $vilc= $rowdelv['code_village'];
                                    if (!empty($vilc)){
                                        $sqlvil = $bdd->prepare("SELECT *  from villages WHERE code_village= :c  ");
                                        $sqlvil->execute(array("c" => $vilc));
                                        $rowvil = $sqlvil->fetch();
                                    }

                                    $rs_sp= $bdd->prepare('select * from sous_prefectures where code_sous_prefecture= :d ');
                                    $rs_sp->execute(array('d' => $rowvil['sous_prefecture_code']  ));
                                    $row_sp = $rs_sp->fetch();

                                   
                                    
                                
                                    $sqldep = $bdd->prepare("SELECT *  from departements WHERE code_departement= :c  ");
                                    $sqldep->execute(array("c" => $row_sp['departement_code']));
                                    $rowdep = $sqldep->fetch();

                                    $codepar= $row['parcelle_code'];
                                    $sqlparcelle = $bdd->prepare("SELECT *  from parcelles WHERE code_parcelle= :c  ");
                                    $sqlparcelle->execute(array("c" => $codepar));
                                    $rowpar = $sqlparcelle->fetch();
                                    $idpassage = $pas;
                                    $rsp = $bdd->prepare("select * from passage_periodes WHERE id = :p  and type_pied='K'  ");
                                    $rsp->execute(array('p'=>$idpassage));
                                    $rowpa = $rsp->fetch();
                                ?>

                                    <tr>
                                        <td> <?php echo $i;  ?></td>
                                        <td><?php if (isset($rowdep['designation'])) echo $rowdep['designation'];  ?></td>
                                        <td><?php if (isset( $rowvil['designation']) ) echo $rowvil['designation'];  ?></td>
                                        <td><?php if (isset( $rowpa['libelle']) ) echo $rowpa['libelle'];  ?></td>
                                        <td><?php if (isset($rowpar['nom_parcelle'])) echo $rowpar['nom_parcelle'];  ?></td>
                                        <td style="text-decoration: underline"><a href="?page=detail_comptage_vil2&idel=<?php echo $rowdel['code_delegation'] ?>&camp=<?php echo $camp ?>&pas=<?php echo $pas ?>&vil=<?php echo $codev ?>"><?php echo number_format($row['a']); ?></a></td>


                                    </tr>

                                    <?php $i++; } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>



            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="js/components.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<!--<script type="text/javascript" src="excel/dist/jquery.table2excel.js"></script>-->
