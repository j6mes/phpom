<?php

namespace JumpKick\Common\DAO;
require_once("JumpKick/Common/Autoload.php");

interface Repository {
	function all();
	function where($qry,$params);
	function find($id);
	function join($table,$foreign,$idx);
}