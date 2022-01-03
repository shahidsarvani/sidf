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

    require_once(BASE_PATH . '/cms/model/Finalzone.php');

    $screen_obj = new Finalzone();
    $id = $_POST['id'];

    $screen = $screen_obj->get_screen($id);
    // echo json_encode($_POST);
    // echo json_encode($_FILES);
    // echo json_encode($id);
    // die();
    $data = $_POST;

    $targetDir = $items_config['finalzone_image_media_path'];
    if (!file_exists($targetDir)) {
        @mkdir($targetDir);
    }

    $data['logo_white'] = $screen['logo_white'];
    $data['logo_black'] = $screen['logo_black'];
    
    if (isset($_FILES['logo_white']['tmp_name']) && $_FILES['logo_white']['tmp_name'] != '') {
        if ($screen['logo_white']) {
            $file = $targetDir . $screen['logo_white'];
            @unlink("{$file}");
        }
        $file = $_FILES['logo_white']['tmp_name'];
        $fileName = time() . '_' . $_FILES['logo_white']['name'];
        $targetFile = $targetDir . '/' . $fileName;
        if (move_uploaded_file($file, $targetFile)) {
            $data['logo_white'] = $fileName;
        }
    }
    if (isset($_FILES['logo_black']['tmp_name']) && $_FILES['logo_black']['tmp_name'] != '') {
        if ($screen['logo_black']) {
            $file = $targetDir . $screen['logo_black'];
            @unlink("{$file}");
        }
        $file = $_FILES['logo_black']['tmp_name'];
        $fileName = time() . '_' . $_FILES['logo_black']['name'];
        $targetFile = $targetDir . '/' . $fileName;
        if (move_uploaded_file($file, $targetFile)) {
            $data['logo_black'] = $fileName;
        }
    }
    $res = $screen_obj->edit_screen($id, $data);

    if ($res) {
        $_SESSION['success'] = 'Final Zone Screen Updated Successfully';
        header('Location: ' . ADMIN_SITE_URL . '/controller/finalzone/index.php');
    } else {
        $_SESSION['errors'] = 'Error! Final Zone Screen not Updated';
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once(BASE_PATH . '/cms/model/Finalzone.php');

    $screen_obj = new Finalzone();
    $screen = $screen_obj->get_screen($_GET['id']);
    $video_media = $screen_obj->get_media($screen['video_key']);
    if ($video_media != false) {
        $video = $video_media->fetch_assoc();
        $video['size'] =  explode('_', $video['file_key'])[0];
        $screen['video'] = $video;
    }

    // echo json_encode($screen);
    // die();
    // if($res) {
    //     $_SESSION['success'] = 'Screen Added Successfully';
    //     header('Location: ' . ADMIN_SITE_URL . '/controller/screens/index.php');
    // } else {
    // 	$_SESSION['errors'] = 'Error! Screen not Added';
    // }
}

$title = 'Final Zone Screens - SIDF';

require BASE_PATH . '/cms/views/layout/scripts.php';
require BASE_PATH . '/cms/views/layout/navbar.php';
require BASE_PATH . '/cms/views/layout/sidebar.php';
require BASE_PATH . '/cms/views/finalzone/edit.php';
