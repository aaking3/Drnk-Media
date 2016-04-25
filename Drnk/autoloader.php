<?php
	spl_autoload_register('autoloader');

	function autoloader($className) {
		include_once($className . '.php');
	}
?>