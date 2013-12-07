<?php
/**
 * PHP Console plugin base
 */

public abstract class phpc_plugin
{
	public abstract function isSupported();
	public abstract function onLoad();
	public abstract function onStart();
	public abstract function onMessage($str = '');
	public abstract function onEnd();
}