<?php
/**
 * Provides a basic shell, with some added extras
 */

// If there is an auto loader here, include it
if (file_exists("vendor/autoload.php")) {
	echo "Loading autoloader...\n";
	include("vendor/autoload.php");
}

/**
 * Parse some PHP
 */
function parse($str) {
	eval(trim($str));
}

// Start Basic Shell
$in = '';
while ($in != "quit" && $in != "^D") {
	// Read a line
	$in = readline("php> ");

	// Parse and complete iteration
	echo parse($in);
	echo "\n";
}