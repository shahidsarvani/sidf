<?php

class Company
{

	public $connect;

	public function __construct()
	{
		require_once(BASE_PATH . '/cms/config/database.php');

		$database = new Database;
		$this->connect = $database->connect();
	}

	public function get_companies()
	{
		$query = "
		SELECT * FROM company_info
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

	public function get_company_count()
	{
		$query = "
		SELECT COUNT(*) AS count FROM company_info
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

	public function get_company($id)
	{
		$query = "
		SELECT * FROM company_info WHERE id = '$id' 
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

	public function add_menu_icons($data)
	{
		$query = '';
		foreach ($data as $key => $value) {
			$company_token_id = $value['company_token_id'];
			$title_eng = filter_var($value['title_eng'], FILTER_SANITIZE_STRING);
			$title_ar = filter_var($value['title_ar'], FILTER_SANITIZE_STRING);
			$icon = filter_var($value['icon'], FILTER_SANITIZE_STRING);
			$query .= "
			INSERT INTO company_menus (company_token_id, title_eng, title_ar, icon) 
			VALUES ('$company_token_id','$title_eng','$title_ar','$icon');
			";
		}
		// echo $query;
		// die();
		if ($this->connect->multi_query($query) === TRUE) {
			return true;
		} else {
			$_SESSION['error_msg'] = $this->connect->error;
			$_SESSION['error_code'] = 500;
			header('Location: ' . ADMIN_SITE_URL . '/controller/error.php');
		}
	}

	public function get_company_icons($id)
	{
		$query = "
		SELECT * 
		FROM company_menus
		WHERE company_token_id = '$id'
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

	public function add_company($data)
	{
		$company_token_id = filter_var($data['company_token_id'], FILTER_SANITIZE_STRING);
		$name_eng = filter_var($data['name_eng'], FILTER_SANITIZE_STRING);
		$name_ar = filter_var($data['name_ar'], FILTER_SANITIZE_STRING);
		$info_eng = filter_var($data['info_eng'], FILTER_SANITIZE_STRING);
		$info_ar = filter_var($data['info_ar'], FILTER_SANITIZE_STRING);
		$logo_key = filter_var($data['logo_key'], FILTER_SANITIZE_STRING);
		$video_key = filter_var($data['video_key'], FILTER_SANITIZE_STRING);
		$query = "
		INSERT INTO company_info (company_token_id, name_eng, name_ar, info_eng, info_ar, logo_key, video_key) VALUES ('$company_token_id','$name_eng','$name_ar','$info_eng','$info_ar','$logo_key','$video_key')
		";
		if (TRUE === $this->connect->query($query)) {
			return $this->connect->insert_id;
		} else {
			$_SESSION['error_msg'] = $this->connect->error;
			$_SESSION['error_code'] = 500;
			header('Location: ' . ADMIN_SITE_URL . '/controller/error.php');
		}
	}

	public function edit_company($id, $data)
	{
		$company_token_id = filter_var($data['company_token_id'], FILTER_SANITIZE_STRING);
		$name_eng = filter_var($data['name_eng'], FILTER_SANITIZE_STRING);
		$name_ar = filter_var($data['name_ar'], FILTER_SANITIZE_STRING);
		$info_eng = filter_var($data['info_eng'], FILTER_SANITIZE_STRING);
		$info_ar = filter_var($data['info_ar'], FILTER_SANITIZE_STRING);
		$logo_key = filter_var($data['logo_key'], FILTER_SANITIZE_STRING);
		$video_key = filter_var($data['video_key'], FILTER_SANITIZE_STRING);
		$query = "
		UPDATE company_info SET company_token_id='$company_token_id',name_eng='$name_eng',name_ar='$name_ar',info_eng='$info_eng',info_ar='$info_ar',logo_key='$logo_key',video_key='$video_key' WHERE id='$id'
		";
		if (TRUE === $this->connect->query($query)) {
			return true;
		} else {
			$_SESSION['error_msg'] = $this->connect->error;
			$_SESSION['error_code'] = 500;
			header('Location: ' . ADMIN_SITE_URL . '/controller/error.php');
		}
	}

	public function remove_prev_menu_icons($id)
	{
		$query = "
		DELETE FROM company_menus WHERE company_token_id = '$id'
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
