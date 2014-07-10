<?php

namespace JumpKick\Common\DAO\MySQL

abstract class MySQLRepository implements Repository, Identity {
	private $dbh;
	public function __construct($id=null) {
		$this->dbh = MySQLDatabaseConnection::getActiveConnection();
	}
	
	
	
	function all() {
		$query = "SELECT * FROM `{$this->getTableName()}`;";
	}
	
	function where($qry) {
		$query = "SELECT * FROM `{$this->getTableName()}` WHERE {$qry};";
	}
	
	function find($id) {
		
	}
	
	function add($object) {
		
	}
}
