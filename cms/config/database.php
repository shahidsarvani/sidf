
<?php

//Database.php

class Database
{
    function connect()
    {
        if ($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == 'shahids-macbook-pro.local') {
            $database = array(
                'host' => 'localhost',
                'db' => 'sidf',
                'user' => 'root',
                'pass' => ''
            );
        } else {
            $database = array(
                'host' => 'localhost',
                'db' => 'sidf',
                'user' => 'admin_sidf',
                'pass' => '4wf4Y?n7'
            );
        }

        $connect = mysqli_connect($database['host'], $database['user'], $database['pass'], $database['db']);

        return $connect;
    }
}

?>
