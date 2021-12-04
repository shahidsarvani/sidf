<?php

class Token
{

	public $connect;

	public function __construct()
	{
		require_once(BASE_PATH . '/cms/config/database.php');

		$database = new Database;
		$this->connect = $database->connect();
	}

	public function get_tokens()
	{
		$query = "
		SELECT * FROM company_tokens
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

	public function get_token_count()
	{
		$query = "
		SELECT COUNT(*) AS count FROM company_tokens
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
	public function get_media($id)
	{
		$query = "
		SELECT * 
		FROM media
		WHERE media.file_key = '$id'
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

	public function get_token($id)
	{
		$query = "
		SELECT * FROM company_tokens WHERE id = '$id' 
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

	public function delete_token($id)
	{
		$query = "
		DELETE FROM company_tokens WHERE id = '$id'
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

	public function add_token($data)
	{
		$name = filter_var($data['name'], FILTER_SANITIZE_STRING);
		$logo_key = filter_var($data['logo_key'], FILTER_SANITIZE_STRING);
		$video_key = filter_var($data['video_key'], FILTER_SANITIZE_STRING);
		$loader_video_key = filter_var($data['loader_video_key'], FILTER_SANITIZE_STRING);
		$slug = $this->slugify($name);
		$query = "
		INSERT INTO company_tokens (name, slug, logo_key, video_key, loader_video_key) VALUES ('$name','$slug','$logo_key','$video_key','$loader_video_key')
		";
		if (TRUE === $this->connect->query($query)) {
			return $this->connect->insert_id;
		} else {
			$_SESSION['error_msg'] = $this->connect->error;
			$_SESSION['error_code'] = 500;
			header('Location: ' . ADMIN_SITE_URL . '/controller/error.php');
		}
	}

	public function edit_token($id, $data)
	{
		$name = filter_var($data['name'], FILTER_SANITIZE_STRING);
		$logo_key = filter_var($data['logo_key'], FILTER_SANITIZE_STRING);
		$video_key = filter_var($data['video_key'], FILTER_SANITIZE_STRING);
		$loader_video_key = filter_var($data['loader_video_key'], FILTER_SANITIZE_STRING);
		$slug = $this->slugify($name);
		$query = "
		UPDATE company_tokens SET name='$name',slug='$slug',logo_key='$logo_key',video_key='$video_key',loader_video_key='$loader_video_key' WHERE id='$id'
		";
		if (TRUE === $this->connect->query($query)) {
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
