<?php

namespace JumpKick\Common\DAO\MySQL;
use JumpKick\Common\DAO\Repository;
use JumpKick\Common\DAO\Identity;
use \PDO;
require_once ("JumpKick\Common\Autoload.php");


abstract class MySQLRepository implements Repository, Identity {
	private $dbh;
	public function __construct($id=null) {
		$this->dbh = MySQLDatabaseConnection::getActiveConnection();
	}
	
	
	
	function all() {
		$query = "SELECT * FROM `{$this->getTableName()}`;";
		$smt = $this->dbh->prepare($query);
		$smt->execute(arary($id));
		
		$result = $smt->fetchAll(PDO::FETCH_ASSOC);
		
		$returnArray = array();
		if(count($result)) {
			foreach($result as $row) {
				$returnArray[] = $this->initRow($row);	
			}	
		}
		
		return $returnArray;
	}
	
	function where($qry) {
		$query = "SELECT * FROM `{$this->getTableName()}` WHERE {$qry};";
		$smt = $this->dbh->prepare($query);
		$smt->execute(arary($id));
		
		$result = $smt->fetchAll(PDO::FETCH_ASSOC);
	
		$returnArray = array();
		if(count($result)) {
			foreach($result as $row) {
				$returnArray[] = $this->initRow($row);	
			}	
		}
		
		return $returnArray;
	}
	
	function find($id) {
		$query = "SELECT * FROM `{$this->getTableName()}` WHERE `{$this->getIdentityColumn()}` = ?;";
		$smt = $this->dbh->prepare($query);
		$smt->execute(array($id));
		
		$result = $smt->fetch(PDO::FETCH_ASSOC);
		$returnResult = $this->initRow($result);	
		
		return $returnResult;
	}

	protected abstract function initRow($row);
}

