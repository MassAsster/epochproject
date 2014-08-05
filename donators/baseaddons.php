<?php
require_once 'bootstrap.php';
secure_page();
$c = get_data();
include ('style.php');
require('config.php');
	
$user="$c->username";
$email="$c->email";
?>


<P>
<TABLE BORDER=1><th bgcolor="#003399"> <center><h3><font color=#ffffff>Build-O-Base</font> </h3><TR><TD>

<?php

			
			
$query = $c->db->prepare("SELECT * FROM authorize WHERE username=:user");
$query->execute(array(':user' => $user));

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    printf("<center><table border=0 bgcolor='#ffffff'><td align=center><font color=#880000><h3>User:</font> %s </h3>Tokens Remaining: %s <P> <font color=#880000>Player ID:</font> %s <P>", $row["username"], $row["tokens"], $row["guid"] );
}

$query = $c->db->prepare("SELECT tokens, guid, COUNT(tokens) FROM authorize WHERE username = :user"); 
$query->execute(array(':user' => $user));
	 

// Print out result
while($row = $query->fetch(PDO::FETCH_ASSOC)){
	$tokens="". $row['tokens'] ."";
	$guid="". $row['guid'] ."";
	if($guid == 0) {
		echo "You have not set up your Profile ID";
		exit();
		}
		else {
			}
if($allowbuildobase == 0) {
		echo "Server Administrator Has Disabled This Feature";
		exit();
}
else {
}



$build1="<form enctype=multipart/form-data action=baseaddons1.php method=POST><input type=hidden name=playername value=$user ><input type=hidden name=baseitem value=small ><input type=image src=images/doit.png></form>";

$build2="<form enctype=multipart/form-data action=baseaddons1.php method=POST><input type=hidden name=playername value=$user ><input type=hidden name=baseitem value=large ><input type=image src=images/doit.png></form>";

$build3="<form enctype=multipart/form-data action=baseaddons1.php method=POST><input type=hidden name=playername value=$user ><input type=hidden name=baseitem value=vehicle ><input type=image src=images/doit.png></form>";

$build4="<form enctype=multipart/form-data action=baseaddons1.php method=POST><input type=hidden name=playername value=$user ><input type=hidden name=baseitem value=helicopter ><input type=image src=images/doit.png></form>";

if($tokens >= $coinsforsmallitems) {
echo "<center>Use $coinsforsmallitems Token(s) from your stash of $tokens <P>$buildobase $build1<P>";
}
else {
	Echo "<center>you do not have enough tokens, please donate";
	exit();
	}
if($tokens >= $coinsforlargeitems) {
echo "<center>Use $coinsforlargeitems Token(s) from your stash of $tokens <P>$buildobase2 $build2<P>";
}
else {
	Echo "<center>you do not have enough tokens for a Large Base Item, please donate";
	}
	if($tokens >= $coinsforvehicleitem) {
echo "<center>Use $coinsforvehicleitem Token(s) from your stash of $tokens <P>$buildobase3 $build3<P>";
}
else {
	Echo "<center>you do not have enough tokens for a Vehicle, please donate";
	}
	if($tokens >= $coinsforhelicopteritem) {
echo "<center>Use $coinsforhelicopteritem Token(s) from your stash of $tokens <P>$buildobase4 $build4<P>";
}
else {
	Echo "<center>you do not have enough tokens for a Helicopter, please donate";
	}
}
echo "<P> Notice: Base Items are database driven<P> Your Item will not show up until server restart<P>READ!<P>Stand in the location you want your object to spawn<P>Drink a soda or eat a food Item<P>Press ALT+TAB and order your item<P>";
?>
</TD></TR></TABLE> 
 <P> 
<BODY></HTML>