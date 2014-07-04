<?php

namespace JumpKick\Common\DAO\MySQL;
use JumpKick\Common\DAO\AbstractDAO;

require_once("JumpKick\Common\Autoload.php");


abstract class MySQLDAO extends AbstractDAO {
	
	protected $isContentLoaded;
	protected $id;
	protected $dbh;
	
	public function __construct($id=null) {
		if($id == null) {
			parent::__construct(false);
		} else {
			parent::__construct(true);
			
			$this->id = $id;
			$this->isContentLoaded = false;
		}
		
		$this->dbh = MySQLDatabaseConnection::getActiveConnection();
	}
	
	
	
	protected function create() {
		$query = "INSERT INTO `" . $this->getTableName() . "` (";
		$query .= implode(",", array_map(function($key) { return "`{$key}`";}, array_keys($this->data)));
		$query .=") VALUES (";
		$query .= implode(",", array_map(function() {return "?";}, $this->data)); 
		$query .= ");";
		
		$statement = $this->dbh->prepare($query);
		$statement->execute(array_values($this->data));
		
		print_r($statement->errorInfo());
	}
	
	protected function update() {

	}
	
	protected function onChangeHook() {
		
	}

	protected function fieldNameFor($field) {
		return "field";
	
	}
	
	protected abstract function getTableName();

}

