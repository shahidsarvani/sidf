<?php
class Sections
{

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

	public function get_max_sort_order()
	{
		$result = $this->connect->query("SELECT max(sort_order) as max_sort_order FROM sections ");
		if ($result->num_rows > 0) {
			$db_row = $result->fetch_array();
			if (isset($db_row["max_sort_order"])) {
				return $db_row["max_sort_order"];
			} else {
				return '0';
			}
		} else {
			return '0';
		}
	}

	public function get_section($id)
	{

		$query = "SELECT * FROM sections WHERE id = '" . $id . "' ";
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

	public function get_section_by_slug($slug)
	{
		$query = "SELECT * FROM sections WHERE slug='" . $slug . "' ";
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
		$query = "DELETE FROM sections WHERE id = '" . $id . "' ";
		$result = $this->connect->query($query);
		if (TRUE === $result) {
			return true;
		} else {
			$_SESSION['error_msg'] = $this->connect->error;
			$_SESSION['error_code'] = 500;
			header('Location: ' . ADMIN_SITE_URL . '/controller/error.php');
		}
	}


	public function get_section_tabs_by_section_id($section_id)
	{
		$query = "SELECT * FROM section_tabs WHERE section_id = '" . $section_id . "' ";
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

	public function get_active_section_tabs_by_section_id($section_id)
	{
		$query = "SELECT * FROM section_tabs WHERE section_id = '" . $section_id . "' AND status = 1 ORDER BY sort_order ASC";
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
		s.en_sub_title as sec_en_sub_title,
		s.ar_sub_title as sec_ar_sub_title, 
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
		st.tab_icon as sec_tab_icon,
		st.bg_video as sec_tab_bg_video,
		st.status as sec_tab_status,
		st.updated_on as sec_tab_updated_on
		FROM sections s LEFT JOIN section_tabs st ON s.id = st.section_id 
		WHERE s.id = '" . $id . "' ORDER BY st.sort_order ASC ";
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
		$en_sub_title = filter_var($data['en_sub_title'], FILTER_SANITIZE_STRING);
		$ar_sub_title = filter_var($data['ar_sub_title'], FILTER_SANITIZE_STRING);
		$sort_order = filter_var($data['sort_order'], FILTER_SANITIZE_STRING);
		$status = filter_var($data['status'], FILTER_SANITIZE_STRING);
		$slug = $this->slugify($slug);
		$updated_on = date('Y-m-d H:i:s');

		$bg_video_name = '';
		if (isset($_FILES["bg_video"]["tmp_name"]) && strlen($_FILES["bg_video"]["tmp_name"]) > 0) {
			$ext = pathinfo($_FILES["bg_video"]["name"], PATHINFO_EXTENSION);
			$bg_video_name = md5(uniqid(rand(), true)) . '.' . $ext;
			$path_with_video = "../../../process/frontend_assets/sections/" . $bg_video_name;
			@move_uploaded_file($_FILES["bg_video"]["tmp_name"], $path_with_video);
		}

		$query1 = "INSERT INTO sections (slug, en_title, ar_title, en_sub_title, ar_sub_title, sort_order, bg_video, status, updated_on) VALUES ('" . $slug . "', '" . $en_title . "', '" . $ar_title . "', '" . $en_sub_title . "', '" . $ar_sub_title . "', '" . $sort_order . "', '" . $bg_video_name . "', '" . $status . "', '" . $updated_on . "')";

		if (TRUE === $this->connect->query($query1)) {
			$last_section_id = $this->connect->insert_id;
			$n = 0;
			if (isset($data['tab_en_title'])) {
				foreach ($data['tab_en_title'] as $tab_entitle) {

					$tab_ar_title = filter_var($data['tab_ar_title']["$n"], FILTER_SANITIZE_STRING);
					$tab_slug = filter_var($data['tab_slug']["$n"], FILTER_SANITIZE_STRING);
					$tab_sort_order = filter_var($data['tab_sort_order']["$n"], FILTER_SANITIZE_STRING);
					$tab_status = filter_var($data['tab_status']["$n"], FILTER_SANITIZE_STRING);
					$tab_slug = $this->slugify($tab_slug);

					$tab_icon_name = '';
					if (isset($_FILES["tab_icon"]["tmp_name"]["$n"]) && strlen($_FILES["tab_icon"]["tmp_name"]["$n"]) > 0) {
						$ext = pathinfo($_FILES["tab_icon"]["name"]["$n"], PATHINFO_EXTENSION);
						$tab_icon_name = md5(uniqid(rand(), true)) . '.' . $ext;
						$path_with_tab_icon = "../../../process/frontend_assets/section_tabs/" . $tab_icon_name;
						@move_uploaded_file($_FILES["tab_icon"]["tmp_name"]["$n"], $path_with_tab_icon);
					}

					$tab_bg_video_name = '';
					if (isset($_FILES["tab_bg_video"]["tmp_name"]["$n"]) && strlen($_FILES["tab_bg_video"]["tmp_name"]["$n"]) > 0) {
						$ext = pathinfo($_FILES["tab_bg_video"]["name"]["$n"], PATHINFO_EXTENSION);
						$tab_bg_video_name = md5(uniqid(rand(), true)) . '.' . $ext;
						$path_with_tab_video = "../../../process/frontend_assets/tab_bg_videos/" . $tab_bg_video_name;
						@move_uploaded_file($_FILES["tab_bg_video"]["tmp_name"]["$n"], $path_with_tab_video);
					}

					$query2 = "INSERT INTO section_tabs (section_id, slug, en_title, ar_title, sort_order, tab_icon, bg_video, 	status, updated_on) VALUES ('" . $last_section_id . "', '" . $tab_slug . "', '" . $tab_entitle . "', '" . $tab_ar_title . "', '" . $tab_sort_order . "', '" . $tab_icon_name . "', '" . $tab_bg_video_name . "', '" . $tab_status . "', '" . $updated_on . "')";
					$this->connect->query($query2);

					$n++;
				}
			}

			return $last_section_id;
		} else {
			$_SESSION['error_msg'] = $this->connect->error;
			$_SESSION['error_code'] = 500;
			header('Location: ' . ADMIN_SITE_URL . '/controller/error.php');
		}
	}

	public function edit_section($id, $data, $items_config)
	{
		$slug = filter_var($data['slug'], FILTER_SANITIZE_STRING);
		$en_title = filter_var($data['en_title'], FILTER_SANITIZE_STRING);
		$ar_title = filter_var($data['ar_title'], FILTER_SANITIZE_STRING);
		$en_sub_title = filter_var($data['en_sub_title'], FILTER_SANITIZE_STRING);
		$ar_sub_title = filter_var($data['ar_sub_title'], FILTER_SANITIZE_STRING);
		$thankyou_en = filter_var($data['thankyou_en'], FILTER_SANITIZE_STRING);
		$thankyou_ar = filter_var($data['thankyou_ar'], FILTER_SANITIZE_STRING);
		$sort_order = filter_var($data['sort_order'], FILTER_SANITIZE_STRING);
		$status = filter_var($data['status'], FILTER_SANITIZE_STRING);
		$bg_video_name = (isset($data['old_bg_video']) && $data['old_bg_video'] != '') ? $data['old_bg_video'] : '';
		$updated_on = date('Y-m-d H:i:s');


		$query1 = "UPDATE sections SET 
				slug='" . $slug . "', 
				en_title='" . $en_title . "', 
				ar_title='" . $ar_title . "', 
				en_sub_title='" . $en_sub_title . "', 
				ar_sub_title='" . $ar_sub_title . "', 
				thankyou_en='" . $thankyou_en . "', 
				thankyou_ar='" . $thankyou_ar . "', 
				sort_order='" . $sort_order . "', 
				bg_video='" . $bg_video_name . "', 
				status='" . $status . "', 
				updated_on='" . $updated_on . "' WHERE id='" . $id . "'";
		if (TRUE === $this->connect->query($query1)) {
			$n = 0;
			if (isset($data['tab_en_title'])) {
				$this->connect->query("DELETE FROM section_tabs WHERE section_id='" . $id . "' ");

				foreach ($data['tab_en_title'] as $tab_entitle) {
					$tab_ar_title = filter_var($data['tab_ar_title']["$n"], FILTER_SANITIZE_STRING);
					$tab_slug = filter_var($data['tab_slug']["$n"], FILTER_SANITIZE_STRING);
					$tab_sort_order = filter_var($data['tab_sort_order']["$n"], FILTER_SANITIZE_STRING);
					$tab_status = filter_var($data['tab_status']["$n"], FILTER_SANITIZE_STRING);
					$tab_slug = $this->slugify($tab_slug);

					$tab_icon_name = (isset($data['old_tab_icon']["$n"]) && $data['old_tab_icon']["$n"] != '') ? $data['old_tab_icon']["$n"] : '';

					if (isset($_FILES["tab_icon"]["tmp_name"]["$n"]) && strlen($_FILES["tab_icon"]["tmp_name"]["$n"]) > 0) {
						if ($tab_icon_name != '') {
							$file = $items_config['section_tabicon_media_path'].$tab_icon_name;
							@unlink("{$file}");
						}

						$ext = pathinfo($_FILES["tab_icon"]["name"]["$n"], PATHINFO_EXTENSION);
						$tab_icon_name = md5(uniqid(rand(), true)) . '.' . $ext;
						$path_with_tab_icon = $items_config['section_tabicon_media_path'] . $tab_icon_name;
						@move_uploaded_file($_FILES["tab_icon"]["tmp_name"]["$n"], $path_with_tab_icon);
					}

					$tab_bg_video_name = (isset($data['old_tab_bg_video']["$n"]) && $data['old_tab_bg_video']["$n"] != '') ? $data['old_tab_bg_video']["$n"] : '';

					$query2 = "INSERT INTO section_tabs (section_id, slug, en_title, ar_title, sort_order, tab_icon, bg_video, 	status, updated_on) VALUES ('" . $id . "', '" . $tab_slug . "', '" . $tab_entitle . "', '" . $tab_ar_title . "', '" . $tab_sort_order . "', '" . $tab_icon_name . "', '" . $tab_bg_video_name . "', '" . $tab_status . "', '" . $updated_on . "')";
					$this->connect->query($query2);

					$n++;
				}
			}

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
			$media_id = filter_var($value['media_id'], FILTER_SANITIZE_STRING);
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
