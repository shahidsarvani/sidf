<?php
$file_key = $_POST['key'];
require './../../config/config.php';
require BASE_PATH . '/cms/model/Media.php';

$targetDir = $items_config['section_tabbgvid_media_path'];

$media = new Media();
$media_details = $media->get_media_by_file_key($file_key);
$res = $media->delete_media($media_details['id']);
if($res == true) {
    $file = $targetDir.$media_details['name'];
    @unlink("{$file}");
    $response['status'] = true;
} else {
    $response['status'] = false;
    $response['message'] = $res;
}
echo json_encode($response);

?>