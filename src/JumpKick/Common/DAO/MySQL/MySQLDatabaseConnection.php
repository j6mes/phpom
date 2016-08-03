<?php

namespace JumpKick\Common\DAO\MySQL;

use PDO;
use JumpKick\Common\AppConfig;
require_once("JumpKick/Common/Autoload.php");

class MySQLDatabaseConnection {
	private static $con;
	private $dbh;

	private function __construct() {
		$conf = new AppConfig();
		 
		$this->dbh = new PDO("mysql:host={$conf->getHost()};charset=utf8;dbname={$conf->getDatabase()}", $conf->getUsername(),$conf->getPassword(), array(
			PDO::ATTR_PERSISTENT => false
		));

	}


	public static function getActiveConnection() {
		if(!isset(self::$con)) {
			self::$con = new MySQLDatabaseConnection();
		}
		
		return self::$con->dbh;
	}

  
}