<?php
/**
 * PHP Console plugin manager
 */

class phpc_pugin_manager
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
		$plugin = str_replace(".php", "", $plugin);
		require_once("plugins/$plugin.php");
		$p = new $plugin();
		if ($p->isSupported()) {
			$this->_plugins[$plugin] = $p;
			$p->onLoad();
			
			if (VERBOSE) {
				echo "Loaded plugin: $plugin...\n";
			}
		}
	}

	/**
	 * Load all plugins
	 */
	public function loadAll() {
		$plugins = scandir(dirname(__FILE__) . "/plugins/");
		foreach ($plugins as $plugin) {
			if ($plugin == '.' || $plugin == '..') {
				continue;
			}

			$this->load($plugin);
		}
	}

	/**
	 * Returns all plugins
	 */
	public function getPlugins() {
		return $this->_plugins;
	}

	/**
	 * Fire an event
	 */
	public function fire($event) {
		foreach ($this->_plugins as $plugin) {
			$plugin->$event();
		}
	}
}