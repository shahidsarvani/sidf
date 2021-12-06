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

    require_once(BASE_PATH . '/cms/model/Token.php');

    $token = new Token();
    $id = $_POST['id'];
    // echo json_encode($_POST);
    // echo json_encode($id);
    // die();
    $res = $token->edit_token($id, $_POST);

    if ($res) {
        $_SESSION['success'] = 'Token Updated Successfully';
        header('Location: ' . ADMIN_SITE_URL . '/controller/tokens/index.php');
    } else {
        $_SESSION['errors'] = 'Error! Token not Updated';
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once(BASE_PATH . '/cms/model/Token.php');

    $token_obj = new Token();
    $token = $token_obj->get_token($_GET['id']);
    $logo = $token_obj->get_media($token['logo_key']);
    $logo = $logo->fetch_assoc();
    $logo['size'] = explode('_', $logo['file_key'])[0];
    $video = $token_obj->get_media($token['video_key']);
    $video = $video->fetch_assoc();
    $video['size'] = explode('_', $video['file_key'])[0];
    $loader_video = $token_obj->get_media($token['loader_video_key']);
    $loader_video = $loader_video->fetch_assoc();
    $loader_video['size'] = explode('_', $loader_video['file_key'])[0];
}

$title = 'Tokens - SIDF';

require BASE_PATH . '/cms/views/layout/scripts.php';
require BASE_PATH . '/cms/views/layout/navbar.php';
require BASE_PATH . '/cms/views/layout/sidebar.php';
require BASE_PATH . '/cms/views/tokens/edit.php';