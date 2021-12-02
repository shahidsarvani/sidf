<?php
@session_start();

require './../../config/config.php';

if (!isset($_SESSION['user_id']) && !$_SESSION['user_id']) {
    header('Location: ' . ADMIN_SITE_URL . '/controller/login.php');
}

require_once(BASE_PATH . '/cms/model/Sections.php');
$section_obj = new Sections();

$json_data = array();
$sec_rows = $section_obj->get_sections(); 
if($sec_rows){
	foreach($sec_rows as $sec_row){
		
		$section_tabs_data = array();
		$sec_tabs_rows = $section_obj->get_section_tabs_by_section_id($sec_row['id']); 
		if($sec_tabs_rows){
			foreach($sec_tabs_rows as $sec_tabs_row){ 
			
				$section_tabs_data[] = array(
					"sec_tab_id" => $sec_tabs_row['id'],
					"sec_tab_section_id" => $sec_tabs_row['section_id'],
					"sec_tab_slug" => $sec_tabs_row['slug'],
					"sec_tab_en_title" => $sec_tabs_row['en_title'],
					"sec_tab_ar_title" => $sec_tabs_row['ar_title'],
					"sec_tab_sort_order" => $sec_tabs_row['sort_order'],
					"sec_tab_icon" => $sec_tabs_row['tab_icon'],
					"sec_tab_bg_video" => $sec_tabs_row['bg_video'],
					"sec_tab_status" => $sec_tabs_row['status'],
					"sec_tab_updated_on" => $sec_tabs_row['updated_on']); 
			}
		} 
		
		$json_data[] = array("sec_id" => $sec_row['id'],
			"sec_slug" => $sec_row['slug'],
			"sec_en_title" => $sec_row['en_title'],
			"sec_ar_title" => $sec_row['ar_title'],
			"sec_sort_order" => $sec_row['sort_order'],
			"sec_bg_video" => $sec_row['bg_video'],
			"sec_status" => $sec_row['status'],
			"sec_updated_on" => $sec_row['updated_on'], 
			"section_tabs" => $section_tabs_data);
	}
}
 
$filename = BASE_PATH . '/sections.json';
$fp = fopen($filename, 'w');
fwrite($fp, json_encode($json_data, JSON_PRETTY_PRINT));
$close = fclose($fp); 
if ($close) {
    $response = [
        'status' => 1
    ];
} else {
    $response = [
        'status' => 0
    ];
}
echo json_encode($response);