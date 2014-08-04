<?php
require_once 'bootstrap.php';
secure_page();
$c = get_data();
include ('style.php');
require('config.php');
?>
<?php		
$user="$c->username";
$multi=$_POST['multiserver'];

if($multi == 0) {
 //make connection to dbase
$connection = @mysql_connect($hostname, $username, $password)
			or die(mysql_error());
			
$db = @mysql_select_db($databasename,$connection)
		or die(mysql_error());
}
else {
}
if($multi == 1) {
$connection = @mysql_connect($hostnames1, $usernames1, $passwords1)
			or die(mysql_error());
			
$db = @mysql_select_db($databasenames1,$connection)
		or die(mysql_error());
}
else {
}
if($multi == 2) {
$connection = @mysql_connect($hostnames2, $usernames2, $passwords2)
			or die(mysql_error());
			
$db = @mysql_select_db($databasenames2,$connection)
		or die(mysql_error());
}
else {
}
if($multi == 3) {
$connection = @mysql_connect($hostnames3, $usernames3, $passwords3)
			or die(mysql_error());
			
$db = @mysql_select_db($databasenames3,$connection)
		or die(mysql_error());
}
else {
}
if($multi == 4) {
$connection = @mysql_connect($hostnames4, $usernames4, $passwords4)
			or die(mysql_error());
			
$db = @mysql_select_db($databasenames4,$connection)
		or die(mysql_error());
}
else {
}
if($multi == 5) {
$connection = @mysql_connect($hostnames5, $usernames5, $passwords5)
			or die(mysql_error());
			
$db = @mysql_select_db($databasenames5,$connection)
		or die(mysql_error());
}
else {
}
if($multi == 6) {
$connection = @mysql_connect($hostnames6, $usernames6, $passwords6)
			or die(mysql_error());
			
$db = @mysql_select_db($databasenames6,$connection)
		or die(mysql_error());
}
else {
}
if($multi == 7) {
$connection = @mysql_connect($hostnames7, $usernames7, $passwords7)
			or die(mysql_error());
			
$db = @mysql_select_db($databasenames7,$connection)
		or die(mysql_error());
}
else {
}
if($multi == 8) {
$connection = @mysql_connect($hostnames8, $usernames8, $passwords8)
			or die(mysql_error());
			
$db = @mysql_select_db($databasenames8,$connection)
		or die(mysql_error());
}
else {
}
if($multi == 9) {
$connection = @mysql_connect($hostnames9, $usernames9, $passwords9)
			or die(mysql_error());
			
$db = @mysql_select_db($databasenames9,$connection)
		or die(mysql_error());
}
else {
}
if($multi == 10) {
$connection = @mysql_connect($hostnames10, $usernames10, $passwords10)
			or die(mysql_error());
			
$db = @mysql_select_db($databasenames10,$connection)
		or die(mysql_error());
}
else {
}


$multi=mysql_real_escape_string($multi);

?>
<center>

<?php

echo "<center><table border=0 bgcolor='#ffffff'><td align=center><font color=#880000>";




$ip=$_SERVER['REMOTE_ADDR'];



 $id=$_POST['who'];
 $id=mysql_real_escape_string($id);
  $idnew=$_POST['newcode'];
 $idnew=mysql_real_escape_string($idnew);
 $what=$_POST['item'];
 $what=mysql_real_escape_string($what);

$result33 = mysql_query("SELECT COUNT(*) FROM `$objecttable` WHERE CharacterID='$id' AND Classname='$what'");
if (!$result33) {
    die(mysql_error());
}
if (mysql_result($result33, 0, 0) > 1) {
 echo "ERROR: Two Items Exist with the same code, For safety, this code cannot be changed";	
  exit();
} else {
}

if (mysql_result($result33, 0, 0) > 0) {

mysql_query("UPDATE `$objecttable` SET CharacterID='$idnew' WHERE CharacterID='$id' AND Classname='$what'");

} 
else {
 echo "ERROR: No Item found with that code<P>This Attempt has been flagged and sent to the Admin<P>Repeated Attempts may result in a ban";
echo "<P><a href=welcome.php>Home</a>";
$today = date("Ymd");
$mailheaders = "From: Donation Manager \n";
$mailheaders .= " $user at $ip has attempted to locate an Item with a combo of $id , but no Item was located with the code entered. .\n";
$mailheaders .= " If this is the only warning message you are receiving, it could have been a mistake, if you are getting multiple warnings, this could be an attempt to break into someone's Base!  .  .\n";
$mailheaders .= "You can reach this user at $emaild :\n";


$to = "$emailforbuynotice";
$subject = "Warning From Epoch Donation Manager";

mail($to, $subject, $mailheaders, "From: No Reply <blackhole@es-gamers.com>\n");
 	
exit();
}



echo "Success, New Code Entered<P>This Code will be usable after server reboot!";
echo "<P><a href=welcome.php>Home</a>";
        
   
	 
?>
