<?php

session_start();

require './../config/config.php';


// if(isset($_SESSION['user_id']) && $_SESSION['user_id']) {

// }

session_unset();

require './../views/login.php';

?>



