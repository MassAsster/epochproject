<?php
// Start a fresh session
if (!isset($_SESSION)) {
	session_start();
}
if(!isset($_SESSION['init'])) {
	session_regenerate_id();
	$_SESSION['init'] = true;
}

if (!defined('YES')) define('YES', true, true);
if (!defined('NO')) define('NO', false, true);

////////////MODIFY BELOW HERE /////////////////////////
//////  WEB SERVER SETUP. NOT GAME SERVER DATABASE //////
if (!defined('DB_HOST')) define('DB_HOST', 'localhost');
if (!defined('DB_USER')) define('DB_USER', 'root');
if (!defined('DB_PASS')) define('DB_PASS', '');
if (!defined('DB_NAME')) define('DB_NAME', 'donate');
if (!defined('DB_PORT')) define('DB_PORT', '3306'); //Ports Other than 3306 currently will not work with this version, your web server (not the game server) must be using 3306//

if (!defined('NUMBER_OF_ATTEMPTS')) define('NUMBER_OF_ATTEMPTS', 6);


if (!defined('DOMAIN_NAME')) define('DOMAIN_NAME', 'http://es-gamers.com/donators/'); // REMEMBER TRAILING SLASH >> /
if (!defined('LOGIN_LOCATION')) define('LOGIN_LOCATION', DOMAIN_NAME . 'login.php');
if (!defined('SITE_NAME')) define('SITE_NAME', 'localhost');
if (!defined('EMAIL_EXT')) define('EMAIL_EXT', 'localhost');
if (!defined('APP_VERSION')) define('APP_VERSION', '1');


////////////DO NOT MODIFY BELOW HERE //////////////////
if (!defined('DEFAULT_REDIRECT')) define('DEFAULT_REDIRECT', 'welcome.php');

//if (!defined('SALT')) define('SALT', 'R3nd0m5$sStR1n8'); Obsolete ADDED PBKDF2.


// This will be shown if a person tries some sneaky cross
// site request attack.
if ( !defined('CSRF_FAILURE') ) define('CSRF_FAILURE',"
  CSRF Error: You don't have permissions!
");

// This will be shown when a user fails to enter a
// username and password on login.
if ( !defined('USERNAME_AND_PASSWORD') ) define('USERNAME_AND_PASSWORD',"
  Please enter your username and password!
");

// This will be shown if the user has entered incorrect login details.
if ( !defined('WORNG_LOGIN_DETAILS') ) define('WORNG_LOGIN_DETAILS',"
  Incorrect username and or password!
");

// This is called when the user does not supply an email address.
if ( !defined('NO_EMAIL_ADDRESS') ) define('NO_EMAIL_ADDRESS',"
  Please supply a valid email address!
");

// When the user does not enter their details for the register page.
if ( !defined('REGISTER_FAIL_NO_DETAILS') ) define('REGISTER_FAIL_NO_DETAILS',"
  All fields are required, please check and try again!
");

// When the user enters the wrong captcha.
if ( !defined('INVALID_CAPTCHA') ) define('INVALID_CAPTCHA',"
  Incorrect CAPTCHA, please try again!
");

// When the user enters a username in use.
if ( !defined('USERNAME_IN_USE') ) define('USERNAME_IN_USE',"
  {{username}} is currently in use, choose another!
");

// When the user enters a username in use.
if ( !defined('EMAIL_IN_USE') ) define('EMAIL_IN_USE',"
  {{email}} is currently in use, choose another!
");

// When the user enters an invalid email address
if ( !defined('INVALID_EMAIL_ADDRESS') ) define('INVALID_EMAIL_ADDRESS',"
  {{email}} is invalid!
");

// When the user requested a new password and the email they entered
// was not found in the database.
if ( !defined('REQUEST_NEW_PASSWORD_FAILURE') ) define('REQUEST_NEW_PASSWORD_FAILURE',"
  {{email}} has not been found in the database.
");

// When the user has requested a new password.
if ( !defined('REQUEST_NEW_PASSWORD_SUCCESS') ) define('REQUEST_NEW_PASSWORD_SUCCESS',"
  Success, check your email for further instructions.
");

// When the user has updated their profile.
if ( !defined('USER_PROFILE_UPDATED') ) define('USER_PROFILE_UPDATED',"
  {{username}}'s profile has been updated.
");

// When the user has been deleted.
if ( !defined('USER_HAS_BEEN_DELETED') ) define('USER_HAS_BEEN_DELETED',"
  User has been successfully removed.
");

// When the user has registered successfully.
if ( !defined('REGISTER_SUCCESS') ) define('REGISTER_SUCCESS',"
  Welcome {{username}}, please check your email.
");

// When the user fails to register.
if ( !defined('REGISTER_FAIL') ) define('REGISTER_FAIL',"
  Something went wrong, please try again.
");

// When a users account is deleted.
if ( !defined('ACCOUNT_DELETED') ) define('ACCOUNT_DELETED', "
  Account successfully removed.
");


 date_default_timezone_set('GMT');
 error_reporting(E_ALL); //  E_ALL OR 0