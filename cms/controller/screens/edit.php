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

    require_once(BASE_PATH . '/cms/model/Screen.php');
	
	$screen = new Screen();
    $id = $_POST['id'];
    // echo json_encode($_POST);
    // echo json_encode($id);
    // die();
    $res = $screen->edit_screen($id, $_POST);
    $data = array();
    foreach ($_POST['file_keys'] as $key) {
        $data[] = [
            'screen_id' => $id,
            'media_id' => $key,
        ];
    }
    $screen->remove_prev_screen_media($id);
    $res = $screen->add_media($data);

    if($res) {
        $_SESSION['success'] = 'Screen Updated Successfully';
        header('Location: ' . ADMIN_SITE_URL . '/controller/screens/index.php');
	} else {
		$_SESSION['errors'] = 'Error! Screen not Updated';
	}
}
if($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once(BASE_PATH . '/cms/model/Screen.php');
	
	$screen_obj = new Screen();
    $screen = $screen_obj->get_screen($_GET['id']);
    $item_media = $screen_obj->get_screen_media($_GET['id']);
    $medias = array();
    foreach ($item_media as $media) {
        $media['size'] = explode('_', $media['file_key'])[0];
        if(explode('.', $media['file_key'])[1] == 'mp4') {
            $media['filetype'] = 'video/'.explode('.', $media['file_key'])[1];
            $media['type'] = 'video';
        } else {
            $media['filetype'] = 'image/'.explode('.', $media['file_key'])[1];
            $media['type'] = 'image';
        }
        array_push($medias, $media);
    }
    $screen['media'] = $medias;

    // if($res) {
    //     $_SESSION['success'] = 'Screen Added Successfully';
    //     header('Location: ' . ADMIN_SITE_URL . '/controller/screens/index.php');
	// } else {
	// 	$_SESSION['errors'] = 'Error! Screen not Added';
	// }
}

$title = 'Screens - SIDF';

require BASE_PATH . '/cms/views/layout/scripts.php';
require BASE_PATH . '/cms/views/layout/navbar.php';
require BASE_PATH . '/cms/views/layout/sidebar.php';
require BASE_PATH . '/cms/views/screens/edit.php';
?>