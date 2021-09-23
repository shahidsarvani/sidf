<?php 

session_start();

require './../../config/config.php';
require './../../config/database.php';

if(!$_SESSION['user_id']) {
    header('Location: ' . ADMIN_SITE_URL . '/controller/login.php');
}
echo "Dashboard";
?>