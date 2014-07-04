<?php

namespace JumpKick\Common\DAO\MySQL;

use PDO;

require_once("JumpKick\Common\Autoload.php");

class MySQLDatabaseConnection {
	private static $con;
	private $dbh;

	private function __construct() { 
		$this->dbh = new PDO("mysql:host=localhost;dbname=ormtest", "root", "", array(
		PDO::ATTR_PERSISTENT => true
	));

	}
	
	public static function getActiveConnection() {
		if(!isset(self::$con)) {
			$con = new MySQLDatabaseConnection();
		}
		
		return $con->dbh;
	}

  
}