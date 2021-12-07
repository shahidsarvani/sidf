<?php

session_start();

require './../../config/config.php';

if (!isset($_SESSION['user_id']) && !$_SESSION['user_id']) {
    header('Location: ' . ADMIN_SITE_URL . '/controller/login.php');
}

require_once(BASE_PATH . '/cms/model/Company.php');
require_once(BASE_PATH . '/cms/model/Token.php');
$company = new Company();
$token_obj = new Token();
$companies = $company->get_companies();
$response['companies'] = [];
foreach ($companies as $index => $value) {
    $logo = $company->get_media($value['logo_key']);
    $logo = $logo->fetch_assoc();
    $video = $company->get_media($value['video_key']);
    $video = $video->fetch_assoc();
    $token = $token_obj->get_token($value['company_token_id']);
    // if($logo) {
    //     $value['logo'] = $logo['name'];
    // }
    // if($video) {
    //     $value['video'] = $video['name'];
    // }
    $icon_html = '';
    $icons = $company->get_company_icons($value['company_token_id']);
    if ($icons) {
        foreach ($icons as $icon) {
            $title_ar = $icon["title_ar"];
            $title_eng = $icon["title_eng"];
            $icon_img = $company->get_media($icon["icon"]);
            if($icon_img) {
                $icon_img = $icon_img->fetch_assoc();
            } else {
                $icon_img['name'] = '';
            }
            $icon_html .= '<div class="icon_single_inner d-flex flex-column align-items-center">
                            <img class="icon_img" src="' . $items_config['rfid_media_url'] . $icon_img['name'] . '" alt="logo" />
                            <h2 class="text-uppercase arabic-content">' . $title_ar . '</h2>
                            <h2 class="text-uppercase">' . $title_eng . '</h2>
                        </div>';
        }
    }
    if ($token['rfid_card_id']) {
        $response['companies'][$token['rfid_card_id']] = '<div class="video_wrapper">
                    <video id="vid" class="w-100 video_inner" autoplay loop>
                        <source src="' . $items_config['rfid_media_url'] . $video['name'] . '" type="' . $video['filetype'] . '">
                    </video>
                </div>
                <div class="text_wrapper_outter">
                    <div class="container-fluid h-100">
                        <div class="row h-100">
                            <div class="col-6 h-100 d-flex align-items-center justify-content-center left-column">
                                <div class="images_single_outter w-100">
                                    <div class="images_wrapper_inner d-flex justify-content-center pb-4">
                                        <img src="' . $items_config['rfid_media_url'] . $logo['name'] . '" alt="logo" />
                                    </div>
                                    <div class="icons_outter d-flex justify-content-start flex-wrap mt-5">
                                        ' . $icon_html . '
                                    </div>
                                </div>
                            </div>
                        
                            <div class="col-6 h-100 d-flex align-items-center justify-content-center flex-column right-column">
                                <div class="scroll-bar">
                                    <div class="text_wrapper_op p-4 direction_rtl mb-4 arabic-content">
                                        <h1 class="text-uppercase heading_main">' . $value['name_ar'] . '</h1>
                                        <p>' . $value['info_ar'] . '</p>
                                    </div>
                                    <div class="text_wrapper_op p-4">
                                        <h1 class="text-uppercase heading_main">' . $value['name_eng'] . '</h1>
                                        <p>' . $value['info_eng'] . '</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
    }
}
// echo json_encode($response);
// die();
$filename = BASE_PATH . '/companies.json';
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
