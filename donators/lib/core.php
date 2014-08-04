<?php
/**
 * CORE
 *
 * The core handles all of the grunt work, such as user CRUD.
 * User logins, logouts forgot passwords etc. Please don't modify
 * this file as it may break the application.
 *
 */
class Core {
	/**
	 * Stores the instance to the database
	 */
	protected $db;
	/**
	 * Stores the generated CSRF toke
	 */
	protected $csrf;
	/**
	 * User instance variables
	 */
	public
		$id,
		$firstname,
		$lastname,
		$username,
		$is_admin,
		$email,
		$location,
		$gravatar,
		$settings;

	/**
	 * Store an instance of the core class
	 */
	protected static $instance;

	/**
	 * Class options
	 */
	protected $options = array();

	/**
	 * Protected no one can instantiate an object by calling new
	 */
	protected function __construct() {  }

	/**
	 * Connect to the database and return an instance of the
	 * connection.
	 */
	protected function connect() {
		/**
		 * Try and connect to the database, this information can be
		 * configured in the inc/config.php file do not change them here.
		 */
		try {
			$this->db = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME.';', DB_USER, DB_PASS);
		} catch (PDOException $e) {
			// Kill the application as the connection to the database failed.
			die('DB Connection Failed: ' . $e->getMessage());
		}

		$this->settings = $this->get_settings();

		if ( !isset($_SESSION['CSRF_TOKEN']) )
			$this->csrf_token();
	}


	public static function init() {
		if ( !self::$instance ) {
			self::$instance = new core();
		}
		$core = self::$instance; // We have an instance of the core class.
		$core->connect(); // Connect to the database.
		$core->set_user_data(); // Check, we may have user data.

		// Ok we are done in here return the core.
		return $core;
	}

	public function set_user_data() {
		// Check to see if the user is logged in, also make some ivars
		// available just so they can be used rather than session variables.
		if ( isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN'] === true ) {
			# We have a logged in user..
			$this->id = $_SESSION['USER_ID'];
			$this->firstname = $_SESSION['FIRSTNAME'];
			$this->lastname = $_SESSION['LASTNAME'];
			$this->username = $_SESSION['USERNAME'];
			$this->is_admin = $_SESSION['IS_ADMIN'];
			$this->email = $_SESSION['EMAIL'];
			$this->location = $_SESSION['LOCATION'];
			$this->gravatar = get_gravatar($this->email, 65);
		}
	}

	public function set_options($options) {
		$this->options = $options;
	}

	public function secure( $validate_users = null ) {

		if ( !empty( $this->options ) ) {
			$options = $this->options; // Set the options.
		}

		// Do we have a login session?
		if ( !isset( $_SESSION['LOGGED_IN'] ) ) {
			// No, no session has been found so redirect
			// the user to login
			return header('Location: ' . URL .
				(isset($options) ?
					(array_key_exists('redirect', $options) ?
						$options['redirect'] : 'login.php' ) : 'login.php')
			);
		}

		// Check to see if we need to validate additional users.
		if ( $validate_users !== null ) {
			// Ok what users does the user want to validate?
			if ( in_array('admin', $validate_users) ) {
				// Validate the admin
				if ( isset($_SESSION['IS_ADMIN']) )
					$admin = $_SESSION['IS_ADMIN'];
				if ($admin !== YES) {
					header('Location: ' . URL . $_SESSION['LOCATION']);
					exit;
				}
			}
		}

	}

	/**
	 * Sends the user a password change request.
	 */
	public function send_password_request($email) {
		// Generate a random hash
		$forgot_hash = bin2hex(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM));

		// Some basic filtering
		$email = filter_var($email, FILTER_VALIDATE_EMAIL);

		if ( $this->in_use($email, 'email') ) {

			$sth = $this->db->prepare("UPDATE `members` SET `forgot_hash` = :forgot_hash WHERE `email` = :email");
			$sth->execute( array( ':email' => $email, ':forgot_hash' => $forgot_hash ) );

			if ( $sth->rowCount() > 0 ) {
				// Send the email Jonny
				$user = $this->get_user_from_email($email);
				Email::to($email);
				Email::from('no.reply@'.EMAIL_EXT);
				Email::subject('Forgot Password Request | ' . SITE_NAME);
				Email::template(ROOT.'/templates/pre_new_password.html' , array(
					'username' => $user->username,
					'app_name' => SITE_NAME,
					'new_password_link' => DOMAIN_NAME . 'forgot_password.php?id=' . $user->id
																	. '&code=' . $forgot_hash
				));
				Email::send();
				return message(false, REQUEST_NEW_PASSWORD_SUCCESS);
			}

		} else {
			// Email does not exist.
			return message(true, _rd('email', $email, REQUEST_NEW_PASSWORD_FAILURE));
		}

	}

	/**
	 * Used to protected forms from Cross Site Request Forgery.
	 * Because our application accepts user input it's important
	 * we protect it against such attacks. To find out what CSRF is
	 * and why it's important check the link below.
	 *
	 * Link: http://en.wikipedia.org/wiki/Cross-site_request_forgery
	 */
	public function csrf_token() {
		$this->csrf = md5(uniqid().rand());
		$_SESSION['CSRF_TOKEN'] = $this->csrf;
		return $this->csrf;
	}

	/**
	 * Grabs the list of users.
	 */
	public function fetch_users() {
		$sql = "SELECT `id`,
										`firstname`,
										`lastname`,
										`username`,
										`is_admin`,
										`email`,
										`redirect`,
										`status` FROM `members` ORDER BY `id` DESC";
		$sth = $this->db->prepare($sql);
		$sth->execute();
		return $sth->fetchAll(PDO::FETCH_OBJ);
	}

	/**
	 * Adds users to the database.
	 */
	public function add_user($firstname, $lastname, $username, $email, $password, $redirect, $status, $new = false) {

		$data = array(); // Blank data array.

		if ( strlen($password) == 0 ) {
			$password = $this->random_password();
		} else if (strlen($password) <= 3) {
			return json_encode(array(
				'error' => true,
				'message' => 'Password is too short! Please enter another or leave blank!'
			));
		}

		// Validation time.
		if ( $this->in_use($username, 'username') ) {
			return die_message(true, _rd('username', $username, USERNAME_IN_USE));
		}
		if ( $this->in_use($email, 'email') ) {
			return die_message(true, _rd('email', $email, EMAIL_IN_USE));
		}
		// Ok validate email.
		if ( !$this->valid_email_address($email) ) {
			return die_message(true, _rd('email', $email, INVALID_EMAIL_ADDRESS));
		}
		//$connection = @mysql_connect(DB_HOST, DB_USER, DB_PASS)		Obsolete?
		//			or die(mysql_error());
		//			
		//$db = @mysql_select_db(DB_NAME,$connection)					Obsolete?
		//		or die(mysql_error());
		//$password=mysql_real_escape_string($password);				Obsolete?
		//$firstname=mysql_real_escape_string($firstname);				Obsolete?
		//$lastname=mysql_real_escape_string($lastname);				Obsolete?
		//$email=mysql_real_escape_string($email);						Obsolete?
		// All the hashing, hashing away
		$pass_unhashed = $password;
		//$password = sha1($password . SALT);

		$password = create_hash($password);

		// Is this users status awaiting activation?
		$reset_token = bin2hex(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM));

		$sql = "INSERT INTO `members`
						(username, password, email, redirect, is_admin, firstname, lastname, status, forgot_hash)
						VALUES (:username, :password, :email, :redirect, :is_admin, :firstname, :lastname, :status, :forgot_hash)";

		// Prepare and execute the statement
		$sth = $this->db->prepare($sql);

		$sth->execute(array(
			':username' => $username,
			':password' => $password,
			':email' => $email,
			':redirect' => (!empty($redirect)) ? $redirect : $this->settings->redirect_location,
			':is_admin' => ($status == 3) ? 1 : 0,
			':firstname' => (!empty($firstname) ? $firstname : ''),
			':lastname' => (!empty($lastname) ? $lastname : ''),
			'status' => $status,
			'forgot_hash' => $reset_token
		));

		// Get the correct template for the user.
		if ( $status == 0 ) {
			$template = 'registration.html';
		} else {
			$template = 'pre_registration.html';
		}

		// Check to see if it was successful
		if ( $sth->rowCount() > 0 ) {

			// Nice and compact email send block.
			Email::to($email);
			Email::from('noreply@'.EMAIL_EXT);
			Email::subject('Welcome ' . $username . ' | ' . SITE_NAME);
			Email::template(ROOT.'/templates/' . $template , array(
				'username' => $username,
				'password' => $pass_unhashed,
				'app_name' => SITE_NAME,
				'activation_url' => DOMAIN_NAME . 'verify_account.php?email=' . $email . '&code=' . $reset_token
			));
			Email::send();
			return message(false, _rd('username', $username, REGISTER_SUCCESS));

		} else {
			// Something went wrong boss.
			return message(false, REGISTER_FAIL);
		}

	}

	/**
	 * update_user: Updates the user.
	 */
	public function update_user($id, $firstname = NULL, $lastname = NULL, $username = NULL, $email = NULL,
	                            $redirect = NULL, $status = NULL, $password = NULL, $refresh = FALSE) {

		// Varz
		$email_on_success = false;

		// Pull the user in question from the database.
		$user = $this->get_user_from_id((int)$id);

		$sql = "UPDATE `members` SET "; // Prepare the SQL
		$tmp_sql = $sql; // Cache the above variable.
 		//make connection to dbase
		//$connection = @mysql_connect(DB_HOST, DB_USER, DB_PASS)		Obsolete?
		//			or die(mysql_error());
		//			
		//$db = @mysql_select_db(DB_NAME,$connection)					Obsolete?
		//		or die(mysql_error());
		//$password=mysql_real_escape_string($password);				Obsolete?
		//$firstname=mysql_real_escape_string($firstname);				Obsolete?
		//$lastname=mysql_real_escape_string($lastname);				Obsolete?
		//$email=mysql_real_escape_string($email);						Obsolete?

		if ( $firstname != $user->firstname ) {
			// Ok, we can change.
			$sql .= " `firstname` = :firstname,";
			$data[':firstname'] = ucfirst($firstname);
		}

		if ( $lastname != $user->lastname ) {
			// Ok, we can change.
			$sql .= " `lastname` = :lastname,";
			$data[':lastname'] = ucfirst($lastname);
		}

		if ( $username != $user->username ) {
			// Check to see if name in use.
			if ( !$this->in_use($username, 'username') ) {
				// Username is not in use, so they can have it.
				$sql .= " `username` = :username,";
				$data[':username'] = $username;
			} else {
				return message(true, _rd('username', $username, USERNAME_IN_USE));
			}
		}

		if ( $email != $user->email ) {
			// Check if email is in use.
			if ( !$this->in_use($email, 'email') ) {
				$sql .= " `email` = :email,";
				$data[':email'] = $email;
			} else {
				return message(true, _rd('email', $email, EMAIL_IN_USE));
			}
		}

		if ( !$this->valid_email_address($email) ) {
			return message(true, INVALID_EMAIL_ADDRESS);
		}

		if ( ($redirect != $user->redirect) || !is_null($redirect) ) {
			$sql .= " `redirect` = :redirect,";
			$data[':redirect'] = $redirect;
		}

		if (!is_null($status)) {
			$status = (int)$status;
			if ($status === 3) {
				// We have an admin
				$sql .= " `status` = :status, is_admin = :admin,";
				$data[':status'] = $status;
				$data[':admin'] = 1;
			} else {
				$sql .= " `status` = :status, is_admin = :admin,";
				$data[':status'] = $status;
				$data[':admin'] = 0;
			}
		}

		if ( !is_null($password) ) {
			$sql .= " `password` = :password ";
			// We will need the unhashed version for later.
			$pass_unhashed = $password;
			$data[':password'] = create_hash($password);

			// Due to the password being changed we should email them.
			$email_on_success = true;
		}

		if ( $sql == $tmp_sql ) {
			// Nothing has been changed.
			return message(false, _rd('username', $username, USER_PROFILE_UPDATED));
		}

		// The query needs prepping a little.
		$sql = substr($sql, 0, -1);
		$sql .= " WHERE `id` = :id";
		$data[':id'] = $id;

		// Ok do the query thing now.
		$query = $this->db->prepare($sql);
		$query->execute($data);
		$count = $query->rowCount();

		// Should we refresh the user data?
		if ( $refresh ) $this->refresh_data($this->id);

		if ( $email_on_success ) {

			// Change of details in particular the password
			// so the user needs emailing.
			Email::to($email);
			Email::from('noreply@'.EMAIL_EXT);
			Email::subject('Change of Details | ' . SITE_NAME);
			Email::template(ROOT.'/templates/change_of_details.html', array(
				'username' => $username,
				'password' => $pass_unhashed,
				'email' => $email,
				'app_name' => SITE_NAME
			));
			Email::send();
		}

		return message(false, _rd('username', $username, USER_PROFILE_UPDATED));

	}

	public function captcha() {
		$sum1 = mt_rand(1, 9);
		$sum2 = mt_rand(1, 9);
		$_SESSION['CAPTCHA'] = $sum1 + $sum2;
		return $sum1 . ' + ' . $sum2 . ' = ';
	}

	protected function in_use($item, $table) {
		$item = strip_tags(stripslashes(strtolower($item)));
		$sql = "SELECT * FROM `members` WHERE `$table` = :item";

		$query = $this->db->prepare($sql);
		$query->execute(array(':item' => $item));

		if ( $query->rowCount() > 0 ) { // We have a match
			return true;
		} else
			return false;
	}

	public function change_password($id, $code) {

		// Some basic filtering
		$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
		$code = filter_var($code, FILTER_SANITIZE_STRING);

		// Ok check to see if these are valid.
		$sql = "SELECT C* FROM `members` WHERE `id` = '$id' AND `forgot_hash` = :code";
		$query = $this->db->prepare($sql);
		$query->execute(array(':code' => $code));

		if ($query->rowCount() > 0) { // These values are correct
			$this->spent_token($id);
			if ($this->perform_task('reset', $id, false))
				return true;
			else
				return false;
		} else {
			return false;
		}
	}

	public function perform_task($task, $id, $admin) {

		if ( $task == 'delete' ) {
			// Delete the user.
			$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
			//$count = $this->db->exec("DELETE FROM `members` WHERE `id` = '$id' LIMIT 1");
			$sql = "DELETE FROM `members` WHERE `id` = :id LIMIT 1";
			$query = $this->db->prepare($sql);
			$query->execute(array(':id' => $id));
			if ($query->rowCount() >= 1) {

				// Did the administrator issue this delete? If so we wan't to redirect them to the manage users.
				if ( $admin ) {
					return message(false, ACCOUNT_DELETED, 'manage_users.php');
				} else {
					// User issued delete, destroy their session and f em off.
					session_destroy();
					return message(false, ACCOUNT_DELETED, 'login.php');
				}

			} else {
				// Failed to delete users account why?
				return message(true, 'Error: Failed to delete account.');
			}

		} else if ($task == 'reset') {
			// Reset the users password.
			$password = $this->random_password();


			$pass_hash = create_hash($password);;
			$sql = "UPDATE `members` SET `password` = :password WHERE `id` = :id LIMIT 1";
			$sth = $this->db->prepare($sql);
			$sth->execute(array(':password' => $pass_hash, ':id' => $id));
			if ($sth->rowCount() >= 1) {
				// Password changed, notify the user.
				$user = $this->get_user_from_id($id);

				Email::to($user->email);
				Email::from('noreply@'.EMAIL_EXT);
				Email::subject('Password Reset | ' . SITE_NAME);
				Email::template(ROOT . '/templates/new_password.html', array(
					'username' => $user->username,
					'password' => $password,
					'app_name' => SITE_NAME
				));

				Email::send();

				return json_encode(
					array(
						'error' => false,
						'message' => 'Password has been successfully changed.',
						'task' => 'reset'
				));
			}

		} else {
			return die_message(true, 'Im confused, what are you trying to do?');
		}
	}

	/**
	 * Grabs a single user from their ID.
	 *
	 * @var <int> $id - The users ID you wish to pull from the database
	 */
	public function get_user_from_id($id) {
		$id = (int)$id; // Cast to int.
		$sth = $this->db->prepare('SELECT `id`, `firstname`, `lastname`, `username`, `is_admin`, `email`, `redirect`, `status` FROM `members` WHERE `id` = :id');
		$sth->execute(array(':id' => $id));
		$sth->setFetchMode(PDO::FETCH_OBJ);
		$user = $sth->fetch();
		$user->gravatar = get_gravatar($user->email, 80);
		return $user;
	}

	protected function spent_token($id) {
		$count = $this->db->exec("UPDATE `members` SET `forgot_hash` = NULL WHERE `id` = '$id'");
		if ( $count > 0 ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Grabs a single user from their email address
	 */
	public function get_user_from_email($email) {
		$sth = $this->db->prepare('SELECT `id`, `firstname`, `lastname`, `username`, `is_admin`, `email`, `redirect`, `status` FROM `members` WHERE `email` = :email');
		$sth->execute(array(':email' => $email));
		$sth->setFetchMode(PDO::FETCH_OBJ);
		return $sth->fetch();
	}

	protected function get_settings() {
		$sth = $this->db->prepare('SELECT * FROM `settings` ORDER BY `id` DESC LIMIT 1');
		$sth->execute();
		$sth->setFetchMode(PDO::FETCH_OBJ);
		return $sth->fetch();
	}

	public function current_status($num, $status) {
		if ($num == $status)
			return 'selected';
	}

	/**
	 * User friendly status
	 */
	public function status($status) {
		switch ($status) {
			case 0:
				return 'Awaiting Activation';
				break;
			case 1:
				return 'Activated';
				break;
			case 2:
				return 'Moderator';
				break;
			case 3:
				return 'Admin';
				break;
			case 4:
				return 'Banned';
				break;
			default:
				return 'Unknown';
				break;
		}
	}

	/**
	 * Checks to see if the user is logged in, if they are
	 * then it will redirect them to their login location.
	 */
	protected function is_logged_in() {
		if ( isset($_SESSION['LOCATION']) ) {
			header('Location: ' . URL . $_SESSION['LOCATION']);
			return true;
		}
	}

	/**
	 * refresh_data is called to update a members user data. ID is passed and
	 * the users session data will be refreshed.
	 */
	public function refresh_data($id) {
		$sth = $this->db->prepare('SELECT * FROM `members` WHERE `id` = :id');
		$sth->execute(array(':id' => $id));
		$sth->setFetchMode(PDO::FETCH_OBJ);
		if ( $sth->rowCount() > 0 ) {
			$row = $sth->fetch();
			$_SESSION['LOGGED_IN'] = true;
			$_SESSION['USER_ID'] = $row->id;
			$_SESSION['FIRSTNAME'] = $row->firstname;
			$_SESSION['LASTNAME'] = $row->lastname;
			$_SESSION['USERNAME'] = $row->username;
			$_SESSION['IS_ADMIN'] = ($row->is_admin == 1)?YES:NO;
			$_SESSION['EMAIL'] = $row->email;
			$_SESSION['LOCATION'] = $row->redirect;
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Checks to see if the user has entered the correct login details.
	 * If they have then it will redirect them to their success page.
	 */
	public function validate_user($user, $pass) {
 //make connection to dbase
//$connection = @mysql_connect(DB_HOST, DB_USER, DB_PASS)
//			or die(mysql_error());
//			
//$db = @mysql_select_db(DB_NAME,$connection)
//		or die(mysql_error());
//		// Clean the variables up.
//		$user=mysql_real_escape_string($user);
//		$pass=mysql_real_escape_string($pass);
//		$user = strip_tags($user);
//		$pass = strip_tags($pass);
//		$pass_hash = sha1($pass . SALT);

		// Build the query
		$sth = $this->db->prepare('SELECT * FROM `members` WHERE `username` = :username ');
		$sth->execute(array(':username' => $user));
		$sth->setFetchMode(PDO::FETCH_OBJ);

		// Check to see if the user has failed to login too many times.
		if ( !isset($_SESSION['LOGIN_ATTEMPTS']) )
			$_SESSION['LOGIN_ATTEMPTS'] = 0;

		if ($_SESSION['LOGIN_ATTEMPTS'] >= NUMBER_OF_ATTEMPTS) {
			return json_encode( array( 'error' => true, 'message' => 'Too many failed login attempts. Come back later!' ) );
		}

		if ($sth->rowCount() >= 1) {
			// We have a user.
			// Set the session variables.
			$row = $sth->fetch();
			if (validate_password($pass, $row->password) === FALSE) {
				$_SESSION['LOGIN_ATTEMPTS'] += 1;
				return json_encode(array(
					'error' => true,
					'message' => WORNG_LOGIN_DETAILS
				));
			}
			// Check to see if the user is banned.
			if ( $row->status == 4 ) {
				return json_encode(
					array(
						'error' => true,
						'message' => 'This account has been banned.'
					));
			}

			// Check to see if the account is inactive.
			if ( $row->status == 0 ) {
				return json_encode(
					   array('error' => true,
							 'message' => 'This account has not yet been activated. Please check your inbox!'
							));
			}
			$_SESSION['LOGGED_IN'] = true;
			$_SESSION['USER_ID'] = $row->id;
			$_SESSION['FIRSTNAME'] = $row->firstname;
			$_SESSION['LASTNAME'] = $row->lastname;
			$_SESSION['USERNAME'] = $row->username;
			$_SESSION['IS_ADMIN'] = ($row->is_admin == 1)?YES:NO;
			$_SESSION['EMAIL'] = $row->email;
			$_SESSION['LOCATION'] = $row->redirect;
			return json_encode(
				array('error' => false,
					  'message' => 'Success, welcome ' . $row->firstname . ' ' . $row->lastname . ' you are now logged in.',
					  'redirect' => $row->redirect)
				);
		} else {
			// No user.
			$_SESSION['LOGIN_ATTEMPTS'] += 1;
			return json_encode(array(
				'error' => true,
				'message' => WORNG_LOGIN_DETAILS
			));
		}

	}

	/**
	 * Validates email addresses
	 */
	protected function valid_email_address($email) {
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return false;
		} else {
			return true;
		}
	}

	/**
	 * Generates a random user password. I did this so administrators can't set user
	 * passwords instead they allow the system to set one.
	 */
	protected function random_password($len = 6) {
		$pass = "";
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@£$%^&*";
		$maxlen = strlen($chars);
		if ( $len > $maxlen )
			$len = $maxlen;
		$i = 0;
		while ($i < $len) {
			$rdm_char = substr($chars, mt_rand(0, $maxlen-1), 1);
			if (!strstr($pass, $rdm_char))
				$pass .= $rdm_char;
			$i++;
		}
		return $pass;
	}

	/**
	 * Verfies the user account and then emails them on success.
	 */
	public function verify_account($email, $code) {
		$stmt = $this->db->prepare("UPDATE `members` SET `status` = :status WHERE `email` = :email AND `forgot_hash` = :code");
		$stmt->execute(array(':status' => 1, ':email' => $email, ':code' => $code));
		$user = $this->get_user_from_email($email);

		// Send the user an email to let them know.

		if ( $stmt->rowCount() > 0 ) {
			// Changes have been made.
			Email::to($email);
			Email::from('no-reply@'.EMAIL_EXT);
			Email::subject('Account now Active | ' . SITE_NAME);
			Email::template(ROOT . '/templates/account_active.html', array(
				'username' => $user->username,
				'app_name' => SITE_NAME,
				'app_url' => LOGIN_LOCATION,
			));
			Email::send(); // Send the email.

			// return message(false, _rd('username', $username, USER_PROFILE_UPDATED));

			return true;

		} else return false;

	}

	/**
	 * Save the system settings.
	 */
	public function save_settings($allow_reg, $location) {
		$sth = $this->db->prepare('UPDATE `settings` SET `allow_registration` = :allow_reg, `redirect_location` = :location WHERE `id` = 1');
		if ($sth->execute(array('allow_reg' => $allow_reg, 'location' => $location))) {
			return array('error' => false, 'message' => 'Settings have been successfully saved.');
		}
	}

	/**
	 * Logs the user out destroys all their session and then
	 * redirects them back to the login (Default)
	 *
	 * @var <string> $location - Where to redirect the user after the logout is
	 * successful? Default is login.php you can also pass URLS
	 */
	public static function logout($location = 'login.php') {
		if (isset($_SESSION['LOGGED_IN'])) {
			if ( session_destroy() )
				header('Location: ' . URL . $location);
		} else header('Location: ' . URL . $location);
	}

}