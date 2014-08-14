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
<TABLE BORDER=1 style="width:800px"><th bgcolor="#003399"> <center><h3><font color=#ffffff>Make A Donation</font> </h3><TR><TD>
<center><table border=0 bgcolor='#ffffff'><td align=center>
<Td> <img src="images/tokens.png"></td>
<td>Current Donation Rewards! 
<P>
This system uses tokens to reward players for donations that are used to help offset server costs. These "tokens" can be used for in game rewards.
<P>
<?php echo "$donationpackage1"; ?>
<P>
<?php echo "$donationpackage2"; ?>
<p>
Token usage:<br>
<?php echo "$coinsforrevive" ?> for reviving a dead player
<br>
<?php echo "$coinsforbagoguns" ?> for a goody bag containing a weapon, food, medical supplies.
<br>
<?php echo "$coinsforbuildingsupplies" ?> for a goody bag full of building supplies
<p>
Legal notice:<br>
By making a donation to this project you signify that you acknowledged, understood, accepted, and agreed to the terms and conditions contained in this notice. Your donation to this project is voluntary and is not a fee for any services, goods, or advantages, and making a donation to this project does not entitle you to any services, goods, or advantages. We have the right to use the money you donate to this project in any lawful way and for any lawful purpose we see fit and we are not obligated to disclose the way and purpose to any party unless required by applicable law. Although this is free software, to our best knowledge this project does not have any tax exempt status (this project is neither a registered non-profit corporation nor a registered charity in any country). Your donation may or may not be tax-deductible; please consult this with your tax adviser. We will not publish/disclose your name and e-mail address without your consent, unless required by applicable law. Your donation is non-refundable. 
<p>

PAYPAL BUTTON CODE GOES HERE

<P>Please Include your Username or Profile ID number so we can attach your tokens to your account.
<P>
<a href="welcome.php">Home</a>

</TD></TR></TABLE> 
 <P> 
<BODY></HTML>