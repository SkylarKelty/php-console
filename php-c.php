<?php
/**
 * Provides a basic shell, with some added extras
 */

// If there is an auto loader here, include it
if (file_exists("vendor/autoload.php")) {
	echo "Loading autoloader...\n";
	include("vendor/autoload.php");
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

// Start Basic Shell
$in = '';
while ($in != "quit" && $in != "^D") {
	// Read a line
	$in = readline("php> ");


	// Overrides
	if (isset($overrides[$in])) {
		$overrides[$in]();
		continue;
	}

	// Parse
	echo eval(trim($in));
	echo "\n";
}