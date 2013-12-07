<?php
/**
 * PHP Console plugin base
 */

public abstract class phpc_plugin
{
	public function isSupported() {
		return true;
	}

	public function onLoad() {	}
	public function onStart() { }
	public function onMessage($str = '') { };
	public function onEnd() { }
}