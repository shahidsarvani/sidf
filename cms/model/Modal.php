<?php

class Modal
{

	public $connect;

	public function __construct()
	{
		require_once(BASE_PATH . '/cms/config/database.php');

		$database = new Database;
		$this->connect = $database->connect();
	}

	public function get_modals_with_year()
	{
		$query = "
		SELECT modals.*, timeline_items.title 
		FROM modals 
		INNER JOIN timeline_items ON modals.timeline_item_id = timeline_items.id ORDER BY modals.id ASC
		";
		$result = $this->connect->query($query);
		if ($this->connect->error) {
			die("Connection failed: " . $this->connect->error);
		}
		if ($result->num_rows > 0) {
			return $result;
		} else {
			return [];
		}
	}
	public function get_modals()
	{
		$query = "
		SELECT * FROM modals ORDER BY id ASC
		";
		$result = $this->connect->query($query);
		if ($this->connect->error) {
			die("Connection failed: " . $this->connect->error);
		}
		if ($result->num_rows > 0) {
			return $result;
		} else {
			return [];
		}
	}

	public function get_modal_count()
	{
		$query = "
		SELECT COUNT(*) AS count FROM modals 
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

	public function get_modal($id)
	{
		$query = "
		SELECT * FROM modals WHERE id = '$id' 
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

	public function get_modal_by_slug($slug)
	{
		$query = "
		SELECT * FROM modals WHERE slug = '$slug' 
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

	public function delete_modal($id)
	{
		$query = "
		DELETE FROM modals WHERE id = '$id'
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

	public function add_modal($data)
	{
		$name = filter_var($data['name'], FILTER_SANITIZE_STRING);
		$timeline_item_id = filter_var($data['timeline_item_id'], FILTER_SANITIZE_NUMBER_INT);
		$slug = $this->slugify($name);
		$created_on = date('Y-m-d H:i:s');
		$updated_on = date('Y-m-d H:i:s');
		$query = "
		INSERT INTO modals (name, slug, timeline_item_id, created_on, updated_on) VALUES ('$name','$slug','$timeline_item_id','$created_on','$updated_on')
		";
		// echo $query;
		// die(); 
		if (TRUE === $this->connect->query($query)) {
			return $this->connect->insert_id;
		} else {
			$_SESSION['error_msg'] = $this->connect->error;
			$_SESSION['error_code'] = 500;
			header('Location: ' . ADMIN_SITE_URL . '/controller/error.php');
		}
	}

	public function add_modal_item($data)
	{
		$created_on = date('Y-m-d H:i:s');
		$query = '';
		foreach ($data as $key => $value) {
			// echo $value['text_ar'];
			$modal_id = $value['modal_id'];
			$title_eng = filter_var($value['title_eng'], FILTER_SANITIZE_STRING);
			$title_ar = filter_var($value['title_ar'], FILTER_SANITIZE_STRING);
			$text_eng = htmlspecialchars($value['text_eng'], ENT_QUOTES);
			$text_ar = htmlspecialchars($value['text_ar'], ENT_QUOTES);
			$media_id = filter_var($value['media_id'], FILTER_SANITIZE_STRING);

			// echo $text_ar;
			// die();

			$query .= "
			INSERT INTO modal_items (modal_id, title_eng, title_ar, text_eng, text_ar, media_id, created_on) 
			VALUES ('$modal_id','$title_eng','$title_ar','$text_eng','$text_ar','$media_id','$created_on');
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

	public function get_modal_items($id)
	{
		$query = "
		SELECT * 
		FROM modal_items
		WHERE modal_id = '$id'
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

	public function edit_modal($id, $data)
	{
		$name = filter_var($data['name'], FILTER_SANITIZE_STRING);
		$slug = $this->slugify($name);
		$updated_on = date('Y-m-d H:i:s');
		$query = "
		UPDATE modals SET name='$name',slug='$slug',updated_on='$updated_on' WHERE id='$id'
		";

		if (TRUE === $this->connect->query($query)) {
			return true;
		} else {
			$_SESSION['error_msg'] = $this->connect->error;
			$_SESSION['error_code'] = 500;
			header('Location: ' . ADMIN_SITE_URL . '/controller/error.php');
		}
	}

	public function remove_prev_modal_items($id)
	{
		$query = "
		DELETE FROM modal_items WHERE modal_id = '$id'
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
