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

if($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once(BASE_PATH . '/cms/model/Screen.php');
	
	$screen_obj = new Screen();

    $res = $screen_obj->delete_screen($_GET['id']);

    if($res) {
        $_SESSION['success'] = 'Screen Deleted Successfully';
        header('Location: ' . ADMIN_SITE_URL . '/controller/screens/index.php');
	} else {
		$_SESSION['errors'] = 'Error! Screen not Deleted';
	}
}

$title = 'Screens - SIDF';

require BASE_PATH . '/cms/views/layout/scripts.php';
require BASE_PATH . '/cms/views/layout/navbar.php';
require BASE_PATH . '/cms/views/layout/sidebar.php';
require BASE_PATH . '/cms/views/screens/index.php';
?>