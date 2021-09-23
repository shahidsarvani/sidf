
<?php

//Database.php

class Database
{
	function connect()
	{
        $database = array(
            'host' => 'localhost',
            'db' => 'sidf',
            'user' => 'root',
            'pass' => ''
        );
        
        $connect = mysqli_connect($database['host'], $database['user'], $database['pass'], $database['db']);

		return $connect;
	}
}

?>
