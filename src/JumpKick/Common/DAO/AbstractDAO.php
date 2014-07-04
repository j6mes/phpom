<?php
namespace JumpKick\Common\DAO;
require_once("JumpKick\Common\Autoload.php");

abstract class AbstractDAO implements DAO {
	private $isPersisted = false;
	private $isUpdatePending = false;

	
	public function __construct($isPersisted) {
		$this->isPersisted = $isPersisted;
	}
	
	public function isPersisted() {
		return $this->isPersisted;
	}
	
	public function isUpdatePending() {
		return $this->isUpdatePending;
	}
	
	protected function setChanged() {
		$this->isUpdatePending = true; 
		$this->onChangeHook();
	}
	
	protected function commit() {
	
		if(!$this->isUpdatePending()) {
			return;
		}
		
		//Validate object before creating/updating
		if($this->validate()) {
			//If object exists, then update it else create it
			if($this->isPersisted()) {
				$this->update();
			} else {
				$this->create();
			}
		
			$this->onCommitHook();
		} else {
			$this->onErrorHook();
		}
	}
	
	
	protected function validate() { 
		//Always return true unless overridden
		return true;
	}
	
	protected function onChangeHook() { 
		//Do nothing here
	}
	
	protected function onErrorHook() { 
		//Do nothing here
	}
	
	protected function onCommitHook() { 
		//Do nothing here
	}
	
	protected function create() {
		//Do nothing here
	}
	
	protected function update() {
		//Do nothing here
	}
}