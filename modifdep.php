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
<!--End of plugin styles-->
<!--Page level styles-->
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
                    <a href="?page=listelocalite2">Liste des localités</a>
                </li>
                <li class="active breadcrumb-item">Modifier departement</li>
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
                        Modifier departement
                    </div>
                    <div class="card-block">
                        <?php
                        if(isset($_GET['id'])){


                            try{
                                $id = $_GET['id'];
                                $rsa = $bdd->prepare('select * from departements where  id = :j2');
                                $rsa->execute(array("j2" => $id));
                                $rowa = $rsa->fetch();

                            } catch (Exception $e) {
                                echo 'Erreur : ' . $e->getMessage() . '<br />';
                                echo 'N� : ' . $e->getCode();
                            }
                        }
                        if (isset($_POST['ok'])){


                    $com =  strtoupper($_POST['com']);
                    $dt = date("Y-m-d H:i:s");
                    // je verifie si la com n existe pas

                            $rs = $bdd->prepare('select * from departements where delegation_code = :d and  designation = :l');
                            $rs->execute(array("d" => $_POST['del'],"l" => $com));
                            $nb = $rs->rowCount();
                            if ($nb==0){
                                try {


                                    $rsql1 = $bdd->prepare('UPDATE  departements SET  designation = :designation, delegation_code = :delegation_code
                                                       WHERE id = :id ');
                                    $tab = $rsql1->execute(array('designation' => $com,'delegation_code' => $_POST['del'], 'id' => $id));


                                } catch (Exception $e) {

                                    echo 'Erreur : ' . $e->getMessage() . '<br />';

                                    echo 'N° : ' . $e->getCode();

                                }
                                header("location:?page=listelocalite2");
                            }else{
                                echo '<span style="color: red; font-size: 17px">Ce departement existe  deja !!!</span>';
                            }


                        }

                        ?>
                        <form class="form-horizontal login_validator" id="form_inline_validator" action=""  method="post" enctype="multipart/form-data">

                            <div class="row">
                                <div class="col-lg-4 input_field_sections">
                                    <h5>Delegations </h5>
                                    <div class="input-group">
                                        <select class="form-control chzn-select" name="del" id="role"  >

                                            <?php
                                            $i=1;
                                            $rsdep = $bdd->prepare('select * from delegations   ORDER BY designation ASC ');
                                            $rsdep->execute();
                                            while($rowdep = $rsdep->fetch()) {
                                                ?>
                                                <option value="<?php echo $rowdep['code_delegation'] ?>" <?php if (isset($rowa['delegation_code']) && $rowa['delegation_code']==$rowdep['code_delegation']){echo "selected";   }  ?>><?php echo $rowdep['designation'] ?></option>

                                            <?php }  ?>

                                        </select>
                                    </div>
                                    </div>

                                <div class="col-lg-8 input_field_sections">
                                    <h5>Commune </h5>
                                    <div class="input-group">
                                        <input name="com" type="text" value="<?php if(isset($rowa['designation'])){ echo $rowa['designation'];}  ?>"  class="form-control" placeholder="Ajout departeent">
                                        <span class="input-group-addon"> <i class="fa fa-braille text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>





                            <br>
                            <hr />
                            <div class="form-group row">
                                <div class="col-lg-6 input_field_sections"></div>
                                <div class="col-lg-5 push-lg-2">
                                    <button class="btn btn-primary" type="submit" name="ok">
                                        <i class="fa fa-braille"></i>
                                       Modifier
                                    </button>
                                    <button class="btn btn-warning" type="reset" id="clear">
                                        <i class="fa fa-refresh"></i>
                                        Annuler
                                    </button>
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
