<?php 

session_start();

require './../../config/config.php';

if(!isset($_SESSION['user_id']) && !$_SESSION['user_id']) {
    header('Location: ' . ADMIN_SITE_URL . '/controller/login.php');
}

require_once(BASE_PATH . '/cms/model/Projector.php');
$projector_obj = new Projector();
$projector = $projector_obj->get_projector();
if($projector !== false) {
    $media = $projector_obj->get_projector_media($projector['media_id']);
    if($media != false) {
        $media['size'] = explode('_', $media['file_key'])[0];
    }
}

$title = 'Projector Video - SIDF';

require BASE_PATH . '/cms/views/layout/scripts.php';
require BASE_PATH . '/cms/views/layout/navbar.php';
require BASE_PATH . '/cms/views/layout/sidebar.php';
require BASE_PATH . '/cms/views/projector/index.php';
?>