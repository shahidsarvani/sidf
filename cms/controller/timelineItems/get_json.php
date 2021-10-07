<?php

session_start();

require './../../config/config.php';

if (!isset($_SESSION['user_id']) && !$_SESSION['user_id']) {
    header('Location: ' . ADMIN_SITE_URL . '/controller/login.php');
}

require_once(BASE_PATH . '/cms/model/Timeline.php');
$timeline_item = new Timeline();
$timeline_items = $timeline_item->get_timeline_items();
$response['timeline_items'] = [];
foreach ($timeline_items as $item) {
    // echo json_encode($item);
    array_push($response['timeline_items'], $item);
}
$filename = BASE_PATH . '/timeline_items.json';
$fp = fopen($filename, 'w');
$written = fwrite($fp, json_encode($response, JSON_PRETTY_PRINT));
$close = fclose($fp);
if($close) {
    $response = [
        'status' => 1
    ];
} else {
    $response = [
        'status' => 0
    ];
}
echo json_encode($response);