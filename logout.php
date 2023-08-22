<?php
session_start();
ob_start();

    /*/* */
       require 'connexion/connectpg.php';
       require('connexion/function.php');


        // oon verifie s'il existe dans la table copnnexion
$rsc = $bdd->prepare('select * from connexions where compte_id= :iduser and statut = :statc and type = :type', array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
$rsc->execute(array('iduser' => $_SESSION['id'], 'statc' =>1, 'type' =>1 ));
$nbc = $rsc->rowCount();
        // insere info connexion
    // on reccupere l email des admin
$id = $_SESSION['id'];
$dt = gmdate("Y-m-d H:i:s");
echo $nbc;

        if($nbc==0)

        {


            $rs2 = $bdd->prepare("INSERT INTO connexions(compte_id, date_connexion, statut,type) VALUES(:iduser, :datc, :statc,:type)");
            $rs2->execute(array('iduser' => $_SESSION['id'], 'datc' => gmdate("Y-m-d H:i:s"), 'statc' => 0, 'type' => 1));
        }else{
           // echo "UPDATE  tbconnexion set date_connexion = '$dt', statut = 0 WHERE compte_id = $id ";
            // mise a jour dans la BD
            $rsmajcon = $bdd->prepare('UPDATE connexions SET date_connexion = :datc, statut = :statc WHERE compte_id = :iduser');
            $rsmajcon->execute(array('datc' => gmdate("Y-m-d H:i:s"), 'statc' => 0, 'type' => 1 ,'iduser' => $_SESSION['id']));
        }

//        $rs3 = $bdd->prepare('INSERT INTO tab_histoconnexion(ipaddress, user_email, dateconn, statconn) VALUES(:ipadress, :log, :datc, :statc)');
//        $rs3->execute(array('ipadress' => get_ip(), 'log' => $_SESSION['email'] ,'datc' => gmdate("Y-m-d H:i:s"), 'statc' => 0));
//

    unset($_SESSION['nom']);
    unset($_SESSION['identite']);
    unset($_SESSION['email']);
    unset($_SESSION['id']);
    unset($_SESSION['gpe']);
    unset($_SESSION['libgpe']);

    unset($_SESSION['pwd']);
    unset($_SESSION['zoneid']);


    session_destroy();/**/

    header("location:index.php");

ob_end_flush() ;
?>