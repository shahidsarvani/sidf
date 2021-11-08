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
    // echo json_encode($_POST);
    // die();
    $res = $modal->edit_modal($id, $_POST);
    $data = array();
    if(array_key_exists('title_eng', $_POST)) {
        for($i = 0; $i < count($_POST['title_eng']); $i++) {
            if($_POST['title_eng'][$i] != '') {
                $data[] = [
                    'modal_id' => $id,
                    'title_eng' => $_POST['title_eng'][$i],
                    'title_ar' => $_POST['title_ar'][$i],
                    'text_eng' => $_POST['text_eng'][$i],
                    'text_ar' => $_POST['text_ar'][$i],
                ];
                if($_POST['modal_media'][$i] == '' && $_POST['old_media_id'][$i] != '') {
                    $data[$i]['media_id'] = $_POST['old_media_id'][$i];
                } else if ($_POST['modal_media'][$i] != '') {
                    $data[$i]['media_id'] = $_POST['modal_media'][$i];
                }
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
            array_push($medias, $media);
        }
    }
    $modal['items'] = $medias;
}

$title = 'Modals - SIDF';

require BASE_PATH . '/cms/views/layout/scripts.php';
require BASE_PATH . '/cms/views/layout/navbar.php';
require BASE_PATH . '/cms/views/layout/sidebar.php';
require BASE_PATH . '/cms/views/modals/edit.php';
