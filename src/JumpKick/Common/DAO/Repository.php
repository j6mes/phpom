<?php

namespace JumpKick\Common\DAO;
require_once("JumpKick\Common\Autoload.php");

interface Repository {
	function all();
	function where($qry);
	function find($id);
	
	function add($object);
}