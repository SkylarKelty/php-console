<?php
/**
 * PHP Console plugin base
 */

require_once(dirname(__FILE__) . "/plugin-manager.php");

abstract class phpc_plugin
{
	public function isSupported() {
		return true;
	}

	public function onLoad() {	}
	public function onStart() { }
	public function onMessage($str = '', $consumed = false) { }
	public function onEnd() { }

	public final function getManager() {
		return phpc_pugin_manager::obtain();
	}
}