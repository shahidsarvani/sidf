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

    // echo json_encode($_POST);
    // echo json_encode($_FILES);
    // die();
    $data = $_POST;

    $targetDir = $items_config['finalzone_image_media_path'];
    if (!file_exists($targetDir)) {
        @mkdir($targetDir);
    }
    $data['logo_white'] = null;
    $data['logo_black'] = null;
    if (isset($_FILES['logo_white']['tmp_name']) && $_FILES['logo_white']['tmp_name'] != '') {
        $file = $_FILES['logo_white']['tmp_name'];
        $fileName = time() . '_' . $_FILES['logo_white']['name'];
        $targetFile = $targetDir . '/' . $fileName;
        if (move_uploaded_file($file, $targetFile)) {
            $data['logo_white'] = $fileName;
        }
    }
    if (isset($_FILES['logo_black']['tmp_name']) && $_FILES['logo_black']['tmp_name'] != '') {
        $file = $_FILES['logo_black']['tmp_name'];
        $fileName = time() . '_' . $_FILES['logo_black']['name'];
        $targetFile = $targetDir . '/' . $fileName;
        if (move_uploaded_file($file, $targetFile)) {
            $data['logo_black'] = $fileName;
        }
    }

    $screen = new Finalzone();
    $screen_id = $screen->add_screen($data);

    if ($screen_id) {
        $_SESSION['success'] = 'Final Zone Screen Added Successfully';
        header('Location: ' . ADMIN_SITE_URL . '/controller/finalzone/index.php');
    } else {
        $_SESSION['errors'] = 'Error! Final Zone Screen not Added';
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once(BASE_PATH . '/cms/model/Finalzone.php');
    $screen = new Finalzone();
    $count = $screen->get_screen_count();
    if ($count['count'] >= 4) {
        header('Location: ' . ADMIN_SITE_URL . '/controller/finalzone/index.php');
    } else {

        $title = 'Final Zone Screens - SIDF';

        require BASE_PATH . '/cms/views/layout/scripts.php';
        require BASE_PATH . '/cms/views/layout/navbar.php';
        require BASE_PATH . '/cms/views/layout/sidebar.php';
        require BASE_PATH . '/cms/views/finalzone/add.php';
    }
}
