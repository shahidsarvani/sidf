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

    require_once(BASE_PATH . '/cms/model/Company.php');

    $company = new Company();
    $id = $_POST['id'];
    // echo json_encode($_POST);
    // echo json_encode($id);
    // die();
    $res = $company->edit_company($id, $_POST);
    $data = array();
    if(array_key_exists('title_eng', $_POST)) {
        for($i = 0; $i < count($_POST['title_eng']); $i++) {
            if($_POST['title_eng'][$i] != '') {
                $data[] = [
                    'company_token_id' => $_POST['company_token_id'],
                    'title_eng' => $_POST['title_eng'][$i],
                    'title_ar' => $_POST['title_ar'][$i],
                    'icon' => $_POST['icon_key'][$i],
                ];
            }
        }
    }
    // echo json_encode($data);
    // die();
    $company->remove_prev_menu_icons($_POST['company_token_id']);
    if($data) {
        $res = $company->add_menu_icons($data);
    }

    if ($res) {
        $_SESSION['success'] = 'Company Updated Successfully';
        header('Location: ' . ADMIN_SITE_URL . '/controller/companies/index.php');
    } else {
        $_SESSION['errors'] = 'Error! Company not Updated';
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once(BASE_PATH . '/cms/model/Company.php');
    require_once(BASE_PATH . '/cms/model/Token.php');

    $token = new Token();
    $tokens = $token->get_tokens();
    $company_obj = new Company();
    $company = $company_obj->get_company($_GET['id']);
    $logo_media = $company_obj->get_media($company['logo_key']);
    if($logo_media != false) {
        $logo = $logo_media->fetch_assoc();
        $logo['size'] = explode('_', $logo['file_key'])[0];
    }
    $video_media = $company_obj->get_media($company['video_key']);
    if($video_media != false) {
        $video = $video_media->fetch_assoc();
        $video['size'] = explode('_', $video['file_key'])[0];
    }
    $icon_array = array();
    $icons = $company_obj->get_company_icons($company['company_token_id']);
    if($icons) {
        foreach ($icons as $icon) {
            $temp = array();
            $icon_media = $company_obj->get_media($icon['icon']);
            $temp['title_eng'] = $icon['title_eng'];
            $temp['title_ar'] = $icon['title_ar'];
            $temp['icon'] = $icon['icon'];
            if($icon_media){
                $temp['icon_detail'] = $icon_media->fetch_assoc();
                $temp['icon_detail']['size'] = explode('_', $temp['icon_detail']['file_key'])[0];
            } else {
                $temp['icon_detail']['name'] = '';
                $temp['icon_detail']['file_key'] = '';
                $temp['icon_detail']['type'] = '';
                $temp['icon_detail']['filetype'] = '';
                $temp['icon_detail']['size'] = 0;
            }
            array_push($icon_array, $temp);
        }
    }
    // echo json_encode($icon_array);
    // die();
}

$title = 'Company Information - SIDF';

require BASE_PATH . '/cms/views/layout/scripts.php';
require BASE_PATH . '/cms/views/layout/navbar.php';
require BASE_PATH . '/cms/views/layout/sidebar.php';
require BASE_PATH . '/cms/views/companies/edit.php';
