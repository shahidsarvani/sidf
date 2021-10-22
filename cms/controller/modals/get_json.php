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
foreach ($modals as $index => $item) {
    $item_media = $modal->get_modal_items($item['id']);
    $medias = array();
    $i = ++$index;
    foreach ($item_media as $media) {
        // $medias[] = [
        //     'modal_id' => $media['modal_id'],
        //     'title_eng' => $media['title_eng'],
        //     'title_ar' => $media['title_ar'],
        //     'text_eng' => $media['text_eng'],
        //     'text_ar' => $media['text_ar'],
        // 'media' => $items_config['modal_media_url'].$media['media'],
        // ];
        if($media['type'] == 'video'){
            array_push($medias, '<div class="item">
                                    <video class="new_inner_img" muted controls onplay="pauseModalSlider(\'#modal'.$i.'\');" onended="playModalSlider(\'#modal'.$i.'\');">
                                        <source src="'.$items_config["modal_media_url"] . $media["media"].'" type="'.$media["filetype"].'">
                                    </video>
                                    <div class="box_content_innerrr english active">
                                        <h3>' . $media["title_eng"] . '</h3>
                                        <p>' . $media["text_eng"] . '</p>
                                    </div>
                                    <div class="box_content_innerrr arabic">
                                        <h3>' . $media["title_ar"] . '</h3>
                                        <p>' . $media["text_ar"] . '</p>
                                    </div>
                                </div>');
        } else {
            array_push($medias, '<div class="item">
                                    <img src="' . $items_config["modal_media_url"].$media["media"] . '" alt="" class="new_inner_img">
                                    <div class="box_content_innerrr english active">
                                        <h3>' . $media["title_eng"] . '</h3>
                                        <p>' . $media["text_eng"] . '</p>
                                    </div>
                                    <div class="box_content_innerrr arabic">
                                        <h3>' . $media["title_ar"] . '</h3>
                                        <p>' . $media["text_ar"] . '</p>
                                    </div>
                                </div>');
        }
    }
    // $temp['modal_name'] = $item['name'];
    // $temp['modal_slug'] = $item['slug'];
    // $temp['timeline_item_id'] = $item['timeline_item_id'];
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
