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
    // die();
    require_once(BASE_PATH . '/cms/model/Token.php');

    $token = new Token();
    $res = $token->add_token($_POST);

    if ($res) {
        $_SESSION['success'] = 'Token Added Successfully';
        header('Location: ' . ADMIN_SITE_URL . '/controller/tokens/index.php');
    } else {
        $_SESSION['errors'] = 'Error! Token not Added';
    }
}


if($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once(BASE_PATH . '/cms/model/Token.php');
    $token = new Token();
    $count = $token->get_token_count();
    if($count['count'] >= 5) {
        header('Location: ' . ADMIN_SITE_URL . '/controller/tokens/index.php');
    } else {
        $title = 'Tokens - SIDF';
        
        require BASE_PATH . '/cms/views/layout/scripts.php';
        require BASE_PATH . '/cms/views/layout/navbar.php';
        require BASE_PATH . '/cms/views/layout/sidebar.php';
        require BASE_PATH . '/cms/views/tokens/add.php';
    }
}