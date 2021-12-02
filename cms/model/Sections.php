<?php
class Sections {

	public $connect;

	public function __construct()
	{
		require_once(BASE_PATH . '/cms/config/database.php');

		$database = new Database;
		$this->connect = $database->connect();
	}

	public function get_sections()
	{
		$query = "SELECT * FROM sections order by sort_order ASC";
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

	public function get_section_count()
	{
		$query = "SELECT COUNT(*) AS count FROM sections";
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
	
	public function get_max_sort_order(){ 
		$result = $this->connect->query("SELECT max(sort_order) as max_sort_order FROM sections ");
		if($result->num_rows > 0) {
			 $db_row = $result->fetch_array();
			 if(isset($db_row["max_sort_order"])){ 
				return $db_row["max_sort_order"]; 
			 }else{
				return '0';
			 }
		}else{
			return '0';
		}
	}
	
	public function get_section($id){
	
		$query = "SELECT * FROM sections WHERE id = '".$id."' ";
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

	public function get_section_by_slug($slug)
	{
		$query = "SELECT * FROM sections WHERE slug='".$slug."' ";
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

	public function delete_section($id)
	{
		$query = "DELETE FROM sections WHERE id = '".$id."' ";
		$result = $this->connect->query($query);
		if (TRUE === $result) {
			return true;
		} else {
			$_SESSION['error_msg'] = $this->connect->error;
			$_SESSION['error_code'] = 500;
			header('Location: ' . ADMIN_SITE_URL . '/controller/error.php');
		}
	}

	public function get_section_tabs($id)
	{
	
	 	/*s.id as sec_id,
		s.slug as sec_slug,
		s.en_title as sec_en_title,
		s.ar_title as sec_ar_title,
		s.sort_order as sec_sort_order,
		s.bg_video as sec_bg_video ,
		s.status as sec_status,
		s.updated_on as sec_updated_on,
		st.id as sec_tab_id,
		st.section_id as sec_tab_section_id,
		st.slug as sec_tab_slug,
		st.en_title as sec_tab_en_title,
		st.ar_title as sec_tab_ar_title,
		st.sort_order as sec_tab_sort_order,
		st.bg_video as sec_tab_bg_video ,
		st.status as sec_tab_status,
		st.updated_on as sec_tab_updated_on*/
		 
		$query = "SELECT s.id as sec_id,
		s.slug as sec_slug,
		s.en_title as sec_en_title,
		s.ar_title as sec_ar_title,
		s.sort_order as sec_sort_order,
		s.bg_video as sec_bg_video ,
		s.status as sec_status,
		s.updated_on as sec_updated_on,
		st.id as sec_tab_id,
		st.section_id as sec_tab_section_id,
		st.slug as sec_tab_slug,
		st.en_title as sec_tab_en_title,
		st.ar_title as sec_tab_ar_title,
		st.sort_order as sec_tab_sort_order,
		st.bg_video as sec_tab_bg_video,
		st.status as sec_tab_status,
		st.updated_on as sec_tab_updated_on
		FROM sections s LEFT JOIN section_tabs st ON s.id = st.section_id 
		WHERE s.id = '".$id."' ORDER BY st.sort_order ASC ";
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
	
	//slug  en_title  ar_title  sort_order  bg_video  status  updated_on
	public function add_section($data)
	{
		$slug = filter_var($data['slug'], FILTER_SANITIZE_STRING);
		$en_title = filter_var($data['en_title'], FILTER_SANITIZE_STRING);
		$ar_title = filter_var($data['ar_title'], FILTER_SANITIZE_STRING);
		$sort_order = filter_var($data['sort_order'], FILTER_SANITIZE_STRING);
		$bg_video = filter_var($data['bg_video'], FILTER_SANITIZE_STRING);
		$status = filter_var($data['status'], FILTER_SANITIZE_STRING); 		
		
		$slug = $this->slugify($slug); 
		$updated_on = date('Y-m-d H:i:s');
		
		$query = "INSERT INTO sections (slug, en_title, ar_title, sort_order, bg_video, status, updated_on) VALUES ('".$slug."', '".$en_title."', '".$ar_title."', '".$sort_order."', '".$bg_video."', '".$status."', '".$updated_on."')";
		
		if (TRUE === $this->connect->query($query)) {
			return $this->connect->insert_id;
		} else {
			$_SESSION['error_msg'] = $this->connect->error;
			$_SESSION['error_code'] = 500;
			header('Location: ' . ADMIN_SITE_URL . '/controller/error.php');
		}
	}

	public function edit_section($id, $data)
	{
		//$name = filter_var($data['name'], FILTER_SANITIZE_STRING);		
		//slug  en_title  ar_title  sort_order  bg_video  status  updated_on
		$slug = filter_var($data['slug'], FILTER_SANITIZE_STRING);
		$en_title = filter_var($data['en_title'], FILTER_SANITIZE_STRING);
		$ar_title = filter_var($data['ar_title'], FILTER_SANITIZE_STRING);
		$sort_order = filter_var($data['sort_order'], FILTER_SANITIZE_STRING);
		$bg_video = filter_var($data['bg_video'], FILTER_SANITIZE_STRING);
		$status = filter_var($data['status'], FILTER_SANITIZE_STRING); 		
		
		$slug = $this->slugify($name);
		$updated_on = date('Y-m-d H:i:s');
		
		$query = "UPDATE sections SET slug='".$slug."', en_title='".$en_title."', ar_title='".$ar_title."', sort_order='".$sort_order."', bg_video='".$bg_video."', status='".$status."', updated_on='".$updated_on."' WHERE id='".$id."'";
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
			$section_id = $value['section_id'];
			$media_id = $value['media_id'];
			$query .= "INSERT INTO section_media (section_id, media_id, created_on) VALUES ('$section_id','$media_id','$created_on');";
		}
		if ($this->connect->multi_query($query) === TRUE) {
			return true;
		} else {
			$_SESSION['error_msg'] = $this->connect->error;
			$_SESSION['error_code'] = 500;
			header('Location: ' . ADMIN_SITE_URL . '/controller/error.php');
		}
	}

	public function remove_prev_section_media($id)
	{
		$query = "DELETE FROM section_media WHERE section_id = '$id'";
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
