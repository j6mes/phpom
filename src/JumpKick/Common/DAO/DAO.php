<?php

namespace JumpKick\Common\DAO;

interface DAO {
	function isPersisted();
	function isUpdatePending();
}