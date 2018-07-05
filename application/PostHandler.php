<?php

require_once('../config.php');

$input = $_REQUEST['download-input'];
$downloadType = $_REQUEST['download-type'];
$downloadLocation = $_REQUEST['download-location'];
$localDownload = empty($_REQUEST['download-locally']) ? false : true;

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
	exec('python3 '.BIN.'/spotify/spotdl.py -f "'.FILES.'/'.$downloadLocation.'" '.$selector.' 2>&1', $output, $status);

	// Download if local 
	if ($localDownload) {

		$strOutput = implode('|', $output);
		preg_match("/(info:\ converting)([^\/]+$)/im", $strOutput, $matches);

		$filename = $matches[2];
		preg_match("/^(.*?)\.m4a/", $filename, $trueName);

		$filename = trim($trueName[1]);
		if (!empty($matches)) { 

			$return['filepath'] = '/files/'.rawurlencode($downloadLocation).'/'.rawurlencode($filename).'.mp3';
		}

	}

	$statusMap = array(
		0 => 'Success',
		1 => 'Unknown error',
		2 => 'Command line error (e.g. invalid args)',
		3 => 'KeyboardInterrupt',
		10 => 'Invalid playlist URL',
		11 => 'Playlist not found'
	);

	$return['status'] = $statusMap[$status];
	$return['output'] = $output;
}

// Return command for debugging
// $return['command'] = 'python3 '.BIN.'/spotify/spotdl.py -f '.FILES.'/'.$downloadLocation.' '.$selector.' 2>&1';

exit(json_encode($return));