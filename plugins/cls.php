<?php
/**
 * Adds a CLS function
 */

require_once("../plugin.php");

public class cls extends phpc_plugin
{
	public function onMessage($str = '') {
		if ($str == "cls") {
			passthru('clear');
			return true;
		}
	}
}
