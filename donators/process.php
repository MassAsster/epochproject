<?php
require_once 'bootstrap.php';
$core = core::init();

/**
 * Called when the user wants to update their profile.
 */
if ( (isset($_POST['task']) && $_POST['task'] == 'user_update_profile' ) ) {
	if ( _csrf() ) {
		
		if ( (isset($_POST['firstname']) && !empty($_POST['firstname'])) ) {
			$firstname = ucfirst($_POST['firstname']);
		} else $firstname = NULL;

		if ( (isset($_POST['lastname']) && !empty($_POST['lastname'])) ) {
			$lastname = ucfirst($_POST['lastname']);
		} else $lastname = NULL;

		if ( (isset($_POST['email']) && !empty($_POST['email'])) ) {
			$email = $_POST['email'];
		} else $email = NULL;

		if ( (isset($_POST['password']) && !empty($_POST['password'])) ) {
			$password = $_POST['password'];
		} else $password = NULL;

		echo $core->update_user($core->id, $firstname, $lastname, 
												$core->username, $email, $core->location, NULL, $password, TRUE);

	} else {
		die_message(true, CSRF_FAILURE);
	}
}

/**
 * Called when the admin wants to reset or delete
 * a user account.
 */
if ( isset($_POST['edit_or_delete']) ) {
	if ( _csrf() ) {

		// Break it down baby.
		$tmp = explode(':', $_POST['edit_or_delete']);
		$task = $tmp[0];
		$id = $tmp[1];

		if ( $task == 'delete' ) {
			// Delete the user baby.
			if ( $_SESSION['IS_ADMIN'] == YES || $_SESSION['USER_ID'] == $id ) {
				// Ok carry out the action as it's an admin or the member
				echo $core->perform_task('delete', $id, ($_SESSION['IS_ADMIN'] == YES)?true:false);
			}
		} else if ($task == 'reset') {
			// Reset their password.
			echo $core->perform_task('reset', $id, true);
		}

	}
}

/**
 * Called when the user tries to update their profile.
 */
if ( (isset($_POST['task']) && $_POST['task'] == 'update_user_from_admin') ) {
	if ( _csrf() ) {

		if ( (isset($_POST['firstname']) && !empty($_POST['firstname'])) ) {
			$firstname = ucfirst($_POST['firstname']);
		} else $firstname = NULL;

		if ( (isset($_POST['lastname']) && !empty($_POST['lastname'])) ) {
			$lastname = ucfirst($_POST['lastname']);
		} else $lastname = NULL;

		if ( (isset($_POST['username']) && !empty($_POST['username'])) ) {
			$username = $_POST['username'];
		} else $username = NULL;

		if ( (isset($_POST['email']) && !empty($_POST['email'])) ) {
			$email = $_POST['email'];
		} else $email = NULL;

		if ( (isset($_POST['redirect']) && !empty($_POST['redirect'])) ) {
			$redirect = $_POST['redirect'];
		} else $redirect = NULL;

		if ( (isset($_POST['status']) && !empty($_POST['status'])) ) {
			$status = $_POST['status'];
		} else $status = NULL;

		if ( (isset($_POST['password']) && !empty($_POST['password'])) ) {
			$password = $_POST['password'];
		} else $password = NULL;

		if ( $core->update_user($_POST['id'], $firstname, $lastname,
			$username, $email, $redirect, $status, $password, false) ) {
			// Success, show the user a flash message.
			Flash::set(false, _rd('username', $username, USER_PROFILE_UPDATED));
			echo json_encode( array('error' => false) ); // Tell JS  it's all good
		} else {
			// Uh-oh we failed sir, the infidels have won.
			Flash::set(false, _rd('username', $username, USER_PROFILE_FAIL_UPDATE));
			echo json_encode( array('error' => true) );
		}

	} else die_message(true, CSRF_FAILURE);
}

/**
 * Called when the admin creates a new user from the backend.
 */
if ( (isset($_POST['task']) && $_POST['task'] == 'create_from_admin') ) {
	if ( _csrf() ) {
		// Check to see if we have data.
		if ((isset($_POST['firstname']) && !empty($_POST['firstname'])) &&
				(isset($_POST['lastname']) && !empty($_POST['lastname'])) &&
		    (isset($_POST['username']) && !empty($_POST['username'])) &&
		    (isset($_POST['email']) && !empty($_POST['email'])) &&
		    (isset($_POST['redirect']) && !empty($_POST['redirect'])) &&
		    (isset($_POST['password']) && !empty($_POST['password'])) &&
		    (isset($_POST['status']) && !empty($_POST['status']))) {

			// Insert into the database.
			echo $core->add_user($_POST['firstname'], $_POST['lastname'],
			                     $_POST['username'], $_POST['email'],
			                     $_POST['password'], $_POST['redirect'],
			                     $_POST['status']);

		} else {
			die_message(true, REGISTER_FAIL_NO_DETAILS);
		}
	} else {
		die_message(true, CSRF_FAILURE);
	}
}

/**
 * Called when the user saves settings.
 */
if ( (isset($_POST['task']) && $_POST['task'] == 'save_settings') ) {
	if ( isset($_POST['allow_reg']) ) {
		echo json_encode($core->save_settings($_POST['allow_reg'],
			(empty($_POST['location']) ? DEFAULT_REDIRECT : $_POST['location'] )));
	}
}

/**
 * Called when the user selects the login button.
 */
if ( (isset($_POST['task']) && $_POST['task'] == 'login') ) {
	// Ensure we have the username, password and CSRF token
	if ( _csrf() ) {
		// Do we have a username and password?
		if ( isset($_POST['username']) && isset($_POST['password']) ) {
			echo $core->validate_user($_POST['username'], $_POST['password']);
		} else {
			die_message(true, USERNAME_AND_PASSWORD);
		}
	} else {
		die_message(true, CSRF_FAILURE);
	}
}

/**
 * Called when a new user registers.
 */
if ( (isset($_POST['task']) && $_POST['task'] == 'new_user') ) {
	// Check that we have the user data.
	if ( isset($_POST['username']) && isset($_POST['password'])
	    && isset($_POST['email']) && isset($_POST['captcha']) ) {
		// Check the captchaaaaaaaaaaa
		if ( $_POST['captcha'] != $_SESSION['CAPTCHA'] ) {
			die_message(true, INVALID_CAPTCHA);
		}
		// We can try to add the user.
		echo $core->add_user('', '', $_POST['username'],
		                  $_POST['email'], $_POST['password'],
		                  $core->settings->redirect_location, 0, true);
	} else {
		die_message(true, REGISTER_FAIL_NO_DETAILS);
	}
}

/**
 * Called when the user forgets their password.
 */
if ( (isset($_POST['task']) && $_POST['task'] == 'forgot_password') ) {
	if ( isset($_POST['email']) ) {
		echo $core->send_password_request($_POST['email']);
	} else {
		die_message(true, NO_EMAIL_ADDRESS);
	}
}