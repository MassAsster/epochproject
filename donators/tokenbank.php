<?php	
require_once 'bootstrap.php';
$c = core::init();
secure_page();
$c = get_data();	
include ('style.php');
require('config.php');


$user="$c->username";
$query = $c->db->prepare("SELECT tokens, guid, COUNT(tokens) FROM authorize WHERE username = :user"); 
$query->execute(array(':user' => $user));

//$result11 = mysql_query($query11) or die(mysql_error());

// Print out result
while($row = $query->fetch(PDO::FETCH_ASSOC)){
	$tokens="". $row['tokens'] ."";
	$guid="". $row['guid'] ."";
	//echo "Tokens: $tokens | PlayerID: $guid";

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
	if($humanweight>0) {
		$punished = "Human kills are punished with $humanweight per kill";
	}
	else {
		$punished = "Human kills not punished";
	}
echo "
<TABLE BORDER=1 style=\"width:800px\"><th bgcolor=\"#003399\"> <center><h3><font color=#ffffff>Token Bank</font> </h3><TR><TD>
<center><table border=0 bgcolor='#ffffff'><td align=center>
<Td> <img src=\"images/tokens.png\"></td>
<td>Player Rewards! 
<P>
This system uses tokens to reward players for playing on the server. These \"tokens\" can be used for in game rewards.
<P>
Note: You will be trading in your zombie kills and your bandit kills, your human kills will remain with your character.
<P>
You can bank Zombie kills, Bandit Kills, and Player Kills. You bank them in the form of tokens, and you can spend these tokens on items
<p>
$punished
<P>
Token usage:<br>
$coinsforrevive for reviving a dead player
<br>
$coinsforbagoguns for a goody bag containing a weapon, food, medical supplies.
<br>
$coinsforbuildingsupplies for a goody bag full of building supplies
<p>


<P>
<P>
<form enctype=multipart/form-data action=tokenbank2.php method=POST>$mutlicharison<input type=hidden name=player value=$guid >$serverlist<br><input type='submit' name='Submit' value='Bank Tokens'></form>
<P>
<a href=\"welcome.php\">Home</a>

</TD></TR></TABLE> 
 <P> 
<BODY></HTML>";


}


	

?>