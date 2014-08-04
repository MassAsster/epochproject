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
<TABLE BORDER=1 style="width:800px"><th bgcolor="#003399"> <center><h3><font color=#ffffff>HELP</font> </h3><TR><TD>
<center><table border=0 bgcolor='#ffffff'><td align=center>
<Td>What's This Thing Do?</td>
<td>This tool is designed to allow players to earn rewards for playing on the server.
<P> Players are rewarded "tokens", and use the tokens when
they want, to revive dead character, get building supplies, or get starting gear. Example: Player was killed just prior to restart and knows he/she
is going to not reach their body before restart. The player can log in to the website, use tokens
to revive their character, so they can rejoin without having to lose keys and such. 
<P>
Each reward has a conditions - such as the revive, you must NOT HAVE A PLAYER ALIVE in order to revive your last alive character. Other rewards require you exit to the lobby before applying them.
<P>
<a href="welcome.php">Home</a>







</TD></TR></TABLE> 
 <P> 
<BODY></HTML>