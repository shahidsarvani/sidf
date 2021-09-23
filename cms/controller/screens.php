<?php 

session_start();

require './../config/config.php';

$title = 'Screens - SIDF';

require './../views/layout/scripts.php';
require './../views/layout/navbar.php';
require './../views/layout/sidebar.php';
require './../views/screens/index.php';
require './../views/layout/footer.php';
?>