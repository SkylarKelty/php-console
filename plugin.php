<?php
/**
 * PHP Console plugin base
 */

require_once("plugin-manager.php");

public abstract class phpc_plugin
{
	public function isSupported() {
		return true;
	}

	public function onLoad() {	}
	public function onStart() { }
	public function onMessage($str = '') { };
	public function onEnd() { }

	public final function getManager() {
		return phpc_pugin_manager::obtain();
	}
}