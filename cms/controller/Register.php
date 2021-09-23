<?php

session_start();

// require './../../config/config.php';


if(isset($_SESSION['user_id']) && $_SESSION['user_id']) {
    header('Location: ' . ADMIN_SITE_URL . '/controller/dashboard.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// $data = $_POST;
	$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
	$email = filter_var(strtolower($_POST['email']), FILTER_SANITIZE_EMAIL);
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$status = 1;

	$errors = '';

    $sql= "INSERT INTO users (username, email, password, status) VALUES ('$username','$email','$password','$status')";
    $result = $connection->query($sql);

	// echo json_encode($result);
	// die();

	if ($result !== false) {
		// $_SESSION['username'] = $user['username'];
		// $_SESSION['userid'] = $user['id'];
		// $_SESSION['useremail'] = $user['email'];
		// $_SESSION['roleid'] = $user['role_id'];
		header('Location: ' . ADMIN_SITE_URL . '/controller/login.php');
	} else {
		$errors .= $connection->error;
        echo json_encode($errors);
        die();
	}
}

require './../views/register.php';

?>

