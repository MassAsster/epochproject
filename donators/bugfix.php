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


<P>
<TABLE BORDER=1><th bgcolor="#003399"> <center><h3><font color=#ffffff>Hour Glass Timer Fix</font> </h3><TR><TD>

<?php
$connection = @mysql_connect($server, $dbusername, $dbpassword)
			or die(mysql_error());
			
$db = @mysql_select_db($db_name,$connection)
			or die(mysql_error());
			
			
$result = mysql_query("SELECT * FROM authorize WHERE username='$user'");

while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    printf("<center><table border=0 bgcolor='#ffffff'><td align=center><font color=#880000><h3>User:</font> %s </h3>Tokens Remaining: %s <P> <font color=#880000>Player ID:</font> %s <P>", $row["username"], $row["tokens"], $row["guid"] );

}

$query = "SELECT tokens, guid, COUNT(tokens) FROM authorize WHERE username = '$user'"; 
	 
$result = mysql_query($query) or die(mysql_error());

// Print out result
while($row = mysql_fetch_array($result)){
	$tokens="". $row['tokens'] ."";
	$guid="". $row['guid'] ."";
	if($guid == 0) {
		echo "You have not set up your Profile ID";
		exit();
		}
		else {
			}
if($allowbugfix == 0) {
		echo "Server Administrator Has Disabled This Feature";
		exit();
}
else {
}
	$whois="<form enctype=multipart/form-data action=fixme.php method=POST><input type=hidden name=player value=$guid ><input type=hidden name=cash value=$tokens ><input type=image src=images/doit.png></form>";
if($tokens >= $coinsforbugfix) {
echo "<center>Use $coinsforbugfix Token(s) from your stash of $tokens <P> Fix a character stuck with that long hour glass<br> timer that refuses to wake up  $whois <P> Warning: Make sure you are logged out of the game<P>having a character in the game will cause this to fail";
}
else {
	Echo "<center>you do not have enough tokens, please donate";
	}
}

	mysql_free_result($result);
?>
</TD></TR></TABLE> 
 <P> 
<BODY></HTML>