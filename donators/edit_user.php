<?php
/**
 * Just some quick checks to make sure that the user isn't
 * trying to access this file directly. Yes I could have included
 * this automatically to save extra lines of code but it would have
 * only been added somewhere else so chill.
 */
if ( !isset($_GET['jq']) )
die('You don\'t have permission to access this file!');
// require_once('lib/core.php');
// $c = new core(true, true);

require_once 'bootstrap.php';
$c = core::init();

// Additional checks time!
if ( !isset($_GET['id']) )
	die('Please supply a valid user ID.');

$user = $c->get_user_from_id($_GET['id']);

?>

<? if (empty($user)): ?>
<h1>Hmm, no one exists with the user id of <?=$_GET['id']?></h1>
<? else: ?>

<h1 class="rule">Currently Editing:
	<? if ( $_SESSION['USER_ID'] === $user->id ): ?>
	<?=$user->firstname, ' ', $user->lastname, ' (Me) '?>
	<? else: ?>
	<?=$user->firstname, ' ', $user->lastname?>
	<? endif; ?>
</h1>
<div class="user_edit_section">

	<form>
		<div class="inputs">
	    <p>
	    	<span class="required"></span>
	    	<input type="text" name="firstname" placeholder="John" value="<?=$user->firstname?>" required>
	    	<small>The users <strong>firstname</strong> is used so it adds a more personal touch to the application.</small>
	    </p>
	    <p>
	    	<span class="required"></span>
	    	<input type="text" name="lastname" placeholder="Doe" value="<?=$user->lastname?>" required>
	    	<small>The users <strong>lastname</strong> is used again to add a more personal touch to the application.</small>
	    </p>
	    <p>
	    	<span class="required"></span>
	    	<input type="text" name="username" placeholder="johndoe" value="<?=$user->username?>" required>
	    	<small>The <strong>username</strong> for obvious reasons allows the user to gain access to their profile.</small>
	    </p>
	    <p>
	    	<span class="required"></span>
	    	<input type="text" name="email" placeholder="johndoe@phpcodemonkey.com" value="<?=$user->email?>" required>
	    	<small>The <strong>email address</strong> used to contact the user should they need new password etc.</small>
	    </p>
	    <p>
	    	<span class="required"></span>
	    	<input type="text" name="redirect" placeholder="protected.php" value="<?=$user->redirect?>" required>
	    	<small>The <strong>redirect</strong> is used to redirect the user once he/she is logged in.</small>
	    </p>

	    <? if ( $_SESSION['USER_ID'] === $user->id ): ?>
	    <p>
	    	<span class="required"></span>
	    	<input type="password" name="password" placeholder="password" required>
	    	<small>The <strong>password</strong> leave blank if you don't want to change.</small>
	    </p>
	  	<? endif; ?>

	    <h2>Other Options</h2>

	    <div class="a_line"></div>

	    <p> 
	    	<img src="<?=$user->gravatar?>" alt="<?=$user->username?>'s Gravatar Image" class="gravatar"> 
	    	<small> The <strong>Gravatar</strong> image. This is automatically fetched from 
	    		<a href="https://en.gravatar.com/">Gravatar</a>. Refer to documentation for use. </small>
	    </p>

	    <!-- 0=awaiting activation;1=activated;2=moderator;3=admin;4=banned; -->
	    <p>
	    	Current Status: <strong><?=$c->status($user->status)?></strong>
	    	<select id="status" class="status_list">
	    		<option value="1" <?=$c->current_status(1, $user->status)?>>Activated (Standard Member)</option>
	    		<option value="3" <?=$c->current_status(3, $user->status)?>>Administrator</option>
	    		<option value="4" <?=$c->current_status(4, $user->status)?>>Banned User</option>
	    	</select>
	    </p>

	    <? if ( $_SESSION['USER_ID'] !== $user->id ): ?>
			<h3>Reset Users Password</h3>
	    <p>
	    	You are able to reset the users password, simply click on the button and the system will send them a new one.
	    	Please note this operation cannot be undone.
	    	<br><br>
	    	<a href="reset:<?=$user->id?>" id="reset_password">Ok, I'm sure send them a new Password</a>
	    </p>
			<? endif; ?>

	    <h3>Delete <?=$user->firstname, ' ', $user->lastname?>?</h3>
	    <p>You can delete this person from the database, once this is done the user will no longer
	    	be able to login to their account. <strong>This action CAN'T be undone!</strong>
	    	<br><br>
	    	<?php if ( $user->is_admin == 1 ): ?>
	    	<span class="red">You canno't delete this person because they are admin.</span>
	    	<?php else: ?>
	    		<a href="delete:<?=$user->id?>" id="delete_account" class="button">It's cool delete this persons account from the database</a>
	  		<?php endif; ?>
	    </p>

	    <div class="a_line"></div>

	    <div class="actions">
	    	<button class="button" id="save">Save</button>
	    	<a href="manage_users.php" id="cancel" class="button cancel-btn">Cancel</a>
	    </div>

	    <input type="hidden" name="id" value="<?=$user->id?>">
	    <input type="hidden" name="csrf_field" value="<?=$_SESSION['CSRF_TOKEN']?>">
		</div><!--/inputs-->
	</form>

	<div id="feedback" class="alert"></div>

</div><!--/user_edit_section-->

<script type="text/javascript" src="js/edit_users.js"></script>

<? endif; ?>