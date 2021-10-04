<?php 

session_start();
if(isset($_SESSION['success'])) {
    unset($_SESSION['success']);
}
if(isset($_SESSION['errors'])) {
    unset($_SESSION['errors']);
}

require './../../config/config.php';

if(!isset($_SESSION['user_id']) && !$_SESSION['user_id']) {
    header('Location: ' . ADMIN_SITE_URL . '/controller/login.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once('./../../model/Screen.php');
	
	$screen = new Screen();
    $screen_id = $screen->add_screen($_POST);
    $data = array();
    foreach ($_POST['file_keys'] as $key) {
        $data[] = [
            'screen_id' => $screen_id,
            'media_id' => $key,
        ];
    }
    $res = $screen->sync_media($data);

    if($res) {
        $_SESSION['success'] = 'Screen Added Successfully';
        header('Location: ' . ADMIN_SITE_URL . '/controller/screens/index.php');
	} else {
		$_SESSION['errors'] = 'Error! Screen not Added';
	}
}

$title = 'Screens - SIDF';

require './../../views/layout/scripts.php';
require './../../views/layout/navbar.php';
require './../../views/layout/sidebar.php';
require './../../views/screens/add.php';
?>