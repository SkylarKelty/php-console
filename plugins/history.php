<?php
/**
 * Persistent history extras for php console
 */

require_once("../plugin.php");

public class history extends phpc_plugin
{
	private $_history_file;
	private $_history_fp;

	public function isSupported() {
		return isset($_SERVER['HOME']);
	}

	public function onLoad() {
		$this->_history_file = $_SERVER['HOME'] . "/.phpc_history";

		// Load in existing history file
		if (file_exists($this->_history_file)) {
			$fp = fopen($this->_history_file, "r");
			while (($line = fgets($fp)) !== FALSE) {
				readline_add_history($line);
			}
			fclose($fp);
		} else {
			touch($this->_history_file);
		}
	}

	public function onStart() {
		$this->_history_fp = fopen($this->_history_file, "a");
	}

	public function onMessage($str = '') {
		// Add to history
		readline_add_history($str);
		fwrite($this->_history_fp, $str . "\n");
	}

	public function onEnd() {
		fclose($this->_history_fp);
	}
}
