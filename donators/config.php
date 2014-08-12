<?php
$version ="1.50";
//set up the names of the database and table for the WEB SERVER
////////////MODIFY THIS SECTION //////////////////
$db_name ="databasename";
$table_name ="authorize";  // don't touch table name
//connect to the server and select the database
//$server = "hive.hfbservers.com";    
//$dbusername = "USERNAME";   
//$dbpassword = "PASSWORD";
////////////MODIFY THIS SECTION //////////////////
//setup the names and tables for the GAME SERVER database
////////////MODIFY THIS SECTION //////////////////
$hostname = "hive.hfbservers.com:3306";
$username = "USERNAME";
$password = "PASSWORD";
$databasename = "DATABASENAME";
////////////MODIFY THIS SECTION //////////////////
$chartablename = "character_data"; //Allows for case sensitive database names
$playerdata= "player_data"; //Player names and PID table Allows for case sensitive database names
$objecttable= "object_data"; //Object Data Table allows for case sensitive database names
$tradersdata= "traders_data"; //Traders item Data Table allows for case sensitive database names
$allowrevive = 1; //allow revive option 0 off 1 on
$allowstartergear = 1; //allow starter gear option 0 off 1 on
$allowbuildloot = 1; //allow builder loot option 0 off 1 on
$allowbugfix = 1; //allow bug fix/heal option 0 off 1 on
$wipeinventory = 0; //Clear inventory on revive 0 off 1 on
$multicharactersupport = 0; //Support for mutli-character mod, allows up to 5 characters
$allowstats = 1; //Allow players to view their stats
$allowbuildobase = 1; // allow Build-o-Base option 0 off 1 on
$allowvaultchange = 1; // allow changing vault code change option 0 off 1 on
$allowbuddysys = 1; // allow buddy system teleport option 0 off 1 on
$instance = 24; // Must match your instance set in the init.sqf
$logging = 1; //enable logging 
$humanity = 350; //Cost in humanity to do business with the bank token system.
$headshotbonus = .02; //Headshots are worth
$zombieweight = .04; //How much for each zombie kill
$banditweight = .05; //how much for each bandit kill
$humanweight = .10; // This is token punishment for killing human players set to 0 to disable
////////////////////////////////stats setup/////////////////////////////
//Site logo
$hostlogo = "logo.png";
//Background table color for the user list
$t1= "#000000";
//Text color for user list
$t1a ="#ffffff";
//background table color for the main page stats
$t2= "#ffffff";
//background table color for detailed player information
$t3= "#E8E8E8";
//side and top panel color for the detailed player info
$t4="#87CEFA";
//Highlighted Text (default is yellow)
$t5="#A00000";
//Banner Text color user list
$t6="#F4A460";
////////////////////////////////////end of stats setup///////////////////////////////////




$coinsgiventonewbies = 5; // new registered players get tokens, this sets how many

$coinsforrevive = ".25";  // number of tokens for revive

$coinsforvault = "1"; // Number of tokens for changing a vault code

$coinsforbuddy = "1"; // tokens to use the buddy system

$coinsforbugfix = ".10"; //Wake up a character that's stuck in the hour glass bug

//////////////////////////BUILD O BASE Setup///////////////////////////////////////

$coinsforsmallitems = "3"; // Small Items inside the Build-O-Base
//Small Items are listed here in the Options//
$buildobase = "<select name='part'>
<option value='Land_Misc_deerstand'>Deer Stand</option>
<option value='Land_Ind_IlluminantTower'>Light Tower</option>
<option value='Land_pumpa'>Well Water</option>
</select>";

$coinsforlargeitems = "5"; // Large Items Inside the Build-O-Base
//Large Items are listed here in the Options//
$buildobase2 = "<select name='part'>
<option value='Land_Ind_TankSmall2'>Fuel Tank</option>
<option value='Land_A_CraneCon'>Giant Construction Crane</option>
<option value='Land_telek1'>Giant Tower</option>
</select>";

$coinsforvehicleitem = "8"; // Vehicle Option in the Build-O-Base
//Large Items are listed here in the Options//
$buildobase3 = "<select name='part'>
<option value='ArmoredSUV_PMC_DZE'>Armed SUV</option>
<option value='M113_TK_EP1'>Armed M113</option>
<option value='M113Ambul_UN_EP1'>M113 Unarmed</option>
</select>";

$coinsforhelicopteritem = "10"; // Helicopter Option in the Build-O-Base
//Helicopter Items are listed here in the Options//
$buildobase4 = "<select name='part'>
<option value='AW159_Lynx_BAF'>AH-11 WildCat</option>
<option value='BAF_Merlin_HC3_D'>Merlin HC3</option>
<option value=’Ka60_GL_PMC'>KA60 with Grenade Launcher</option>
</select>";


//////////////////////////END BUILD O BASE Setup///////////////////////////////////////

///////////////////////////////////begin building supplies setup//////////////////

$coinsforbuildingsupplies = "3"; // cost Backpack of building supplies package 1
$mybuildlootp1 = "[\"DZ_LargeGunBag_EP1\",[[\"ItemCompass\",\"M110_NVG_EP1\"],[1,1]],[[\"ItemWoodWallGarageDoor\",\"ItemWoodWallWithDoorLg\",\"ItemWoodWallLg\",\"ItemVault\",\"ItemWoodFloor\",\"ItemWoodStairs\",\"PartWoodLumber\",\"20Rnd_762x51_B_SCAR\",\"ItemComboLock\",\"ItemAntibiotic\",\"ItemBandage\",\"ItemGoldBar10oz\",\"MortarBucket\"],[1,1,4,1,4,2,4,4,1,1,2,1,2]]]";
$buildlootdescp1 = "DZ_LargeGunBag_EP1 ItemCompass M110_NVG_EP1 (1)ItemWoodWallGarageDoor (1)ItemWoodWallWithDoorLg (4)ItemWoodWallLg (1)ItemVault (4)ItemWoodFloor<br> (2)ItemWoodStairs (4)PartWoodLumber (4)20Rnd_762x51_B_SCAR<br> (1)ItemComboLock (1)ItemAntibiotic (2)ItemBandage (1)ItemGoldBar10oz (2)MortarBucket"; //whats in the building loot?

$coinsforbuildingsupplies2 = "5"; // cost BackPack of building Supplies Package 2
$mybuildlootp2 = "[\"DZ_LargeGunBag_EP1\",[[\"ItemCompass\",\"M107_DZ\"],[1,1]],[[\"ItemWoodWallGarageDoor\",\"ItemWoodWallWithDoorLg\",\"ItemWoodWallLg\",\"ItemVault\",\"ItemWoodFloor\",\"ItemWoodStairs\",\"PartWoodLumber\",\"10Rnd_127x99_m107\",\"ItemComboLock\",\"ItemAntibiotic\",\"ItemBandage\",\"ItemGoldBar10oz\",\"MortarBucket\"],[1,1,4,1,4,2,4,4,1,1,2,1,2]]]";
$buildlootdescp2 = "DZ_LargeGunBag_EP1 ItemCompass M107_DZ<br>(1)ItemWoodWallGarageDoor (1)ItemWoodWallWithDoorLg (4)ItemWoodWallLg<br>(1)ItemVault (4)ItemWoodFloor (2)ItemWoodStairs (4)PartWoodLumber<br>(4)10Rnd_127x99_m107 (1)ItemComboLock (1)ItemAntibiotic (2)ItemBandage (1)ItemGoldBar10oz (2)MortarBucket"; //whats in the building loot?

$coinsforbuildingsupplies3 = "8"; // cost BackPack of Building Supplies Package 3
$mybuildlootp3 = "[\"DZ_LargeGunBag_EP1\",[[\"ItemCompass\",\"ItemEtool\",\"ItemToolbox\",\"MeleeCrowbar\",\"M107_DZ\"],[1,1,1,1,1]],[[\"ItemVault\",\"ItemComboLock\",\"ItemAntibiotic\",\"ItemBandage\",\"ItemGoldBar10oz\",\"cinder_door_kit\",\"cinder_garage_kit\",\"cinder_wall_kit\",\"ItemWoodStairs\",\"10Rnd_127x99_m107\"],[1,1,1,2,1,1,1,7,3,7]]]";
$buildlootdescp3 = "DZ_LargeGunBag_EP1 ItemCompass ItemEtool ItemToolbox MeleeCrowbar M107_DZ<br>(1)ItemVault (1)ItemComboLock (1)ItemAntibiotic<br>(2)ItemBandage (1)ItemGoldBar10oz (1)cinder_door_kit<br>(1)cinder_garage_kit (7)cinder_wall_kit (3)ItemWoodStairs (7)10Rnd_127x99_m107,[1,1,1,2,1,1,1,7,3,7]]]"; //whats in the building loot?



/////////////////////////////begin starting loot setup///////////////////////////////////
$coinsforbagoguns = ".10"; //Backpack with gun, food, PACKAGE  1,2,3 (pistols and such)
$coinsforbagoguns2 = ".20"; //Backpack with gun, food, PACKAGE 4,5,6 (rifles and such)
$coinsforbagoguns3 = ".30"; //Backpack with gun, food, PACKAGE 7,8,9 (sniper rifles)



//STARTING LOOT- PACKAGE 1,2,3 PISTOLS/SHOTGUNS/SMALL ARMS
$mystarterlootp1 = "[\"DZ_LargeGunBag_EP1\",[[\"ItemCompass\",\"ItemToolbox\",\"Sa61_EP1\",\"Binocular\",\"ItemMap\"],[1,1,1,1,1]],[[\"ItemAntibiotic\",\"ItemBandage\",\"ItemGoldBar10oz\",\"20Rnd_B_765x17_Ball\",\"ItemPainkiller\",\"PartGeneric\",\"PartGlass\",\"PartWheel\"],[1,2,1,8,1,1,1,1]]]";// Starter gear loadout
$startlootp1desc= "DZ_LargeGunBag_EP1 ItemCompass ItemToolbox Sa61_EP1 Binocular ItemMap<br> ItemAntibiotic ItemBandage ItemGoldBar10oz 20Rnd_B_765x17_Ball<br>ItemPainkiller PartGeneric PartGlass PartWheel [1,2,1,8,1,1,1,1]";//whats in the starting loot?

$mystarterlootp2 = "[\"DZ_LargeGunBag_EP1\",[[\"ItemCompass\",\"ItemToolbox\",\"Binocular\",\"ItemMap\",\"UZI_EP1\"],[1,1,1,1,1]],[[\"ItemAntibiotic\",\"ItemBandage\",\"ItemGoldBar10oz\",\"ItemPainkiller\",\"PartGeneric\",\"PartGlass\",\"PartWheel\",\"30Rnd_9x19_UZI\"],[1,2,1,1,1,1,1,8]]]";
$startlootp2desc= " DZ_LargeGunBag_EP1 ItemCompass ItemToolbox Binocular ItemMap UZI_EP1<br> ItemAntibiotic ItemBandage ItemGoldBar10oz ItemPainkiller <br> PartGeneric PartGlass PartWheel 30Rnd_9x19_UZI [1,2,1,1,1,1,1,8]";

$mystarterlootp3 = "[\"DZ_LargeGunBag_EP1\",[[\"ItemCompass\",\"ItemToolbox\",\"Binocular\",\"ItemMap\",\"M9SD\"],[1,1,1,1,1]],[[\"ItemAntibiotic\",\"ItemBandage\",\"ItemGoldBar10oz\",\"ItemPainkiller\",\"PartGeneric\",\"PartGlass\",\"PartWheel\",\"15Rnd_9x19_M9SD\"],[1,2,1,1,1,1,1,8]]]";
$startlootp3desc= "DZ_LargeGunBag_EP1 ItemCompass ItemToolbox Binocular ItemMap M9SD<br>ItemAntibiotic ItemBandage ItemGoldBar10oz ItemPainkiller <br> PartGeneric PartGlass PartWheel 15Rnd_9x19_M9SD [1,2,1,1,1,1,1,8]]]";

//STARTING LOOT PACKAGE 4,5,6 - RIFLES MID RANGE WEAPONS

$mystarterlootp4 = "[\"DZ_LargeGunBag_EP1\",[[\"ItemCompass\",\"ItemToolbox\",\"Binocular\",\"ItemMap\",\"M1014\"],[1,1,1,1,1]],[[\"ItemAntibiotic\",\"ItemBandage\",\"ItemGoldBar10oz\",\"ItemPainkiller\",\"PartGeneric\",\"PartGlass\",\"PartWheel\",\"ItemMorphine\",\"ItemSodaMdew\",\"FoodCanFrankBeans\",\"8Rnd_B_Beneli_74Slug\"],[1,2,1,1,1,1,1,1,1,1,5]]]";
$startlootp4desc= " DZ_LargeGunBag_EP1 ItemCompass ItemToolbox Binocular ItemMap M1014 <br> ItemAntibiotic ItemBandage ItemGoldBar10oz ItemPainkiller <br> PartGeneric PartGlass PartWheel ItemMorphine ItemSodaMdew <br> FoodCanFrankBeans 8Rnd_B_Beneli_74Slug [1,2,1,1,1,1,1,1,1,1,5]";

$mystarterlootp5 = "[\"DZ_LargeGunBag_EP1\",[[\"ItemCompass\",\"ItemToolbox\",\"Binocular\",\"ItemMap\",\"M4A1\"],[1,1,1,1,1]],[[\"ItemAntibiotic\",\"ItemBandage\",\"ItemGoldBar10oz\",\"ItemPainkiller\",\"PartGeneric\",\"PartGlass\",\"PartWheel\",\"ItemMorphine\",\"ItemSodaMdew\",\"FoodCanFrankBeans\",\"8Rnd_B_Beneli_74Slug\",\"30Rnd_556x45_Stanag\"],[1,2,1,1,1,1,1,1,1,1,1,6]]]";
$startlootp5desc= " DZ_LargeGunBag_EP1 ItemCompass ItemToolbox Binocular ItemMap M4A1 <br> ItemAntibiotic ItemBandage ItemGoldBar10oz ItemPainkiller <br> PartGeneric PartGlass PartWheel ItemMorphine ItemSodaMdew <br> FoodCanFrankBeans 8Rnd_B_Beneli_74Slug 30Rnd_556x45_Stanag [1,2,1,1,1,1,1,1,1,1,1,6]";

$mystarterlootp6 = "[\"DZ_LargeGunBag_EP1\",[[\"ItemCompass\",\"ItemToolbox\",\"Binocular\",\"ItemMap\",\"bizon_silenced\"],[1,1,1,1,1]],[[\"ItemAntibiotic\",\"ItemBandage\",\"ItemGoldBar10oz\",\"ItemPainkiller\",\"PartGeneric\",\"PartGlass\",\"PartWheel\",\"ItemMorphine\",\"ItemSodaMdew\",\"FoodCanFrankBeans\",\"8Rnd_B_Beneli_74Slug\",\"64Rnd_9x19_SD_Bizon\"],[1,2,1,1,1,1,1,1,1,1,1,7]]]";
$startlootp6desc= " DZ_LargeGunBag_EP1 ItemCompass ItemToolbox Binocular ItemMap bizon_silenced <br> ItemAntibiotic ItemBandage ItemGoldBar10oz ItemPainkiller <br> PartGeneric PartGlass PartWheel ItemMorphine ItemSodaMdew <br> FoodCanFrankBeans 8Rnd_B_Beneli_74Slug 64Rnd_9x19_SD_Bizon [1,2,1,1,1,1,1,1,1,1,1,7]";

//STARTING LOOT PACKAGE 7,8,9 - SNIPER RIFLES AND LONG RANGE WEAPONS

$mystarterlootp7 = "[\"DZ_LargeGunBag_EP1\",[[\"ItemCompass\",\"ItemToolbox\",\"Binocular\",\"ItemMap\",\"DMR\"],[1,1,1,1,1]],[[\"ItemAntibiotic\",\"ItemBandage\",\"ItemGoldBar10oz\",\"ItemPainkiller\",\"PartGeneric\",\"PartGlass\",\"PartWheel\",\"ItemMorphine\",\"ItemSodaMdew\",\"FoodCanFrankBeans\",\"8Rnd_B_Beneli_74Slug\",\"Skin_Soldier_Bodyguard_AA12_PMC_DZ\",\"FoodCanBakedBeans\",\"FoodCanPasta\",\"HandChemBlue\",\"20Rnd_762x51_DMR\"],[1,2,1,1,1,1,1,1,1,1,1,1,1,1,1,4]]]";
$startlootp7desc= "DZ_LargeGunBag_EP1 ItemCompass ItemToolbox Binocular ItemMap  DMR <br> ItemAntibiotic ItemBandage ItemGoldBar10oz ItemPainkiller <br> PartGeneric PartGlass PartWheel ItemMorphine ItemSodaMdew FoodCanFrankBeans 8Rnd_B_Beneli_74Slug <br> Skin_Soldier_Bodyguard_AA12_PMC_DZ FoodCanBakedBeans FoodCanPasta <br> HandChemBlue 20Rnd_762x51_DMR [1,2,1,1,1,1,1,1,1,1,1,1,1,1,1,4] ";

$mystarterlootp8 = "[\"DZ_LargeGunBag_EP1\",[[\"ItemCompass\",\"ItemToolbox\",\"Binocular\",\"ItemMap\",\"SVD\"],[1,1,1,1,1]],[[\"ItemAntibiotic\",\"ItemBandage\",\"ItemGoldBar10oz\",\"ItemPainkiller\",\"PartGeneric\",\"PartGlass\",\"PartWheel\",\"ItemMorphine\",\"ItemSodaMdew\",\"FoodCanFrankBeans\",\"8Rnd_B_Beneli_74Slug\",\"Skin_Soldier_Bodyguard_AA12_PMC_DZ\",\"FoodCanBakedBeans\",\"FoodCanPasta\",\"HandChemBlue\",\"10Rnd_762x54_SVD\"],[1,2,1,1,1,1,1,1,1,1,1,1,1,1,1,5]]]";
$startlootp8desc= " DZ_LargeGunBag_EP1 ItemCompass ItemToolbox Binocular ItemMap SVD <br> ItemAntibiotic ItemBandage ItemGoldBar10oz ItemPainkiller <br> PartGeneric PartGlass PartWheel ItemMorphine ItemSodaMdew FoodCanFrankBeans 8Rnd_B_Beneli_74Slug <br> Skin_Soldier_Bodyguard_AA12_PMC_DZ FoodCanBakedBeans FoodCanPasta <br> HandChemBlue 10Rnd_762x54_SVD [1,2,1,1,1,1,1,1,1,1,1,1,1,1,1,5] ";

$mystarterlootp9 = "[\"DZ_LargeGunBag_EP1\",[[\"ItemCompass\",\"ItemToolbox\",\"Binocular\",\"ItemMap\",\"M24\"],[1,1,1,1,1]],[[\"ItemAntibiotic\",\"ItemBandage\",\"ItemGoldBar10oz\",\"ItemPainkiller\",\"PartGeneric\",\"PartGlass\",\"PartWheel\",\"ItemMorphine\",\"ItemSodaMdew\",\"FoodCanFrankBeans\",\"8Rnd_B_Beneli_74Slug\",\"Skin_Soldier_Bodyguard_AA12_PMC_DZ\",\"FoodCanBakedBeans\",\"FoodCanPasta\",\"HandChemBlue\",\"5Rnd_762x51_M24\"],[1,2,1,1,1,1,1,1,1,1,1,1,1,1,1,6]]]";
$startlootp9desc= " DZ_LargeGunBag_EP1 ItemCompass ItemToolbox Binocular ItemMap M24 <br> ItemAntibiotic ItemBandage ItemGoldBar10oz ItemPainkiller <br> PartGeneric PartGlass PartWheel ItemMorphine ItemSodaMdew FoodCanFrankBeans 8Rnd_B_Beneli_74Slug <br> Skin_Soldier_Bodyguard_AA12_PMC_DZ FoodCanBakedBeans FoodCanPasta <br> HandChemBlue  5Rnd_762x51_M24 [1,2,1,1,1,1,1,1,1,1,1,1,1,1,1,6] ";

///////////////// END STARTING LOOT SETUP ///////////////////////


$coinsforbuild1 = "10"; //coins for small premade base
$smallbasedesc = "What is included in the small premade base";

$coinsforbuild2 = "15"; //coins for med premade base
$medbasedesc = "what is included in the med premade base";

$coinsforbuild3 = "20"; //coins for large premade base
$largebasedesc = "What is included in the large premade base";

////////////////FOR USE WITH MULTIPLE GAME SERVERS ONLY/////////////////////////////
$mutliserversetup = 0; // 1 for multi-server, zero for a single server setup
$howmanyservers = 2; // How many servers are you setting up? 2-10 are valid
//If multi-server setup 1, continue below, if not, setup complete
$servername1 = "DayZ Epoch Cherno";
$s1instance = 11; // Must match your instance set in the init.sqf
$servername2 = "DayZ Epoch Taviana";
$s2instance = 13; // Must match your instance set in the init.sqf
$servername3 = "DayZ Epoch Panthera";
$s3instance = 16; // Must match your instance set in the init.sqf
$servername4 = "DayZ Epoch NAPF";
$s4instance = 24; // Must match your instance set in the init.sqf
$servername5 = "DayZ Epoch NAPF";
$s5instance = 24; // Must match your instance set in the init.sqf
$servername6 = "DayZ Epoch NAPF";
$s6instance = 24; // Must match your instance set in the init.sqf
$servername7 = "DayZ Epoch NAPF";
$s7instance = 24; // Must match your instance set in the init.sqf
$servername8 = "DayZ Epoch NAPF";
$s8instance = 24; // Must match your instance set in the init.sqf
$servername9 = "DayZ Epoch NAPF";
$s9instance = 24; // Must match your instance set in the init.sqf
$servername10 = "DayZ Epoch NAPF";
$s10instance = 24; // Must match your instance set in the init.sqf

//setup the names and tables for the GAME SERVER 1 database
////////////SERVER NUMBER ONE //////////////////
$hostnames1 = "hive.hfbservers.com:3306";  // OR DAYZ.ST:3306 
$usernames1 = "DATABASE USERNAME";
$passwords1 = "DATABASE PASSWORD";
$databasenames1 = "NAME OF THE DATABASE";  // FOR HFB SERVERS IT'S THE SAME AS THE USER NAME
////////////MODIFY THIS SECTION //////////////////

//setup the names and tables for the GAME SERVER 2 database
////////////SERVER NUMBER TWO //////////////////
$hostnames2 = "hive.hfbservers.com:3306";  // OR DAYZ.ST:3306 
$usernames2 = "DATABASE USERNAME";
$passwords2 = "DATABASE PASSWORD";
$databasenames2 = "NAME OF THE DATABASE";  // FOR HFB SERVERS IT'S THE SAME AS THE USER NAME
////////////MODIFY THIS SECTION //////////////////

//setup the names and tables for the GAME SERVER 3 database
////////////SERVER NUMBER THREE //////////////////
$hostnames3 = "hive.hfbservers.com:3306";  // OR DAYZ.ST:3306 
$usernames3 = "DATABASE USERNAME";
$passwords3 = "DATABASE PASSWORD";
$databasenames3 = "NAME OF THE DATABASE";  // FOR HFB SERVERS IT'S THE SAME AS THE USER NAME
////////////MODIFY THIS SECTION //////////////////

//setup the names and tables for the GAME SERVER 4 database
////////////SERVER NUMBER FOUR //////////////////
$hostnames4 = "hive.hfbservers.com:3306";  // OR DAYZ.ST:3306 
$usernames4 = "DATABASE USERNAME";
$passwords4 = "DATABASE PASSWORD";
$databasenames4 = "NAME OF THE DATABASE";  // FOR HFB SERVERS IT'S THE SAME AS THE USER NAME
////////////MODIFY THIS SECTION //////////////////

////////////SERVER NUMBER Five //////////////////
$hostnames5 = "hive.hfbservers.com:3306";  // OR DAYZ.ST:3306 
$usernames5 = "DATABASE USERNAME";
$passwords5 = "DATABASE PASSWORD";
$databasenames5 = "NAME OF THE DATABASE";  // FOR HFB SERVERS IT'S THE SAME AS THE USER NAME
////////////MODIFY THIS SECTION //////////////////
////////////SERVER NUMBER six //////////////////
$hostnames6 = "hive.hfbservers.com:3306";  // OR DAYZ.ST:3306 
$usernames6 = "DATABASE USERNAME";
$passwords6 = "DATABASE PASSWORD";
$databasenames6 = "NAME OF THE DATABASE";  // FOR HFB SERVERS IT'S THE SAME AS THE USER NAME
////////////MODIFY THIS SECTION //////////////////
////////////SERVER NUMBER seven //////////////////
$hostnames7 = "hive.hfbservers.com:3306";  // OR DAYZ.ST:3306 
$usernames7 = "DATABASE USERNAME";
$passwords7 = "DATABASE PASSWORD";
$databasenames7 = "NAME OF THE DATABASE";  // FOR HFB SERVERS IT'S THE SAME AS THE USER NAME
////////////MODIFY THIS SECTION //////////////////
////////////SERVER NUMBER eight //////////////////
$hostnames8 = "hive.hfbservers.com:3306";  // OR DAYZ.ST:3306 
$usernames8 = "DATABASE USERNAME";
$passwords8 = "DATABASE PASSWORD";
$databasenames8 = "NAME OF THE DATABASE";  // FOR HFB SERVERS IT'S THE SAME AS THE USER NAME
////////////MODIFY THIS SECTION //////////////////
////////////SERVER NUMBER nine //////////////////
$hostnames9 = "hive.hfbservers.com:3306";  // OR DAYZ.ST:3306 
$usernames9 = "DATABASE USERNAME";
$passwords9 = "DATABASE PASSWORD";
$databasenames9 = "NAME OF THE DATABASE";  // FOR HFB SERVERS IT'S THE SAME AS THE USER NAME
////////////MODIFY THIS SECTION //////////////////
////////////SERVER NUMBER ten //////////////////
$hostnames10 = "hive.hfbservers.com:3306";  // OR DAYZ.ST:3306 
$usernames10 = "DATABASE USERNAME";
$passwords10 = "DATABASE PASSWORD";
$databasenames10 = "NAME OF THE DATABASE";  // FOR HFB SERVERS IT'S THE SAME AS THE USER NAME
////////////MODIFY THIS SECTION //////////////////

?>
