<?php



$database = array(
    'host' => 'localhost',
    'db' => 'sidf',
    'user' => 'root',
    'pass' => ''
);

$connection = mysqli_connect($database['host'], $database['user'], $database['pass'], $database['db']);

if (!$connection) {
    header('Location: ' . ADMIN_SITE_URL . '/controller/error.php');
}
