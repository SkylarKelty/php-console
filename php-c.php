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
	"cls" => function() {
		readline_clear_history();
	}
);

// Start Basic Shell
$in = '';
while ($in != "quit" && $in != "^D") {
	// Read a line
	$in = readline("php> ");

	// Add to history
	readline_add_history($in);

	// Overrides
	if (isset($overrides[$in])) {
		$overrides[$in]();
		continue;
	}

	// Parse
	echo eval(trim($in));
	echo "\n";
}