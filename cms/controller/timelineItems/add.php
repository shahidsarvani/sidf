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
    $timeline = new Timeline();
    $data = $_POST;
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
    // echo json_encode($data);
    // echo json_encode($_FILES);
    // die();
    $timeline_id = $timeline->add_timeline_item($data);

    if($timeline_id) {
        $_SESSION['success'] = 'Timeline Item Added Successfully';
        header('Location: ' . ADMIN_SITE_URL . '/controller/timelineItems/index.php');
	} else {
		$_SESSION['errors'] = 'Error! Timeline Item not Added';
	}
}

if($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once(BASE_PATH . '/cms/model/Timeline.php');
    $timeline = new Timeline();
    $count = $timeline->get_timeline_count();
    if($count['count'] >= 15) {
        header('Location: ' . ADMIN_SITE_URL . '/controller/timelineItems/index.php');
    } else {
        $title = 'Timeline Items - SIDF';
        
        require BASE_PATH . '/cms/views/layout/scripts.php';
        require BASE_PATH . '/cms/views/layout/navbar.php';
        require BASE_PATH . '/cms/views/layout/sidebar.php';
        require BASE_PATH . '/cms/views/timelineItems/add.php';
    }
}

?>