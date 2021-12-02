<?php
$mine = 0;
if ($_SERVER['HTTP_HOST'] == 'localhost' && $mine == 1) {
    $con_file_path = __FILE__;
    $con_file_path = str_replace('\cms\config\config.php', '',  $con_file_path);
    $con_file_path = str_replace('/cms/config/config.php', '',  $con_file_path);
    define('BASE_PATH', $con_file_path);
    //\cms\config\config.php

    // define('BASE_PATH', '/Applications/XAMPP/xamppfiles/htdocs/PHP/sidf');
    define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/custom3/sidf');
    define('ADMIN_SITE_URL', BASE_URL . '/cms');
    define('ADMIN_ASSET', BASE_URL . '/assets/admin_assets');
    define('USER_ASSET', BASE_URL . '/assets/frontend_assets');
    define('ADMIN_VIEW', BASE_PATH . '/cms/views');
    define('USER_SITE_URL', BASE_URL);
    $items_config = array(
        'images_url' => USER_ASSET . '/screen_media/',
        'images_path' => BASE_PATH . '/assets/frontend_assets/screen_media/',
        'modal_media_url' => USER_ASSET . '/modal_media/',
        'modal_media_path' => BASE_PATH . '/assets/frontend_assets/modal_media/',
    );
} else if ($_SERVER['HTTP_HOST'] == 'localhost' && $mine == 0) {
    $con_file_path = __FILE__;
    $con_file_path = str_replace('\cms\config\config.php', '',  $con_file_path);
    $con_file_path = str_replace('/cms/config/config.php', '',  $con_file_path);
    define('BASE_PATH', $con_file_path);
    $con_file_url = $_SERVER['HTTP_REFERER'];
    $con_file_url = substr($con_file_url, 0, strpos($con_file_url,'sidf')+4);
    // echo $_SERVER['HTTP_REFERER'].'<br>';
    // echo strpos($con_file_url,'sidf');
    // die();
    define('BASE_URL', $con_file_url);
    define('ADMIN_SITE_URL', BASE_URL . '/cms');
    define('ADMIN_ASSET', BASE_URL . '/assets/admin_assets');
    define('USER_ASSET', BASE_URL . '/assets/frontend_assets');
    define('ADMIN_VIEW', BASE_PATH . '/cms/views');
    define('USER_SITE_URL', BASE_URL);
    $items_config = array(
        'images_url' => USER_ASSET . '/screen_media/',
        'images_path' => BASE_PATH . '/assets/frontend_assets/screen_media/',
        'modal_media_url' => USER_ASSET . '/modal_media/',
        'modal_media_path' => BASE_PATH . '/assets/frontend_assets/modal_media/',
    );
} else {
    define('BASE_PATH', '/var/www/vhosts/digitalpoin8.com//sidf.digitalpoin8.com');
    define('BASE_URL', 'https://sidf.digitalpoin8.com');
    define('ADMIN_SITE_URL', BASE_URL . '/cms');
    define('ADMIN_ASSET', BASE_URL . '/assets/admin_assets');
    define('USER_ASSET', BASE_URL . '/assets/frontend_assets');
    define('ADMIN_VIEW', BASE_PATH . '/cms/views');
    define('USER_SITE_URL', BASE_URL);
    $items_config = array(
        'images_url' => USER_ASSET . '/screen_media/',
        'images_path' => BASE_PATH . '/assets/frontend_assets/screen_media/',
        'modal_media_url' => USER_ASSET . '/modal_media/',
        'modal_media_path' => BASE_PATH . '/assets/frontend_assets/modal_media/',
    );
}

// $email_config = array(
//     'email_address' => 'hamza0952454@gmail.com',
//     'email_name' => 'Hamza Bhatti',
//     'email_password' => '2777a16b9398ac',
//     'email_subject' => 'Password Reset Code',
//     'email_username' => '28f97a1a718e43',
//     'smtp_host' => 'smtp.mailtrap.io',
//     'smtp_port' => '2525',
//     'smtp_encrypt' => 'tls'
// );
