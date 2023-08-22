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
                    <a href="?page=luseradmin">Liste des comptes utilisateurs</a>
                </li>
                <li class="active breadcrumb-item">Ajouter </li>
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
                       // echo  password_hash('111',PASSWORD_DEFAULT);
                        if (isset($_POST['ok'])){


                            $rsv = $bdd->prepare('select * from users_admin where email = :d ');
                            $rsv->execute(array('d' => $_POST['email'] ));
                            $nb= $rsv->rowCount();
                            if ($nb==0){

                                $rs2 = $bdd->prepare('INSERT INTO users_admin (nom, prenoms,email,password,
fonction_admin,created_at,id_creation,idgroupe,contact,active) 
VALUES(:nom, :prenoms,:email,:password,
:fonction_admin,:created_at,:id_creation,:idgroupe,:contact,:active)');
/*
var_dump(array('matricule' => $_POST['mat'],'nom' => $_POST['nom'],'prenoms' => $_POST['pnom'],'contact' => $_POST['tel']
,'fonction' => $_POST['fonction'] ,'date_creation' => gmdate('Y-m-d H:i:s') ,'est_admin' => $_POST['admin']
,'est_agent' => $_POST['ag'],'est_dg' => $_POST['dg'],'est_dr' => $_POST['dr'],'active' => $_POST['statut'],'delegation_code' => $_POST['dep'],'id_creation' => $_SESSION['id'],
    'login' => password_hash($_POST['pwd'],PASSWORD_BCRYPT),'email' => $_POST['email']));*/

        $rs2->execute(array('nom' => $_POST['nom'],'prenoms' => $_POST['pnom'],'email' => $_POST['email']
                                ,'password' => password_hash($_POST['pwd'],PASSWORD_DEFAULT) ,'fonction_admin' => $_POST['fonction']
        ,'created_at' => gmdate('Y-m-d H:i:s') ,'id_creation' =>  $_SESSION['id'],'idgroupe' => $_POST['role'],
                          'contact' => $_POST['tel']  ,'active' => $_POST['statut']));

         }

 header('location:accueil.php?page=luseradmin');
                        }

                        ?>

                        <form class="form-horizontal login_validator" id="form_inline_validator" action=""  method="post" enctype="multipart/form-data">

                            <div class="row">
                                <div class="col-lg-4 input_field_sections">
                                    <h5>Nom </h5>

                                    <div class="input-group">
                                        <input type="text" class="form-control" name="nom">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-8 input_field_sections">
                                    <h5>Prénoms </h5>

                                    <div class="input-group">
                                        <input type="text" class="form-control" name="pnom">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-lg-3 input_field_sections">
                                    <h5>Contact</h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="tel" id="tel">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-3 input_field_sections">
                                    <h5>Email</h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="email" id="email">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-lg-3 input_field_sections">
                                    <h5>Mot de passe</h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="pwd" id="pwd">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-3 input_field_sections">
                                    <h5>Fonction</h5>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="fonction" id="fonction">
                                        <span class="input-group-addon"> <i class="fa fa-location text-primary"></i>
                                        </span>
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-lg-8 input_field_sections">
                                    <h5>Role </h5>
                                    <div class="input-group">
                                        <select class="form-control chzn-select" name="role" id="role"  >
                                            <option value="" selected readonly=""> Choix du rôle </option>

                                            <?php
                                            $i=1;
                                            $rsdep = $bdd->prepare('select * from gpe_user   ORDER BY descgpe ASC ');
                                            $rsdep->execute();
                                            while($rowdep = $rsdep->fetch()) {
                                                ?>
                                                <option value="<?php echo $rowdep['idgpe'] ?>"><?php echo $rowdep['descgpe'] ?></option>

                                            <?php }  ?>

                                        </select>
                                    </div>

                                </div>
                                <div class="col-lg-4 input_field_sections">

                                    <div class="col-lg-8 ">
                                        <h5>Statut</h5>
                                        <label for="radio31" class="custom-control custom-radio signin_radio3">
                                            <input id="radio31" name="statut" type="radio" class="custom-control-input" value="1"  checked>
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Activé </span>
                                        </label>
                                        <label for="radio41" class="custom-control custom-radio signin_radio4">
                                            <input id="radio41" name="statut" type="radio" class="custom-control-input" value="0">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Désactivé</span>
                                        </label>

                                    </div>
                                </div>
                            </div>


                            <br>
                            <hr />
                            <div class="form-group row">
                                <div class="col-lg-6 input_field_sections"></div>
                                <div class="col-lg- p4 push-lg-2">
                                    <button class="btn btn-primary" type="submit" name="ok">
                                        <i class="fa fa-user"></i>
                                        Creer Compte
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


