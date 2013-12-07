<?php
/**
 * Provides a basic shell, with some added extras
 */

// Basic Shell
$fp = fopen("php://stdin", "r");
$in = '';
while ($in != "quit") {
	echo "php> ";
	$in = trim(fgets($fp));
	eval ($in);
	echo "\n";
}