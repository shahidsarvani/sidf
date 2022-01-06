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

    require_once(BASE_PATH . '/cms/model/Timeline.php');
	
	$screen = new Timeline();
    $id = $_POST['id'];
    $data = $_POST;
    $data['text_eng'] = strlen(strip_tags($_POST['text_eng'])) > 0 ? strip_tags($_POST['text_eng']) : '';
    $data['text_ar'] = strlen(strip_tags($_POST['text_ar'])) > 0 ? strip_tags($_POST['text_ar']) : '';

    // echo json_encode($_FILES['image']['tmp_name']);
    // echo json_encode($_POST);
    // die();

    if($_FILES['image']['tmp_name'] == '' && isset($_POST['old_image'])) {
        $data['image'] = $_POST['old_image'];
    }

    if($_FILES['image']['tmp_name'] != '' && $data['position'] == '9') {
        
        $targetDir = $items_config['images_path'];
        $images_url = $items_config['images_url'];
        if (!file_exists($targetDir)) {
            @mkdir($targetDir);
        }
        $file = $_FILES['image']['tmp_name'];
        $fileName = time().'_'.$_FILES['image']['name']; 
        $targetFile = $targetDir . '/' . $fileName;
        if (move_uploaded_file($file, $targetFile)) {
            $data['image'] = $fileName;
        }
    }
    // echo $data['text_eng'];
    // echo json_encode($data);
    // die();
    $res = $screen->edit_timeline_item($id, $data);

    if($res) {
        $_SESSION['success'] = 'Timeline Item Updated Successfully';
        header('Location: ' . ADMIN_SITE_URL . '/controller/timelineItems/index.php');
	} else {
		$_SESSION['errors'] = 'Error! Timeline Item not Updated';
	}
}
if($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once(BASE_PATH . '/cms/model/Timeline.php');
	
	$timline_obj = new Timeline();
    $timeline = $timline_obj->get_timeline_item($_GET['id']);
}

$title = 'Timeline Items - SIDF';

require BASE_PATH . '/cms/views/layout/scripts.php';
require BASE_PATH . '/cms/views/layout/navbar.php';
require BASE_PATH . '/cms/views/layout/sidebar.php';
require BASE_PATH . '/cms/views/timelineItems/edit.php';
?>