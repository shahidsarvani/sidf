<?php
echo json_encode($_SERVER);
die();
// define('ADMIN_SITE_URL', 'http://localhost/PHP/sidf/cms');
// define('USER_SITE_URL', 'http://localhost/PHP/sidf');
define('ADMIN_SITE_URL', 'https://sidf.digitalpoin8.com/cms');
define('USER_SITE_URL', 'https://sidf.digitalpoin8.com');

$email_config = array(
    'email_address' => 'hamza0952454@gmail.com',
    'email_name' => 'Hamza Bhatti',
    'email_password' => '2777a16b9398ac',
    'email_subject' => 'Password Reset Code',
    'email_username' => '28f97a1a718e43',
    'smtp_host' => 'smtp.mailtrap.io',
    'smtp_port' => '2525',
    'smtp_encrypt' => 'tls'
);

$items_config = array(
    'images_folder' => 'images/'
);
