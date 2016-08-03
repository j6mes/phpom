<?php

namespace JumpKick\Common\DAO\MySQL;
require_once ("JumpKick/Common/Autoload.php");


class SimpleRepository extends MySQLRepository {
	
	protected function initRow($row) {
		
		$dao = new SimpleDAO($row[$this->getIdentityColumn()]);
		unset($row[$this->getIdentityColumn()]);
		$dao->init($row);
		
		return $dao;
	}
	
	public function getTableName() {
		return "test";
	}
	
	public function getIdentityColumn() {
		return "id";
	}
}

$repo = new SimpleRepository();
$row = $repo->find(25);
$row->set("x","z");
$row->commit();
