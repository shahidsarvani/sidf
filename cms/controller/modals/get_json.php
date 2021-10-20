<?php

session_start();

require './../../config/config.php';

if (!isset($_SESSION['user_id']) && !$_SESSION['user_id']) {
    header('Location: ' . ADMIN_SITE_URL . '/controller/login.php');
}

require_once(BASE_PATH . '/cms/model/Modal.php');
$modal = new Modal();
$modals = $modal->get_modals();
$response['modals'] = [];
$temp = array();
foreach ($modals as $item) {
    $item_media = $modal->get_modal_items($item['id']);
    $medias = array();
    foreach ($item_media as $media) {
        $medias[] = [
            'modal_id' => $media['modal_id'],
            'title_eng' => $media['title_eng'],
            'title_ar' => $media['title_ar'],
            'text_eng' => $media['text_eng'],
            'text_ar' => $media['text_ar'],
            'media' => $items_config['modal_media_url'].$media['media'],
        ];
    }
    $temp['modal_nam'] = $item['name'];
    $temp['modal_slug'] = $item['slug'];
    $temp['timeline_item_id'] = $item['timeline_item_id'];
    $temp['items'] = $medias;
    array_push($response['modals'], $temp);
}
$filename = BASE_PATH . '/modals.json';
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
