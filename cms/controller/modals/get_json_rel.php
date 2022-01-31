<?php

session_start();

require './../../config/config.php';

if (!isset($_SESSION['user_id']) && !$_SESSION['user_id']) {
    header('Location: ' . ADMIN_SITE_URL . '/controller/login.php');
}

require_once(BASE_PATH . '/cms/model/Modal.php');
$modal = new Modal();
$modals = $modal->get_modals();
foreach ($modals as $index => $item) {
    $modal_items = $modal->get_modal_items($item['id']);
    $data = array();
    // $loop = $modal_items->num_rows < 2 ? 'loop' : '';
    $loop = 'loop';
    if ($modal_items) {
        foreach ($modal_items as $value) {
            $temp_data = [
                'title_eng' => $value["title_eng"],
                'text_eng' => html_entity_decode($value["text_eng"]),
                'title_ar' => $value["title_ar"],
                'text_ar' => html_entity_decode($value["text_ar"]),
                'active_en' => $value["title_ar"] == '' && $value["text_ar"] == '' ? 'active' : '',
                'active_ar' => $value["title_ar"] != '' || $value["text_ar"] != '' ? 'active' : '',
                // 'iframe_link' => html_entity_decode($value["media_id"]),
            ];
            if ($value['media_id'] != '' && $value['media_id'] != 0) {
                $media = $modal->get_media($value['media_id']);
                // echo json_encode($media);
                if ($media != false) {
                    $media = $media->fetch_assoc();
                    // if ($media['type'] == 'video') {
                        $temp_data['src'] = '../assets/frontend_assets/modal_media/' . $media["name"];
                        $temp_data['type'] = $media["type"];
                        $temp_data['filetype'] = $media["filetype"];
                    // } else {
                    //     $temp_data['src'] = $items_config["modal_media_url"] . $media["name"];
                    //     $temp_data['type'] = $media["type"];
                    // }
                } else {
                    $temp_data['src'] = '';
                    $temp_data['type'] = '';
                    $temp_data['filetype'] = '';
                }
            } else {
                $temp_data['src'] = '';
                $temp_data['type'] = '';
                $temp_data['filetype'] = '';
            }
            array_push($data, $temp_data);    
        }
    }
    $modal_index = str_replace('-', '', $item['slug']);
    $modal_data = [
        'loop' => $loop,
        'modal_data' => $data
    ];
    $response[$modal_index] = $modal_data;
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
