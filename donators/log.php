<?php
require_once 'bootstrap.php';
$c = secure_page_admin();
$c = get_data();
include ('style.php');
require('config.php');
?>
<?php		


$connection = @mysql_connect($server, $dbusername, $dbpassword)
			or die(mysql_error());
			
$db = @mysql_select_db($db_name,$connection)
		or die(mysql_error());
$query = "SELECT COUNT(date), date, user, action FROM `donatorlog` GROUP BY date ORDER BY date DESC"; 
	 
$result = mysql_query($query) or die(mysql_error());

// Print out result
while($row = mysql_fetch_array($result)){
	$id="". $row['date'] ."";
	$user="". $row['user'] ."";
	$action="". $row['action'] ."";
	

echo "<table border=0 width=800 bgcolor=\"#ffffff\"><tr><td width=25%><font color=blue>Date:</font><font color=red>$id</font>";
echo "</td><td width=25%><font color=blue>User:</font> <font color=red>$user</font> </td><td width=50%><font color=blue>Action:</font> <font color=red>$action</font></td></table>";
	echo "<br />";
}
?>
</TD></TR></TABLE> 
 <P> 
<BODY></HTML>