<?php

spl_autoload_register('__autoload');


function __autoload($class) {
	$class = str_replace('\\', '/', $class) . '.php';
	@require_once($class);
}

