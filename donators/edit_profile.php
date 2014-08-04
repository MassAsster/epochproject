<?php
require 'bootstrap.php';
$c = core::init();
secure_page();
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href=" css/style.css">
  <script src="js/jquery.js"></script>
  <script src="js/custom.js"></script>
  <script src="js/edit_users.js"></script>

  <title><?=SITE_NAME?>:Edit</title>
</head>

<body>
<div class="wrapper">

  <div class="no-js">
    <p>This application uses JavaScript to function correctly, to use this app and it's features enable JavaScript!</p>
  </div><!--/no-js-->

  <header class="thinner">
    <h2>
      <!-- <img src="<?=$c->gravatar?>" alt="<?=$c->username?>'s Gravatar Image" class="gravatar"> -->
      <?=$c->username?>'s Account</h2>
      <small>
        <a href="<?=$c->location?>">Back</a> | <a href="?logout" title="Logout">Logout</a>
      </small>
  </header>

  <div class="content edit_profile">

  <form>
    <div class="inputs">
      <p>
        <span class="required"></span>
        <input type="text" name="firstname" placeholder="John" value="<?=$c->firstname?>" required>
        <small>The users <strong>firstname</strong> is used so it adds a more personal touch to the application.</small>
      </p>
      <p>
        <span class="required"></span>
        <input type="text" name="lastname" placeholder="Doe" value="<?=$c->lastname?>" required>
        <small>The users <strong>lastname</strong> is used again to add a more personal touch to the application.</small>
      </p>
      <p>
        <span class="required"></span>
        <input type="text" name="email" placeholder="johndoe@phpcodemonkey.com" value="<?=$c->email?>" required>
        <small>The <strong>email address</strong> used to contact the user should they need new password etc.</small>
      </p>
      <p>
        <span class="required"></span>
        <input type="password" name="password" placeholder="password">
        <small>The <strong>password</strong> leave blank if you don't want to change.</small>
      </p>

      <div class="inner_edit_profile">
        <h2> Other Options </h2>
        <div class="a_line"></div>
        <p>
          <a href="https://en.gravatar.com/"><img src="<?=$c->gravatar?>" alt="<?=$c->username?>'s Gravatar Image" class="gravatar-small"></a>
          Here is where other various account settings and options appear.
          If you'd like to change your portfolio image (<strong>Gravatar</strong>)
          then head over to <a href="https://en.gravatar.com/">Gravatar</a>.
        </p>

        <h3>Delete My Account</h3>
        <p>You can delete your account from <?=SITE_NAME?>'s database, once this is done you will no longer
          be able access your account. <strong>This action CAN'T be undone!</strong>
          <br><br>
          <a href="delete:<?=$c->id?>" id="delete_account">It's cool delete my account from the database</a>
        </p>

        <div class="a_line"></div>

        <div class="actions">
          <button class="button" id="update_profile">Save</button>
        </div>

        <input type="hidden" name="id" value="<?=$c->id?>">
        <input type="hidden" name="csrf_field" value="<?=$_SESSION['CSRF_TOKEN']?>">

      </div><!--//innder_edit_profile-->

    </div><!--/inputs-->
  </form>

  <div id="feedback" class="alert"></div>

</div><!--/user_edit_section-->



</div><!--/wrapper-->
</body>
</html>