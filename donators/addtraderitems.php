<?php
require_once 'bootstrap.php';
$c = secure_page_admin();
$c = get_data();
include ('style.php');
require('config.php');
?>
<?php		
if(isset($_POST['submit'])) 
{ 
 $multi=$_POST['multiserver'];

if($multi == 0) {
 //make connection to dbase
$connection = @mysql_connect($hostname, $username, $password)
			or die(mysql_error());
			
$db = @mysql_select_db($databasename,$connection)
		or die(mysql_error());
}
else {
}
if($multi == 1) {
$connection = @mysql_connect($hostnames1, $usernames1, $passwords1)
			or die(mysql_error());
			
$db = @mysql_select_db($databasenames1,$connection)
		or die(mysql_error());
}
else {
}
if($multi == 2) {
$connection = @mysql_connect($hostnames2, $usernames2, $passwords2)
			or die(mysql_error());
			
$db = @mysql_select_db($databasenames2,$connection)
		or die(mysql_error());
}
else {
}
if($multi == 3) {
$connection = @mysql_connect($hostnames3, $usernames3, $passwords3)
			or die(mysql_error());
			
$db = @mysql_select_db($databasenames3,$connection)
		or die(mysql_error());
}
else {
}
if($multi == 4) {
$connection = @mysql_connect($hostnames4, $usernames4, $passwords4)
			or die(mysql_error());
			
$db = @mysql_select_db($databasenames4,$connection)
		or die(mysql_error());
}
else {
}
if($multi == 5) {
$connection = @mysql_connect($hostnames5, $usernames5, $passwords5)
			or die(mysql_error());
			
$db = @mysql_select_db($databasenames5,$connection)
		or die(mysql_error());
}
else {
}
if($multi == 6) {
$connection = @mysql_connect($hostnames6, $usernames6, $passwords6)
			or die(mysql_error());
			
$db = @mysql_select_db($databasenames6,$connection)
		or die(mysql_error());
}
else {
}
if($multi == 7) {
$connection = @mysql_connect($hostnames7, $usernames7, $passwords7)
			or die(mysql_error());
			
$db = @mysql_select_db($databasenames7,$connection)
		or die(mysql_error());
}
else {
}
if($multi == 8) {
$connection = @mysql_connect($hostnames8, $usernames8, $passwords8)
			or die(mysql_error());
			
$db = @mysql_select_db($databasenames8,$connection)
		or die(mysql_error());
}
else {
}
if($multi == 9) {
$connection = @mysql_connect($hostnames9, $usernames9, $passwords9)
			or die(mysql_error());
			
$db = @mysql_select_db($databasenames9,$connection)
		or die(mysql_error());
}
else {
}
if($multi == 10) {
$connection = @mysql_connect($hostnames10, $usernames10, $passwords10)
			or die(mysql_error());
			
$db = @mysql_select_db($databasenames10,$connection)
		or die(mysql_error());
}
else {
}
$multi=mysql_real_escape_string($multi);
 $id=$_POST['id'];
$item = $_POST['name'];
$qty = $_POST['qty'];
$buy = $_POST['buy'];
$sell = $_POST['sell'];
$tid = $_POST['tid'];
$afile = $_POST['afile'];
mysql_query("INSERT INTO `$tradersdata` (`id`, `item`, `qty`, `buy`, `sell`, `order`, `tid`, `afile`) VALUES
 ($id, '$item', $qty, '$buy', '$sell', 0, $tid, '$afile');");

echo "<TABLE BORDER=1 style='width:400px'><th bgcolor='#003399'> <center><h3><font color=#ffffff>Add Trader Items</font> </h3><TR><TD>
<center><table border=0 bgcolor='#ffffff'><td align=center>
<td>";
Echo "Insert of $item Complete<P>";
echo "<a href=admintools.php>Back To AdminTools</a>";
exit();
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
//$randnumber= "echo int rand ( int 10000 , int 90000 )";
?>
<TABLE BORDER=1 style='width:400px'><th bgcolor='#003399'> <center><h3><font color=#ffffff>Add Trader Items</font> </h3><TR><TD>
<center><table border=0 bgcolor='#ffffff'><td align=center>
<td>
<form name="test" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"><?php echo $serverlist ?>ID:<input type="text" size="8" name="id" placeholder="<?php echo rand(10000,90000); ?>"><br>Item:<input type="text" size="40" name="name" placeholder=<?php echo "[\"Mi17_DZE\",2]" ?>><br>How Many In Stock:<input type="text" size="4" name="qty" placeholder="100"><br>Purchase Cost:<input type="text" size="30" name="buy" placeholder=<?php echo "[2,\"ItemGoldBar10oz\",1]" ?>><br>Sell For:<input type="text" size="30" name="sell" placeholder=<?php echo "[1,\"ItemGoldBar10oz\",1]" ?>><input type=hidden name=order value=0 ><br>Trader TID:<input type="text" size="4" name="tid" placeholder="519"><select name='afile'>
<option value='trade_items'>trade_items</option>
<option value='trade_weapons'>trade_weapons</option>
<option value='trade_any_vehicle'>trade_any_vehicle</option>
<option value='trade_backpacks'>trade_backpacks</option>
</select><input type="submit" name="submit" value="Submit Form"></form>
<P>
<h3><font color=red><center> <h3><b>Warning:</b></h3></font> Using this tool incorrectly <u>will cause</u> major problems with your database, please follow all rules and guidelines of proper format and item names
  </TD></TR></TABLE> 
 
