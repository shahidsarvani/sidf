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

	public function get_timeline_count()
	{
		$query = "
		SELECT COUNT(*) AS count FROM timeline_items
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

	public function add_timeline_item($data)
	{
		$title = filter_var($data['title'], FILTER_SANITIZE_STRING);
		$text_eng = filter_var($data['text_eng'], FILTER_SANITIZE_STRING);
		$text_ar = filter_var($data['text_ar'], FILTER_SANITIZE_STRING);
		$position = filter_var($data['position'], FILTER_SANITIZE_NUMBER_INT);
		$slug = 'item-'.$position;
		$created_on = date('Y-m-d H:i:s');
		$updated_on = date('Y-m-d H:i:s');
		if(isset($data['image'])) {
			$image = filter_var($data['image'], FILTER_SANITIZE_STRING);
			$query = "
			INSERT INTO timeline_items (title, slug, text_eng, text_ar, position, image, created_on, updated_on) VALUES ('$title','$slug','$text_eng','$text_ar','$position','$image','$created_on','$updated_on')
			";
		} else {
			$query = "
			INSERT INTO timeline_items (title, slug, text_eng, text_ar, position, created_on, updated_on) VALUES ('$title','$slug','$text_eng','$text_ar','$position','$created_on','$updated_on')
			";
		}
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
		$text_eng = htmlspecialchars($data['text_eng'], ENT_QUOTES);
		$text_ar = htmlspecialchars($data['text_ar'], ENT_QUOTES);
		// $text_eng = htmlentities($data['text_eng']);
		// $text_ar = htmlentities($data['text_ar']);
		$position = filter_var($data['position'], FILTER_SANITIZE_NUMBER_INT);
		$slug = 'item-'.$position;
		$updated_on = date('Y-m-d H:i:s');
		if(isset($data['image'])) {
			$image = filter_var($data['image'], FILTER_SANITIZE_STRING);
			$query = "
			UPDATE timeline_items SET title='$title',slug='$slug',text_eng='$text_eng',text_ar='$text_ar',position='$position',image='$image',updated_on='$updated_on' WHERE id='$id'
			";
		} else {
			$query = "
			UPDATE timeline_items SET title='$title',slug='$slug',text_eng='$text_eng',text_ar='$text_ar',position='$position',image=NULL,updated_on='$updated_on' WHERE id='$id'
			";
		}

		if (TRUE === $this->connect->query($query)) {
			return true;
		} else {
			$_SESSION['error_msg'] = $this->connect->error;
			$_SESSION['error_code'] = 500;
			header('Location: ' . ADMIN_SITE_URL . '/controller/error.php');
		}
	}
}
