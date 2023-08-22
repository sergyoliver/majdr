<link rel="stylesheet" type="text/css" href="css/pages/widgets.css">
<link rel="stylesheet" href="leaflet.css?d=<?php echo time() ?>" />
<!--<link rel="stylesheet" href="ol6/ol.css?d=--><?php //echo time() ?><!--" />-->
<!--<link rel="stylesheet" href="ol6/switcher/ol-layerswitcher.css?d=--><?php //echo time() ?><!--" />-->
<!--<link rel="stylesheet" href="ol6/switcher/layerswitcher.css?d=--><?php //echo time() ?><!--" />-->
<style>
    body{
        margin:0
    }
    #maCarte{
        height: 100vh;
    }
</style>
<div class="wrapper" style=" min-height: 606px;">
    <div id="content" class="bg-container">

        <header class="head">
            <div class="main-bar row">
                <div class="col-sm-5 col-lg-6 skin_txt">
                    <h4 class="nav_top_align">
                        <i class="fa fa-pencil"></i>
                        DASHBORD
                    </h4>
                </div>
                <div class="col-sm-7 col-lg-6">
                    <ol class="breadcrumb float-xs-right nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                            <a href="accueil.php?page=milieu">
                                <i class="fa fa-home" data-pack="default" data-tags=""></i>
                                Dashboard
                            </a>
                        </li>
                    </ol>

                </div>
            </div>
        </header>




        <div class="row">
            <div class="col-lg-8 m-t-35">
                <div class="card">
                    <div class="card-header card-primary" style="color: white">Repartition </div>


                    <div class="card-block" style="background: transparent url(icon/main_bg.jpg) repeat 0 0;">
                        <?php
                        // nbre de departement
                        $rsd = $bdd->prepare('select * from departements ');
                        $rsd->execute();
                        $nbd = $rsd->rowCount();

                        ?>
                        <div class="row" >
                            <div class="col-lg-12 input_field_sections" >
                                <div class="col-sm-6 col-xs-12 col-lg-6">
                                    <div class="widget_icon_bgclr icon_align bg-white" >
                                        <div class="bg_icon bg_icon_success float-xs-left">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </div>
                                        <div class="text-xs-right" style="color: #696056; font-weight: bold;">
                                            <h3 id="widget_count1" ><?php echo number_format($nbd); ?></h3>
                                            <p style="font-size: 15px" >Departement</p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                // nbre de departement
                                $rsp = $bdd->prepare('select * from parcelles WHERE supp =0 or supp is null');
                                $rsp->execute();
                                $nbp = $rsp->rowCount();

                                ?>
                                <div class="col-sm-6 col-xs-12 col-lg-6">
                                    <div class="widget_icon_bgclr icon_align bg-white">
                                        <div class="bg_icon bg_icon_success float-xs-left">
                                            <i class="fa fa-ellipsis-v " aria-hidden="true"></i>
                                        </div>
                                        <div class="text-xs-right" style="color: #696056; font-weight: bold;">
                                            <h3 id="widget_count1"><?php echo number_format($nbp); ?></h3>
                                            <p style="font-size: 15px">Nb parcelles</p>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <?php
                            // nbre de departement
                            $rssup = $bdd->prepare('select sum(superficie ) as sup from parcelles WHERE supp =0 or supp is null');
                            $rssup->execute();
                            $rowsup = $rssup->fetch();

                            ?>
                            <div class="col-lg-12 input_field_sections">
                                <div class="col-sm-6 col-xs-12 col-lg-12 m-b-15">
                                    <div class="widget_icon_bgclr icon_align bg-white" style="color: #696056">
                                        <div class="bg_icon bg_icon_success float-xs-left">
                                            <i class="fa fa-cube" aria-hidden="true"></i>
                                        </div>
                                        <div class="text-xs-right" style="color: #696056;  font-weight: bold;">
                                            <h3 id="widget_count1" ><?php echo number_format(round($rowsup['sup'],2)); ?></h3>
                                            <p style="font-size: 15px">Superficie Total en ha</p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                // nbre de departement
                                $rsprod = $bdd->prepare('select * from producteurs ');
                                $rsprod->execute();
                                $nbprod = $rsprod->rowCount();

                                ?>
                                <div class="col-sm-6 col-xs-12 col-lg-12">
                                    <div class="widget_icon_bgclr icon_align bg-white" style="color: #696056">
                                        <div class="bg_icon bg_icon_primary float-xs-left">
                                            <i class="fa fa-users " aria-hidden="true"></i>
                                        </div>
                                        <div class="text-xs-right" style="color: #696056; font-weight: bold;">
                                            <h3 id="widget_count1" ><?php  echo number_format($nbprod); ?></h3>
                                            <p style="font-size: 15px">Nb Producteurs</p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <br>


                    </div>


                </div>


            </div>
            <div class="col-lg-4 m-t-35">
                <div class="row m-t-25">
                    <div class="col-xs-12 col-sm-12 col-lg-12">
                        <div class="icon_align bg-white" STYLE="vertical-align: middle; margin: auto;text-align: center">
                            <div class=" col-xs-12 button_align_top_button_wrap">
                        <span class="button-wrap">
                            <a href="?page=comptagecafe_encour" class="button button-pill button-danger" style="background-color: #0b7f14; color: white">Comptages café </a>
                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-lg-12 media_max_573 m-t-25">
                        <div class="widget_icon_bgclr icon_align bg-white" STYLE="vertical-align: middle; margin: auto;text-align: center">
                            <div class=" col-xs-12 button_align_top_button_wrap">
                        <span class="button-wrap">
                            <a href="?page=comptagecacao_encour" class="button button-pill button-success" style="background-color: #613510; color: white">Comptages Cacao </a>
                        </span>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 m-t-35">
                <div class="col-lg-8 ">
                    <div class="card">
                        <div class="card-header card-primary" style="background-color: #613510; color: white">Dernier comptage cacao
                            <?php
                            /// quel campagne
                            ///
                            $datej = gmdate("Y-m-d");
                            // echo "SELECT campagne  from passage_periodes WHERE  date_debut >='$datej'  and date_fin <='$datej' and type_pied='K'   ";
                            $sqlperiode = $bdd->prepare("SELECT max(campagne) as camp from passage_periodes WHERE  type_pied='K'   ");
                            $sqlperiode->execute();
                            $row_periode = $sqlperiode->fetch();
                            // $row_periode['camp'];
                            //le numero passage dernier coptage
                            $sqlperiode_comp = $bdd->prepare("SELECT max(nump) as nump from passage_periodes WHERE  type_pied='K'  and campagne = :c ");
                            $sqlperiode_comp->execute(array("c"=>$row_periode['camp']));
                            $row_periode_c = $sqlperiode_comp->fetch();

                            // dernier passage de la campagne
                            $sqlperiode_last = $bdd->prepare("SELECT * from passage_periodes WHERE  type_pied='K'  and campagne = :c and nump= :np");
                            $sqlperiode_last->execute(array("c"=>$row_periode['camp'],"np"=>$row_periode_c['nump']));
                            $row_last_passage = $sqlperiode_last->fetch();
                            echo  $row_last_passage['campagne'].' : Periode '.$row_last_passage['type_periode']." ".$row_last_passage['libelle'];
                            ?>

                        </div>
                        <!--                <div style="align-content: center"><img src="icon/legende.jpg" style="text-align: center" alt=""></div>-->
                        <table  class="table table-striped  table-bordered table_res dataTable  " style="padding: 10px">
                            <thead>
                            <tr style="background-color: #1e4552; color: white; font-weight: bold">
                                <td>fruit A </td>
                                <td>fruit B</td>
                                <td>fruit C</td>
                                <td>fruit D</td>
                                <td>Perte A</td>
                                <td>Perte B</td>
                            </tr>

                            </thead>
                            <tbody>
                            <tr style=" font-size: 16px; font-weight: bold">
                                <?php
                                $sqlccacao = $bdd->prepare("SELECT sum(fruit_a) as a , sum(fruit_b) as b , sum(fruit_c) as c ,sum(fruit_d) as d , sum(pertes_a) as pa , sum(pertes_b) as pb  from comptage_cacaos WHERE  an_campagne = :an  and id_passage_periode = :p and supp=0  ");
                                $sqlccacao->execute(array("an" => $row_last_passage['campagne'],"p" => $row_last_passage['id']));
                                $rowccacao = $sqlccacao->fetch();

                                ?>
                                <td><?php  echo separer_montant($rowccacao['a'])  ?></td>
                                <td><?php echo separer_montant($rowccacao['b']) ?></td>
                                <td><?php echo separer_montant($rowccacao['c']) ?></td>
                                <td><?php echo separer_montant($rowccacao['d']) ?></td>
                                <td><?php echo separer_montant($rowccacao['pa']) ?></td>
                                <td><?php  echo separer_montant($rowccacao['pb']) ?></td>
                            </tr>
                            </tbody>
                        </table>
                        <br>
                    </div>



                </div>
                <div class="col-lg-4 " >
                    <div class="card">
                        <div class="card-header card-primary" style="background-color: #0b7f14; color: white">Comptage en cours café campagne <?php
                            $sqlperiodec = $bdd->prepare("SELECT max(campagne) as camp from passage_periodes WHERE  type_pied='C'   ");
                            $sqlperiodec->execute();
                            $row_periodec = $sqlperiodec->fetch();
                            //   echo $row_periodec['camp'];
                            //le numero passage dernier coptage
                            $sqlperiode_compc = $bdd->prepare("SELECT max(nump) as nump from passage_periodes WHERE  type_pied='C'  and campagne = :c ");
                            $sqlperiode_compc->execute(array("c"=>$row_periode['camp']));
                            $row_periode_cc = $sqlperiode_compc->fetch();

                            // dernier passage de la campagne
                            $sqlperiode_lastc = $bdd->prepare("SELECT * from passage_periodes WHERE  type_pied='C'  and campagne = :c and nump= :np");
                            $sqlperiode_lastc->execute(array("c"=>$row_periodec['camp'],"np"=>$row_periode_cc['nump']));
                            $row_last_passagec = $sqlperiode_lastc->fetch();

                            echo  $row_last_passagec['campagne'].' : Periode '.$row_last_passagec['type_periode']." ".$row_last_passagec['libelle'];


                            ?> </div>


                        <table  class="table table-striped  table-bordered table_res dataTable  " style="padding: 10px">
                            <thead>
                            <tr style="background-color: #1e4552; color: white; font-weight: bold">
                                <td>Nombre de grappes</td>
                                <td>Nombre de fruits</td>
                            </tr>

                            </thead>
                            <tbody>
                            <tr style=" font-size: 16px; font-weight: bold">
                                <td><?php
                                    $sqlcp = $bdd->prepare("SELECT sum(grappe) as gp , sum(fruit) as f  from comptage_cafes WHERE  an_campagne = :an  and id_passage_periode = :p  ");
                                    $sqlcp->execute(array("an" => $row_last_passagec['campagne'],"p" => $row_last_passagec['id']));
                                    $rowcp = $sqlcp->fetch();
                                    echo separer_montant($rowcp['gp'])

                                    ?></td>
                                <td>
                                    <?php
                                    echo separer_montant($rowcp['f'])

                                    ?>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <br>

                    </div>



                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 m-t-35">
                <div class="col-lg-6 m-t-35">
                    <div class="card">
                        <div class="card-header card-primary" style="color: white">Repartition des parcelles de Cacao </div>
                        <!--                <div style="align-content: center"><img src="icon/legende.jpg" style="text-align: center" alt=""></div>-->
                        <div id="maCarte" style="height: 500px"></div>
                        <br>

                    </div>



                </div>
                <div class="col-lg-6 m-t-35">
                    <div class="card">
                        <div class="card-header card-primary" style="color: white">Repartition des parcelles de café  </div>
                        <!--                <div style="align-content: center"><img src="icon/legende.jpg" style="text-align: center" alt=""></div>-->
                        <div id="maCarte2" style="height: 500px"></div>
                        <br>

                    </div>



                </div>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript" src="js/components.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="leaflet.js"></script>
<!--<script type="text/javascript" src="ol6/ol.js?d=--><?php //echo time() ?><!--"></script>-->
<!--<script type="text/javascript" src="ol6/switcher/ol-layerswitcher.js?d=--><?php //echo time() ?><!--"></script>-->

<script type="text/javascript" src="mapleaflet.js?d=<?php echo time() ?>"></script>
<script type="text/javascript" src="mapleaflet2.js?d=<?php echo time() ?>"></script>
