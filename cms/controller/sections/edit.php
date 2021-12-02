<?php
@session_start();
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

    require_once(BASE_PATH . '/cms/model/Sections.php');

    $section_obj = new Sections();
    $id = $_POST['id'];
    // echo json_encode($_POST);
    // echo json_encode($id);
    // die();
    $rows = $res = $section_obj->edit_section($id, $_POST);
/*    $data = array();
    if (array_key_exists('file_keys', $_POST)) {
        foreach ($_POST['file_keys'] as $key) {
            $data[] = [
                'screen_id' => $id,
                'media_id' => $key,
            ];
        }
    }
    $screen->remove_prev_screen_media($id);
    if ($data) {
        $res = $screen->add_media($data);
    }*/

    if ($res) {
        $_SESSION['success'] = 'Section Updated Successfully';
        header('Location: ' . ADMIN_SITE_URL . '/controller/sections/index.php');
    } else {
        $_SESSION['errors'] = 'Error! Section not Updated';
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once(BASE_PATH . '/cms/model/Sections.php');

    $section_obj = new Sections();
    $row = $section_obj->get_section($_GET['id']);
    /*$item_media = $section_obj->get_screen_media($_GET['id']);
    $medias = array();
    if ($item_media) {
        foreach ($item_media as $media) {
            $media['size'] = explode('_', $media['file_key'])[0];
            if (explode('.', $media['file_key'])[1] == 'mp4') {
                $media['filetype'] = 'video/' . explode('.', $media['file_key'])[1];
                $media['type'] = 'video';
            } else {
                $media['filetype'] = 'image/' . explode('.', $media['file_key'])[1];
                $media['type'] = 'image';
            }
            array_push($medias, $media);
        }
    }
    $screen['media'] = $medias;*/

    // if($res) {
    //     $_SESSION['success'] = 'Screen Added Successfully';
    //     header('Location: ' . ADMIN_SITE_URL . '/controller/screens/index.php');
    // } else {
    // 	$_SESSION['errors'] = 'Error! Screen not Added';
    // }
}

$title = 'Sections - SIDF';

require BASE_PATH . '/cms/views/layout/scripts.php';
require BASE_PATH . '/cms/views/layout/navbar.php';
require BASE_PATH . '/cms/views/layout/sidebar.php';
require BASE_PATH . '/cms/views/sections/edit.php';
