<?php

class Media
{

	public $connect;

	public function __construct()
	{
		require_once(BASE_PATH . '/cms/config/database.php');

		$database = new Database;
		$this->connect = $database->connect();
	}

	public function add_media($data)
	{
		$name = filter_var($data['name'], FILTER_SANITIZE_STRING);
		$file_key = filter_var($data['file_key'], FILTER_SANITIZE_STRING);
		$type = filter_var($data['type'], FILTER_SANITIZE_STRING);
		$filetype = filter_var($data['filetype'], FILTER_SANITIZE_STRING);
		$created_on = date('Y-m-d H:i:s');
		$get_media = $this->get_media_by_file_key($file_key);
		if ($get_media) {
		} else {
			$query = "
			INSERT INTO media (name, file_key, filetype, type, created_on) VALUES ('$name','$file_key','$filetype','$type','$created_on')
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

	public function delete_media($id)
	{
		$query = "
		DELETE FROM media WHERE id = '$id'
		";
		$result = $this->connect->query($query);
		if (TRUE === $result) {
			return true;
		} else {
			return $this->connect->error;
		}
	}

	public function get_media_by_file_key($file_key)
	{
		$file_key = filter_var($file_key, FILTER_SANITIZE_STRING);
		$query = "
		SELECT * FROM media WHERE file_key = '$file_key' 
		";
		$result = $this->connect->query($query);
		if ($this->connect->error) {
			die("Connection failed: " . $this->connect->error);
		}
		if ($result->num_rows > 0) {
			return $result->fetch_assoc();
		} else {
			return false;
		}
	}
}
