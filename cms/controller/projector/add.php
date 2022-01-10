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

    require_once(BASE_PATH . '/cms/model/Projector.php');

    $projector_obj = new Projector();
    $projector = $projector_obj->get_projector();
    // echo json_encode($projector);
    // echo json_encode($_POST);
    // die();
    if ($projector == false) {
        $res = $projector_obj->add_projector($_POST);
    } else {
        $res = $projector_obj->edit_projector($projector['id'], $_POST);
    }

    if ($res) {
        $_SESSION['success'] = 'Projector video Added Successfully';
        header('Location: ' . ADMIN_SITE_URL . '/controller/projector/index.php');
    } else {
        $_SESSION['errors'] = 'Error! Something went wrong';
    }
}
