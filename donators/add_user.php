<?php
/**
 * Just some quick checks to make sure that the user isn't
 * trying to access this file directly. Yes I could have included
 * this automatically to save extra lines of code but it would have
 * only been added somewhere else so chill.
 */
if ( !isset($_GET['jq']) )
	die('You don\'t have permission to access this file!');
require_once 'bootstrap.php';
secure_page();
$c = core::init();
?>

<div class="user_edit_section">
	<h1>Adding New User</h1>
	<form>
		<div class="inputs">
	    <p>
	    	<span class="required"></span>
	    	<input type="text" name="firstname" placeholder="John" required>
	    	<small>The users <strong>firstname</strong> is used so it adds a more personal touch to the application.</small>
	    </p>
	    <p>
	    	<span class="required"></span>
	    	<input type="text" name="lastname" placeholder="Doe" required>
	    	<small>The users <strong>lastname</strong> is used again to add a more personal touch to the application.</small>
	    </p>
	    <p>
	    	<span class="required"></span>
	    	<input type="text" name="username" placeholder="johndoe" required>
	    	<small>The <strong>username</strong> for obvious reasons allows the user to gain access to their profile.</small>
	    </p>
	    <p>
	    	<span class="required"></span>
	    	<input type="text" name="email" placeholder="johndoe@phpcodemonkey.com" required>
	    	<small>The <strong>email address</strong> used to contact the user should they need new password etc.</small>
	    </p>
	    <p>
	    	<span class="required"></span>
	    	<input type="text" name="redirect" placeholder="protected.php" value="<?=$c->settings->redirect_location?>" required>
	    	<small>The <strong>redirect</strong> is used to redirect the user once he/she is logged in.</small>
	    </p>
	    <p>
	    	<span class="required"></span>
	    	<input type="password" name="password" placeholder="password" required>
	    	<small>The <strong>password</strong> leave blank if you want a randomly generated one.</small>
	    </p>

	    <h2>Other Options</h2>

	    <div class="a_line"></div>
	    <p>
	    	Add the users status here, if you leave this at <strong>Awaiting Activation</strong> the user will be sent
	    	an activation email and will have to follow the procedures to activate their account. Any other will
	    	automatically activate their account. Final thing users will automatically be sent a welcome email
	    	regardless of their status.<br><br>
	    	<select id="status" class="status_list">
	    		<option value="1">Activated (Standard Member)</option>
	    		<option value="3">Administrator</option>
	    	</select>
	    </p>

	    <div class="a_line"></div>

	    <div class="actions">
	    	<button class="button" id="create">Create</button>
	    	<a href="manage_users.php" id="cancel" class="button cancel-btn">Cancel</a>
	    </div>

	    <input type="hidden" name="csrf_field" value="<?=$_SESSION['CSRF_TOKEN']?>">
		</div><!--/inputs-->
	</form>

	<div id="feedback" class="alert"></div>

</div><!--/user_edit_section-->

<script type="text/javascript" src="js/edit_users.js"></script>