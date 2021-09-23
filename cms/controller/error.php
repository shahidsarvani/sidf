<?php

session_start();

require './../config/config.php';

if(isset($_SESSION['error_code']) && $_SESSION['error_code'] == 500) { 
    require './../views/errors/error500.php';
} else {
    require './../views/errors/error404.php';
}


?>