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
 
 $multi=$_POST['multiserver'];

 $slot=$_POST['slot'];

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

 $stat2=$_POST['player'];
$stat2=mysql_real_escape_string($stat2);
$multi=mysql_real_escape_string($multi);
$slot=mysql_real_escape_string($slot);
$theitem=$_POST['part'];
$theitem=mysql_real_escape_string($theitem);
$car=$_POST['iscar'];
$car=mysql_real_escape_string($car);
$emaild=$_POST['email'];
$emaild=mysql_real_escape_string($emaild);

if($multi == 0) {
$instancer = $instance;
}
if($multi == 1) {
$instancer = $s1instance;
}
if($multi == 2) {
$instancer = $s2instance;
}
if($multi == 3) {
$instancer = $s3instance;
}
if($multi == 4) {
$instancer = $s4instance;
}
if($multi == 5) {
$instancer = $s5instance;
}
if($multi == 6) {
$instancer = $s6instance;
}
if($multi == 7) {
$instancer = $s7instance;
}
if($multi == 8) {
$instancer = $s8instance;
}
if($multi == 9) {
$instancer = $s9instance;
}
if($multi == 10) {
$instancer = $s10instance;
}

if($multicharactersupport == 1) {
$query = "SELECT Worldspace, MAX(CharacterID) FROM $chartablename WHERE PlayerUID = '$stat2' AND Slot = '$slot' AND Alive = 1"; 
}
else {
$query = "SELECT Worldspace, MAX(CharacterID) FROM $chartablename WHERE PlayerUID = '$stat2' AND Alive = 1"; 
	 
} 
$result = mysql_query($query) or die(mysql_error());

// Print out result
while($row = mysql_fetch_array($result)){
	$charda="". $row['MAX(CharacterID)'] ."";
	$location="". $row['Worldspace'] ."";
$randomnumber = rand(10000000,90000000);
$date = date('Y-m-d H:i:s');
if($car == 1) {
$fuel = 1.00000;
$inventoryset = "[[[],[]],[[],[]],[[],[]]]";
$idme = 0;
}
if($car == 0) {
$fuel = 0.00000;
$inventoryset = "[]";
$idme = rand(100,9000);
}
mysql_query("INSERT INTO `$objecttable` (`ObjectUID`, `Instance`, `Classname`, `Datestamp`, `LastUpdated`, `CharacterID`, `Worldspace`, `Inventory`, `Hitpoints`, `Fuel`, `Damage`) VALUES
 ('$randomnumber', '$instancer', '$theitem', '$date', '$date', '$idme', '$location', '$inventoryset', '[]', '$fuel', '0.00000');");
echo "<TABLE BORDER=1 style='width:400px'><th bgcolor='#003399'> <center><h3><font color=#ffffff>Processing</font> </h3><TR><TD>
<center><table border=0 bgcolor='#ffffff'><td align=center>
<td>";


$today = date("Ymd");
$mailheaders = "From: Donation Manager \n";
$mailheaders .= " $user has paid for a $theitem at $location it has been assigned object number $randomnumber .\n";
$mailheaders .= " No Further Action by you is required.  .\n";
$mailheaders .= "You can reach this user at $emaild :\n";


$to = "$emailforbuynotice";
$subject = "Epoch Donation Manager";

mail($to, $subject, $mailheaders, "From: No Reply <blackhole@es-gamers.com>\n");



Echo "Transaction in-progress<P> Item being applied to Database<P>";
echo "Please wait...<P><img src=images/loader.gif><P></td></table>";
}


?>




  
 
