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

    require_once(BASE_PATH . '/cms/model/Sections.php');

    $sections = new Sections();
    $res = $sections->add_section($_POST);
   /* $data = array();
    foreach ($_POST['file_keys'] as $key) {
        $data[] = [
            'section_id' => $screen_id,
            'media_id' => $key,
        ];
    }
    $res = $sections->add_section($data);*/

    if ($res) {
        $_SESSION['success'] = 'Section Added Successfully';
        header('Location: ' . ADMIN_SITE_URL . '/controller/sections/index.php');
    } else {
        $_SESSION['errors'] = 'Error! Section not Added';
    }
}


if($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once(BASE_PATH . '/cms/model/Sections.php');
    $section_obj = new Sections();
	//max_sort_order = $section_obj->get_max_sort_order();
    $count = $section_obj->get_section_count();
    if($count['count'] <= 4) {
		$title = 'Section - SIDF';
        require BASE_PATH . '/cms/views/layout/scripts.php';
        require BASE_PATH . '/cms/views/layout/navbar.php';
        require BASE_PATH . '/cms/views/layout/sidebar.php';
        require BASE_PATH . '/cms/views/sections/add.php';
    }else{
		header('Location: ' . ADMIN_SITE_URL . '/controller/sections/index.php');
		exit;
    }
}