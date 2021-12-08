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
    $rows = $res = $section_obj->edit_section($id, $_POST, $items_config);

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
    $bg_video = $section_obj->get_media($row['bg_video']);
    if($bg_video) {
        $bg_video = $bg_video->fetch_assoc();
        $row['bg_video_name'] = $bg_video['name'];
    } else {
        $row['bg_video_name'] = '';
    }
    $records = $section_obj->get_section_tabs_by_section_id($_GET['id']);
    if ($records) {
        foreach ($records as $record) {
            $bg_video = $section_obj->get_media($row['bg_video']);
            $bg_video = $bg_video->fetch_assoc();
            $record['bg_video_name'] = $bg_video['name'];
        }
    }
}

$title = 'Sections - SIDF';

require BASE_PATH . '/cms/views/layout/scripts.php';
require BASE_PATH . '/cms/views/layout/navbar.php';
require BASE_PATH . '/cms/views/layout/sidebar.php';
require BASE_PATH . '/cms/views/sections/edit.php';
