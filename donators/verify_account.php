<?php
// require_once('lib/core.php');
// $c = new core;

require_once 'bootstrap.php';
$c = core::init();

// Do they have the goods?
if ( !isset($_GET['email']) || !isset($_GET['code']) ) {
	header('Location: login.php');
	exit;
}
if (is_null($_GET['code'])) {
	// NULL is default for forgot_hash
	header('Location: login.php');
	exit;	
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href=" css/style.css">

  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>

  <title>Account Verify | <?=SITE_NAME?></title>
</head>
	
<body>
	
	<h1>Simple. Secure. Verify</h1>

	<div class="login verify_text">
  	<? if ($c->verify_account($_GET['email'], $_GET['code'])): ?>
  		<p>
  			Success, your account has now been verified!
  			<br>
  			<br>
  			You may now <a href="<?=LOGIN_LOCATION?>">Login</a>
  		</p>
  	<? else: ?>
  	<p>
  		Failed to verify account. Have you clicked the link provided in the email?
  	</p>
  	<? endif; ?>
	</div><!--/login-->

</body>
</html>