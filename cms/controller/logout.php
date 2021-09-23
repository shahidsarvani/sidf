<?php

session_start();

require './../config/config.php';

session_unset();

header('Location: ' . ADMIN_SITE_URL . '/controller/login.php');

?>



