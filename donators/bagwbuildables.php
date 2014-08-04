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
<TABLE BORDER=1 style="width:500px"><th bgcolor="#003399"> <center><h3><font color=#ffffff>Large Gunbag with Building Supplies</font> </h3><TR><TD>

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
			if($allowbuildloot == 0) {
		echo "Server Administrator Has Disabled This Feature";
		exit();
}
else {
}
	$whois="<form enctype=multipart/form-data action=packobuild.php method=POST><input type=hidden name=player value=$guid ><input type=hidden name=cash value=$tokens ><input type=image src=images/doit.png></form>";
if($tokens >= $coinsforbuildingsupplies) {
echo "<center>Warning: You must be in the lobby, or Logged out of the server<P>having a character still in game will result in you losing your tokens<P>";
}
else {
	Echo "<center>you do not have enough tokens, please donate";
	exit();
	}
	
	
if($tokens >= $coinsforbuildingsupplies) {
	
$whois="<form enctype=multipart/form-data action=packobuild.php method=POST>
<input type=hidden name=player value=$guid >
<input type=hidden name=package value=1 >
<input type=hidden name=cash value=$tokens >
<input type=image src=images/doit.png></form>";
echo "<center>Use $coinsforbuildingsupplies Token(s) from your stash of $tokens<P>

<font color=red>Package 1:</font> $buildlootdescp1
<P>
$whois
<P>";
}
else {
}
if($tokens >= $coinsforbuildingsupplies2) {
	
$whois2="<form enctype=multipart/form-data action=packobuild.php method=POST>
<input type=hidden name=player value=$guid >
<input type=hidden name=package value=2 >
<input type=hidden name=cash value=$tokens >
<input type=image src=images/doit.png></form>";
echo "<center>Use $coinsforbuildingsupplies2 Token(s) from your stash of $tokens<P>

<font color=red>Package 2:</font> $buildlootdescp2
<P>
$whois2
<P>";
}
else {
}
if($tokens >= $coinsforbuildingsupplies3) {
	
$whois3="<form enctype=multipart/form-data action=packobuild.php method=POST>
<input type=hidden name=player value=$guid >
<input type=hidden name=package value=3 >
<input type=hidden name=cash value=$tokens >
<input type=image src=images/doit.png></form>";
echo "<center>Use $coinsforbuildingsupplies3 Token(s) from your stash of $tokens<P>

<font color=red>Package 3:</font> $buildlootdescp3
<P>
$whois3
<P>";
}
else {
}	
	
	
	
}

	mysql_free_result($result);
?>
</TD></TR></TABLE> 
 <P> 
<BODY></HTML>