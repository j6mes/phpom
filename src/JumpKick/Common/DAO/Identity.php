<?php

namespace JumpKick\Common\DAO;
require_once("JumpKick/Common/Autoload.php");

interface Identity {
	function getTableName();
	function getIdentityColumn();
}