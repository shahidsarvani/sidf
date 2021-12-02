<?php
	@session_start();
	
	require './../../config/config.php';
	
	if(!isset($_SESSION['user_id']) && !$_SESSION['user_id']) {
		header('Location: ' . ADMIN_SITE_URL . '/controller/login.php');
	}
	
	require_once(BASE_PATH . '/cms/model/Sections.php');
	$sections_obj = new Sections();
	$rows = $sections_obj->get_sections(); 
	
	/*for($i = 0; $i < count($all_sections); $i++){
		$item_media = $sections_obj->get_section_media($all_sections[$i]['id']);
		$section_arrs = array();
		if($item_media) {
			foreach ($item_media as $media) {
				array_push($section_arrs, $media);
			}
		}
		
		$all_sections[$i]['media'] = $medias;
	}*/
	// echo json_encode($all_screens);
	// die();
	
	$title = 'Sections - SIDF';
	
	require BASE_PATH . '/cms/views/layout/scripts.php';
	require BASE_PATH . '/cms/views/layout/navbar.php';
	require BASE_PATH . '/cms/views/layout/sidebar.php';
	require BASE_PATH . '/cms/views/sections/index.php';
	?>