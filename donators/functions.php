<?php

//function to get the date
function last_login()
{
	$date = gmdate("Y-m-d");
	return $date;
}

//function that sets the session variable
function sess_vars($base_dir, $server, $dbusername, $dbpassword, $db_name, $table_name, $user, $pass)
{


	//make connection to dbase
	$connection = @mysql_connect($server, $dbusername, $dbpassword)
				or die(mysql_error());
				
	$db = @mysql_select_db($db_name,$connection)
				or die(mysql_error());
				
	$sql = "SELECT * FROM $table_name WHERE username = '$user' and password = password('$pass')";

	$result = @mysql_query($sql, $connection) or die(mysql_error());


	//get the number of rows in the result set
	$num = mysql_num_rows($result);

	//set session variables if there is a match
	if ($num != 0) 
	{
		while ($sql = mysql_fetch_object($result)) 
		{
			$_SESSION[first_name] 	= $sql -> firstname;
			$_SESSION[last_name] 	= $sql -> lastname; 
			$_SESSION[user_name] 	= $sql -> username;       
			$_SESSION[password] 	= $sql -> password;
			$_SESSION[group1]	 	= $sql -> group1;
			$_SESSION[group2]	 	= $sql -> group2;
			$_SESSION[group3] 		= $sql -> group3;
			$_SESSION[pchange]		= $sql -> pchange;  
			$_SESSION[email] 		= $sql -> email;
			$_SESSION[redirect]		= $sql -> redirect;
			$_SESSION[verified]		= $sql -> verified;
			$_SESSION[last_login]	= $sql -> last_login;
		}
	}else{
		$_SESSION[redirect] = "$base_dir/errorlogin.html";
	}
}

//functions that will determine if access is allowed
function allow_access($group)
{
	if ($_SESSION[group1] == "$group" || $_SESSION[group2] == "$group" || $_SESSION[group3] == "$group" ||
		$_SESSION[group1] == "Administrators" || $_SESSION[group2] == "Administrators" || $_SESSION[group3] == "Administrators" ||
		$_SESSION[user_name] == "$group")
		{
			$allowed = "yes";
		}else{
			$allowed = "no";
		}
	return $allowed;
}

//function to check the length of the requested password
function password_check($min_pass, $max_pass, $pass)
{

	$valid = "yes";
	if ($min_pass > strlen($pass) || $max_pass < strlen($pass))
	{
		$valid = "no";
	}

	return $valid;
}

?>