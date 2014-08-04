<?php	
require_once 'bootstrap.php';
secure_page();
$c = get_data();	
include ('style.php');
require('config.php');
?>

<?php
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

			
			
$pname=$_POST['player'];
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
$lastlogin="". $row['LastLogin'] ."";
$deaths="". $row['Generation'] ."";
$zombiekills="". $row['KillsZ'] ."";
$banditkills="". $row['KillsB'] ."";
$humankills="". $row['KillsH'] ."";
$headshotkills="". $row['HeadshotsZ'] ."";
$humanity="". $row['Humanity'] ."";
$model="". $row['Model'] ."";
$inventory="". $row['Inventory'] ."";
$backpack="". $row['Backpack'] ."";

$distance="". $row['DistanceFoot'] ."";
$humanity="". $row['Humanity'] ."";
$uniform2="". $row['Model'] ."";
if($uniform2 == "\"Survivor2_DZ\"") {
	$uniform = "Survivor2_DZ";
	}
	else {
		$uniform = "$uniform2";
		}
//$formattedinventory=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', 'BQR ', $inventory);


		printf("<table border=0 width=600 bgcolor=\"$t3\" cellspacing=\"0\"> <td bgcolor=$t4><center><font color=$t5>Player:</font> $pname<td bgcolor=$t4>  <td align=right bgcolor=$t4> <img src=images/epochlogo.png><td bgcolor=$t4><tr><td bgcolor=$t4><center><P><img height=250 width=100 src=images/$uniform.png></td>
		<td></td>
		<td>
<table border=0 cellpadding='10'><tr><td>		
		<font color=$t5>Deaths</font> %s <P><font color=$t5>Kills:<P></font> Zombies: <font color=#00FF00>%s</font><P>  Bandits: <font color=green>%s</font><P>Players: <font color=red>%s</font> <P><font color=$t5>HeadShots: </font>%s <P>  </td>
</td><td><font color=$t5>Last Seen On: </font>$lastlogin<P><font color=$t5>Distance Traveled:</font> $distance Meters<P><font color=$t5>Humanity:</font> $humanity</td></table>		
		<td><center></a></td>
		<tr><td bgcolor=$t4><center><font color=$t5></font><P></td>
		<td></td>
		<td><font color=$t5>Inventory:</font><P> ", $row["Generation"], $row["KillsZ"], $row["KillsB"], $row["KillsH"], $row["HeadshotsZ"] );
$string = $inventory;
$patterns = array();
$patterns[0] = '/\[\[\"/';
$patterns[1] = '/\"\,/';
$patterns[2] = '/\"\]/';
//$patterns[3] = '/\[\"/';
//$patterns[4] = '/\"/';
$replacements = array();
//$replacements[4] = '<img src=';
//$replacements[3] = '<img src=';
$replacements[2] = '<img src=images/';
$replacements[1] = '.png>';
$replacements[0] = '.png>';
//echo preg_replace($patterns, $replacements, $string);


$string2 = preg_replace($patterns, $replacements, $string);
$patterns2 = array();
$patterns2[0] = '/\"/';
//$patterns2[1] = '/,\[/';
$replacements2 = array();
//$replacements2[1] = '';
$replacements2[0] = '<img src=images/';
//echo preg_replace($patterns2, $replacements2, $string2);

$string3 = preg_replace($patterns2, $replacements2, $string2);
$patterns3 = array();
$patterns3[0] = '/\]/';
$patterns3[1] = '/,\[/';
$patterns3[2] = '/\[/';
$patterns3[3] = '/\,/';
$replacements3 = array();
$replacements3[3] = '';
$replacements3[2] = '';
$replacements3[1] = '';
$replacements3[0] = '';
//echo preg_replace($patterns3, $replacements3, $string3);

$string4 = preg_replace($patterns3, $replacements3, $string3);
$patterns4 = array();
$patterns4[0] = '/Green\d+/';
$patterns4[1] = '/Blue\d+/';
$patterns4[2] = '/Yellow\d+/';
$patterns4[3] = '/Black\d+/';
$patterns4[4] = '/Red\d+/';
$replacements4 = array();
$replacements4[4] = 'Red';
$replacements4[3] = 'Black';
$replacements4[2] = 'Yellow';
$replacements4[1] = 'Blue';
$replacements4[0] = 'Green';
echo preg_replace($patterns4, $replacements4, $string4);


echo "<P> <font color=$t5>BackPack: </font><P>";
$string5 = $backpack;
$patterns5 = array();
$patterns5[0] = '/\[\[\"/';
$patterns5[1] = '/\"\,/';
$patterns5[2] = '/\"\]/';
$replacements5 = array();
$replacements5[2] = '<img src=images/';
$replacements5[1] = '.png>';
$replacements5[0] = '.png>';



$string6 = preg_replace($patterns5, $replacements5, $string5);
$patterns6 = array();
$patterns6[0] = '/\"/';
$replacements6 = array();
$replacements6[0] = '<img src=images/';

$string7 = preg_replace($patterns6, $replacements6, $string6);
$patterns7 = array();
$patterns7[0] = '/\]/';
$patterns7[1] = '/,\[/';
$replacements7 = array();
$replacements7[1] = '';
$replacements7[0] = '';


$string8 = preg_replace($patterns7, $replacements7, $string7);
$patterns8 = array();
$patterns8[0] = '/Green\d+/';
$patterns8[1] = '/Blue\d+/';
$patterns8[2] = '/Yellow\d+/';
$patterns8[3] = '/Black\d+/';
$patterns8[4] = '/Red\d+/';
$replacements8 = array();
$replacements8[4] = 'Red';
$replacements8[3] = 'Black';
$replacements8[2] = 'Yellow';
$replacements8[1] = 'Blue';
$replacements8[0] = 'Green';


$string9 = preg_replace($patterns7, $replacements7, $string7);
$patterns9 = array();
$patterns9[0] = '/\[/';
$patterns9[1] = '/\[\[/';
$replacements9 = array();
$replacements9[1] = '';
$replacements9[0] = '';


echo preg_replace($patterns9, $replacements9, $string9);



echo "</td><td></table><P>";
}
if($mutliserversetup ==1) {
include ('genstats.php');
}
?>