<?php

session_start();

require './../../config/config.php';

if (!isset($_SESSION['user_id']) && !$_SESSION['user_id']) {
    header('Location: ' . ADMIN_SITE_URL . '/controller/login.php');
}

require_once(BASE_PATH . '/cms/model/Timeline.php');
require_once(BASE_PATH . '/cms/model/Modal.php');
$timeline_item = new Timeline();
$modal_obj = new Modal();
$timeline_items = $timeline_item->get_timeline_items_with_modal();
$response['timeline_items'] = [];
foreach ($timeline_items as $item) {
    $modal_items = $modal_obj->get_modal_items($item['modal_id']);
    $item['titles_en'] = array();
    $item['titles_ar'] = array();
    if ($modal_items) {
        foreach ($modal_items as $modal_item) {
            array_push($item['titles_en'], $modal_item['title_eng']);
            array_push($item['titles_ar'], $modal_item['title_ar']);
        }
    }
    $item['titles_en'] = array_unique($item['titles_en']);
    $item['titles_ar'] = array_unique($item['titles_ar']);
    // echo json_encode($item);
    if ($item['image'] != null) {
        $item['image'] = '../assets/frontend_assets/screen_media/' . $item['image'];
    }
    array_push($response['timeline_items'], $item);
}
$filename = BASE_PATH . '/timeline_items.json';
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
