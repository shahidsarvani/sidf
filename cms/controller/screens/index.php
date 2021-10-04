<?php 

session_start();

require './../../config/config.php';

if(!isset($_SESSION['user_id']) && !$_SESSION['user_id']) {
    header('Location: ' . ADMIN_SITE_URL . '/controller/login.php');
}

require_once('./../../model/Screen.php');
$screen = new Screen();
$screens = $screen->get_screens();
$all_screens = array();
foreach ($screens as $item) {
    array_push($all_screens, $item);
} 

for($i = 0; $i < count($all_screens); $i++){
    $item_media = $screen->getScreenMedia($all_screens[$i]['id']);
    $medias = array();
    foreach ($item_media as $media) {
        array_push($medias, $media);
    }
    $all_screens[$i]['media'] = $medias;
}

$title = 'Screens - SIDF';

require './../../views/layout/scripts.php';
require './../../views/layout/navbar.php';
require './../../views/layout/sidebar.php';
require './../../views/screens/index.php';
?>