<?php	
require_once 'bootstrap.php';
secure_page();
$c = get_data();	
include ('style.php');
require('config.php');
?>

<?php



$user="$c->username";
 $pname=$_POST['player'];
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
 
 $pname=mysql_real_escape_string($pname);
 
if($multicharactersupport == 1 ) {
$slot=$_POST['slot'];
$slot=mysql_real_escape_string($slot);
}
else {
}
$multi=mysql_real_escape_string($multi);


if($multicharactersupport == 1 ) {
$result44 = mysql_query("SELECT COUNT(*) FROM $chartablename WHERE PlayerUID='$pname' AND Alive='1' AND Slot='$slot'");
}
else {
$result44 = mysql_query("SELECT COUNT(*) FROM $chartablename WHERE PlayerUID='$pname' AND Alive='1'");
}

if (!$result44) {
    die(mysql_error());
    }
if (mysql_result($result44, 0, 0) == 0) {
Echo "<center><font color=red>You do not have a character that is currently alive.";
exit();
}
else {
	}
if($multicharactersupport == 1 ) {
$result = mysql_query("SELECT * FROM $chartablename WHERE PlayerUID='$pname' AND Alive='1' AND Slot='$slot'");
}
else {
$result = mysql_query("SELECT * FROM $chartablename WHERE PlayerUID='$pname' AND Alive='1'");
}
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
//$result4 = mysql_query("SELECT * FROM Player_DATA WHERE PlayerUID='$idname'");

$zombiekills="". $row['KillsZ'] ."";
$banditkills="". $row['KillsB'] ."";
$humankills="". $row['KillsH'] ."";
if($zombiekills==0) {
	echo "No zombie kills to process, bank not active";
	exit();
}
else {
} 
$zombietotal = $zombiekills * $zombieweight;
$bandittotal = $banditkills * $banditweight;
$humantotal = $humankills * $humanweight;

$thetotal = ($zombietotal + $bandittotal) - $humantotal;


       $connection = @mysql_connect($server, $dbusername, $dbpassword)
			or die(mysql_error());
			
$db = @mysql_select_db($db_name,$connection)
			or die(mysql_error()); 


$query11 = "SELECT tokens, guid, COUNT(tokens) FROM authorize WHERE guid = '$pname'"; 

$result11 = mysql_query($query11) or die(mysql_error());

// Print out result
while($row = mysql_fetch_array($result11)){
	$tokens32="". $row['tokens'] ."";
	$guid="". $row['guid'] ."";
$updateit = $tokens32 + $thetotal;
mysql_query("UPDATE `authorize` SET tokens='$updateit' WHERE guid='$guid'");	

echo "<center><table border=0 bgcolor='#ffffff'><td align=center><font color=#880000>";
echo "<center>Token Bank: <P>Tokens Already Had: $tokens32<P> 
Token Math:<P>Zombie Kills: $zombiekills , worth $zombieweight each. $zombietotal total <P>
Bandit Kills: $banditkills , worth $banditweight each. $bandittotal total <P>
Human Kills: $humankills , minus $humanweight each. $humantotal total lost tokens <P>
Tally new tokens: $thetotal<P>
Final token balance: $updateit


";

if($multicharactersupport == 0 ) {
mysql_query("UPDATE `$chartablename` SET KillsZ='0', KillsB='0' WHERE PlayerUID='$pname' AND Alive='1'");
}
else {
mysql_query("UPDATE `$chartablename` SET KillsZ='0', KillsB='0' WHERE PlayerUID='$pname' AND Alive='1' AND Slot='$slot'");
}
}
}
?>