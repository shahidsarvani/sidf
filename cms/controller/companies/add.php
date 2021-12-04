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
    require_once(BASE_PATH . '/cms/model/Company.php');

    $company = new Company();
    $res = $company->add_company($_POST);
    $data = array();
    if(array_key_exists('title_eng', $_POST)) {
        for($i = 0; $i < count($_POST['title_eng']); $i++) {
            if($_POST['title_eng'][$i] != '') {
                $data[] = [
                    'company_token_id' => $_POST['company_token_id'],
                    'title_eng' => $_POST['title_eng'][$i],
                    'title_ar' => $_POST['title_ar'][$i],
                    'icon' => $_POST['icon'][$i],
                ];
            }
        }
    }
    // echo json_encode($data);
    // die();
    if($data) {
        $res = $company->add_menu_icons($data);
    }

    if ($res) {
        $_SESSION['success'] = 'Company Added Successfully';
        header('Location: ' . ADMIN_SITE_URL . '/controller/companies/index.php');
    } else {
        $_SESSION['errors'] = 'Error! Company not Added';
    }
}


if($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once(BASE_PATH . '/cms/model/Token.php');
    $token = new Token();
    $tokens = $token->get_tokens();
    require_once(BASE_PATH . '/cms/model/Company.php');
    $company = new Company();
    $count = $company->get_company_count();
    if($count['count'] >= 4) {
        header('Location: ' . ADMIN_SITE_URL . '/controller/companies/index.php');
    } else {
        $title = 'Company Information - SIDF';
        
        require BASE_PATH . '/cms/views/layout/scripts.php';
        require BASE_PATH . '/cms/views/layout/navbar.php';
        require BASE_PATH . '/cms/views/layout/sidebar.php';
        require BASE_PATH . '/cms/views/companies/add.php';
    }
}