<?php
if($_SERVER['HTTP_HOST'] == 'localhost'){
    define('ADMIN_SITE_URL', 'http://localhost/PHP/sidf/cms');
    define('ADMIN_ASSET', 'http://localhost/PHP/sidf/assets/admin_assets');
    define('ADMIN_VIEW', '/Applications/XAMPP/xamppfiles/htdocs/PHP/sidf/cms/views');
    define('USER_SITE_URL', 'http://localhost/PHP/sidf');
} else {
    define('ADMIN_SITE_URL', 'https://sidf.digitalpoin8.com/cms');
    define('ADMIN_ASSET', 'https://sidf.digitalpoin8.com/assets/admin_assets');
    define('ADMIN_VIEW', 'https://sidf.digitalpoin8.com/cms/views');
    define('USER_SITE_URL', 'https://sidf.digitalpoin8.com');
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

$items_config = array(
    'images_folder' => 'images/'
);
