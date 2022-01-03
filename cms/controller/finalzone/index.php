<?php 

session_start();

require './../../config/config.php';

if(!isset($_SESSION['user_id']) && !$_SESSION['user_id']) {
    header('Location: ' . ADMIN_SITE_URL . '/controller/login.php');
}

require_once(BASE_PATH . '/cms/model/Finalzone.php');
$screen = new Finalzone();
$screens = $screen->get_screens();
$all_screens = array();
if($screens !== false) {
    foreach ($screens as $item) {
        array_push($all_screens, $item);
    } 
}
// echo json_encode($all_screens);
// die();

$title = 'Final Zone Screens - SIDF';

require BASE_PATH . '/cms/views/layout/scripts.php';
require BASE_PATH . '/cms/views/layout/navbar.php';
require BASE_PATH . '/cms/views/layout/sidebar.php';
require BASE_PATH . '/cms/views/finalzone/index.php';
?>