<?php

class Projector
{

	public $connect;

	public function __construct()
	{
		require_once(BASE_PATH . '/cms/config/database.php');

		$database = new Database;
		$this->connect = $database->connect();
	}

	public function get_projector()
	{
		$query = "
		SELECT * FROM projector LIMIT 1
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

	public function get_projector_media($id)
	{
		$query = "
		SELECT *
		FROM media 
		WHERE file_key = '$id'
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

	public function add_projector($data)
	{
		$media_id = filter_var($data['media_id'], FILTER_SANITIZE_STRING);
		$created_on = date('Y-m-d H:i:s');
		$updated_on = date('Y-m-d H:i:s');
		$query = "
		INSERT INTO projector (media_id, created_on, updated_on) VALUES ('$media_id','$created_on','$updated_on')
		";
		if (TRUE === $this->connect->query($query)) {
			return $this->connect->insert_id;
		} else {
			$_SESSION['error_msg'] = $this->connect->error;
			$_SESSION['error_code'] = 500;
			header('Location: ' . ADMIN_SITE_URL . '/controller/error.php');
		}
	}

	public function edit_projector($id, $data)
	{
		$media_id = filter_var($data['media_id'], FILTER_SANITIZE_STRING);
		$updated_on = date('Y-m-d H:i:s');
		$query = "
		UPDATE projector SET media_id='$media_id',updated_on='$updated_on' WHERE id='$id'
		";
		if (TRUE === $this->connect->query($query)) {
			return true;
		} else {
			$_SESSION['error_msg'] = $this->connect->error;
			$_SESSION['error_code'] = 500;
			header('Location: ' . ADMIN_SITE_URL . '/controller/error.php');
		}
	}
}
