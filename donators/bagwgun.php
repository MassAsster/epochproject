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
<TABLE BORDER=1 style='width:500px'><th bgcolor="#003399"> <center><h3><font color=#ffffff>Large Gunbag with Gun, Medical & Food</font> </h3><TR><TD>

<?php
$connection = @mysql_connect($server, $dbusername, $dbpassword)
			or die(mysql_error());
			
$db = @mysql_select_db($db_name,$connection)
			or die(mysql_error());
			
			
$result = mysql_query("SELECT * FROM authorize WHERE username='$user'");

while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    printf("<center><table border=0 bgcolor='#ffffff'><td align=center><tr><font color=#880000><h3>User:</font> %s </h3>Tokens Remaining: %s <P> <font color=#880000>Player ID:</font> %s <P></tr>", $row["username"], $row["tokens"], $row["guid"] );

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
			if($allowstartergear == 0) {
		echo "Server Administrator Has Disabled This Feature";
		exit();
}
else {
}

if($tokens >= $coinsforbagoguns) {
	
	
$whois="<form enctype=multipart/form-data action=packogun.php method=POST>
<select name='package'>
<option value='1'>Package 1</option>
<option value='2'>Package 2</option>
<option value='3'>Package 3</option>
</select>	
<input type=hidden name=player value=$guid >
<input type=hidden name=cash value=$tokens >
<input type=image src=images/doit.png></form>";
echo "<tr><center><font color=#000033><h3>Use $coinsforbagoguns Token(s) from your stash of $tokens</h3><tr><P>

<font color=red>Package 1:</font> $startlootp1desc<tr>
<P>
<font color=red>Package 2:</font> $startlootp2desc<tr>
<P>
<font color=red>Package 3:</font> $startlootp3desc<tr>
<P>
$whois
<P></tr>";
}
else {
	Echo "<center>you do not have enough tokens, please donate";
	exit();
}
if($tokens >= $coinsforbagoguns2 ) {
		$whois2="<form enctype=multipart/form-data action=packogun.php method=POST>
<select name='package'>
<option value='4'>Package 4</option>
<option value='5'>Package 5</option>
<option value='6'>Package 6</option>
</select>	
<input type=hidden name=player value=$guid >
<input type=hidden name=cash value=$tokens >
<input type=image src=images/doit.png></form>";
echo "<center><h3>Use $coinsforbagoguns2 Token(s) from your stash of $tokens</h3><P>

<font color=red>Package 4:</font> $startlootp4desc
<P>
<font color=red>Package 5:</font> $startlootp5desc
<P>
<font color=red>Package 6:</font> $startlootp6desc
<P>
$whois2 
<P>";
}
else {
}
if($tokens >= $coinsforbagoguns3 ) {
		$whois3="<form enctype=multipart/form-data action=packogun.php method=POST>
<select name='package'>
<option value='7'>Package 7</option>
<option value='8'>Package 8</option>
<option value='9'>Package 9</option>
</select>	
<input type=hidden name=player value=$guid >
<input type=hidden name=cash value=$tokens >
<input type=image src=images/doit.png></form>";
echo "<center><h3>Use $coinsforbagoguns3 Token(s) from your stash of $tokens</h3><P>

<font color=red>Package 7:</font> $startlootp7desc
<P>
<font color=red>Package 8:</font> $startlootp8desc
<P>
<font color=red>Package 9:</font> $startlootp9desc
<P>
$whois3
<P>";
}
else {
}
Echo "<P> Warning: You must be in the lobby, or Logged out of the server<P>having a character still in game will result in you losing your tokens";


}

	mysql_free_result($result);
?>
</TD></TR></TABLE> 
 <P> 
<BODY></HTML>