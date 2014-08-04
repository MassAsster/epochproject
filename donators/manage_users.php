<?php
require_once 'bootstrap.php';
$c = secure_page_admin();
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href=" css/style.css">
  <script src="js/jquery.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/custom.js"></script>
  <script src="js/edit_users.js"></script>

  <title><?=SITE_NAME?>: Manage Users</title>
</head>

<body>
<div class="wrapper">

  <?php if ( $flash = Flash::get() ): ?>
    <div class="alert <?=($flash)?'success':'error'?>" style="display: block;">
      <p> <?=$flash['msg']?> </p>
    </div><!--//alert-->
  <?php endif; ?>

  <div class="no-js">
    <p>This application uses JavaScript to function correctly, to use this app and it's features enable JavaScript!</p>
  </div><!--/no-js-->

  <header>
    <h2>Manage Users</h2> <small><?=($c->is_admin == 'Yes')?' | ':'<a href="edit_profile.php">Edit Profile</a> | '?>
        <a href="?logout" title="Logout">Logout</a></small>
  </header>

  <div class="main content" role="main">
    <table id="user_list" class="user_table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Tokens</th>
          <th>Email</th>
          <th>Redirect</th>
          <th>Admin</th>
          <th>Status</th>
          <th>Manage</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($c->fetch_users() as $user): ?>
        <tr data-id="<?=$user->id?>" id="<?=$user->id?>">
          <td><?=$user->id?></td>
          <td><?=$user->username?></td>
<?php 
$whois="<form enctype=multipart/form-data action=edittokens.php method=POST><input type=hidden name=player value='$user->username' ><input type=image src=images/tokens.png></form>";
?>
          <td><?php echo "$whois"; ?></td>
          <td><?=$user->email?></td>
          <td><?=$user->redirect?></td>
          <td><?=($user->is_admin == 1) ? 'Yes' : 'No'?></td>
          <td><?=$c->status($user->status)?></td>
          <td><a href="#" class="edit">Edit</a></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div><!--/main-->

  <button class="button user_btn" id="add_user">Add User</button>

  <div id="edit_user" class="content margin_top_2em hidden">

  </div><!--/content-->



</div><!--/wrapper-->
<script type="text/javascript">
  $(document).ready( function() {
    $('#user_list').dataTable();
  });
</script>
</body>
</html>