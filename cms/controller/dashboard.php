<?php 

session_start();

require './../config/config.php';

if(!isset($_SESSION['user_id']) && !$_SESSION['user_id']) {
    header('Location: ' . ADMIN_SITE_URL . '/controller/login.php');
}

$title = 'Dashboard - SIDF';

require './../views/layout/scripts.php';
require './../views/layout/navbar.php';
require './../views/layout/sidebar.php';
require './../views/index.php';
?>