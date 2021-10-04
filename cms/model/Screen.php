<?php

class Screen
{

	public $connect;

	public function __construct()
	{
		require_once('./../../config/database.php');

		$database = new Database;
		$this->connect = $database->connect();
	}

	public function get_screens()
	{
		$query = "
		SELECT * FROM screens
		";
		$result = $this->connect->query($query);
		// echo json_encode($this->connect->error);
		// die();
		if ($result->num_rows > 0) {
			return $result;
		} else {
			return false;
		}
	}

	public function getScreenMedia($id)
	{
		$query = "
		SELECT media.*, screen_media.screen_id as through_key 
		FROM media 
		INNER JOIN screen_media ON screen_media.media_id = media.file_key 
		WHERE screen_media.screen_id = '$id'
		";
		$result = $this->connect->query($query);
		if ($result->num_rows > 0) {
			return $result;
		} else {
			return false;
		}
	}

	public function add_screen($data)
	{
		$name = filter_var($data['name'], FILTER_SANITIZE_STRING);
		$slug = $this->slugify($name);
		$created_on = date('Y-m-d H:i:s');
		$updated_on = date('Y-m-d H:i:s');
		$query = "
		INSERT INTO screens (name, slug, created_on, updated_on) VALUES ('$name','$slug','$created_on','$updated_on')
		";
		if (TRUE === $this->connect->query($query)) {
			return $this->connect->insert_id;
		} else {
			$_SESSION['error_msg'] = $this->connect->error;
			$_SESSION['error_code'] = 500;
			header('Location: ' . ADMIN_SITE_URL . '/controller/error.php');
		}
	}

	public function sync_media($data)
	{

		$created_on = date('Y-m-d H:i:s');
		$query = '';
		foreach ($data as $key => $value) {
			$screen_id = $value['screen_id'];
			$media_id = $value['media_id'];
			$query .= "
			INSERT INTO screen_media (screen_id, media_id, created_on) VALUES ('$screen_id','$media_id','$created_on');
			";
		}
		if ($this->connect->multi_query($query) === TRUE) {
			return true;
		} else {
			$_SESSION['error_msg'] = $this->connect->error;
			$_SESSION['error_code'] = 500;
			header('Location: ' . ADMIN_SITE_URL . '/controller/error.php');
		}
	}

	public function slugify($text, string $divider = '-')
	{
		// replace non letter or digits by divider
		$text = preg_replace('~[^\pL\d]+~u', $divider, $text);

		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);

		// trim
		$text = trim($text, $divider);

		// remove duplicate divider
		$text = preg_replace('~-+~', $divider, $text);

		// lowercase
		$text = strtolower($text);

		if (empty($text)) {
			return 'n-a';
		}

		return $text;
	}
}
