<?php

/**
 * Handles downloads
 */
class Structure
{
	
	function __construct() {
		// Get download directory list
	}

	public function getDownloadLocations() {

		$directories = scandir(FILES);

		foreach ($directories as $key => $dir) {
			if (strpos($dir, '.') === 0)
				unset($directories[$key]);
		}

		return $directories;

	}

	public function getFile() {

	}
}