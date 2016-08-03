<?php

namespace JumpKick\Common\DAO\MySQL;

class MySQLJoinDescription {
	private $fromcol;
	private $totable;
	private $tocol;
	
	function __construct($fromcol, $totable, $tocol) {
		$this->fromcol = $fromcol;
		$this->totable = $totable;
		$this->tocol = $tocol;
		
	}
	
	function getFromCol() {
		return $this->fromcol;
	}
	
	function getToTable() {
		return $this->totable;
	}
	
	function getToCol() {
		return $this->tocol;
	}
}
