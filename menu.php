
<?php
if ($_SESSION['gpe']=='SuperAdmin'){
    include 'menu_superadmin.php';
}
if ($_SESSION['gpe']=='CSPR'){
    include 'menu_cspr.php';
}




?>