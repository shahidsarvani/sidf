<?php

class Screen
{

	public $connect;

	public function __construct()
	{
		require_once(BASE_PATH . '/cms/config/database.php');

		$database = new Database;
		$this->connect = $database->connect();
	}

	public function get_screens()
	{
		$query = "
		SELECT * FROM screens
		";
		$result = $this->connect->query($query);
		if ($this->connect->error) {
			die("Connection failed: " . $this->connect->error);
		}
		if ($result->num_rows > 0) {
			return $result;
		} else {
			return false;
		}
	}

	public function get_screen($id)
	{
		$query = "
		SELECT * FROM screens WHERE id = '$id' 
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

	public function get_screen_by_slug($slug)
	{
		$query = "
		SELECT * FROM screens WHERE slug = '$slug' 
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

	public function delete_screen($id)
	{
		$query = "
		DELETE FROM screens WHERE id = '$id'
		";
		$result = $this->connect->query($query);
		if (TRUE === $result) {
			return true;
		} else {
			$_SESSION['error_msg'] = $this->connect->error;
			$_SESSION['error_code'] = 500;
			header('Location: ' . ADMIN_SITE_URL . '/controller/error.php');
		}
	}

	public function get_screen_media($id)
	{
		$query = "
		SELECT media.*, screen_media.screen_id as through_key 
		FROM media 
		INNER JOIN screen_media ON screen_media.media_id = media.file_key 
		WHERE screen_media.screen_id = '$id'
		";
		$result = $this->connect->query($query);
		if ($this->connect->error) {
			die("Connection failed: " . $this->connect->error);
		}
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

	public function edit_screen($id, $data)
	{
		$name = filter_var($data['name'], FILTER_SANITIZE_STRING);
		$slug = $this->slugify($name);
		$updated_on = date('Y-m-d H:i:s');
		$query = "
		UPDATE screens SET name='$name',slug='$slug',updated_on='$updated_on' WHERE id='$id'
		";
		if (TRUE === $this->connect->query($query)) {
			return true;
		} else {
			$_SESSION['error_msg'] = $this->connect->error;
			$_SESSION['error_code'] = 500;
			header('Location: ' . ADMIN_SITE_URL . '/controller/error.php');
		}
	}

	public function add_media($data)
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

	public function remove_prev_screen_media($id)
	{
		$query = "
		DELETE FROM screen_media WHERE screen_id = '$id'
		";
		$result = $this->connect->query($query);
		if (TRUE === $result) {
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
