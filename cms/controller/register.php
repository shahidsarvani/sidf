<?php

session_start();

require './../config/config.php';


if(isset($_SESSION['user_id']) && $_SESSION['user_id']) {
    header('Location: ' . ADMIN_SITE_URL . '/controller/dashboard.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$errors = '';

    require_once('./../model/User.php');
	
	$user = new User();

	$user_data = $user->get_user_by_email($_POST);

	if(!$user_data) {
		$user->insert_user($_POST);
		header('Location: ' . ADMIN_SITE_URL . '/controller/login.php');
	} else {
		$errors .= 'User already exist';
	}
}

require './../views/register.php';

?>

