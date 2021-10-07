<?php 

session_start();

require './../../config/config.php';

if(!isset($_SESSION['user_id']) && !$_SESSION['user_id']) {
    header('Location: ' . ADMIN_SITE_URL . '/controller/login.php');
}

require_once(BASE_PATH . '/cms/model/Screen.php');
$screen = new Screen();
$screens = $screen->get_screens();
$all_screens = array();
if($screens !== false) {
    foreach ($screens as $item) {
        array_push($all_screens, $item);
    } 
}

for($i = 0; $i < count($all_screens); $i++){
    $item_media = $screen->get_screen_media($all_screens[$i]['id']);
    $medias = array();
    foreach ($item_media as $media) {
        array_push($medias, $media);
    }
    $all_screens[$i]['media'] = $medias;
}
// echo json_encode($all_screens);
// die();

$title = 'Screens - SIDF';

require BASE_PATH . '/cms/views/layout/scripts.php';
require BASE_PATH . '/cms/views/layout/navbar.php';
require BASE_PATH . '/cms/views/layout/sidebar.php';
require BASE_PATH . '/cms/views/screens/index.php';
?>