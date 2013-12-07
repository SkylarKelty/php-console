<?php
/**
 * Adds a CLS function
 */

require_once(dirname(dirname(__FILE__)) . "/plugin.php");

class cls extends phpc_plugin
{
	public function onMessage($str = '', $consumed = false) {
		if ($str == "cls") {
			passthru('clear');
			return true;
		}
	}
}
