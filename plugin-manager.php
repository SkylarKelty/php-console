<?php
/**
 * PHP Console plugin manager
 */

public class phpc_pugin_manager
{
	private $_plugins;

	private function __construct() {
		$this->_plugins = array();
	}

	/**
	 * Singleton..
	 */
	public static function obtain() {
		static $manager;
		if (!isset($manager)) {
			$manager = new phpc_pugin_manager();
		}
		return $manager;
	}

	/**
	 * Is this plugin loaded?
	 */
	public function isLoaded($plugin) {
		return isset($this->_plugins[$plugin]);
	}

	/**
	 * Load a plugin
	 */
	public function load($plugin) {
		require_once("plugins/$plugin.php");
		$p = new $plugin();
		if ($p->isSupported()) {
			$this->_plugins[$plugin] = $p;
		}
	}

	/**
	 * Load all plugins
	 */
	public function loadAll() {
		$plugins = scandir("plugins/");
		foreach ($plugins as $plugin) {
			if ($plugin == '.' || $plugin == '..') {
				continue;
			}

			$this->load($plugin);
		}
	}
}