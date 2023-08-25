<style>
    a{
        text-decoration: underline;
    }
    a:hover{
        color: #FF0000;
    }
</style>
<div class="wrapper" style=" min-height: 606px;">
    <div id="content" class="bg-container">

        <header class="head">
            <div class="main-bar row">
                <div class="col-sm-5 col-lg-6 skin_txt">
                    <h4 class="nav_top_align">
                        <i class="fa fa-pencil"></i>
                        Gestion des localités
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

                        <li class="active breadcrumb-item">liste des localités</li>
                    </ol>
                </div>
            </div>
        </header>

        <div class="row">
            <div class="col-lg-12">
                <div class="card m-t-35">
                        <div class="card-header bg-white">
                            <i class="fa fa-table"></i> Listes des délégations
                            <a href="?page=ajoutcompte"  role="button"  class="btn btn-primary float-xs-right" style="display: none">
                                <i class="fa fa-plus" style="margin-right: 3%;"></i> Creer une délégation
                            </a>
                        </div>
                        <div class="card-block m-t-35" id="retour_table">

                            <table id="example2"  class="table2excel display table table-stripped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Delegation</th>
                                    <th>Departement</th>
                                    <th>Sous prefecture</th>
                                    <th>Village</th>

                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                $i=1;
                                $rsg = $bdd->prepare(' select dl.designation as delegation, dl.id as iddl, dp.designation as departement,dp.id as iddp, sp.designation as sousp,sp.id as idsp, v.designation as vil, v.id as idv,v.code_village
FROM delegations  dl, departements dp,sous_prefectures sp,villages v
where dl.code_delegation=dp.delegation_code and dp.code_departement=sp.departement_code
and sp.code_sous_prefecture=v.sous_prefecture_code ');
                                $rsg->execute();
                                while($rowg = $rsg->fetch()) {


                                ?>

                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><a href="?page=modifdel&id=<?php echo $rowg['iddl']; ?>"><?php echo $rowg['delegation']; ?></a></td>
                                    <td><a href="?page=modifdep&id=<?php echo $rowg['iddp']; ?>"><?php echo $rowg['departement']; ?></a></td>
                                    <td><a href="?page=modifsoup&id=<?php echo $rowg['idsp']; ?>"><?php echo $rowg['sousp']; ?></a></td>
                                    <td><a href="?page=modifvil&id=<?php echo $rowg['idv']; ?>"><?php echo $rowg['vil']; ?></a></td>


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
<input type="hidden" value="<?php echo $_SESSION['id'] ?>" id="masession">
<script type="text/javascript" src="js/components.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<!--<script type="text/javascript" src="excel/dist/jquery.table2excel.js"></script>-->
