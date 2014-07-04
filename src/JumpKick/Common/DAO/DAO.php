<?php

namespace JumpKick\Common\DAO;

interface DAO {
	function isPersisted();
	function isUpdatePending();
	
	function set($field,$value);
	function get($field);
	
	function load($data);
	
}