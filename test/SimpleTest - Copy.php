<?php

namespace JumpKick\Common\DAO;
use JumpKick\Common\DAO\AbstractDAO;
use \PHPUnit_Framework_TestCase as PHPUnit_Framework_TestCase;

class MoneyTest extends PHPUnit_Framework_TestCase {
    public function testCanBeNegated() {
        $var = new TestThing(false);
        
    }

}



class TestThing extends AbstractDAO {

}