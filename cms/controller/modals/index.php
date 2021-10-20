<?php 

session_start();

require './../../config/config.php';

if(!isset($_SESSION['user_id']) && !$_SESSION['user_id']) {
    header('Location: ' . ADMIN_SITE_URL . '/controller/login.php');
}

require_once(BASE_PATH . '/cms/model/Modal.php');
$modal = new Modal();
$modals = $modal->get_modals_with_year();
// foreach ($modals as $modal) {
//     echo json_encode($modal);
// }
// die();
$title = 'Modals - SIDF';

require BASE_PATH . '/cms/views/layout/scripts.php';
require BASE_PATH . '/cms/views/layout/navbar.php';
require BASE_PATH . '/cms/views/layout/sidebar.php';
require BASE_PATH . '/cms/views/modals/index.php';
?>