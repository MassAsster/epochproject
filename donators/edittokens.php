<?php
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
 
 //make connection to dbase
$connection = @mysql_connect($server, $dbusername, $dbpassword)
			or die(mysql_error());
			
$db = @mysql_select_db($db_name,$connection)
		or die(mysql_error());


 //This gets all the other information from the form 
 $stat=$_POST['player'];
$stat=mysql_real_escape_string($stat);

$query = "SELECT tokens, guid, COUNT(tokens) FROM authorize WHERE username = '$stat'"; 
	 
$result = mysql_query($query) or die(mysql_error());

// Print out result
while($row = mysql_fetch_array($result)){
	$tokens="". $row['tokens'] ."";
Echo " $stat has $tokens Tokens ";	
$whois="<form enctype=multipart/form-data action=edittokens2.php method=POST><input type=hidden name=player value='$stat' ><input type=text name=newtoken size=5><input type=image src=images/doit.png></form>";
Echo "<P>Enter New Token Value : <P> $whois";
}







  

  

  
 ?> 
