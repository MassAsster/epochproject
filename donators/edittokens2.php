<?php
require_once 'bootstrap.php';
$c = secure_page_admin();
$c = get_data();
include ('style.php');
require('config.php');
?>
<?php		
$user="$c->username";
?>
<?php 
 
 //make connection to dbase
$connection = @mysql_connect($server, $dbusername, $dbpassword)
			or die(mysql_error());
			
$db = @mysql_select_db($db_name,$connection)
		or die(mysql_error());


 //This gets all the other information from the form 
 $stat=$_POST['player'];
$stat=mysql_real_escape_string($stat);
 $tokes=$_POST['newtoken'];
$tokes=mysql_real_escape_string($tokes);



if($logging == 1) {
$date = date('Y-m-d H:i:s');
mysql_query("INSERT INTO `donatorlog` (`date`, `user`, `action`) VALUES
 ('$date', '$user', 'Admin: updated $stat tokens to $tokes ');");
}
mysql_query("UPDATE `authorize` SET tokens='$tokes' WHERE username='$stat' ");



  echo "Player $stat updated to $tokes Tokens <P> <a href='manage_users.php'>Back</a> ";

  

  
 ?> 
