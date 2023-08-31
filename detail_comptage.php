<?php
if (isset($_GET['idel'])){

     $codedel = $_GET['idel'];
     $camp = $_GET['camp'];
     $pas = $_GET['pas'];

    $rsdel = $bdd->prepare('select * from delegations where id= :d ');
    $rsdel->execute(array('d' => $codedel  ));
    $rowdel = $rsdel->fetch();
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


                        <li class="active breadcrumb-item">Details des données transferées : <?php echo $rowdel['designation']?> </li>
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
                                    <th>Departement </th>
                                    <th>Sous Prefecture </th>
                                    <th>Village </th>
                                    <th>Nbre </th>

                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                $i=1;
                               // echo $rowdel['code_delegation'];
                                $sqlccacao_dr = $bdd->prepare("SELECT count(id) as a, village_code  from comptage_cacaos WHERE  an_campagne = :an  and id_passage_periode = :p and supp=0 and delegation_code = :dl  group by village_code ");
                                $sqlccacao_dr->execute(array("an" => $camp,"p" =>$pas,"dl" => $rowdel['code_delegation']));

                                while($rowg = $sqlccacao_dr->fetch()) {
                                    $codev = $rowg['village_code'];
                                    $rsppp = $bdd->prepare('select * from villages where code_village= :d ');
                                    $rsppp->execute(array('d' => $codev  ));
                                  $rowvill = $rsppp->fetch();

                                  /// sous prefecture

                                    $rs_sp= $bdd->prepare('select * from sous_prefectures where code_sous_prefecture= :d ');
                                    $rs_sp->execute(array('d' => $rowvill['sous_prefecture_code']  ));
                                    $row_sp = $rs_sp->fetch();

                                    // departeent
                                    $rs_dep= $bdd->prepare('select * from departements where code_departement= :d ');
                                    $rs_dep->execute(array('d' => $row_sp['departement_code']  ));
                                    $row_dep = $rs_dep->fetch();
                                ?>

                                <tr>
                                    <td><?php echo $i; ?></td>

                                    <td><?php echo $row_dep['designation']; ?></td>
                                    <td><?php echo $row_sp['designation']; ?></td>
                                    <td><?php echo $rowvill['designation']; ?></td>
                                    <td style="text-decoration: underline"><a href="?page=detail_comptage_vil&idel=<?php echo $rowdel['code_delegation'] ?>&camp=<?php echo $camp ?>&pas=<?php echo $pas ?>&vil=<?php echo $codev ?>"><?php echo number_format($rowg['a']); ?></a></td>


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
