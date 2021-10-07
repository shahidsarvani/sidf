<?php

session_start();

require './../../config/config.php';

if (!isset($_SESSION['user_id']) && !$_SESSION['user_id']) {
    header('Location: ' . ADMIN_SITE_URL . '/controller/login.php');
}

require_once(BASE_PATH . '/cms/model/Screen.php');
$screen = new Screen();
$screens = $screen->get_screens();
$response['screens'] = [];
$temp = array();
foreach ($screens as $item) {
    $item_media = $screen->get_screen_media($item['id']);
    $medias = array();
    foreach ($item_media as $media) {
        array_push($medias, USER_ASSET.'/images/'.$media['name']);
    }
    $temp['screen_name'] = $item['name'];
    $temp['screen_slug'] = $item['slug'];
    $temp['media'] = $medias;
    array_push($response['screens'], $temp);
}
$filename = BASE_PATH . '/screens.json';
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
