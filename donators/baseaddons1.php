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

$connection = @mysql_connect($server, $dbusername, $dbpassword)	or die(mysql_error());			
$db = @mysql_select_db($db_name,$connection) or die(mysql_error()); 		
$size=$_POST['baseitem'];
			

	
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

	if($mutliserversetup == 1) {


if($howmanyservers == 2) {
$serverlist = "<select name='multiserver'>
<option value='1'>$servername1</option>
<option value='2'>$servername2</option>
</select>";
  }
   if($howmanyservers == 3) {
$serverlist = "<select name='multiserver'>
<option value='1'>$servername1</option>
<option value='2'>$servername2</option>
<option value='3'>$servername3</option>
</select>";
  }
     if($howmanyservers == 4) {
$serverlist = "<select name='multiserver'>
<option value='1'>$servername1</option>
<option value='2'>$servername2</option>
<option value='3'>$servername3</option>
<option value='4'>$servername4</option>
</select>";
  }
     if($howmanyservers == 5) {
$serverlist = "<select name='multiserver'>
<option value='1'>$servername1</option>
<option value='2'>$servername2</option>
<option value='3'>$servername3</option>
<option value='4'>$servername4</option>
<option value='5'>$servername5</option>
</select>";
  }
       if($howmanyservers == 6) {
$serverlist = "<select name='multiserver'>
<option value='1'>$servername1</option>
<option value='2'>$servername2</option>
<option value='3'>$servername3</option>
<option value='4'>$servername4</option>
<option value='5'>$servername5</option>
<option value='6'>$servername6</option>
</select>"; 
  }
         if($howmanyservers == 7) {
$serverlist = "<select name='multiserver'>
<option value='1'>$servername1</option>
<option value='2'>$servername2</option>
<option value='3'>$servername3</option>
<option value='4'>$servername4</option>
<option value='5'>$servername5</option>
<option value='6'>$servername6</option>
<option value='7'>$servername7</option>
</select>";
  }
           if($howmanyservers == 8) {
$serverlist = "<select name='multiserver'>
<option value='1'>$servername1</option>
<option value='2'>$servername2</option>
<option value='3'>$servername3</option>
<option value='4'>$servername4</option>
<option value='5'>$servername5</option>
<option value='6'>$servername6</option>
<option value='7'>$servername7</option>
<option value='8'>$servername8</option>
</select>";
  }
             if($howmanyservers == 9) {
$serverlist = "<select name='multiserver'>
<option value='1'>$servername1</option>
<option value='2'>$servername2</option>
<option value='3'>$servername3</option>
<option value='4'>$servername4</option>
<option value='5'>$servername5</option>
<option value='6'>$servername6</option>
<option value='7'>$servername7</option>
<option value='8'>$servername8</option>
<option value='9'>$servername9</option>
</select>";
  }
               if($howmanyservers == 10) {
  $serverlist = "<select name='multiserver'>
<option value='1'>$servername1</option>
<option value='2'>$servername2</option>
<option value='3'>$servername3</option>
<option value='4'>$servername4</option>
<option value='5'>$servername5</option>
<option value='6'>$servername6</option>
<option value='7'>$servername7</option>
<option value='8'>$servername8</option>
<option value='9'>$servername9</option>
<option value='10'>$servername10</option>
</select>";
}
	}
	else {
		$serverlist = "<input type=hidden name=multiserver value=0 >";
	}
	
	if($multicharactersupport == 1) {
$mutlicharison = "<select name='slot'>
<option value='1'>Character 1</option>
<option value='2'>Character 2</option>
<option value='3'>Character 3</option>
<option value='4'>Character 4</option>
<option value='5'>Character 5</option>
</select>";
}
else {
	$mutlicharison = "<input type=hidden name=slot value=0 >";
}


if($size == "small") {
$whatisleft = $tokens - $coinsforsmallitems;
mysql_query("UPDATE `authorize` SET tokens='$whatisleft' WHERE guid='$guid' ");
$build1="<form enctype=multipart/form-data action=baseaddons2.php method=POST>$mutlicharison $serverlist $buildobase<input type=hidden name=playername value=$user ><input type=hidden name=email value=$email ><input type=hidden name=player value=$guid ><input type=hidden name=cash value=$tokens ><input type=hidden name=iscar value=0 ><input type=image src=images/doit.png></form>";
}
if($size == "large") {
$whatisleft = $tokens - $coinsforlargeitems;
mysql_query("UPDATE `authorize` SET tokens='$whatisleft' WHERE guid='$guid' ");
$build1="<form enctype=multipart/form-data action=baseaddons2.php method=POST>$mutlicharison $serverlist $buildobase2<input type=hidden name=playername value=$user ><input type=hidden name=email value=$email ><input type=hidden name=player value=$guid ><input type=hidden name=cash value=$tokens ><input type=hidden name=iscar value=0 ><input type=image src=images/doit.png></form>";
}
if($size == "vehicle") {
$whatisleft = $tokens - $coinsforvehicleitem;
mysql_query("UPDATE `authorize` SET tokens='$whatisleft' WHERE guid='$guid' ");
$build1="<form enctype=multipart/form-data action=baseaddons2.php method=POST>$mutlicharison $serverlist $buildobase3<input type=hidden name=playername value=$user ><input type=hidden name=email value=$email ><input type=hidden name=player value=$guid ><input type=hidden name=cash value=$tokens ><input type=hidden name=iscar value=1 ><input type=image src=images/doit.png></form>";
}
if($size == "helicopter") {
$whatisleft = $tokens - $coinsforhelicopteritem;
mysql_query("UPDATE `authorize` SET tokens='$whatisleft' WHERE guid='$guid' ");
$build1="<form enctype=multipart/form-data action=baseaddons2.php method=POST>$mutlicharison $serverlist $buildobase4<input type=hidden name=playername value=$user ><input type=hidden name=email value=$email ><input type=hidden name=player value=$guid ><input type=hidden name=cash value=$tokens ><input type=hidden name=iscar value=1 ><input type=image src=images/doit.png></form>";
}


echo "<center>Payment Taken, Choose your Item:<P>$build1<P>";




	
}
echo "<P> Notice: Base Items are database driven<P> Your Item will not show up until server restart<P>READ!<P>Stand in the location you want your object to spawn<P>Drink a soda or eat a food Item<P>Press ALT+TAB and order your item<P>";
	mysql_free_result($result);
?>
</TD></TR></TABLE> 
 <P> 
<BODY></HTML>
