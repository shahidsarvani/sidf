<?php
$file_key = $_POST['key'];
require './../../config/config.php';
require BASE_PATH . '/cms/model/Media.php';

$targetDir = $items_config['rfid_media_path'];

$media = new Media();
$media_details = $media->get_media_by_file_key($file_key);
if($media_details != false) {
    $res = $media->delete_media($media_details['id']);
    if($res == true) {
        $file = $targetDir.$media_details['name'];
        @unlink("{$file}");
        $response['status'] = true;
    } else {
        $response['status'] = false;
        $response['message'] = $res;
    }
} else {
    $response['status'] = true;
}
echo json_encode($response);
