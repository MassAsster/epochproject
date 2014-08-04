<?php
/**
 * APPLICATION BOOTSTRAP
 *
 * This files is required throughout the application in order to
 * work correctly. Please do not change any of the contents in
 * this file as it may break the application.
 *
 */

// Check the version of php
if ( phpversion() < 5.3 ) {
	die(' This application requires php version 5.3.x - Check documentation for more info ');
}

/**
 * APPLICATION DEFINES
 */
define('ROOT', str_replace('\\', '/', dirname(__FILE__)) . '/');
$path1 = explode('/', str_replace('\\', '/', dirname($_SERVER['SCRIPT_FILENAME'])));
$path2 = explode('/', substr(ROOT, 0, -1));
$path3 = explode('/', str_replace('\\', '/', dirname($_SERVER['PHP_SELF'])));
for ($i = count($path2); $i < count($path1); $i++) array_pop($path3);
$url = $_SERVER['HTTP_HOST'] . implode('/', $path3);
($url{strlen($url) -1} == '/') ? define('URL', 'http://' . $url) : define('URL', 'http://' . $url . '/');

/**
 * FILE INCLUDES
 */
require_once ROOT . 'inc/config.php';
require_once ROOT . 'inc/pbkdf2.php';
require_once ROOT . 'lib/core.php';
require_once ROOT . 'lib/email.php';
require_once ROOT . 'lib/flash.php';
require_once ROOT . 'inc/functions.php';

// Required for logout
(isset($_GET['logout']))?core::logout():false;