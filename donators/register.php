<?php
require_once 'bootstrap.php';
$core = get_data();
$sum = $core->captcha();
$settings = $core->settings;
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href=" css/style.css">
  <script src="js/jquery.js"></script>
  <script src="js/custom.js"></script>

  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>

  <title><?=SITE_NAME?>: Register</title>
</head>

<body>
<div class="wrapper">

	<div class="no-js">
    <p>This application uses JavaScript to function correctly, to use this app and it's features enable JavaScript!</p>
  </div><!--/no-js-->

	<div class="main">

		<h1> <a href="register.php">Register</a> </h1>

    <?php if ( $settings->allow_registration <= 0 ): ?>
    <div class="login verify_text">
      <p>I'm sorry but registration is currently closed.</p>
    </div><!--/login-->
    <?php else: ?>
    <form class="login">
      <div class="inputs">
        <p class="input-block">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" placeholder="username" autofocus required>
        </p>
        <p class="input-block">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" placeholder="password" required>
        </p>
        <p class="input-block">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" placeholder="example@phpcodemonkey.com" required>
        </p>
        <p class="input-block">
          <label for="captcha">Sum of: <?=$sum?></label>
          <input type="text" name="captcha" id="captcha" placeholder="<?=$sum?>" required>
        </p>
        <input type="hidden" name="csrf_field" value="<?=$_SESSION['CSRF_TOKEN']?>">
      </div><!--/inputs-->
      <div class="actions">
        <input type="submit" class="button" id="register" value="Register">
        <img src="./images/loader.gif" alt="Loading..." class="form_loader">
        <p><a href="login.php">Login</a> or <a href="forgot_password.php">Forgot Password?</a></p>
      </div><!--/actions-->
    </form>
    <?php endif; ?>

	</div><!--/main-->

	<div id="feedback" class="alert"></div>

</div><!--/wrapper-->
</body>
</html>