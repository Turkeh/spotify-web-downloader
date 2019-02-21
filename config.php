<?php

define("BIN", $_SERVER['DOCUMENT_ROOT']."/bin");
define("FILES", $_SERVER['DOCUMENT_ROOT']."/files");
define("FILES_URL", "/files");
define("ASSETS", $_SERVER['DOCUMENT_ROOT']."/assets");
define("ASSETS_URL", "/assets");
define("APPLICATION", $_SERVER['DOCUMENT_ROOT']."/application");
define("APPLICATION_URL", "/application");

function debug($log) {

	file_put_contents($_SERVER['DOCUMENT_ROOT'].'/storage/logs/debug-log.log', "\n\r".
		print_r($log, true)
	, FILE_APPEND);

}