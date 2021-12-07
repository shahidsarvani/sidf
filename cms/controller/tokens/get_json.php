<?php

session_start();

require './../../config/config.php';

if (!isset($_SESSION['user_id']) && !$_SESSION['user_id']) {
    header('Location: ' . ADMIN_SITE_URL . '/controller/login.php');
}

require_once(BASE_PATH . '/cms/model/Token.php');
$token = new Token();
$tokens = $token->get_tokens();
$response['tokens'] = [];
foreach ($tokens as $index => $value) {
    $temp = '';
    $logo = $token->get_media($value['logo_key']);
    $logo = $logo->fetch_assoc();
    $video = $token->get_media($value['video_key']);
    $video = $video->fetch_assoc();
    $loader_video = $token->get_media($value['loader_video_key']);
    $loader_video = $loader_video->fetch_assoc();
    // if($logo) {
    //     $value['logo'] = $logo['name'];
    // }
    // if($video) {
    //     $value['video'] = $video['name'];
    // }
    $temp .= '<div class="col-6 d-flex align-items-center justify-content-center flex-column next_tab" data-slug="' . $value['slug'] . '" data-card_id="' . $value['rfid_card_id'] . '" data-loader_name="' . $items_config['rfid_loadermedia_url'] . $loader_video['name'] . '" data-loader_type="' . $loader_video['filetype'] . '">
                <div class="categoriesvideo_wrapper">
                    <video id="vid" class="categories_video_inner" autoplay loop muted>
                        <source src="' . $items_config['rfid_media_url'] . $video['name'] . '" type="' . $video['filetype'] . '">
                    </video>
                </div>
                <div class="video-logo">
                    <img class="" src="' . $items_config['rfid_media_url'] . $logo['name'] . '" alt="logo" />
                </div>
            </div>';
    array_push($response['tokens'], $temp);
}
// echo json_encode($response);
// die();
$filename = BASE_PATH . '/tokens.json';
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
