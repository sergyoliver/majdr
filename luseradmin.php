<div class="wrapper" style=" min-height: 606px;">
    <div id="content" class="bg-container">

        <header class="head">
            <div class="main-bar row">
                <div class="col-sm-5 col-lg-6 skin_txt">
                    <h4 class="nav_top_align">
                        <i class="fa fa-pencil"></i>
                        Gestion des utilisateurs
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

                        <li class="active breadcrumb-item">liste des utilisateur siège</li>
                    </ol>
                </div>
            </div>
        </header>

        <div class="row">
            <div class="col-lg-12">
                <div class="card m-t-35">
                    <div class="card-header bg-white">
                        <i class="fa fa-table"></i> Listes des utilisateurs siège
                        <a href="?page=ajoutcompteadmin"  role="button"  class="btn btn-primary float-xs-right">
                            <i class="fa fa-plus" style="margin-right: 3%;"></i> Creer un nouveau Compte
                        </a>
                    </div>
                    <div class="card-block m-t-35">

                        <table id="example1"  class="table2excel display table table-stripped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom et prenoms</th>
                                <th>Email</th>
                                <th>fonction_admin</th>
                                <th>Groupe utilisateur</th>
                                <th>Statut</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            $i=1;
                            $rsg = $bdd->prepare("select * from gpe_user,users_admin WHERE idgroupe=idgpe ORDER BY id desc");
                            $rsg->execute();
                            while($rowg = $rsg->fetch()) {
                                ?>

                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $rowg['nom']." ". $rowg['prenoms']; ?></td>
                                    <td><?php echo $rowg['email']; ?></td>
                                    <td><?php echo $rowg['fonction_admin']; ?></td>
                                    <td><?php echo $rowg['descgpe']; ?></td>


                                    <td><?php if ( $rowg['active']==1){ ?>
                                            <span class="label text-success ">Actif</span>
                                        <?php }else{
                                            //  echo $rowg['active'];
                                            ?>
                                            <span class="label text-danger ">Non Actif</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="?page=modifcompteadmin&id=<?php echo $rowg['id']; ?>" class="todoedit">
                                            <span class="fa fa-pencil"></span>
                                        </a>
                                        <span class="dividor">|</span>
                                        <a href="#" class="tododelete redcolor">
                                            <span class="fa fa-trash"></span>
                                        </a>

                                    </td>
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
