<?php
/**
 * Provides a basic shell, with some added extras
 */

require_once(dirname(__FILE__) . "/plugin-manager.php");

// Parse arguments
if (isset($_SERVER['argv'])) {
	foreach ($_SERVER['argv'] as $arg) {
		if ($arg == "-v") {
			define("VERBOSE", true);
		}
	}
}

// Defaults
defined("VERBOSE") or define("VERBOSE", false);

// If there is an auto loader here, include it
if (file_exists("vendor/autoload.php")) {
	if (VERBOSE) {
		echo "Loading autoloader...\n";
	}
	include("vendor/autoload.php");
}

// Load up the plugin manager
$pmgr = phpc_pugin_manager::obtain();
$pmgr->loadAll();

$pmgr->fire("onStart");

// Start Shell
$prompt = "php > ";
$buffer = '';
$braceCount = 0;
while (true) {
	// Read a line
	$in = readline($prompt);
	$in = trim($in);

	if ($in == "quit" || $in == "exit") {
		break;
	}

	// Let plugins intervene if we have an empty buffer
	if (empty($buffer)) {
		// Fire message event on plugins
		$consumed = false;
		foreach ($pmgr->getPlugins() as $plugin) {
			if ($plugin->onMessage($in, $consumed) === true) {
				$consumed = true;
			}
		}

		// Allow plugins to consume messages
		if ($consumed) {
			continue;
		}
	}

	$buffer .= $in;

	$lastChar = substr($in, -1);

	// Have we finished building something?
	if ($braceCount > 0 && $lastChar == '}') {
		$braceCount--;
		if ($braceCount == 0) {
			$prompt = "php > ";
		}
	}

	// Are we building something?
	if ($lastChar == '{') {
		$prompt = "php { ";
		$braceCount++;
	}

	// Are we ready to eval?
	if (($lastChar == ';' || $lastChar == '}') && $braceCount == 0) {
		// Eval
		echo eval($buffer);
		echo "\n";

		$buffer = '';
		continue;
	}
}

$pmgr->fire("onEnd");