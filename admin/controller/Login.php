<?php

session_start();

require './../../config/config.php';
require './../../config/database.php';


if(isset($_SESSION['user_id']) && $_SESSION['user_id']) {
    header('Location: ' . ADMIN_SITE_URL . '/controller/dashboard.php');
}

if($_POST) {
    echo json_encode($_POST);
    die();
}

require './../views/login.php';

?>

