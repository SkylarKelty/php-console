<?php
/**
 * Provides a basic shell, with some added extras
 */

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
require_once("plugin-manager.php");
$pmgr = phpc_pugin_manager::obtain();
$pmgr->loadAll();

$pmgr->fire("onStart");

// Start Basic Shell
$in = '';
while ($in != "quit" && $in != "^D") {
	// Read a line
	$in = readline("php> ");

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

	// Parse
	echo eval(trim($in));
	echo "\n";
}

$pmgr->fire("onEnd");