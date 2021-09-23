<?php

session_start();

require './../config/config.php';


if(isset($_SESSION['user_id']) && $_SESSION['user_id']) {
    header('Location: ' . ADMIN_SITE_URL . '/controller/dashboard.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {

	$errors = '';

    require_once('./../model/User.php');
	
	$user = new User();
	$user_data = $user->get_user_by_email($_POST);

    if($user_data) {
        if(password_verify($_POST['password'], $user_data['password'])) {
            $_SESSION['user_username'] = $user_data['username'];
            $_SESSION['user_id'] = $user_data['id'];
            $_SESSION['user_email'] = $user_data['email'];
            header('Location: ' . ADMIN_SITE_URL . '/controller/dashboard.php');
        }
	} else {
		$errors .= 'User does not exist';
	}
}

require './../views/login.php';

?>



