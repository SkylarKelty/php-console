<?php
/**
 * Adds a Help function that prints out arguments for certain php functions
 */

require_once(dirname(dirname(__FILE__)) . "/plugin.php");

class help extends phpc_plugin
{
	private static $_defs = array(
		"addcslashes" => array("\$str", "\$charlist"),
		"addslashes" => array("\$str"),
		"bin2hex" => array("\$str"),
		"chr" => array("\$ascii"),
		"chunk_split" => array("\$body", "\$chunklen", "\$end"),
		"convert_cyr_string" => array("\$str", "\$from", "\$to"),
		"convert_uudecode" => array("\$data"),
		"convert_uuencode" => array("\$data"),
		"count_chars" => array("\$string", "\$mode"),
		"crc32" => array("\$str"),
		"crypt" => array("\$str", "\$salt"),
		"echo" => array("\$arg1", "\$..."),
		"explode" => array("\$delimiter", "\$string", "\$limit"),
		"fprintf" => array("\$handle", "\$format", "\$args", "\$..."),
		"get_html_translation_table" => array("\$table", "\$flags", "\$encoding"),
		"hebrev" => array("\$hebrew_text", "\$max_chars_per_line"),
		"hebrevc" => array("\$hebrew_text", "\$max_chars_per_line"),
		"hex2bin" => array("\$data"),
		"html_entity_decode" => array("\$string", "\$flags", "\$encoding"),
		"htmlentities" => array("\$string", "\$flags", "\$encoding", "\$double_encode"),
		"htmlspecialchars" => array("\$string", "\$flags", "\$encoding", "\$double_encode"),
		"htmlspecialchars_decode" => array("\$string", "\$flags"),
		"implode" => array("\$glue", "\$pieces"),
		"lcfirst" => array("\$str"),
		"levenshtein" => array("\$str1", "\$str2"),
		"localeconv" => array(),
		"ltrim" => array("\$str", "\$charlist"),
		"md5" => array("\$str", "\$raw_output"),
		"md5_file" => array("\$filename", "\$raw_output"),
		"metaphone" => array("\$str", "\$phonemes"),
		"money_format" => array("\$format", "\$number"),
		"nl2br" => array("\$string", "\$is_xhtml"),
		"nl_langinfo" => array("\$item"),
		"number_format" => array("\$number", "\$decimals"),
		"ord" => array("\$string"),
		"parse_str" => array("\$str"),
		"print" => array("\$arg"),
		"printf" => array("\$format", "\$args", "\$..."),
		"quoted_printable_decode" => array("\$str"),
		"quoted_printable_encode" => array("\$str"),
		"quotemeta" => array("\$str"),
		"rtrim" => array("\$str", "\$charlist"),
		"setlocale" => array("\$category", "\$locale", "\$..."),
		"sha1" => array("\$str", "\$raw_output"),
		"sha1_file" => array("\$filename", "\$raw_output"),
		"similar_text" => array("\$first", "\$second"),
		"soundex" => array("\$str"),
		"sprintf" => array("\$format", "\$args", "\$..."),
		"sscanf" => array("\$str", "\$format"),
		"str_getcsv" => array("\$input", "\$delimiter", "\$enclosure", "\$escape"),
		"str_ireplace" => array("\$search", "\$replace", "\$subject"),
		"str_pad" => array("\$input", "\$pad_length", "\$pad_string", "\$pad_type"),
		"str_repeat" => array("\$input", "\$multiplier"),
		"str_replace" => array("\$search", "\$replace", "\$subject"),
		"str_rot13" => array("\$str"),
		"str_shuffle" => array("\$str"),
		"str_split" => array("\$string", "\$split_length"),
		"str_word_count" => array("\$string", "\$format", "\$charlist"),
		"strcasecmp" => array("\$str1", "\$str2"),
		"strcmp" => array("\$str1", "\$str2"),
		"strcoll" => array("\$str1", "\$str2"),
		"strcspn" => array("\$str1", "\$str2", "\$start", "\$length"),
		"strip_tags" => array("\$str", "\$allowable_tags"),
		"stripcslashes" => array("\$str"),
		"stripos" => array("\$haystack", "\$needle", "\$offset"),
		"stripslashes" => array("\$str"),
		"stristr" => array("\$haystack", "\$needle", "\$before_needle"),
		"strlen" => array("\$string"),
		"strnatcasecmp" => array("\$str1", "\$str2"),
		"strnatcmp" => array("\$str1", "\$str2"),
		"strncasecmp" => array("\$str1", "\$str2", "\$len"),
		"strncmp" => array("\$str1", "\$str2", "\$len"),
		"strpbrk" => array("\$haystack", "\$char_list"),
		"strpos" => array("\$haystack", "\$needle", "\$offset"),
		"strrchr" => array("\$haystack", "\$needle"),
		"strrev" => array("\$string"),
		"strripos" => array("\$haystack", "\$needle", "\$offset"),
		"strrpos" => array("\$haystack", "\$needle", "\$offset"),
		"strspn" => array("\$subject", "\$mask", "\$start", "\$length"),
		"strstr" => array("\$haystack", "\$needle", "\$before_needle"),
		"strtok" => array("\$str", "\$token"),
		"strtolower" => array("\$str"),
		"strtoupper" => array("\$string"),
		"strtr" => array("\$str", "\$from", "\$to"),
		"substr" => array("\$string", "\$start", "\$length"),
		"substr_compare" => array("\$main_str", "\$str", "\$offset", "\$length", "\$case_insensitivity"),
		"substr_count" => array("\$haystack", "\$needle", "\$offset", "\$length"),
		"substr_replace" => array("\$string", "\$replacement", "\$start", "\$length"),
		"trim" => array("\$str", "\$charlist"),
		"ucfirst" => array("\$str"),
		"ucwords" => array("\$str"),
		"vfprintf" => array("\$handle", "\$format", "\$args"),
		"vprintf" => array("\$format", "\$args"),
		"vsprintf" => array("\$format", "\$args"),
		"wordwrap" => array("\$str", "\$width", "\$break", "\$cut"),
	);

	public function onMessage($str = '', $consumed = false) {
		if (strpos($str, "help ") === 0) {
			$function = substr($str, 5);
			if (isset(self::$_defs[$function])) {
				echo "Usage: \n";
				$args = self::$_defs[$function];
				echo $function . '(' . join(', ', $args) . ');';
				echo "\n";
				return true;
			}
		}
	}
}
