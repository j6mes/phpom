<?php

namespace JumpKick\Common\DAO;
use JumpKick\Common\DAO\AbstractDAO;
use \PHPUnit_Framework_TestCase;

class AbstractDAOTest extends PHPUnit_Framework_TestCase {
    public function testInitialPersistedStateFalse() {
        $dao = new TestAbstractDAO(false);
        $this->assertFalse($dao->isPersisted());
    }
	
	public function testInitialPersistedStateTrue() {
        $dao = new TestAbstractDAO(true);
        $this->assertTrue($dao->isPersisted());
    }

	public function testInitialChangeStateFalse() {
        $dao = new TestAbstractDAO(true);
        $this->assertFalse($dao->isUpdatePending());
    }
	
	public function testChangeStateOnSet() {
        $dao = new TestAbstractDAO(true);
		$dao->set("a","b");
        $this->assertTrue($dao->isUpdatePending());
    }
	
	public function testChangeStateOnLoad() {
		$testarr["a"]="b";
        $dao = new TestAbstractDAO(true);
		$dao->load($testarr);
        $this->assertTrue($dao->isUpdatePending());
    }
	
	public function testValidateCalledOnCommit() {
        $dao = new TestAbstractDAO(true);
		$dao->set("a","b");
		$dao->commit();
        $this->assertTrue($dao->wasValidateCalled());
    }
	
	public function testValidateCalledWithNoDataOnCommit() {
        $dao = new TestAbstractDAO(true);
		$dao->commit();
        $this->assertFalse($dao->wasValidateCalled());
    }

	public function testCreateCalledWithInitialStateFalse() {
        $dao = new TestAbstractDAO(false);
		
		$dao->set("a","b");
		$dao->setValidateReturnValue(true);
		
		$dao->commit();
        $this->assertTrue($dao->wasCreateCalled());
    }
	
	public function testCreateErrorCalledWithValidateReturnValse() {
        $dao = new TestAbstractDAO(false);
		
		$dao->set("a","b");
		$dao->setValidateReturnValue(false);
		
		$dao->commit();
        $this->assertTrue($dao->wasErrorHookCalled());
    }
	
	
}



class TestAbstractDAO extends AbstractDAO {
	private $validateCalled = false;
	
	private $createCalled = false;
	private $errorCalled = false;
	
	
	private $validateReturnValue = false;
	
	protected function validate() {
		$this->validateCalled = true;
		return $this->validateReturnValue;
	}
	
	public function setValidateReturnValue($validateReturnValue) {
		$this->validateReturnValue = $validateReturnValue;
	}
	
	public function wasValidateCalled() {
		return $this->validateCalled;
	}
	
	protected function create() {
		$this->createCalled = true;
	}
	
	public function wasCreateCalled() {
		return $this->createCalled;
	}
	
	protected function onErrorHook() {
		$this->errorCalled = true;
	}
	
	public function wasErrorHookCalled() {
		return $this->errorCalled;
	}
	
	
}