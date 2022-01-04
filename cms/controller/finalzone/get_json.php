<?php

session_start();

require './../../config/config.php';

if (!isset($_SESSION['user_id']) && !$_SESSION['user_id']) {
    header('Location: ' . ADMIN_SITE_URL . '/controller/login.php');
}

require_once(BASE_PATH . '/cms/model/Finalzone.php');
$screen = new Finalzone();
$screens = $screen->get_screens();
foreach ($screens as $index => $value) {
    $item_media = $screen->get_media($value['video_key']);
    $name = $screen->slugify($value['name']);
    $data[$name] = array();
    $temp['logo'] = $items_config['finalzone_image_media_url'] . $value['logo'];
    $temp['video'] = '';
    if($item_media != false) {
        $video = $item_media->fetch_assoc();
        $temp['video'] = '<video width="100%" id="vid" autoplay loop><source src="' . $items_config['finalzone_video_media_url'] . $video['name'] . '" type="' . $video['filetype'] . '">Your browser does not support HTML video.</video>';
    }
    $data[$name] = $temp;
}
// echo json_encode($data);
$filename = BASE_PATH . '/finalzone/finalzone.json';
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
