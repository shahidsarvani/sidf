<?php 

session_start();

require './../../config/config.php';

if(!isset($_SESSION['user_id']) && !$_SESSION['user_id']) {
    header('Location: ' . ADMIN_SITE_URL . '/controller/login.php');
}

require_once(BASE_PATH . '/cms/model/Company.php');
$company = new Company();
$companies = $company->get_companies();
$all_companies = array();
if($companies !== false) {
    foreach ($companies as $item) {
        array_push($all_companies, $item);
    } 
}

$title = 'Company Information - SIDF';

require BASE_PATH . '/cms/views/layout/scripts.php';
require BASE_PATH . '/cms/views/layout/navbar.php';
require BASE_PATH . '/cms/views/layout/sidebar.php';
require BASE_PATH . '/cms/views/companies/index.php';
