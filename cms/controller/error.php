<?php

session_start();

require './../config/config.php';

if($_SESSION['error_code'] == 500) { 
    require './../views/errors/error500.php';
} else if($_SESSION['error_code'] == 404) {
    require './../views/errors/error404.php';
}


?>