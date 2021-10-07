<?php

class Timeline
{

	public $connect;

	public function __construct()
	{
		require_once(BASE_PATH . '/cms/config/database.php');

		$database = new Database;
		$this->connect = $database->connect();
	}

	public function get_timeline_items()
	{
		$query = "
		SELECT * FROM timeline_items ORDER BY position ASC
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

	public function get_timeline_item($id)
	{
		$query = "
		SELECT * FROM timeline_items WHERE id = '$id' 
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

	public function get_timeline_item_by_slug($slug)
	{
		$query = "
		SELECT * FROM timeline_items WHERE slug = '$slug' 
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

	public function delete_timeline_item($id)
	{
		$query = "
		DELETE FROM timeline_items WHERE id = '$id'
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

	// public function get_screen_media($id)
	// {
	// 	$query = "
	// 	SELECT media.*, screen_media.screen_id as through_key 
	// 	FROM media 
	// 	INNER JOIN screen_media ON screen_media.media_id = media.file_key 
	// 	WHERE screen_media.screen_id = '$id'
	// 	";
	// 	$result = $this->connect->query($query);
	// 	if ($this->connect->error) {
	// 		die("Connection failed: " . $this->connect->error);
	// 	}
	// 	if ($result->num_rows > 0) {
	// 		return $result;
	// 	} else {
	// 		return false;
	// 	}
	// }

	public function add_timeline_item($data)
	{
		$title = filter_var($data['title'], FILTER_SANITIZE_STRING);
		$text_eng = filter_var($data['text_eng'], FILTER_SANITIZE_STRING);
		$text_ar = filter_var($data['text_ar'], FILTER_SANITIZE_STRING);
		$position = filter_var($data['position'], FILTER_SANITIZE_NUMBER_INT);
		$slug = 'item-'.$position;
		$created_on = date('Y-m-d H:i:s');
		$updated_on = date('Y-m-d H:i:s');
		$query = "
		INSERT INTO timeline_items (title, slug, text_eng, text_ar, position, created_on, updated_on) VALUES ('$title','$slug','$text_eng','$text_ar','$position','$created_on','$updated_on')
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

	public function edit_timeline_item($id, $data)
	{
		$title = filter_var($data['title'], FILTER_SANITIZE_STRING);
		$text_eng = filter_var($data['text_eng'], FILTER_SANITIZE_STRING);
		$text_ar = filter_var($data['text_ar'], FILTER_SANITIZE_STRING);
		$position = filter_var($data['position'], FILTER_SANITIZE_NUMBER_INT);
		$slug = 'item-'.$position;
		$updated_on = date('Y-m-d H:i:s');
		$query = "
		UPDATE timeline_items SET title='$title',slug='$slug',text_eng='$text_eng',text_ar='$text_ar',position='$position',updated_on='$updated_on' WHERE id='$id'
		";
		if (TRUE === $this->connect->query($query)) {
			return true;
		} else {
			$_SESSION['error_msg'] = $this->connect->error;
			$_SESSION['error_code'] = 500;
			header('Location: ' . ADMIN_SITE_URL . '/controller/error.php');
		}
	}

	// public function add_media($data)
	// {
	// 	$created_on = date('Y-m-d H:i:s');
	// 	$query = '';
	// 	foreach ($data as $key => $value) {
	// 		$screen_id = $value['screen_id'];
	// 		$media_id = $value['media_id'];
	// 		$query .= "
	// 		INSERT INTO screen_media (screen_id, media_id, created_on) VALUES ('$screen_id','$media_id','$created_on');
	// 		";
	// 	}
	// 	if ($this->connect->multi_query($query) === TRUE) {
	// 		return true;
	// 	} else {
	// 		$_SESSION['error_msg'] = $this->connect->error;
	// 		$_SESSION['error_code'] = 500;
	// 		header('Location: ' . ADMIN_SITE_URL . '/controller/error.php');
	// 	}
	// }

	// public function remove_prev_screen_media($id)
	// {
	// 	$query = "
	// 	DELETE FROM screen_media WHERE screen_id = '$id'
	// 	";
	// 	$result = $this->connect->query($query);
	// 	if (TRUE === $result) {
	// 		return true;
	// 	} else {
	// 		$_SESSION['error_msg'] = $this->connect->error;
	// 		$_SESSION['error_code'] = 500;
	// 		header('Location: ' . ADMIN_SITE_URL . '/controller/error.php');
	// 	}
	// }

	// public function get_timeline_item_count()
	// {
	// 	$query = "
	// 	SELECT COUNT(*) as count FROM timeline_items
	// 	";
	// 	$result = $this->connect->query($query);
	// 	if ($this->connect->error) {
	// 		die("Connection failed: " . $this->connect->error);
	// 	}
	// 	if ($result->num_rows > 0) {
	// 		return $result->fetch_assoc();
	// 	} else {
	// 		return false;
	// 	}
	// }

	// public function slugify($text, string $divider = '-')
	// {
	// 	// replace non letter or digits by divider
	// 	$text = preg_replace('~[^\pL\d]+~u', $divider, $text);

	// 	// transliterate
	// 	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	// 	// remove unwanted characters
	// 	$text = preg_replace('~[^-\w]+~', '', $text);

	// 	// trim
	// 	$text = trim($text, $divider);

	// 	// remove duplicate divider
	// 	$text = preg_replace('~-+~', $divider, $text);

	// 	// lowercase
	// 	$text = strtolower($text);

	// 	if (empty($text)) {
	// 		return 'n-a';
	// 	}

	// 	return $text;
	// }
}
