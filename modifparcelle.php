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
               Formulaire d'ajout de compte
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
                        if (isset($_GET['idp'])){
                            $idpa = $_GET['idp'];
                            $rspm = $bdd->prepare('select * from parcelles where id = :d ');
                            $rspm->execute(array('d' => $idpa ));
                            $rowpm= $rspm->fetch();
                        }
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


                            if (!empty($_POST['Datedebut'])){
                                if ($_POST['Datedebut']=="--"){
                                    $datedb = '';
                                }else{
                                    $datedb = formatinv_date($_POST['Datedebut']);
                                }


                            }else{$datedb = ''; }

                            $rsql1 = $bdd->prepare('UPDATE parcelles set
code_parcelle= :code_parcelle,delegation_code= :delegation_code,code_sous_prefecture= :code_sous_prefecture,village_code = :village_code
,type_plantation= :type_plantation,departement_code= :departement_code, nom_parcelle = :nom_parcelle,date_creation= :date_creation,
date_modification= :date_modification,id_modification= :id_modification,code_prod= :code_prod,
variete= :variete,superficie= :superficie,production_annuelle= :production_annuelle,annnee_creation= :annnee_creation,
observation_variete= :observation_variete,active= :active,mode_aquisition= :mode_aquisition WHERE id = :d ');


                            $rsql1->execute(array('code_parcelle' => $_POST['codep'],'delegation_code' => $rowdp['delegation_code'], 'code_sous_prefecture' => $sp, 'village_code' => $_POST['vil']
, 'type_plantation' => $_POST['actif'],'departement_code'=> $_POST['dep'],'nom_parcelle'=> $_POST['nomsite']
,'date_creation'=> $datedb,'date_modification'=> gmdate("Y-m-d H:i:s"),'id_modification'=> $_SESSION['id'],'code_prod'=> $_POST['prod']
,'variete'=> $_POST['variete'],'superficie'=> $_POST['sup'],'production_annuelle'=> $_POST['prodan'],'annnee_creation'=> $_POST['an'],
'observation_variete'=> $_POST['obs'],'active'=>$_POST['actifp'],'mode_aquisition'=> $_POST['modea'],'d'=>$idpa));

                            /*     var_dump(array('code_parcelle' => $_POST['codep'],'delegation_code' => $rowdp['delegation_code'], 'code_sous_prefecture' => $sp, 'village_code' => $_POST['vil']
, 'type_plantation' => $_POST['actif'],'departement_code'=> $_POST['dep'],'nom_parcelle'=> $_POST['nomsite']
,'date_creation'=> formatinv_date($_POST['Datedebut']),'date_modification'=> gmdate("Y-m-d H:i:s"),'id_modification'=> $_SESSION['id'],'code_prod'=> $_POST['prod']
,'variete'=> $_POST['variete'],'superficie'=> $_POST['sup'],'production_annuelle'=> $_POST['prodan'],'annnee_creation'=> $_POST['an'],
'observation_variete'=> $_POST['obs'],'active'=>$_POST['actifp'],'mode_aquisition'=> $_POST['modea'],'d'=>$idpa));*/

header('location:accueil.php?page=listeparcelle');
                        }




                        ?>

                        <form class="form-horizontal login_validator" id="form_inline_validator" action=""  method="post" enctype="multipart/form-data">
                            <div class="row">
                            <div class="col-lg-12 input_field_sections">

                                <div class="col-lg-7 push-lg-6">
                                    <h5>Type de plantation</h5>
                                    <label for="radio3" class="custom-control custom-radio signin_radio3">
                                        <input id="radio3" name="actif" type="radio" class="custom-control-input" value="CAFE"  <?php if ($rowpm['type_plantation']=='CAFE') echo 'checked' ; ?>>
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">Café </span>
                                    </label>
                                    <label for="radio4" class="custom-control custom-radio signin_radio4">
                                        <input id="radio4" name="actif" type="radio" class="custom-control-input" value="CACAO"  <?php if ($rowpm['type_plantation']=='CACAO') echo 'checked' ; ?>>
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">Cacao</span>
                                    </label>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 input_field_sections">
                                    <h5>Code de la parcelle</h5>

                                    <div class="input-group">
                                        <input type="text" style="background-color: #8fdf82; font-weight: bold;color: black" class="form-control" name="codep" value="<?php echo $rowpm['code_parcelle'] ?>">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-12 input_field_sections">
                                    <h5>Producteurs</h5>
                                    <div class="input-group">
                                        <select class="form-control chzn-select" name="prod" id="prod"  >
                                            <option  disabled>Producteurs</option>
                                            <option value="0">Inconnu</option>
                                            <?php
                                            $p=1;
                                            $rsprod = $bdd->prepare('select nom,code_producteur from producteurs where   producteurs.supp =0   group by nom,code_producteur  ');
                                            $rsprod->execute();
                                            while($rowprod = $rsprod->fetch()) {
                                                ?>
                                                <option value="<?php echo $rowprod['code_producteur'] ?>"  <?php if ($rowpm['code_prod']==$rowprod['code_producteur']) echo 'selected' ; ?>><?php echo $rowprod['nom'] ?></option>

                                            <?php }  ?>

                                        </select>
                                    </div>
                                    <span style="text-align: center"><a data-toggle="modal"  href="#ajoutp" class="todoedit">Ajouter nouveau producteur</a><a class="fa fa-plus"></a></span>

                                    <!--                                    <span style="text-align: center"><a href="">eau producteur</a></span>-->

                                </div>


                            </div>

                            <div class="modal fade bs-example-modal-md" id="ajoutp" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="false" style="z-index: 3000000">
                                <div class="modal-dialog modal-xl rounded">
                                    <div class="modal-content">
                                        <div class="card-header card-primary">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title text-white">Nouveau producteur</h4>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row">

                                                 <div class="col-lg-12 input_field_sections">
                                                    <h5>Producteur  </h5>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control"  name="nom" id="nomprod" value="">
                                                        <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i></span>
                                                    </div>
                                                </div>

                                                <div class="col-lg-8 input_field_sections">
                                                    <h5>Contact  </h5>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control"  name="tel" id="telprod" value="">
                                                        <span class="input-group-addon"> <i class="fa fa-phone text-primary"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <hr>

                                            <div class="input-group d-flex">
                                                <button type="button" data-dismiss="modal" class="btn btn-primary pull-left">Annuler</button> &nbsp;
                                                <a href="javascript:void(0);" data-dismiss="modal" type="button" class="btn btn-success pull-right" onclick="ajoutprod()">Ajouter producteur</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 input_field_sections">
                                    <h5>Délégation / Departement</h5>
                                    <div class="input-group">
                                        <select class="form-control chzn-select" name="dep" id="dep" onchange="check_parcelle(this.value)" >
                                            <option selected disabled>Departement</option>
                                            <?php
                                            $i=1;
                                            $rsdep = $bdd->prepare('select *,dp.designation as dpt from departements dp,delegations dl WHERE dl.code_delegation=dp.delegation_code ORDER BY dpt ASC ');
                                            $rsdep->execute();
                                            while($rowdep = $rsdep->fetch()) {
                                                ?>
                                                <option value="<?php echo $rowdep['code_departement'] ?>" <?php if ($rowpm['departement_code']==$rowdep['code_departement']) echo 'selected' ; ?>><?php echo $rowdep['designation'].' / '. $rowdep['dpt'] ?></option>

                                            <?php }  ?>

                                        </select>
                                    </div>

                                </div>
                                <div class="col-lg-4 input_field_sections">
                                    <h5>Sous Prefecture / Village</h5>
                                    <div class="input-group">
                                        <select class="form-control chzn-select" name="vil" id="vil" >
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
                                <div class="col-lg-4 input_field_sections">
                                    <h5>Nom du site</h5>

                                    <div class="input-group">
                                        <input type="text" class="form-control" name="nomsite" value="<?php echo $rowpm['nom_parcelle'] ?>">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-3 input_field_sections">
                                    <h5>Variétés</h5>
                                    <div class="input-group">
                                        <select class="form-control chzn-select" name="variete" id="variete"  >
                                            <option >variete</option>
                                            <option value="Tout Venant" <?php if ($rowpm['variete']=='Tout Venant') echo 'selected' ; ?>> Tout Venant</option>
                                            <option value="Café arabica" <?php if ($rowpm['variete']=='Café arabica') echo 'selected' ; ?>> Café arabica</option>
                                            <option value="Café robusta" <?php if ($rowpm['variete']=='Café robusta') echo 'selected' ; ?>> Café robusta</option>
                                            <option value="Café nvelle variété" <?php if ($rowpm['variete']=='Café nvelle variété') echo 'selected' ; ?>> Café nvelle variété</option>
                                            <option value="Cacao ancien" <?php if ($rowpm['variete']=='Cacao ancien') echo 'selected' ; ?>> Cacao ancien</option>
                                            <option value="Cacao Mercedes"  <?php if ($rowpm['variete']=='Cacao Mercedes') echo 'selected' ; ?>> Cacao Mercedes</option>


                                        </select>
                                    </div>

                                </div>
                                <div class="col-lg-3 input_field_sections">
                                    <h5>Mode d'acquisition</h5>
                                    <div class="input-group">
                                        <select class="form-control chzn-select" name="modea" id="modea" >
                                            <option  disabled></option>
                                            <option <?php if ($rowpm['mode_aquisition']=='achat') echo 'selected' ; ?> value="achat" >achat</option>
                                            <option value="héritage" <?php if ($rowpm['mode_aquisition']=='héritage') echo 'selected' ; ?>>héritage</option>
                                            <option value="location" <?php if ($rowpm['mode_aquisition']=='location') echo 'selected' ; ?> >location</option>
                                            <option value="partenariat" <?php if ($rowpm['mode_aquisition']=='partenariat') echo 'selected' ; ?> >partenariat</option>

                                        </select>
                                    </div>

                                </div>
                                <div class="col-lg-3 input_field_sections">
                                    <h5>Superficie ha</h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="sup" id="sup" value="<?php echo $rowpm['superficie'] ?>">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-3 input_field_sections">
                                    <h5>Date de creation</h5>
                                    <div class="input-group">
                                            <span class="input-group-addon"> <i class="fa fa-calendar text-primary"></i>
                                            </span>
                                        <input autocomplete="off" type="text" class="form-control" placeholder="jj-mm-aaaa" id="dp1" name="Datedebut" value="<?php echo $rowpm['date_creation'] ?>">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-3 input_field_sections">
                                    <h5>Année de creation</h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="an" id="an" value="<?php echo $rowpm['annnee_creation'] ?>">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-3 input_field_sections">
                                    <h5>Production Annuelle</h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="prodan" id="prodan" value="<?php echo $rowpm['production_annuelle'] ?>">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-3 input_field_sections">
                                    <h5>Longitude</h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="long" id="long" disabled value="<?php echo $rowpm['longitude'] ?>">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div><div class="col-lg-3 input_field_sections">
                                    <h5>Latitude</h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="lat" id="lat" disabled value="<?php echo $rowpm['latitude'] ?>">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-12 input_field_sections">
                                    <h3>Observation</h3>
                                    <div class="form-group">
                                        <textarea  class="form-control"  name="obs" rows="4" cols="50"><?php echo $rowpm['observation_variete'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 input_field_sections">

                                    <div class="col-lg-7 push-lg-6">
                                        <h5>Activé ou non la parcelle</h5>
                                        <label for="radio31" class="custom-control custom-radio signin_radio3">
                                            <input id="radio31" name="actifp" type="radio" class="custom-control-input" value="1"  <?php if ($rowpm['active']=='1') echo 'checked' ; ?>>
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Activé </span>
                                        </label>
                                        <label for="radio41" class="custom-control custom-radio signin_radio4">
                                            <input id="radio41" name="actifp" type="radio" class="custom-control-input" value="0"  <?php if ($rowpm['active']=='0' or empty($rowpm['active']) ) echo 'checked' ; ?>>
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Ne pas activé</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <hr />
                            <div class="form-group row">
                                <div class="col-lg-6 input_field_sections"></div>
                                <div class="col-lg-4 push-lg-2">
                                    <button class="btn btn-primary" type="submit" name="ok">
                                        <i class="fa fa-user"></i>
                                      Modifier Parcelle
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
