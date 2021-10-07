<?php
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    define('BASE_PATH', '/Applications/XAMPP/xamppfiles/htdocs/PHP/sidf');
    define('BASE_URL', 'http://localhost/PHP/sidf');
    define('ADMIN_SITE_URL', BASE_URL . '/cms');
    define('ADMIN_ASSET', BASE_URL . '/assets/admin_assets');
    define('USER_ASSET', BASE_URL . '/assets/frontend_assets');
    define('ADMIN_VIEW', BASE_PATH . '/cms/views');
    define('USER_SITE_URL', BASE_URL);
    $items_config = array(
        'images_url' => USER_ASSET . '/images/',
        'images_path' => BASE_PATH . '/assets/frontend_assets/images/'
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
        'images_url' => USER_ASSET . '/images/',
        'images_path' => BASE_PATH . '/assets/frontend_assets/images/'
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
