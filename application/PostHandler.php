<?php

require_once('../config.php');

$input = $_REQUEST['download-input'];
$downloadType = $_REQUEST['download-type'];
$downloadLocation = $_REQUEST['download-location'];

$return = array();
if (!empty($input)) {

	// Setup download type
	switch ($downloadType) {
		case 'song':
			$selector = '--song "'.$input.'"';
			break;

		case 'link':
			$selector = '--playlist "'.$input.'"';
			break;			
		
		default:
			break;
	}

	// Run command
	exec('python3 '.BIN.'/spotify/spotdl.py -f "'.FILES.'/'.$downloadLocation.'" '.$selector.' 2>&1', $output, $return_var);

	// // Download if local 
	// if ($downloadLocation == 'Local') {

	// 	$GLOBALS['currentFile'] = FILES_URL.'/'.$downloadLocation;

	// 	exit(APPLICATION_URL."/PostHandler.php");

	// 	header("Location: ".APPLICATION_URL."/PostHandler.php");
	// 	exit();

	// }

	$return['variable'] = $return_var;
	$return['output'] = $output;
}

// Return command for debugging
$return['command'] = 'python3 '.BIN.'/spotify/spotdl.py -f '.FILES.'/'.$downloadLocation.' '.$selector.' 2>&1';

exit(json_encode($return));