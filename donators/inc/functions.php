<?php
/**
 * Functions
 *
 * Can be used to handle most of the tasks for this system.
 * This file was actually included to make locking down the
 * application easier. Please don't modify this file
 * as it may break the application.
 *
 */

/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * @param boole $img True to return a complete IMG tag False for just the URL
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 * @source http://gravatar.com/site/implement/images/php/
 */
function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
	$url = 'http://www.gravatar.com/avatar/';
	$url .= md5( strtolower( trim( $email ) ) );
	$url .= "?s=$s&d=$d&r=$r";
	if ( $img ) {
		$url = '<img src="' . $url . '"';
		foreach ( $atts as $key => $val )
			$url .= ' ' . $key . '="' . $val . '"';
		$url .= ' />';
	}
	return $url;
}

function dd($data) {
	echo '<pre>';
	var_dump($data);
	die('</pre>');
}

/**
 * Replaces the placeholders in the users custom
 * error or success messages.
 */
function _rd($key, $with, $define) {
	return preg_replace("/{{{$key}}}/", $with, $define);
}

/**
 * Validates CSRF attacks, Snake attacks!
 * @return [bool] True on success.
 */
function _csrf() {
	if ( (isset($_POST['csrf_field']) &&
	    $_POST['csrf_field'] === $_SESSION['CSRF_TOKEN']) ) {
		return true; // Yes dear!
	} else return false; // You snake!
}

/**
 * Sends a JSON message and then kills the scipt.
 */
function die_message($true_or_false, $msg) {
	die(json_encode(array(
		'error' => $true_or_false,
		'message' => $msg
	)));
}

/**
 * Sends a JSON message.
 */
function message($true_or_false, $msg, $redirect = NULL) {
	$msg = array(
		'error' => $true_or_false,
		'message' => $msg
	);

	(!is_null( $redirect )) ? $msg['redirect'] = $redirect : NULL;

	return json_encode($msg);
}

/**
 * Set some login options, such as 'If the user tries to access
 * a protected page where should they be redirected to?' and
 * 'What users have access to the page im calling set_options on'
 */
function set_options($options) {
	// Options must be an array.
	if ( !is_array( $options ) ) {
		return 'You must supply an array of options';
	}
	$core = core::init();
	$core->set_options($options);
}

/**
 * secure_page is called to secure any page.
 * this will lock down the page to everyone
 * also redirecting them to the login page.
 */
function secure_page() {
	$core = core::init();
	$core->secure();
}

/**
 * secure_page_admin is called to lock down
 * administrator pages, this will authenticate
 * administrators and allow them access.
 */
function secure_page_admin() {
	$core = core::init();
	$core->secure(array('admin'));
	return $core;
}

/**
 * get_data is called to return the logged in users information
 * from the core lib.
 */
function get_data() {
	return core::init();
}