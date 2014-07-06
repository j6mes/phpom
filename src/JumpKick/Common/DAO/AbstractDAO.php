<?php
namespace JumpKick\Common\DAO;
require_once("JumpKick\Common\Autoload.php");

abstract class AbstractDAO implements DAO {
	private $isPersisted = false;
	private $isUpdatePending = false;

	protected $data;
	
	public function __construct($isPersisted) {
		$this->isPersisted = $isPersisted;
	}
	
	public function isPersisted() {
		return $this->isPersisted;
	}
	
	public function isUpdatePending() {
		return $this->isUpdatePending;
	}
	
	public function set($field,$value) {
		$this->data[$field] = $value;
		$this->setChanged();
	}
	
	public function get($field) {
		return $this->data[$field];
	}
	
	
	
	public function load($data) {
		if(is_array($data)) {
			foreach($data as $key=>$value) {
				$this->data[$key] = $value;
			}
		}
		$this->setChanged();
	}
	
	
	protected function setChanged() {
		$this->isUpdatePending = true; 
		$this->onChangeHook();
	}
	
	public function commit() {
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