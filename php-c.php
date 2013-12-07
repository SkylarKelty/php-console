<?php
/**
 * Provides a basic shell, with some added extras
 */

// If there is an auto loader here, include it
if (file_exists("vendor/autoload.php")) {
	echo "Loading autoloader...\n";
	include("vendor/autoload.php");
}

// Basic Shell
$fp = fopen("php://stdin", "r");
$in = '';
while ($in != "quit") {
	echo "php> ";
	$in = trim(fgets($fp));
	eval ($in);
	echo "\n";
}