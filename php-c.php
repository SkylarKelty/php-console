<?php
/**
 * Provides a basic shell, with some added extras
 */

// If there is an auto loader here, include it
if (file_exists("vendor/autoload.php")) {
	echo "Loading autoloader...\n";
	include("vendor/autoload.php");
}

$history_file = $_SERVER['HOME'] . "/.phpc_history";

// Load in existing history file
if (file_exists($history_file)) {
	$fp = fopen($history_file, "r");
	while (($line = fgets($fp)) !== FALSE) {
		readline_add_history($line);
	}
	fclose($fp);
} else {
	touch($history_file);
}

// Some overrides
$overrides = array(
	"clh" => function() {
		readline_clear_history();
	},
	"cls" => function() {
		passthru('clear');
	},
);

// Start logging
$fp = fopen($history_file, "a");

// Start Basic Shell
$in = '';
while ($in != "quit" && $in != "^D") {
	// Read a line
	$in = readline("php> ");

	// Add to history
	readline_add_history($in);
	fwrite($fp, $in . "\n");

	// Overrides
	if (isset($overrides[$in])) {
		$overrides[$in]();
		continue;
	}

	// Parse
	echo eval(trim($in));
	echo "\n";
}

// Stop logging
fclose($fp);