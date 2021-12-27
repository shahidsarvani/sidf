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
    if ($item_media) {
        foreach ($item_media as $value) {
            if ($value['media_id'] != '' && $value['media_id'] != 0) {
                $media = $modal->get_media($value['media_id']);
                $loop = $item_media->num_rows < 2 ? 'loop' : '';
                // echo json_encode($media);
                if ($media != false) {
                    $media = $media->fetch_assoc();
                    if ($media['type'] == 'video') {
                        array_push($medias, '<div class="item">
                                                <video class="new_inner_img" autoplay controls onplay="pauseModalSlider(\'#modal' . $i . '\');" onended="playModalSlider(\'#modal' . $i . '\');" ' . $loop . '>
                                                    <source src="' . $items_config["modal_media_url"] . $media["name"] . '" type="' . $media["filetype"] . '">
                                                </video>
                                                <div class="box_content_innerrr english active">
                                                    <h3>' . $value["title_eng"] . '</h3>
                                                    <p>' . $value["text_eng"] . '</p>
                                                </div>
                                                <div class="box_content_innerrr arabic">
                                                    <h3>' . $value["title_ar"] . '</h3>
                                                    <p>' . $value["text_ar"] . '</p>
                                                </div>
                                            </div>');
                    } else {
                        array_push($medias, '<div class="item">
                                                <img src="' . $items_config["modal_media_url"] . $media["name"] . '" alt="" class="new_inner_img">
                                                <div class="box_content_innerrr english active">
                                                    <h3>' . $value["title_eng"] . '</h3>
                                                    <p>' . $value["text_eng"] . '</p>
                                                </div>
                                                <div class="box_content_innerrr arabic">
                                                    <h3>' . $value["title_ar"] . '</h3>
                                                    <p>' . $value["text_ar"] . '</p>
                                                </div>
                                            </div>');
                    }
                } else {
                    array_push($medias, '<div class="item">
                                            <video class="new_inner_img" autoplay controls onplay="pauseModalSlider(\'#modal' . $i . '\');" onended="playModalSlider(\'#modal' . $i . '\');" ' . $loop . '>
                                                <source src="#" type="#">
                                            </video>
                                            <div class="box_content_innerrr english active">
                                                <h3>' . $value["title_eng"] . '</h3>
                                                <p>' . $value["text_eng"] . '</p>
                                            </div>
                                            <div class="box_content_innerrr arabic">
                                                <h3>' . $value["title_ar"] . '</h3>
                                                <p>' . $value["text_ar"] . '</p>
                                            </div>
                                        </div>');
                }
            }
        }
    }
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
