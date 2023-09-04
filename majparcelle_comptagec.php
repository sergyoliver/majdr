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
               Formulaire de mise à jour
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
                    <a href="?page=listeparcelle">Liste des parcelles</a>
                </li>
                <li class="active breadcrumb-item">Ajouter nouvelle parcelle</li>
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
                       Ajouter un nouveau compte
                    </div>
                    <div class="card-block">
                        <?php

                        if (isset($_POST['ok'])){
                          // $codepar =   generer_codepar($_POST['actif'],$_POST['dep']);
                         //  var_dump($codepar);
                            $vvv = $_POST['vil'] ;
                          //  echo "select * from villages where code_village ='$vvv' ";
                            $rsv = $bdd->prepare('select * from villages where code_village = :d ');
                            $rsv->execute(array('d' => $_POST['vil'] ));
                            $rowv = $rsv->fetch();
                             $sp = $rowv['sous_prefecture_code'];

                            $rsdp = $bdd->prepare('select * from departements where code_departement = :d ');
                            $rsdp->execute(array('d' => $_POST['dep'] ));
                            $rowdp = $rsdp->fetch();

                            if ($_POST['actif']=="CACAO"){
                                $matable = 'comptage_cacaos';
                            }else{
                                $matable = 'comptage_cafes';
                            }




                            $rsql1 = $bdd->prepare('UPDATE parcelles set
code_sous_prefecture= :code_sous_prefecture,village_code = :village_code,departement_code= :departement_code, 
date_modification= :date_modification,id_modification= :id_modification 
WHERE code_parcelle = :d and delegation_code= :del ');


                            $rsql1->execute(array('code_sous_prefecture' => $sp, 'village_code' => $_POST['vil'], 'departement_code' => $_POST['dep']
,'date_modification'=> gmdate("Y-m-d H:i:s"),'id_modification'=> $_SESSION['id'],'d'=>$_POST['codep'],'del'=>$rowdp['delegation_code']));


                            $rsqlc = $bdd->prepare("UPDATE $matable set
sous_prefecture_code= :sous_prefecture_code,village_code = :village_code,departement_code= :departement_code, 
date_modification= :date_modification,id_modification= :id_modification 
WHERE parcelle_code = :d and delegation_code= :del ");

                            echo "UPDATE $matable set
sous_prefecture_code= :sous_prefecture_code,village_code = :village_code,departement_code= :departement_code, 
date_modification= :date_modification,id_modification= :id_modification 
WHERE parcelle_code = :d and delegation_code= :del ";

                          $ok=  $rsqlc->execute(array('sous_prefecture_code' => $sp, 'village_code' => $_POST['vil'], 'departement_code' => $_POST['dep']
                            ,'date_modification'=> gmdate("Y-m-d H:i:s"),'id_modification'=> $_SESSION['id'],'d'=>$_POST['codep'],'del'=>$rowdp['delegation_code']));

var_dump(array('sous_prefecture_code' => $sp, 'village_code' => $_POST['vil'], 'departement_code' => $_POST['dep']
,'date_modification'=> gmdate("Y-m-d H:i:s"),'id_modification'=> $_SESSION['id'],'d'=>$_POST['codep'],'del'=>$rowdp['delegation_code']));
                          //  header('location:accueil.php?page=listeparcelle');
                            if ($ok){
                                echo "mise à jour effectué avec succès";
                            }
                        }




                        ?>

                        <form class="form-horizontal login_validator" id="form_inline_validator" action=""  method="post" enctype="multipart/form-data">
                            <div class="row">
                            <div class="col-lg-12 input_field_sections">

                                <div class="col-lg-7 push-lg-6">
                                    <h5>Type de plantation</h5>
                                    <label for="radio3" class="custom-control custom-radio signin_radio3">
                                        <input id="radio3" name="actif" type="radio" class="custom-control-input" value="CAFE" required  >
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">Comptage Café </span>
                                    </label>
                                    <label for="radio4" class="custom-control custom-radio signin_radio4">
                                        <input id="radio4" name="actif" type="radio" class="custom-control-input" value="CACAO"  required >
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">Comptage Cacao</span>
                                    </label>
                                </div>
                            </div>
                            </div>

                            <div class="row">

                                <div class="col-lg-4 input_field_sections">
                                    <h5>Parcelle</h5>
                                    <div class="input-group">
                                        <select class="form-control chzn-select" name="dep" id="dep" onchange="check_parcelled(this.value)" required >
                                            <option selected disabled>-</option>
                                            <?php
                                            $i=1;
                                            $rsp = $bdd->prepare('select * from parcelles WHERE delegation_code = :d ORDER BY nom_parcelle ASC ');
                                            $rsp->execute(array("d"=>$_SESSION['zone']));
                                            while($rowp = $rsp->fetch()) {
                                                ?>
                                                <option value="<?php echo $rowp['code_parcelle'] ?>" ><?php echo $rowp['nom_parcelle'].' / '. $rowp['code_parcelle'] ?></option>

                                            <?php }  ?>

                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="row" id="retourparcelle">


                            </div>

                              <div class="row">
                                <div class="col-lg-4 input_field_sections">
                                    <h5>Délégation / Departement</h5>
                                    <div class="input-group">
                                        <select class="form-control chzn-select" name="dep" id="dep" onchange="check_parcelle(this.value)"  required>
                                            <option selected disabled>Departement</option>
                                            <?php
                                            $i=1;
                                            $rsdep = $bdd->prepare('select *,dp.designation as dpt from departements dp,delegations dl WHERE dl.code_delegation=dp.delegation_code and dl.code_delegation= :d ORDER BY dpt ASC ');
                                            $rsdep->execute(array("d"=>$_SESSION['zone']));
                                            while($rowdep = $rsdep->fetch()) {
                                                ?>
                                                <option value="<?php echo $rowdep['code_departement'] ?>" ><?php echo $rowdep['designation'].' / '. $rowdep['dpt'] ?></option>

                                            <?php }  ?>

                                        </select>
                                    </div>

                                </div>
                                <div class="col-lg-4 input_field_sections">
                                    <h5>Sous Prefecture / Village</h5>
                                    <div class="input-group">
                                        <select class="form-control chzn-select" name="vil" id="vil" required >
                                            <option  disabled></option>
                                            <?php
                                            $code=$rowpm['departement_code'];
                                            $sqll = "SELECT *,v.designation as vil  from villages v ,sous_prefectures sp WHERE sp.code_sous_prefecture=v.sous_prefecture_code AND sp.departement_code= '$code'";
                                            # Try query or error
                                            $rsl=$bdd->prepare($sqll);
                                            $rsl->execute();
                                            $m=1;
                                            while ($rowl = $rsl->fetch()){
                                                ?>
                                                <option value="<?php echo $rowl['code_village'] ?>" <?php if ($rowl['code_village']==$rowpm['village_code']) echo 'selected' ; ?>><?php echo $rowl['designation'].' / '.$rowl['vil'].'' ?></option>

                                            <?php }  ?>

                                        </select>
                                    </div>

                                </div>


                            </div>
                            <input type="hidden" id="del" value="<?=$_SESSION['zone'] ?>">

                            <br>
                            <hr />
                            <div class="form-group row">
                                <div class="col-lg-6 input_field_sections"></div>
                                <div class="col-lg-4 push-lg-2">
                                    <button class="btn btn-primary" type="submit" name="ok">
                                        <i class="fa fa-user"></i>
                                      Mettre à jour
                                    </button>

                                </div>
                            </div>
                    </div>
                </div>
                        </form>
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

<script type="text/javascript" src="js/pages/datetime_piker.js?d=<?php echo time() ?>"></script>

<script type="text/javascript">
    function check_parcelle(str) {
        //il fait la mise a jour du prix de base et l'observation
        var xhr2;
        var form_data2 = new FormData();
        form_data2.append("code", str);

        if (window.XMLHttpRequest) xhr2 = new XMLHttpRequest();
        else if (window.ActiveXObject) xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
        xhr2.open('POST', "data/rechvillage.php", true);
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
    function check_parcelled(str) {
        //il fait la mise a jour du prix de base et l'observation
        var xhr2;
        var form_data2 = new FormData();
        form_data2.append("codep", str);
        form_data2.append("zone", $('#del').val());

        if (window.XMLHttpRequest) xhr2 = new XMLHttpRequest();
        else if (window.ActiveXObject) xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
        xhr2.open('POST', "data/parcellemaj.php", true);
        xhr2.send(form_data2);
        xhr2.onreadystatechange = function() {
            if (xhr2.readyState == 4 && xhr2.status == 200) {
                document.getElementById("retourparcelle").innerHTML = this.responseText;


            }
            if (xhr2.readyState == 4 && xhr2.status != 200) {
                alert("Error : returned status code " + xhr2.status);
            }
        }
    }
    function ajoutprod() {
        //il fait la mise a jour du prix de base et l'observation
        var xhr2;
        var form_data2 = new FormData();
        form_data2.append("nomp", $('#nomprod').val());
        form_data2.append("telp", $('#telprod').val());

        if (window.XMLHttpRequest) xhr2 = new XMLHttpRequest();
        else if (window.ActiveXObject) xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
        xhr2.open('POST', "data/ajoutprod.php", true);
        xhr2.send(form_data2);
        xhr2.onreadystatechange = function() {
            if (xhr2.readyState == 4 && xhr2.status == 200) {
                document.getElementById("prod").innerHTML = this.responseText;
                $("#prod").trigger("chosen:updated");

            }
            if (xhr2.readyState == 4 && xhr2.status != 200) {
                alert("Error : returned status code " + xhr2.status);
            }
        }
    }
</script>
