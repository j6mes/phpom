<?php

namespace JumpKick\Common\DAO\MySQL;
require_once("JumpKick\Common\Autoload.php");

	
class SimpleDAO extends MySQLDAO {
	public function test() {
		$this->set("x","y");
		$this->set("a","b");
		$this->commit();
		$this->set("x","z");
		$this->commit();
	}
	
	public function getTableName() {
		return "test";
	}
	
	public function getIdentityColumn() {
		return "id";
	}
	
}

	
