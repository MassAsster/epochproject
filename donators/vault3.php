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

	 
?>
<table cellspacing='0' cellpadding='10' border='1' bordercolor='#000000'><tr><td>
<P>
<form enctype=multipart/form-data action=vault4.php method=POST>
<table cellspacing='0' cellpadding='10' border='0' bordercolor='#000000'>
   <tr>
      <td>
         <table cellspacing='2' cellpadding='2' border='0'>
            <tr>
            <td align='right'>User:
            <td> <?php $ip=$_SERVER['REMOTE_ADDR']; echo " $user at $ip"; ?>
            <tr>
               <td align='right' class='normal_field'>Current Code</td>
               <td class='element_label'>
                  <input type='text' name='who' placeholder="NUMBERS ONLY" size='10'><td> 
               </td>
       </tr>
                   <tr>
               <td align='right' class='normal_field'>New Code</td>
               <td class='element_label'>
                  <input type='text' name='newcode' placeholder="NUMBERS ONLY" size='10'><td> 
               </td>
       </tr>
                   <tr>
               <td align='right' class='normal_field'>Item Type</td>
               <td class='element_label'>
                  <select name='item'>
<option value='VaultStorageLocked'>Locked Vault</option>
<option value='Land_DZE_WoodDoorLocked'>Wood Door</option>
<option value='Land_DZE_LargeWoodDoorLocked'>Wood Garage Door</option>
<option value='LockboxStorageLocked'>LockBox</option>
<option value='CinderWallDoorLocked_DZ'>CinderWallGarageDoor</option>
<option value='CinderWallDoorSmallLocked_DZ'>CinderWallDoor</option>
</select>
<td>
               </td>
       </tr>
                          <tr>
               <td align='right' class='normal_field'>Warning: New code must match the length of old code.<P>If old code is 3 Digits, new code must be 3 Digits.<P>Failure to follow this will result in loss of access to your item.</td>
       </tr>
            <tr>
               <td colspan='2' align='center'>
               
               <input type=hidden name=multiserver value=<?php echo "$multi"; ?> >
                  <input type='submit' name='Submit' value='Submit'>
               </td>
            </tr>
            
         </table>
      </td>
   </tr>
</table>
</form>
</body>
<html>