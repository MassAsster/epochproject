<?php
header( "refresh:10;url=thanks.php?thankyou=1" );
require_once 'bootstrap.php';
secure_page();
$c = get_data();
include ('style.php');
require('config.php');
?>
<?php		
$user="$c->username";
?>
<?php 

 $stat2=$_POST['player'];


 $pack=$_POST['package'];
  $slot=$_POST['slot'];

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
if($pack == 1) {
	$loadout = $mystarterlootp1;
}
else {
}
if($pack == 2) {
	$loadout = $mystarterlootp2;
}
else {
}
if($pack == 3) {
	$loadout = $mystarterlootp3;
}
else {
}
if($pack == 4) {
	$loadout = $mystarterlootp4;
}
else {
}
if($pack == 5) {
	$loadout = $mystarterlootp5;
}
else {
}
if($pack == 6) {
	$loadout = $mystarterlootp6;
}
else {
}if($pack == 7) {
	$loadout = $mystarterlootp7;
}
else {
}
if($pack == 8) {
	$loadout = $mystarterlootp8;
}
else {
}
if($pack == 9) {
	$loadout = $mystarterlootp9;
}
else {
}

$multi=mysql_real_escape_string($multi);
$pack=mysql_real_escape_string($pack);
$stat2=mysql_real_escape_string($stat2);
$slot=mysql_real_escape_string($slot);

if($multicharactersupport == 1) {
$query = "SELECT Datestamp, MAX(CharacterID) FROM $chartablename WHERE PlayerUID = '$stat2' AND Slot = '$slot'"; 
	}
	else {
		$query = "SELECT Datestamp, MAX(CharacterID) FROM $chartablename WHERE PlayerUID = '$stat2'"; 
	}
$result = mysql_query($query) or die(mysql_error());

// Print out result
while($row = mysql_fetch_array($result)){
	$charda="". $row['MAX(CharacterID)'] ."";
	if($multicharactersupport == 1) {
mysql_query("UPDATE `$chartablename` SET Backpack='$loadout' WHERE CharacterID='$charda' AND Slot = '$slot'");
}
else {
mysql_query("UPDATE `$chartablename` SET Backpack='$loadout' WHERE CharacterID='$charda'");
}

}
echo "<TABLE BORDER=1 style='width:400px'><th bgcolor='#003399'> <center><h3><font color=#ffffff>Processing</font> </h3><TR><TD>
<center><table border=0 bgcolor='#ffffff'><td align=center>
<td>";
Echo "Transaction in-progress<P>";
echo "Please wait...<P><img src=images/loader.gif></td></table>";

?>




  
 
