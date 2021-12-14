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

    require_once(BASE_PATH . '/cms/model/Modal.php');

    $modal = new Modal();
    $id = $_POST['id'];
    // echo json_encode($_FILES);
    // echo json_encode($_POST['text_ar']);
    // die();
    $res = $modal->edit_modal($id, $_POST);
    $data = array();
    if(array_key_exists('title_eng', $_POST)) {
        for($i = 0; $i < count($_POST['title_eng']); $i++) {
            if($_POST['title_eng'][$i] != '' || $_POST['title_ar'][$i] || $_POST['text_eng'][$i] || $_POST['text_ar'][$i] || $_POST['old_media_id'][$i]) {
                $data[] = [
                    'modal_id' => $id,
                    'title_eng' => $_POST['title_eng'][$i],
                    'title_ar' => $_POST['title_ar'][$i],
                    'text_eng' => strip_tags($_POST['text_eng'][$i], '<p><ol><ul><li><h1><h2><h3><h4><h5><h6>'),
                    'text_ar' => strip_tags($_POST['text_ar'][$i], '<p><ol><ul><li><h1><h2><h3><h4><h5><h6>'),
                    'media_id' => $_POST['old_media_id'][$i],
                ];
                // if($_POST['modal_media'][$i] == '' && $_POST['old_media_id'][$i] != '') {
                //     $data[$i]['media_id'] = $_POST['old_media_id'][$i];
                // } else if ($_POST['modal_media'][$i] != '') {
                //     $data[$i]['media_id'] = $_POST['modal_media'][$i];
                // }
            }
        }
    }
    // echo json_encode($data);
    // die();
    $modal->remove_prev_modal_items($id);
    if($data) {
        $res = $modal->add_modal_item($data);
    }
    

    if ($res) {
        $_SESSION['success'] = 'Modal Updated Successfully';
        header('Location: ' . ADMIN_SITE_URL . '/controller/modals/index.php');
    } else {
        $_SESSION['errors'] = 'Error! Modal not Updated';
    }
}
if($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once(BASE_PATH . '/cms/model/Modal.php');
    require_once(BASE_PATH . '/cms/model/Timeline.php');
	
	$modal_obj = new Modal();
    $modal = $modal_obj->get_modal($_GET['id']);
    $item_media = $modal_obj->get_modal_items($_GET['id']);
	$timeline_obj = new Timeline();
    $timelines = $timeline_obj->get_timeline_items();
    $medias = array();
    if($item_media) {
        foreach ($item_media as $media) {
            $media_details = $modal_obj->get_media($media['media_id']);
            $media['detail'] = array();
            if ($media_details !== false) {
                $media['detail'] = $media_details->fetch_assoc();
                $media['detail']['size'] = explode('_', $media['detail']['file_key'])[0];
            }
            // $media['detail'] = $media_details->fetch_assoc();
            // $media['detail']['size'] = explode('_', $media['detail']['file_key'])[0];
            array_push($medias, $media);
            // echo json_encode($media);
        }
    }
    $modal['items'] = $medias;
}

// echo json_encode($modal['items']);
// die();

$title = 'Modals - SIDF';

require BASE_PATH . '/cms/views/layout/scripts.php';
require BASE_PATH . '/cms/views/layout/navbar.php';
require BASE_PATH . '/cms/views/layout/sidebar.php';
require BASE_PATH . '/cms/views/modals/edit.php';
