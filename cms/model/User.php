<?php


class User {

	public $connect;

	public function __construct()
	{
		require_once('./../../config/database.php');

		$database_object = new Database;

		$this->connect = $database_object->connect();
	}

}
?>