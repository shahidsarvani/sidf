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

    // echo $_GET['id'];
    // die();
    require_once(BASE_PATH . '/cms/model/Timeline.php');
	
	$timeline_obj = new Timeline();

    $res = $timeline_obj->delete_timeline_item($_GET['id']);

    if($res) {
        $_SESSION['success'] = 'Timeline Item Deleted Successfully';
        header('Location: ' . ADMIN_SITE_URL . '/controller/timelineItems/index.php');
	} else {
		$_SESSION['errors'] = 'Error! Timeline Item not Deleted';
	}
}

$title = 'Timeline Items - SIDF';

require BASE_PATH . '/cms/views/layout/scripts.php';
require BASE_PATH . '/cms/views/layout/navbar.php';
require BASE_PATH . '/cms/views/layout/sidebar.php';
require BASE_PATH . '/cms/views/timelineItems/index.php';
?>