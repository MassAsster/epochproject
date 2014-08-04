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
$query = "SELECT tokens FROM authorize WHERE guid = '$stat'";   
//select tokens from database instead of POST var so client cannot modify.
$result = mysql_query($query) or die(mysql_error());
$result = mysql_fetch_assoc($result);
$tokes = $result['tokens'];
$tokes=mysql_real_escape_string($tokes);

$whatisleft = $tokes - $coinsforrevive;
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
if($logging == 1) {
$date = date('Y-m-d H:i:s');
mysql_query("INSERT INTO `donatorlog` (`date`, `user`, `action`) VALUES
 ('$date', '$user', 'paid for Revive PID $stat ');");
}
mysql_query("UPDATE `authorize` SET tokens='$whatisleft' WHERE guid='$stat' ");
$whois="<form enctype=multipart/form-data action=reviveme2.php method=POST>$mutlicharison<input type=hidden name=player value=$stat ><input type=hidden name=multiserver value=0 ><input type=image src=images/doit.png></form>";


echo "<TABLE BORDER=1 style='width:400px'><th bgcolor='#003399'> <center><h3><font color=#ffffff>Payment</font> </h3><TR><TD>
<center><table border=0 bgcolor='#ffffff'><td align=center>
<td>";
if($mutliserversetup == 0) {
  echo "Payment Taken For $stat <P> Press Continue to complete the Revive<P> $whois<P> ";
}
else {
$server1="<form enctype=multipart/form-data action=reviveme2.php method=POST>$mutlicharison<input type=hidden name=player value=$stat ><input type=hidden name=multiserver value=1 ><input type='submit' value='$servername1'></form>";
$server2="<form enctype=multipart/form-data action=reviveme2.php method=POST>$mutlicharison<input type=hidden name=player value=$stat ><input type=hidden name=multiserver value=2 ><input type='submit' value='$servername2'></form>";
$server3="<form enctype=multipart/form-data action=reviveme2.php method=POST>$mutlicharison<input type=hidden name=player value=$stat ><input type=hidden name=multiserver value=3 ><input type='submit' value='$servername3'></form>";
$server4="<form enctype=multipart/form-data action=reviveme2.php method=POST>$mutlicharison<input type=hidden name=player value=$stat ><input type=hidden name=multiserver value=4 ><input type='submit' value='$servername4'></form>";
$server5="<form enctype=multipart/form-data action=reviveme2.php method=POST>$mutlicharison<input type=hidden name=player value=$stat ><input type=hidden name=multiserver value=5 ><input type='submit' value='$servername5'></form>";
$server6="<form enctype=multipart/form-data action=reviveme2.php method=POST>$mutlicharison<input type=hidden name=player value=$stat ><input type=hidden name=multiserver value=6 ><input type='submit' value='$servername6'></form>";
$server7="<form enctype=multipart/form-data action=reviveme2.php method=POST>$mutlicharison<input type=hidden name=player value=$stat ><input type=hidden name=multiserver value=7 ><input type='submit' value='$servername7'></form>";
$server8="<form enctype=multipart/form-data action=reviveme2.php method=POST>$mutlicharison<input type=hidden name=player value=$stat ><input type=hidden name=multiserver value=8 ><input type='submit' value='$servername8'></form>";
$server9="<form enctype=multipart/form-data action=reviveme2.php method=POST>$mutlicharison<input type=hidden name=player value=$stat ><input type=hidden name=multiserver value=9 ><input type='submit' value='$servername9'></form>";
$server10="<form enctype=multipart/form-data action=reviveme2.php method=POST>$mutlicharison<input type=hidden name=player value=$stat ><input type=hidden name=multiserver value=10 ><input type='submit' value='$servername10'></form>";

echo "Payment Taken For $stat <P> Choose a server<P>";
 if($howmanyservers == 2) {
  echo "$server1 $server2"; 
  }
   if($howmanyservers == 3) {
  echo "$server1 $server2 $server3"; 
  }
     if($howmanyservers == 4) {
  echo "$server1 $server2 $server3 $server4"; 
  }
     if($howmanyservers == 5) {
  echo "$server1 $server2 $server3 $server4 $server5"; 
  }
       if($howmanyservers == 6) {
  echo "$server1 $server2 $server3 $server4 $server5 $server6"; 
  }
         if($howmanyservers == 7) {
  echo "$server1 $server2 $server3 $server4 $server5 $server6 $server7"; 
  }
           if($howmanyservers == 8) {
  echo "$server1 $server2 $server3 $server4 $server5 $server6 $server7 $server8"; 
  }
             if($howmanyservers == 9) {
  echo "$server1 $server2 $server3 $server4 $server5 $server6 $server7 $server8 $server9"; 
  }
               if($howmanyservers == 10) {
  echo "$server1 $server2 $server3 $server4 $server5 $server6 $server7 $server8 $server9 $server10"; 
  }
  
   echo"<P> ";
	}  
  
 ?>



</TD></TR></TABLE> 