<link type="text/css" rel="stylesheet" href="vendors/jasny-bootstrap/css/jasny-bootstrap.min.css"/>
<link type="text/css" rel="stylesheet" href="vendors/bootstrapvalidator/css/bootstrapValidator.min.css"/>
<!--End of plugin styles-->
<!--Page level styles-->
<link type="text/css" rel="stylesheet" href="vendors/jasny-bootstrap/css/jasny-bootstrap.min.css"/>
<link type="text/css" rel="stylesheet" href="vendors/bootstrapvalidator/css/bootstrapValidator.min.css"/>
<link type="text/css" rel="stylesheet" href="vendors/inputlimiter/css/jquery.inputlimiter.css"/>
<link type="text/css" rel="stylesheet" href="vendors/chosen/css/chosen.css"/>
<link type="text/css" rel="stylesheet" href="vendors/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css"/>
<link type="text/css" rel="stylesheet" href="vendors/jquery-tagsinput/css/jquery.tagsinput.css"/>
<link type="text/css" rel="stylesheet" href="vendors/daterangepicker/css/daterangepicker.css"/>
<link type="text/css" rel="stylesheet" href="vendors/datepicker/css/bootstrap-datepicker.min.css"/>
<link type="text/css" rel="stylesheet" href="vendors/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link type="text/css" rel="stylesheet" href="vendors/bootstrap-switch/css/bootstrap-switch.min.css"/>
<link type="text/css" rel="stylesheet" href="vendors/jasny-bootstrap/css/jasny-bootstrap.min.css"/>
<link type="text/css" rel="stylesheet" href="vendors/fileinput/css/fileinput.min.css"/>
<link type="text/css" rel="stylesheet" href="css/pages/form_elements.css"/>
<link type="text/css" rel="stylesheet" href="#" id="skin_change"/>

<header class="head">
    <div class="main-bar row">
        <div class="col-sm-5 col-lg-6 skin_txt">
            <h4 class="nav_top_align">
                <i class="fa fa-pencil"></i>
               Comptage Cacao
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

                <li class="active breadcrumb-item">Comptage Cacao 2023-2024</li>
            </ol>
        </div>
    </div>
</header>
<div class="outer">
    <div class="inner bg-container forms">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-white">
                        Faire une Nouvelle recherche
                    </div>
                    <div class="card-block">
                        <form class="form-horizontal login_validator" id="form_inline_validator" action=""  method="post" enctype="multipart/form-data">

                            <div class="row">
                                <div class="col-lg-2 input_field_sections">
                                    <h5>Campagne</h5>
                                    <div class="input-group">
                                        <select class="form-control chzn-select" name="camp" id="camp" onchange="affiche_periode(this.value)" >
                                            <option selected disabled>selectionner campagne</option>
                                            <?php
                                            $i=1;
                                            $datedb= gmdate('Y')-2; //2021
                                            $datefin= gmdate('Y')+1;//2024


                                            $rsan = $bdd->prepare("select campagne from passage_periodes where type_pied='K' and year(date_debut)>= '$datedb' and year(date_debut)< '$datefin' GROUP BY campagne");
                                            $rsan->execute();
                                            while($rowan = $rsan->fetch()) {
                                                ?>
                                                <option value="<?php echo $rowan['campagne'] ?>"><?php echo $rowan['campagne'] ?></option>

                                            <?php }  ?>

                                        </select>
                                    </div>

                                </div>
                                <div class="col-lg-2 input_field_sections">
                                    <h5>Periode</h5>
                                    <div class="input-group">
                                        <select class="form-control chzn-select" name="periode" id="periode"  onchange="affiche_passage(this.value)"  >
                                            <option selected disabled>selectionner passage</option>


                                        </select>
                                    </div>

                                </div>
                                <div class="col-lg-2 input_field_sections">
                                    <h5>Passage</h5>
                                    <div class="input-group">
                                        <select class="form-control chzn-select" name="passage" id="passage"   >
                                            <option selected disabled>selectionner passage</option>


                                        </select>
                                    </div>

                                </div>

                                <div class="col-lg-2 input_field_sections">
                                    <h5>Departement</h5>
                                    <div class="input-group">
                                        <select class="form-control chzn-select" name="dep" id="dep" onchange="check_village(this.value)" >
                                            <option selected disabled>Selectionner</option>
                                            <?php

                                            $rsdep = $bdd->prepare("select id,code_departement,designation from departements  ORDER BY designation asc");
                                            $rsdep->execute();
                                            while($rowdep = $rsdep->fetch()) {
                                                ?>
                                                <option value="<?php echo $rowdep['code_departement'] ?>"><?php echo $rowdep['designation'] ?></option>

                                            <?php }  ?>

                                        </select>
                                    </div>

                                </div>
                                <div class="col-lg-2 input_field_sections">
                                    <h5>Village</h5>
                                    <div class="input-group">
                                        <select class="form-control chzn-select" name="vil" id="vil" onchange="check_parcelle(this.value)" >
                                            <option selected disabled>Village</option>

                                        </select>
                                    </div>

                                </div>
                                <div class="col-lg-2 input_field_sections">
                                    <h5>Parcelle</h5>
                                    <div class="input-group">
                                        <select class="form-control chzn-select" name="par" id="par" onchange="check_parcelleindiv(this.value)" >
                                            <option selected disabled>Parcelle</option>

                                        </select>
                                    </div>

                                </div>




                            </div>



                        </form>
                    </div>
                </div>
                <div class="card-block " id="retour_table">

                    <div class="row">
                        <div class="col-lg-12 input_field_sections">


                            <table id="example2" class="table table-striped  table-bordered table_res dataTable  ">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Delegation</th>
                                    <th>Departement</th>
                                    <th>Village</th>
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

                                <tr>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>


                                </tr>

                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/components.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<!-- global scripts-->
<script type="text/javascript" src="vendors/jquery.uniform/js/jquery.uniform.js"></script>
<script type="text/javascript" src="vendors/inputlimiter/js/jquery.inputlimiter.js"></script>
<script type="text/javascript" src="vendors/chosen/js/chosen.jquery.js"></script>
<script type="text/javascript" src="vendors/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script type="text/javascript" src="vendors/jquery-tagsinput/js/jquery.tagsinput.js"></script>
<script type="text/javascript" src="vendors/validval/js/jquery.validVal.min.js"></script>
<script type="text/javascript" src="vendors/moment/js/moment.min.js"></script>
<script type="text/javascript" src="vendors/daterangepicker/js/daterangepicker.js"></script>
<script type="text/javascript" src="vendors/datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="vendors/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="vendors/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="vendors/autosize/js/jquery.autosize.min.js"></script>
<script type="text/javascript" src="vendors/inputmask/js/inputmask.js"></script>
<script type="text/javascript" src="vendors/inputmask/js/jquery.inputmask.js"></script>
<script type="text/javascript" src="vendors/inputmask/js/inputmask.date.extensions.js"></script>
<script type="text/javascript" src="vendors/inputmask/js/inputmask.extensions.js"></script>
<script type="text/javascript" src="vendors/fileinput/js/fileinput.min.js"></script>
<script type="text/javascript" src="vendors/fileinput/js/theme.js"></script>


<!--end of plugin scripts-->
<script type="text/javascript" src="js/form.js"></script>
<script type="text/javascript" src="js/pages/form_elements.js"></script>
<!--<script type="text/javascript" src="js/pages/simple_datatables.js"></script>-->
<script type="text/javascript">
    function rech_passage(str) {
        //il fait la mise a jour du prix de base et l'observation

        var xhr2;
        var form_data2 = new FormData();
        form_data2.append("anc", str);

        if (window.XMLHttpRequest) xhr2 = new XMLHttpRequest();
        else if (window.ActiveXObject) xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
        xhr2.open('POST', "data/rech_cpte_cacaopas.php", true);
        xhr2.send(form_data2);
        xhr2.onreadystatechange = function() {
            if (xhr2.readyState == 4 && xhr2.status == 200) {

                document.getElementById("retour_table").innerHTML = this.responseText;
                $('#example2').DataTable( {
                    "dom": "<'row'<'col-md-6 col-xs-12'l><'col-md-6 col-xs-12'f>r><'table-responsive't><'row'<'col-md-5 col-xs-12'i><'col-md-7 col-xs-12'p>>",
                    "pagingType": "full_numbers"
                } );
                affiche_passage(str);

            }else{

            }
            if (xhr2.readyState == 4 && xhr2.status != 200) {
                alert("Error : returned status code " + xhr2.status);
            }
        }
    }
    function affiche_periode(str) {
        //il fait la mise a jour du prix de base et l'observation

        var xhr2;
        var form_data2 = new FormData();
        form_data2.append("codecam", str);

        if (window.XMLHttpRequest) xhr2 = new XMLHttpRequest();
        else if (window.ActiveXObject) xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
        xhr2.open('POST', "data/rech_periode.php", true);
        xhr2.send(form_data2);
        xhr2.onreadystatechange = function() {
            if (xhr2.readyState == 4 && xhr2.status == 200) {

                document.getElementById("periode").innerHTML = this.responseText;
                $("#periode").trigger("chosen:updated");

            }
            if (xhr2.readyState == 4 && xhr2.status != 200) {
                alert("Error : returned status code " + xhr2.status);
            }
        }
    }
    function affiche_passage(str) {
        //il fait la mise a jour du prix de base et l'observation

        var xhr2;
        var form_data2 = new FormData();
        form_data2.append("codecam", $('#camp').val());
        form_data2.append("periode", str);

        if (window.XMLHttpRequest) xhr2 = new XMLHttpRequest();
        else if (window.ActiveXObject) xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
        xhr2.open('POST', "data/rech_passage.php", true);
        xhr2.send(form_data2);
        xhr2.onreadystatechange = function() {
            if (xhr2.readyState == 4 && xhr2.status == 200) {

                document.getElementById("passage").innerHTML = this.responseText;
                $("#passage").trigger("chosen:updated");

            }
            if (xhr2.readyState == 4 && xhr2.status != 200) {
                alert("Error : returned status code " + xhr2.status);
            }
        }
    }

    function rech_par_deleg(str) {
        //il fait la mise a jour du prix de base et l'observation

        var xhr2;
        var form_data2 = new FormData();
        form_data2.append("anc", $('#camp').val());
        form_data2.append("idpa", str);
        if (window.XMLHttpRequest) xhr2 = new XMLHttpRequest();
        else if (window.ActiveXObject) xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
        xhr2.open('POST', "data/rech_cpte_cacaocamp.php", true);
        xhr2.send(form_data2);
        xhr2.onreadystatechange = function() {
            if (xhr2.readyState == 4 && xhr2.status == 200) {

                document.getElementById("retour_table").innerHTML = this.responseText;
                $('#example2').DataTable( {
                    "dom": "<'row'<'col-md-6 col-xs-12'l><'col-md-6 col-xs-12'f>r><'table-responsive't><'row'<'col-md-5 col-xs-12'i><'col-md-7 col-xs-12'p>>",
                    "pagingType": "full_numbers"
                } );
                rech_par_dep(str);

            }else{

            }
            if (xhr2.readyState == 4 && xhr2.status != 200) {
                alert("Error : returned status code " + xhr2.status);
            }
        }
    }
    function affiche_del(str) {
        //il fait la mise a jour du prix de base et l'observation

        var xhr2;
        var form_data2 = new FormData();
        form_data2.append("idpa", str);
        form_data2.append("camp", $('#camp').val());

        if (window.XMLHttpRequest) xhr2 = new XMLHttpRequest();
        else if (window.ActiveXObject) xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
        xhr2.open('POST', "data/rech_del.php", true);
        xhr2.send(form_data2);
        xhr2.onreadystatechange = function() {
            if (xhr2.readyState == 4 && xhr2.status == 200) {

                document.getElementById("del").innerHTML = this.responseText;
                $("#del").trigger("chosen:updated");

            }
            if (xhr2.readyState == 4 && xhr2.status != 200) {
                alert("Error : returned status code " + xhr2.status);
            }
        }
    }


    function rech_par_dep(str) {
        //il fait la mise a jour du prix de base et l'observation

        var xhr2;
        var form_data2 = new FormData();
        form_data2.append("del", str);
        form_data2.append("camp", $('#camp').val());
        form_data2.append("idpa", $('#passage').val());

        if (window.XMLHttpRequest) xhr2 = new XMLHttpRequest();
        else if (window.ActiveXObject) xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
        xhr2.open('POST', "data/rech_cpte_cacaodel.php", true);
        xhr2.send(form_data2);
        xhr2.onreadystatechange = function() {
            if (xhr2.readyState == 4 && xhr2.status == 200) {

                document.getElementById("retour_table").innerHTML = this.responseText;
                $('#example2').DataTable( {
                    "dom": "<'row'<'col-md-6 col-xs-12'l><'col-md-6 col-xs-12'f>r><'table-responsive't><'row'<'col-md-5 col-xs-12'i><'col-md-7 col-xs-12'p>>",
                    "pagingType": "full_numbers"
                } );
                affiche_dep(str)

            }else{

            }
            if (xhr2.readyState == 4 && xhr2.status != 200) {
                alert("Error : returned status code " + xhr2.status);
            }
        }
    }
    function affiche_dep(str) {
        //il fait la mise a jour du prix de base et l'observation

        var xhr2;
        var form_data2 = new FormData();
        form_data2.append("code", str);
        form_data2.append("camp", $('#camp').val());
        form_data2.append("idpa", $('#passage').val());

        if (window.XMLHttpRequest) xhr2 = new XMLHttpRequest();
        else if (window.ActiveXObject) xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
        xhr2.open('POST', "data/rech_dep.php", true);
        xhr2.send(form_data2);
        xhr2.onreadystatechange = function() {
            if (xhr2.readyState == 4 && xhr2.status == 200) {

                document.getElementById("dep").innerHTML = this.responseText;
                $("#dep").trigger("chosen:updated");

            }
            if (xhr2.readyState == 4 && xhr2.status != 200) {
                alert("Error : returned status code " + xhr2.status);
            }
        }
    }

    function check_village(str) {
        //il fait la mise a jour du prix de base et l'observation

        var xhr2;
        var form_data2 = new FormData();
        form_data2.append("dp", str);


        if (window.XMLHttpRequest) xhr2 = new XMLHttpRequest();
        else if (window.ActiveXObject) xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
        xhr2.open('POST', "data/rech_dev.php", true);
        xhr2.send(form_data2);
        xhr2.onreadystatechange = function() {
            if (xhr2.readyState == 4 && xhr2.status == 200) {

                document.getElementById("vil").innerHTML = this.responseText;
                $("#vil").trigger("chosen:updated");

            }
            if (xhr2.readyState == 4 && xhr2.status != 200) {
                alert("Error : returned status code " + xhr2.status);
            }
        }
    }
    function affiche_dev(str) {
        //il fait la mise a jour du prix de base et l'observation

        var xhr2;
        var form_data2 = new FormData();
        form_data2.append("dp", str);
        form_data2.append("camp", $('#camp').val());
        form_data2.append("del", $('#del').val());
        form_data2.append("idpa", $('#passage').val());

        if (window.XMLHttpRequest) xhr2 = new XMLHttpRequest();
        else if (window.ActiveXObject) xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
        xhr2.open('POST', "data/rech_dev.php", true);
        xhr2.send(form_data2);
        xhr2.onreadystatechange = function() {
            if (xhr2.readyState == 4 && xhr2.status == 200) {

                document.getElementById("vil").innerHTML = this.responseText;
                $("#vil").trigger("chosen:updated");

            }
            if (xhr2.readyState == 4 && xhr2.status != 200) {
                alert("Error : returned status code " + xhr2.status);
            }
        }
    }
    function check_parcelle(str) {
        //il fait la mise a jour du prix de base et l'observation

        var xhr2;
        var form_data2 = new FormData();
        form_data2.append("vil", str);
        form_data2.append("camp", $('#camp').val());
        form_data2.append("del", $('#del').val());
        form_data2.append("dep", $('#dep').val());
        form_data2.append("idpa", $('#passage').val());
        if (window.XMLHttpRequest) xhr2 = new XMLHttpRequest();
        else if (window.ActiveXObject) xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
        xhr2.open('POST', "data/rech_cpte_cacaopar2.php", true);
        xhr2.send(form_data2);
        xhr2.onreadystatechange = function() {
            if (xhr2.readyState == 4 && xhr2.status == 200) {

                document.getElementById("retour_table").innerHTML = this.responseText;
                $('#example2').DataTable( {
                    "dom": "<'row'<'col-md-6 col-xs-12'l><'col-md-6 col-xs-12'f>r><'table-responsive't><'row'<'col-md-5 col-xs-12'i><'col-md-7 col-xs-12'p>>",
                    "pagingType": "full_numbers"
                } );
                affiche_par(str);

            }else{

            }
            if (xhr2.readyState == 4 && xhr2.status != 200) {
                alert("Error : returned status code " + xhr2.status);
            }
        }
    }

    function affiche_par(str) {
        //il fait la mise a jour du prix de base et l'observation

        var xhr2;
        var form_data2 = new FormData();
        form_data2.append("vil", str);
        form_data2.append("camp", $('#camp').val());
        form_data2.append("del", $('#del').val());
        form_data2.append("dep", $('#dep').val());
        form_data2.append("idpa", $('#passage').val());
        if (window.XMLHttpRequest) xhr2 = new XMLHttpRequest();
        else if (window.ActiveXObject) xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
        xhr2.open('POST', "data/rech_par.php", true);
        xhr2.send(form_data2);
        xhr2.onreadystatechange = function() {
            if (xhr2.readyState == 4 && xhr2.status == 200) {

                document.getElementById("par").innerHTML = this.responseText;
                $("#par").trigger("chosen:updated");

            }
            if (xhr2.readyState == 4 && xhr2.status != 200) {
                alert("Error : returned status code " + xhr2.status);
            }
        }
    }
    function check_parcelleindiv(str) {
        //il fait la mise a jour du prix de base et l'observation

        var xhr2;
        var form_data2 = new FormData();
        form_data2.append("pa", str);
        form_data2.append("camp", $('#camp').val());
        form_data2.append("del", $('#del').val());
        form_data2.append("dep", $('#dep').val());
        form_data2.append("idpa", $('#passage').val());
        form_data2.append("vil", $('#vil').val());
        if (window.XMLHttpRequest) xhr2 = new XMLHttpRequest();
        else if (window.ActiveXObject) xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
        xhr2.open('POST', "data/rech_cpte_cacaoparindiv.php", true);
        xhr2.send(form_data2);
        xhr2.onreadystatechange = function() {
            if (xhr2.readyState == 4 && xhr2.status == 200) {

                document.getElementById("retour_table").innerHTML = this.responseText;
                $('#example2').DataTable( {
                    "dom": "<'row'<'col-md-6 col-xs-12'l><'col-md-6 col-xs-12'f>r><'table-responsive't><'row'<'col-md-5 col-xs-12'i><'col-md-7 col-xs-12'p>>",
                    "pagingType": "full_numbers"
                } );

            }else{

            }
            if (xhr2.readyState == 4 && xhr2.status != 200) {
                alert("Error : returned status code " + xhr2.status);
            }
        }
    }
    function majcacao(str) {
        //il fait la mise a jour du prix de base et l'observation

        var xhr2;
        var form_data2 = new FormData();
        var a = 'fa'+str;
        var b = 'fb'+str;
        var c = 'fc'+str;
        var d = 'fd'+str;
        var pa = 'pa'+str;
        var pb = 'pb'+str;
        var fe = 'fe'+str;
        var flo = 'flo'+str;
        var noue = 'noue'+str;
        var obs = 'obs'+str;
        var obsr = 'obsr'+str;

        form_data2.append("a", $('#'+a).val());
        form_data2.append("b", $('#'+b).val());
        form_data2.append("c", $('#'+c).val());
        form_data2.append("d", $('#'+d).val());
        form_data2.append("pa", $('#'+pa).val());
        form_data2.append("fe", $('#'+fe).val());
        form_data2.append("flo", $('#'+flo).val());
        form_data2.append("noue", $('#'+noue).val());
        form_data2.append("pb", $('#'+pb).val());
        form_data2.append("obs", $('#'+obs).val());
        form_data2.append("obsr", $('#'+obsr).val());
        form_data2.append("id", str);

        if (window.XMLHttpRequest) xhr2 = new XMLHttpRequest();
        else if (window.ActiveXObject) xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
        xhr2.open('POST', "data/update_cpte_cacao.php", true);
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

    function validerp(par,camp,passage) {
        //il fait la mise a jour du prix de base et l'observation

        var xhr2;
        var form_data2 = new FormData();

        form_data2.append("pa", par);
        form_data2.append("camp", camp);
        form_data2.append("idpa", passage);
        form_data2.append("del", $('#delegation').val());
        form_data2.append("dep", $('#departement').val());
        form_data2.append("vil", $('#village').val());

        if (window.XMLHttpRequest) xhr2 = new XMLHttpRequest();
        else if (window.ActiveXObject) xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
        xhr2.open('POST', "data/valider_cpte_cacao.php", true);
        xhr2.send(form_data2);
        xhr2.onreadystatechange = function() {
            if (xhr2.readyState == 4 && xhr2.status == 200) {
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "positionClass": "toast-top-right",
                    "onclick": null,
                    "showDuration": "100",
                    "hideDuration": "100",
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "swing",
                    "showMethod": "fadeIn",
                    "hideMethod": "slideUp"
                };
                toastr.success("Comptages validé avec succes", "Validation");
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
