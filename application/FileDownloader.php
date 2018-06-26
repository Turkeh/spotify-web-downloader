<?php

require_once('../config.php');



$currentFile = $GLOBALS['currentFile'];

$finfo = finfo_open(FILEINFO_MIME_TYPE);
header('Content-Type: '.finfo_file($finfo, $currentFile));

$finfo = finfo_open(FILEINFO_MIME_ENCODING);
header('Content-Transfer-Encoding: '.finfo_file($finfo, $currentFile)); 

header('Content-disposition: attachment; filename="'.basename($currentFile).'"'); 
readfile($currentFile);

$GLOBALS['currentFile'] = '';
unset($GLOBALS['currentFile']);