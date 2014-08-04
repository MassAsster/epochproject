<?php
require_once 'bootstrap.php';
$core = core::init();

if ( isset($_GET['id']) && isset($_GET['code'])) {
  $result = $core->change_password($_GET['id'], $_GET['code']);
}

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href=" css/style.css">
  <script src="js/jquery.js"></script>
  <script src="js/custom.js"></script>
  <title><?=SITE_NAME?>: Forgot Password</title>
</head>

<body>
<div class="wrapper">

  <div class="no-js">
    <p>This application uses JavaScript to function correctly, to use this app and it's features enable JavaScript!</p>
  </div><!--/no-js-->

  <div id="feedback" class="alert"></div>

  <div class="main">

    <h1> <a href="forgot_password.php">Simple. Secure. Forgot</a> </h1>

    <? if ( (isset($result) && $result === true) ): ?>
    <div class="login verify_text">
      <p>Success, we have sent you a new password. Check your email!</p>
    </div><!--/login-->
    <? else: ?>
    <form class="login">
      <div class="inputs">
        <p class="input-block">
          <label for="email">Email Address</label>
          <input type="email" name="email" id="email" placeholder="example@phpcodemonkey.com" autofocus required>
        </p>
      </div><!--/inputs-->
      <div class="actions">
        <input type="submit" class="button" id="forgot_password" value="Retrieve">
        <img src="./images/loader.gif" alt="Loading..." class="form_loader">
        <p><a href="register.php">Register</a> or <a href="login.php">Login</a></p>
      </div><!--/actions-->
    </form>
    <? endif; ?>

  </div><!--/main-->

</div><!--/wrapper-->
</body>
</html>
