<div class="wrapper" style=" min-height: 606px;">
    <div id="content" class="bg-container">

        <header class="head">
            <div class="main-bar row">
                <div class="col-sm-5 col-lg-6 skin_txt">
                    <h4 class="nav_top_align">
                        <i class="fa fa-pencil"></i>
                        Gestion des parcelles
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

                        <li class="active breadcrumb-item">liste des parcelles</li>
                    </ol>
                </div>
            </div>
        </header>

        <div class="row">
            <div class="col-lg-12">
                <div class="card m-t-35">
                        <div class="card-header bg-white">
                            <i class="fa fa-table"></i> Listes des parcelles
                            <a href="?page=ajoutparcelle"  role="button"  class="btn btn-primary float-xs-right">
                                <i class="fa fa-plus" style="margin-right: 3%;"></i> Creer une parcelle
                            </a>
                        </div>
                    <div class="card-block">

                        <div class="row" style="display: none">
                            <div class="col-lg-12 input_field_sections">
                                <h5>Choix producteur </h5>
                                <div class="input-group">
                                    <?php
                                    $rs3=$bdd->prepare("SELECT code_producteur,nom FROM producteurs ORDER BY  nom asc");
                                    $rs3->execute();
                                    ?>
                                    <select class="form-control chzn-select" name="prod" id="prod" required  tabindex="1" onchange="ajout()">
                                        <option  disabled  selected value="-1">Selectionner</option>
                                        <option     value="all">Aucun</option>
                                        <?php while ($row3 = $rs3->fetch()) { ?>
                                            <option value="<?php echo $row3['code_producteur']; ?>" ><?php echo $row3['nom']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>



                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-lg-12 input_field_sections">

                                    <table id="example2" class="table table-responsive table-striped table-bordered table_res dataTable ">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                        <th>Délégation</th>
                                            <th>Departement</th>
                                            <th>Sous prefecture</th>
                                            <th>Village</th>
                                            <th>Code</th>
                                            <th>designation</th>
                                            <th>Variété</th>
                                            <th>Date creation</th>
                                            <th>Superficie(ha)</th>
                                            <th>Production Annuelle </th>
                                            <th>Latitude </th>
                                            <th>Longitude </th>
                                            <th>Statut </th>
                                            <th>Actions</th>

                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php

                                        $sqll = "SELECT *  from parcelles WHERE supp=0 and delegation_code =:d or supp is null and delegation_code =:d";
                                        # Try query or error
                                        $rsl=$bdd->prepare($sqll);
                                        $rsl->execute(array("d"=>$_SESSION['zone']));
                                        $m=1;
                                        while ($rowl = $rsl->fetch()){
                                            $codev = $rowl['village_code'];
                                            $rsv = $bdd->prepare('select * from villages where code_village= :d ');
                                            $rsv->execute(array('d' => $codev ));
                                            $rowv=  $rsv->fetch();
                                            $codesp = $rowl['code_sous_prefecture'];

                                            $rssp = $bdd->prepare('select * from sous_prefectures where code_sous_prefecture= :d ');
                                            $rssp->execute(array('d' => $codesp  ));
                                            $rowsp=  $rssp->fetch();
                                            $codedep = $rowl['departement_code'];
                                            $rsdp = $bdd->prepare('select * from departements where code_departement= :d ');
                                            $rsdp->execute(array('d' => $codedep  ));
                                            $rowdp=  $rsdp->fetch();



                                            $rsdel = $bdd->prepare('select * from delegations where code_delegation= :d ');
                                            $rsdel->execute(array('d' => $rowl['delegation_code']  ));
                                            $rowdel=  $rsdel->fetch();

                                            ?>
                                            <tr>
                                                <td><?php echo $m  ?></td>
                                                <td><?php if ($rowdel['designation'] ) echo $rowdel['designation']  ?></td>
                                                <td><?php if ($rowdp['designation'] ) echo $rowdp['designation']  ?></td>
                                                <td><?php if ($rowsp['designation'] ) echo $rowsp['designation']  ?></td>
                                                <td><?php if($rowv['designation']) echo $rowv['designation']  ?></td>
                                                <td><?php if ($rowl['code_parcelle']) echo $rowl['code_parcelle']  ?></td>
                                                <td><?php if ($rowl['nom_parcelle']) echo $rowl['nom_parcelle']  ?></td>
                                                <td><?php if($rowl['variete']) echo $rowl['variete']  ?></td>
                                                <td><?php echo $rowl['date_creation']  ?></td>
                                                <td><?php echo $rowl['superficie']  ?></td>
                                                <td><?php echo number_format(intval($rowl['production_annuelle']))  ?></td>
                                                <td><?php echo $rowl['latitude']  ?></td>
                                                <td><?php echo $rowl['longitude']  ?></td>
                                                <td><?php if ($rowl['active']==1){ echo '<span style="color: green">Activé</span>'; }else{  echo '<span style="color: red">Désactivé</span>';}   ?></td>
                                                <td>
                                                    <a href="?page=modifparcelle&idp=<?php echo $rowl['id'] ?>"> <span class="fa fa-pencil" style="font-size: 15px;"></span></a>
                                                    &nbsp;<a href="#"> <span class="fa fa-trash" style="font-size: 15px;"></span></a>
                                                </td>
                                            </tr>
                                            <?php $m++ ; } ?>
                                        </tbody>
                                    </table>

                            </div>
                        </div>
                    </div>
                    </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="js/components.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<!--<script type="text/javascript" src="excel/dist/jquery.table2excel.js"></script>-->
<script type="text/javascript" >
    function ajout() {
        //il fait la mise a jour du prix de base et l'observation

        var xhr2;
        var form_data2 = new FormData();
        form_data2.append("p", $('#prod').val());

        if (window.XMLHttpRequest) xhr2 = new XMLHttpRequest();
        else if (window.ActiveXObject) xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
        xhr2.open('POST', "data/rechparcelle.php", true);
        xhr2.send(form_data2);
        xhr2.onreadystatechange = function() {
            if (xhr2.readyState == 4 && xhr2.status == 200) {

                document.getElementById("retour_table").innerHTML = this.responseText;
                $('#example2').DataTable( {
                    "dom": "<'row'<'col-md-6 col-xs-12'l><'col-md-6 col-xs-12'f>r><'table-responsive't><'row'<'col-md-5 col-xs-12'i><'col-md-7 col-xs-12'p>>",
                    "pagingType": "full_numbers"
                } );
            }
            if (xhr2.readyState == 4 && xhr2.status != 200) {
                alert("Error : returned status code " + xhr2.status);
            }
        }
    }
</script>