<?php
/**
 * Adds an ls function
 */

require_once(dirname(dirname(__FILE__)) . "/plugin.php");

class ls extends phpc_plugin
{
	public function onMessage($str = '', $consumed = false) {
		if ($str == "ls") {
			passthru('ls -al');
			return true;
		}

		if (substr($str, 0, 2) == "ls") {
			passthru($str);
			return true;
		}
	}
}
