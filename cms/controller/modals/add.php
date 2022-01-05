<?php

session_start();
if (isset($_SESSION['success'])) {
    unset($_SESSION['success']);
}
if (isset($_SESSION['errors'])) {
    unset($_SESSION['errors']);
}

require './../../config/config.php';

if (!isset($_SESSION['user_id']) && !$_SESSION['user_id']) {
    header('Location: ' . ADMIN_SITE_URL . '/controller/login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // echo json_encode($_POST);
    // echo json_encode($_FILES);
    // die();
    require_once(BASE_PATH . '/cms/model/Modal.php');

    $modal = new Modal();
    $modal_id = $modal->add_modal($_POST);
    $data = array();
    if(array_key_exists('title_eng', $_POST)) {
        for($i = 0; $i < count($_POST['title_eng']); $i++) {
            if($_POST['title_eng'][$i] != '' || $_POST['title_ar'][$i] || $_POST['text_eng'][$i] || $_POST['text_ar'][$i] || $_POST['old_media_id'][$i]) {
                $data[] = [
                    'modal_id' => $modal_id,
                    'title_eng' => $_POST['title_eng'][$i],
                    'title_ar' => $_POST['title_ar'][$i],
                    'text_eng' => strip_tags($_POST['text_eng'][$i], '<p><ol><ul><li><h1><h2><h3><h4><h5><h6>'),
                    'text_ar' => strip_tags($_POST['text_ar'][$i], '<p><ol><ul><li><h1><h2><h3><h4><h5><h6>'),
                    'media_id' => $_POST['old_media_id'][$i],
                ];
            }
        }
    }
    // echo json_encode($data);
    // die();
    $res = true;
    if($data) {
        $res = $modal->add_modal_item($data);
    }

    if ($res) {
        $_SESSION['success'] = 'Modal Added Successfully';
        header('Location: ' . ADMIN_SITE_URL . '/controller/modals/index.php');
    } else {
        $_SESSION['errors'] = 'Error! Modal not Added';
    }
}


if($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once(BASE_PATH . '/cms/model/Modal.php');
    require_once(BASE_PATH . '/cms/model/Timeline.php');
    $modal = new Modal();
    $count = $modal->get_modal_count();
	$timeline_obj = new Timeline();
    $timelines = $timeline_obj->get_timeline_items();
    if($count['count'] >= 16) {
        header('Location: ' . ADMIN_SITE_URL . '/controller/modals/index.php');
    } else {
        $title = 'Modals - SIDF';
        
        require BASE_PATH . '/cms/views/layout/scripts.php';
        require BASE_PATH . '/cms/views/layout/navbar.php';
        require BASE_PATH . '/cms/views/layout/sidebar.php';
        require BASE_PATH . '/cms/views/modals/add.php';
    }
}

