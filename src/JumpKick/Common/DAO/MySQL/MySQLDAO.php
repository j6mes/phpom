<?php

namespace JumpKick\Common\DAO\MySQL;
use JumpKick\Common\DAO\AbstractDAO;

require_once("JumpKick\Common\Autoload.php");



class MySQLDAO extends AbstractDAO {
	
	protected $isContentLoaded;
	protected $id; 
	
	public function __construct($id) {
		parent::__construct($true);
		
		$this->id = $id;
		$this->isContentLoaded = false;
	}
	
	protected function create() {
		
	}
	
	protected function update() {
		
	}
	
	protected function onChangeHook() {
		
	}
	
	protected void 
	
	public function test() {
		$this->setChanged();
		$this->commit();
	}
}

$a  = new MySQLDAO(false);
$a->test();