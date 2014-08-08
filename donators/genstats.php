
<?php
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
	$connection = @mysql_connect($hostname, $username, $password)
			or die(mysql_error());
			
$db = @mysql_select_db($databasename,$connection)
		or die(mysql_error());
echo "<TABLE BORDER=0><th width=580> <center><TR><TD align=center>";
echo "<form enctype=multipart/form-data action=userlist.php method=POST>$serverlist<input type='submit' value='Detailed Player List'></form>";
			echo "<table BORDER=0 cellpadding=20 bgcolor=\"#1a1a1a\"><tr><td bgcolor=\"$t2\"><center> <h4>Top 10<P>Zombie Killers</h4></center>";
$result = mysql_query("SELECT * FROM $chartablename WHERE Alive = 1 ORDER BY `KillsZ` DESC LIMIT 10");
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

$uid="". $row['PlayerUID'] ."";
$zombiekills="". $row['KillsZ'] ."";

$result33rrr = mysql_query("SELECT PlayerName FROM `$playerdata` WHERE PlayerUID='$uid'");
if (!$result33rrr) {
    die(mysql_error());
}
$nameis=mysql_result($result33rrr, 0, 0);
// Print out result
echo "$nameis <font color=$t5> $zombiekills</font><P>";


}
echo "</td>";
			echo "<td bgcolor=\"$t2\"><center> <h4>Top 10<P>Banidt Killers</h4></center>";
$result = mysql_query("SELECT * FROM $chartablename WHERE Alive = 1 ORDER BY `KillsB` DESC LIMIT 10");
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

$uid="". $row['PlayerUID'] ."";
$banditkills="". $row['KillsB'] ."";


$result33rr = mysql_query("SELECT PlayerName FROM `$playerdata` WHERE PlayerUID='$uid'");
if (!$result33rr) {
    die(mysql_error());
}
$nameis1=mysql_result($result33rr, 0, 0);
// Print out result
echo "$nameis1 <font color=$t5> $banditkills</font><P>";


}
echo "</td>";
			echo "<td bgcolor=\"$t2\"><center> <h4>Top 10<P>Human Killers</h4></center>";
$result = mysql_query("SELECT * FROM $chartablename WHERE Alive = 1 ORDER BY `KillsH` DESC LIMIT 10");
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

$uid="". $row['PlayerUID'] ."";
$humankills="". $row['KillsH'] ."";

$result33r = mysql_query("SELECT PlayerName FROM `$playerdata` WHERE PlayerUID='$uid'");
if (!$result33r) {
    die(mysql_error());
}
$nameis2=mysql_result($result33r, 0, 0);
// Print out result
echo "$nameis2 <font color=$t5> $humankills</font><P>";


}
echo "</td><tr>";
			echo "<td bgcolor=\"$t2\"><center> <h4>Top 10<P>Headshot Killers</h4></center>";
$result = mysql_query("SELECT * FROM $chartablename WHERE Alive = 1 ORDER BY `HeadshotsZ` DESC LIMIT 10");
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

$uid="". $row['PlayerUID'] ."";
$headshotkills="". $row['HeadshotsZ'] ."";

$result33 = mysql_query("SELECT PlayerName FROM `$playerdata` WHERE PlayerUID='$uid'");
if (!$result33) {
    die(mysql_error());
}
$nameis3=mysql_result($result33, 0, 0);
// Print out result
echo "$nameis3 <font color=$t5> $headshotkills</font><P>";


}
echo "</td>";
			echo "<td bgcolor=\"$t2\"><center> <h4>Top 10<P>Humanity Hoarders</h4></center>";
$result = mysql_query("SELECT * FROM $chartablename WHERE Alive = 1 ORDER BY `Humanity` DESC LIMIT 10");
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

$uid="". $row['PlayerUID'] ."";
$deaths="". $row['Generation'] ."";
$zombiekills="". $row['KillsZ'] ."";
$banditkills="". $row['KillsB'] ."";
$humankills="". $row['KillsH'] ."";
$headshotkills="". $row['HeadshotsZ'] ."";
$humanity="". $row['Humanity'] ."";

$result334 = mysql_query("SELECT PlayerName FROM `$playerdata` WHERE PlayerUID='$uid'");
if (!$result334) {
    die(mysql_error());
}
$nameis4=mysql_result($result334, 0, 0);
// Print out result
echo "$nameis4 <font color=$t5> $humanity</font><P>";


}
echo "</td>";
			echo "<td bgcolor=\"$t2\"><center> <h4>Top 10<P>Travelers</h4></center>";
$result = mysql_query("SELECT * FROM $chartablename WHERE Alive = 1 ORDER BY `DistanceFoot` DESC LIMIT 10");
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

$uid="". $row['PlayerUID'] ."";
$foot="". $row['DistanceFoot'] ."";

$result33454 = mysql_query("SELECT PlayerName FROM `$playerdata` WHERE PlayerUID='$uid'");
if (!$result33454) {
    die(mysql_error());
}
$nameis454=mysql_result($result33454, 0, 0);
// Print out result
echo "$nameis454 <font color=$t5> $foot (m)</font><P>";


}
echo "</td></table>";
mysql_close($connection)
?>
</TD></TR></TABLE> 
 <P> 
<BODY></HTML>