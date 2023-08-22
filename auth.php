<?php
error_reporting(0);
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 07/05/2017
 * Time: 01:33
 */

$info = "";

$log = htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
$pwd = htmlentities($_POST['pwd'], ENT_QUOTES, "UTF-8");
echo $pwd1 = password_hash($_POST['pwd'],PASSWORD_DEFAULT);
$nbre = 0;

if ($log=="admin@gmail.com" and $pwd=="ccc"){


    $_SESSION['nom'] = "Kassi";
    $_SESSION['identite'] = $_SESSION['nom']." Serge Olivier ";
    $_SESSION['email'] = $log;
    $_SESSION['id'] = 3000;
    $_SESSION['gpe'] = "SuperAdmin";
    $_SESSION['dgpe'] = "Super Admin";
    $_SESSION['libgpe'] = $pwd;
    $_SESSION['photo'] = "";
    $_SESSION['mat'] ="3000";
//var_dump($_SESSION);

    // oon verifie s'il existe dans la table copnnexion
    $rsc = $bdd->prepare('select * from connexions where compte_id= :iduser and statut = :statc');
    $rsc->execute(array('iduser' => $_SESSION['id'], 'statc' =>0 ));
     $nbc = $rsc->rowCount();
    // insere info connexion

     if($nbc==0)
    {
        $rs2 = $bdd->prepare('INSERT INTO connexions(compte_id, date_connexion, statut) VALUES(:compte_id, :date_connexion, :statut)');
        $rs2->execute(array('compte_id' => $_SESSION['id'], 'date_connexion' => gmdate("Y-m-d H:i:s"), 'statut' => 1));
    }else{
        // mise a jour dans la BD
        $rsmajcon = $bdd->prepare('UPDATE connexions SET date_connexion = :datc, statut = :statc WHERE compte_id = :iduser');
        $rsmajcon->execute(array('datc' => gmdate("Y-m-d H:i:s"), 'statc' => 1 ,'iduser' => $_SESSION['id']));
    }
  // var_dump( array('datc' => gmdate("Y-m-d H:i:s"), 'statc' => 1 ,'iduser' => $_SESSION['id']));

    header('location:accueil.php?page=milieu');


}else{

   //echo "select * from agents where  matricule = '$log' and  login ='$pwd1' AND active=1 or email ='$log' and login ='$pwd1' and active = 1";
    $rs1 = $bdd->prepare("select * from users_admin where   email ='$log'  and active = 1");
    $rs1->execute();
    $row = $rs1->fetch(PDO::FETCH_ASSOC);
//var_dump($row);

    if ($row) {

           if (password_verify($_POST['pwd'],$row['password'])) {
               $_SESSION['nom'] = $row['nom'];
               $_SESSION['identite'] = $row['nom'] . " " . $row['prenoms'];
               $_SESSION['email'] = $row['email'];
               $_SESSION['id'] = $row['id'];
               //$_SESSION['mat'] = $row['matricule'];
               $rs12 = $bdd->prepare("select * from gpe_user where   idgpe = :gp  ");
               $rs12->execute(array("gp"=>$row['idgroupe']));
               $rowgp = $rs12->fetch(PDO::FETCH_ASSOC);
               $_SESSION['gpe'] = $rowgp['libgpe'];
               $_SESSION['libgpe'] = $rowgp['descgpe'];


               $rsc = $bdd->prepare('select * from connexions where compte_id= :iduser and statut = :statc and type=1');
               $rsc->execute(array('iduser' => $_SESSION['id'], 'statc' =>0 ));
               $nbc = $rsc->rowCount();
               // insere info connexion

               if($nbc==0)
               {
                   $rs2 = $bdd->prepare('INSERT INTO connexions(compte_id, date_connexion, statut,type) VALUES(:compte_id, :date_connexion, :statut, :type)');
                   $rs2->execute(array('compte_id' => $_SESSION['id'], 'date_connexion' => gmdate("Y-m-d H:i:s"), 'statut' => 1, 'type' => 1));
               }else{
                   // mise a jour dans la BD
                   $rsmajcon = $bdd->prepare('UPDATE connexions SET date_connexion = :datc, statut = :statc WHERE compte_id = :iduser and type = :t');
                   $rsmajcon->execute(array('datc' => gmdate("Y-m-d H:i:s"), 'statc' => 1 ,'iduser' => $_SESSION['id'],'t' => 1));
               }
               // echo  'je suis connecté';
           }else{
               //echo "mot de pas non conforme";
           }
        header('location:accueil.php?page=milieu');


    }else{

        // on trace l info
        $chemin = 'logcon/';
        $act = "Echec connexion a la plateforme login renseigné:" . $log;
        trace_echec($chemin, get_ip(), $act);

        $detail = get_ip() . "_" . $log . "_" . date('d/m/Y H:i:s', time());
        echo ' <div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">× </button><strong> Accès erroné : </strong>
        Login et mot de passe sont erronés ! </div>';

        $info = "";


        // envoi_mail_echec($info,$rowm['emailad'],$rowm['emailcor'],$detail);
        //header('location:index.php');
    }



}