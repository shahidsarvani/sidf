<?php

class User
{

	public $connect;

	public function __construct()
	{
		require_once(BASE_PATH . '/cms/config/database.php');

		$database = new Database;
		$this->connect = $database->connect();
	}

	public function get_user_by_email($data)
	{
		$email = filter_var(strtolower($data['email']), FILTER_SANITIZE_EMAIL);
		$query = "
		SELECT * FROM users WHERE email = '$email'
		";

		if ($result = mysqli_query($this->connect, $query)) {
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		} else {
			$_SESSION['error_msg'] = $this->connect->error;
			$_SESSION['error_code'] = 500;
			header('Location: ' . ADMIN_SITE_URL . '/controller/error.php');
		}
	}

	function insert_user($data)
	{
		$username = filter_var($data['username'], FILTER_SANITIZE_STRING);
		$email = filter_var(strtolower($data['email']), FILTER_SANITIZE_EMAIL);
		$password = password_hash($data['password'], PASSWORD_DEFAULT);
		$status = 1;
		$created_on = date('Y-m-d H:i:s');
		$updated_on = date('Y-m-d H:i:s');
		$query = "
		INSERT INTO users (username, email, password, status, created_on, updated_on) VALUES ('$username','$email','$password','$status','$created_on','$updated_on')
		";
		if ($result = $this->connect->query($query)) {
			return $result;
		} else {
			$_SESSION['error_msg'] = $this->connect->error;
			$_SESSION['error_code'] = 500;
			header('Location: ' . ADMIN_SITE_URL . '/controller/error.php');
		}
	}
}
