<?php
@session_start();

require './../../config/config.php';

if (!isset($_SESSION['user_id']) && !$_SESSION['user_id']) {
    header('Location: ' . ADMIN_SITE_URL . '/controller/login.php');
}

require_once(BASE_PATH . '/cms/model/Sections.php');
$section_obj = new Sections();
$sections = $section_obj->get_sections();
$response['screens'] = [];
$temp = array();
$sliders = ['one', 'two', 'three', 'four', 'five', 'six', 'seven'];
foreach ($sections as $index => $value) {
    $item_media = $section_obj->get_screen_media($value['id']);
    $section_arrs = array();
    $loop = $item_media->num_rows < 2 ? 'loop' : '';
    foreach ($item_media as $media) {
        if($media['type'] == 'video'){
            array_push($section_arrs, '<div class="item"><video class="img_slid" muted controls onplay="pauseSlider(\'.slider_'.$sliders[$index].'\');" onended="playSlider(\'.slider_'.$sliders[$index].'\');" '.$loop.'><source src="'.$items_config['images_url'] . $media['name'].'" type="'.$media['filetype'].'"></video></div>');
        } else {
            array_push($section_arrs, '<div class="item"><img src="'.$items_config['images_url'].$media['name'].'" alt="" class="img_slid"></div>');
        }
    }
     
    $temp['section_arrs'] = $section_arrs;
    array_push($response['sections'], $temp);
}
$filename = BASE_PATH . '/sections.json';
$fp = fopen($filename, 'w');
$written = fwrite($fp, json_encode($response, JSON_PRETTY_PRINT));
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
