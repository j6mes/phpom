<?php

namespace JumpKick\Common\DAO\MySQL;
use JumpKick\Common\DAO\AbstractDAO;
use JumpKick\Common\DAO\Identity;

require_once ("JumpKick\Common\Autoload.php");

abstract class MySQLDAO extends AbstractDAO implements Identity {

	protected $isContentLoaded;
	protected $id;
	protected $dbh;

	public function __construct($id = null) {
	
		if ($id == null) {
			parent::__construct(false);
		} else {
			parent::__construct(true);

			$this -> id = $id;
			$this -> isContentLoaded = false;
		}

		$this -> dbh = MySQLDatabaseConnection::getActiveConnection();
	}

	protected function create() {
		$query = "INSERT INTO `" . $this -> getTableName() . "` (";
		$query .= implode(",", array_map(function($key) {
			return "`{$key}`";
		}, array_keys($this -> data)));
		$query .= ") VALUES (";
		$query .= implode(",", array_map(function() {
			return "?";
		}, $this -> data));
		$query .= ");";

		$statement = $this -> dbh -> prepare($query);
		$statement -> execute(array_values($this -> data));

		$this->id = $this -> dbh -> lastInsertId();

	}

	protected function update() {
		$query = "UPDATE `" . $this -> getTableName() . "` SET";
		$query .= implode(",", array_map(function($key) {
			return "`{$key}`=?";
		}, array_keys($this -> data)));
		$query .= "WHERE `{$this->getIdentityColumn()}` = ? LIMIT 1;";

		$statement = $this -> dbh -> prepare($query);
	
		$vals = array_merge(array_values($this -> data), array($this -> id));

		$statement -> execute($vals);
	}

	protected function delete() {
		$query = "DELETE FROM `" . $this -> getTableName() . "` WHERE `" . $this -> getIdentityColumn() . "` = ? LIMIT 1;";
		$statement = $this -> dbh -> prepare($query);

		$vals = array($this -> id);
		$statement -> execute($vals);
	}

	protected function onChangeHook() {

	}


}
