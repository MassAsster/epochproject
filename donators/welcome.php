<?php
require_once 'bootstrap.php';
include ('style.php');
require('config.php');

$c = core::init();
secure_page();
$c = get_data();

$user="$c->username";
$connection = @mysql_connect($server, $dbusername, $dbpassword)	or die(mysql_error());
$db = @mysql_select_db($db_name,$connection) or die(mysql_error()); 
$today = date("Y-m-d H:i:s");
//$c->connect();
//var_dump($c);	

//$query = $c->db->prepare("SELECT * FROM `authorize` WHERE username=:user");
//$query->execute(array(':user' => $user));
//var_dump($query->rowCount());
//
?>

<TABLE BORDER=1 style='width:600px'><th bgcolor="#003399"> <center><h3><font color=#ffffff>Welcome <?=$c->username?></font> </h3><TR><TD>
<center><table border=0 bgcolor='#ffffff'><td align=center><tr><P>
<img src="<?=$c->gravatar?>" >
<P>
<br><form enctype=multipart/form-data action=addpin.php method=POST><input type='submit' value='Change Pin'></form>
<P>
<?php

$query = $c->db->prepare("SELECT * FROM `authorize` WHERE username=:user");
$query->execute(array(':user' => $user));

if ($query->rowCount() > 0){
	$c->db->prepare("UPDATE `authorize` SET last_login='$today' WHERE username='$user'");
	$query->execute(array(':user' => $user));
} else {
	$query = $c->db->prepare("INSERT INTO `authorize` VALUES (:user, :today, 'noname', '0', '0' , :coins)");
	$query->execute(array(':user' => $user, ':today' => $today, ':coins' => $coinsgiventonewbies));
	echo "First time account setup complete <P> You were given $coinsgiventonewbies free token(s) to try this system! <br> ";
}
$result447 = mysql_query("SELECT COUNT(*) FROM `authorize` WHERE username='$user' AND serverop='0'");
if (!$result447) {
    die(mysql_error());
    }
if (mysql_result($result447, 0, 0) > 0) {
Echo "<P>We detected you do not have a buddy pin, you can do that <a href=addpin.php >HERE</a><P>";
}

$query = $c->db->prepare("SELECT * FROM `authorize` WHERE username=:user AND guid='0'");
$query->execute(array(':user' => $user));


if ($query->rowCount() > 0) echo "<P>We detected you have still yet to update your ID, you can do that <a href=guidsetup.php >HERE</a>";
else {
$query = $c->db->prepare("SELECT tokens, guid, COUNT(tokens) FROM authorize WHERE username = :user"); 
$query->execute(array(':user' => $user));

// Print out result
while($row = $query->fetch(PDO::FETCH_ASSOC)){
	$tokens="". $row['tokens'] ."";
	$guid="". $row['guid'] ."";
	echo "Tokens: $tokens | PlayerID: $guid";

	if($multicharactersupport == 1) {
		$mutlicharison = "<select name='slot'>
		<option value='1'>Character 1</option>
		<option value='2'>Character 2</option>
		<option value='3'>Character 3</option>
		<option value='4'>Character 4</option>
		<option value='5'>Character 5</option>
		</select>";
}
else $mutlicharison = "<input type=hidden name=slot value=0 >";
	
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
if($allowstats == 1) {
echo "<form enctype=multipart/form-data action=mystats.php method=POST target=_blank>$mutlicharison<input type=hidden name=player value=$guid >$serverlist<br><input type='submit' value='My Stats'></form>";
}
else {
}
	}
}
$areyouadmin = "$c->is_admin";
if($areyouadmin == 1) {
echo "<br><form enctype=multipart/form-data action=admintools.php method=POST target=_blank><input type='submit' value='Admin Controls'></form> ";
}
if($allowdonation == 1) {
$donation="<a href='gettokens.php'><img src='images/buytokens.png' border='0'></a>";
}
else {
$donation="";
}
	?>
<br>
<?php echo $donation ?><a href="tokenbank.php"><img src="images/gettokens.png" border="0"></a><a href="edit_profile.php"><img src="images/myprofile.png" border="0"></a><a href="help.php"><img src="images/help.png" border="0"></a><P>
<a href="revive.php"><img src="images/revive.png" border="0"></a>
<a href="bagwgun.php"><img src="images/startgear.png" border="0"></a><a href="bagwbuildables.php"><img src="images/building.png" border="0"></a>
<P>
<a href="bugfix.php"><img src="images/heal.png" border="0"></a><a href="baseaddons.php"><img src="images/baseparts.png" border="0"></a><a href="vault.php"><img src="images/safe.png" border="0"></a><a href="buddy.php"><img src="images/buddy.png" border="0"></a>
</tr></td></table>
<center>
<?php
if($allowstats == 1) {
	if($mutliserversetup == 1) {
	}
	else {
include ('genstats.php');
}
}
?>

