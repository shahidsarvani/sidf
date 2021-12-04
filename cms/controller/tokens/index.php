<?php 

session_start();

require './../../config/config.php';

if(!isset($_SESSION['user_id']) && !$_SESSION['user_id']) {
    header('Location: ' . ADMIN_SITE_URL . '/controller/login.php');
}

require_once(BASE_PATH . '/cms/model/Token.php');
$token = new Token();
$tokens = $token->get_tokens();
$all_tokens = array();
if($tokens !== false) {
    foreach ($tokens as $item) {
        array_push($all_tokens, $item);
    } 
}

for($i = 0; $i < count($all_tokens); $i++){
    $logo = $token->get_media($all_tokens[$i]['logo_key']);
    $logo = $logo->fetch_assoc();
    if($logo) {
        $all_tokens[$i]['logo'] = $logo['name'];
    }
    $video = $token->get_media($all_tokens[$i]['video_key']);
    $video = $video->fetch_assoc();
    if($video) {
        $all_tokens[$i]['video'] = $video['name'];
    }
}
// echo json_encode($all_tokens);
// die();

$title = 'Tokens - SIDF';

require BASE_PATH . '/cms/views/layout/scripts.php';
require BASE_PATH . '/cms/views/layout/navbar.php';
require BASE_PATH . '/cms/views/layout/sidebar.php';
require BASE_PATH . '/cms/views/tokens/index.php';
