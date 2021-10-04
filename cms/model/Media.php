<?php

class Media
{

	public $connect;

	public function __construct()
	{
		require_once('./../../config/database.php');

		$database = new Database;
		$this->connect = $database->connect();
	}

	public function add_media($data)
	{
		$name = filter_var($data['name'], FILTER_SANITIZE_STRING);
		$file_key = filter_var($data['file_key'], FILTER_SANITIZE_STRING);
		$created_on = date('Y-m-d H:i:s');
		$query = "
		INSERT INTO media (name, file_key, created_on) VALUES ('$name','$file_key','$created_on')
		";
		if ($this->connect->query($query) === TRUE) {
			return $this->connect->insert_id;
		} else {
			$_SESSION['error_msg'] = $this->connect->error;
			$_SESSION['error_code'] = 500;
			header('Location: ' . ADMIN_SITE_URL . '/controller/error.php');
		}
	}
}
