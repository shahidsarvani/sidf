<?php

session_start();

require './../../config/config.php';

if (!isset($_SESSION['user_id']) && !$_SESSION['user_id']) {
    header('Location: ' . ADMIN_SITE_URL . '/controller/login.php');
}

require_once(BASE_PATH . '/cms/model/Screen.php');
$screen = new Screen();
$screens = $screen->get_screens();
$data['screens'] = [];
$sliders = ['one', 'two', 'three', 'four', 'five', 'six', 'seven'];
foreach ($screens as $index => $value) {
    $item_media = $screen->get_screen_media($value['id']);
    // $temp = array();
    $medias = array();
    $loop = $item_media->num_rows < 2 ? 'loop' : '';
    foreach ($item_media as $media) {
        if($media['type'] == 'video'){
            array_push($medias, '<div class="item"><video class="img_slid" muted controls onplay="pauseSlider(\'.slider_'.$sliders[$index].'\');" onended="playSlider(\'.slider_'.$sliders[$index].'\');" '.$loop.'><source src="'.$items_config['images_url'] . $media['name'].'" type="'.$media['filetype'].'"></video></div>');
        } else {
            array_push($medias, '<div class="item"><img src="'.$items_config['images_url'].$media['name'].'" alt="" class="img_slid"></div>');
        }
    }
    // $temp['screen_name'] = $item['name'];
    // $temp['screen_slug'] = $item['slug'];
    $temp['media'] = $medias;
    array_push($data['screens'], $temp);
}
$filename = BASE_PATH . '/screens.json';
$fp = fopen($filename, 'w');
$written = fwrite($fp, json_encode($data, JSON_PRETTY_PRINT));
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
