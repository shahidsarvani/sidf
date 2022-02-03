<?php

session_start();

require './../../config/config.php';

if (!isset($_SESSION['user_id']) && !$_SESSION['user_id']) {
    header('Location: ' . ADMIN_SITE_URL . '/controller/login.php');
}

require_once(BASE_PATH . '/cms/model/Token.php');
$token = new Token();
$tokens = $token->get_active_tokens();
$response['tokens'] = [];
$i = 1;
if($tokens) {
    foreach ($tokens as $index => $value) {
        $temp = '';
        $logo_media = $token->get_media($value['logo_key']);
        if ($logo_media != false) {
            $logo = $logo_media->fetch_assoc();
        }
        $video_media = $token->get_media($value['video_key']);
        if ($video_media != false) {
            $video = $video_media->fetch_assoc();
        }
        $loader_video_media = $token->get_media($value['loader_video_key']);
        if ($loader_video_media != false) {
            $loader_video = $loader_video_media->fetch_assoc();
        }
        $temp .= '<div class="col-6 order-' . $value['sort_order'] . ' d-flex align-items-center justify-content-center flex-column next_tab logo_' . $i . '" data-slug="' . $value['slug'] . '" data-card_id="' . $value['rfid_card_id'] . '" data-loader_name="' . (isset($loader_video) ? $items_config['rfid_loadermedia_url'] . $loader_video['name'] : "") . '" data-loader_type="' . (isset($loader_video) ? $loader_video['filetype'] : "") . '">
                    <div class="categoriesvideo_wrapper">
                        <video id="vid" class="categories_video_inner" autoplay loop muted>
                            <source src="' . (isset($video) ? $items_config['rfid_media_url'] . $video['name'] : "") . '" type="' . (isset($video) ? $video['filetype'] : "") . '">
                        </video>
                    </div>
                    <div class="video-logo">
                        <img class="" src="' . (isset($logo) ? $items_config['rfid_media_url'] . $logo['name'] : "") . '" alt="logo" />
                    </div>
                </div>';
        array_push($response['tokens'], $temp);
        $i++;
    }
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
