<?php
$mine = 0;
$host = $_SERVER['HTTP_HOST'];
$con_file_path = __FILE__;
$con_file_path = str_replace('\cms\config\config.php', '',  $con_file_path);
$con_file_path = str_replace('/cms/config/config.php', '',  $con_file_path);
define('BASE_PATH', $con_file_path);
if ($host == 'localhost' && $mine == 1) {
    define('BASE_URL', 'http://' . $host . '/sidf');
} else if ($host == 'localhost' && $mine == 0) {
    define('BASE_URL', 'http://' . $host . '/PHP/sidf');
} else if ($host == 'localhost' && $mine == 2) {
    define('BASE_URL', 'http://' . $host . '/sidf');
} else {
    define('BASE_URL', 'https://sidf.digitalpoin8.com');
}
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
    'rfid_media_url' => USER_ASSET . '/rfid_media/',
    'rfid_media_path' => BASE_PATH . '/assets/frontend_assets/rfid_media/',
    'rfid_loadermedia_url' => USER_ASSET . '/rfid_media/loader/',
    'rfid_loadermedia_path' => BASE_PATH . '/assets/frontend_assets/rfid_media/loader/',
);

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


/* start of the file uploading function */
function fileExists($file, $dir)
{
    $i = 1;
    $probeer = $file;
    while (file_exists($dir . $probeer)) {
        $punt = strrpos($file, ".");
        if (substr($file, ($punt - 3), 1) !== ("[") && substr($file, ($punt - 1), 1) !== ("]")) {
            $probeer = substr($file, 0, $punt) . "[" . $i . "]" .
                substr($file, ($punt), strlen($file) - $punt);
        } else {
            $probeer = substr($file, 0, ($punt - 3)) . "[" . $i . "]" .
                substr($file, ($punt), strlen($file) - $punt);
        }
        $i++;
    }
    return $probeer;
}
/* end of the file uploading function */
