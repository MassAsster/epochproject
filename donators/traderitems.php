<?php
require_once 'bootstrap.php';
$c = secure_page_admin();
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
$multi=mysql_real_escape_string($multi);
$query = "SELECT COUNT(id), id, item, qty, tid FROM $tradersdata GROUP BY id ORDER BY qty DESC"; 
	 
$result = mysql_query($query) or die(mysql_error());

// Print out result
while($row = mysql_fetch_array($result)){
	$id="". $row['id'] ."";
	$item="". $row['item'] ."";
	$tid="". $row['tid'] ."";
	$qty="". $row['qty'] ."";
	
$whois="<form enctype=multipart/form-data action=traderitems2.php method=POST><input type=hidden name=server value='$multi' ><input type=hidden name=id value='$id' ><input type=text name=newqty size=4><input type='submit' value='Edit QTY'></form>";
echo "<table border=0 width=800 bgcolor=\"#ffffff\"><tr><td width=25%><font color=blue>Item:</font><font color=red>$item</font>";
echo "</td><td width=25%><font color=blue>QTY:</font> <font color=red>$qty</font> </td><td width=25%><font color=blue>Trader:</font> <font color=red>$tid</font></td><td width=25%> $whois</td></table>";
	echo "<br />";
}
?>
</TD></TR></TABLE> 
 <P> 
<BODY></HTML>