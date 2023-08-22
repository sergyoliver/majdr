<?php
if ($_SESSION['gpe']=='SuperAdmin'){
    include 'superadmin.php';
}
if ($_SESSION['gpe']=='CSPR'){
    include 'dash_cspr.php';
}




?>