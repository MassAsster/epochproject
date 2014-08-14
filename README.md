epochproject
============

DayZ Epoch Player Reward System


Player Reward System:

Note 1:
PDO and new password encyptions have been added, this will require an update to the database table 'password' if you updating from an older version. This update is included in the updatedatabase.sql file. A new buddy system has been added to allow players to join friends upon spawning in. A new method for receiving tokens has been finialized and allows server operators to set the value of kills, headshots, bandit kills, as well as set the cost in humanity to make trades with the banking system. Two levels of cost (for humanity) are customizable and allow for players above a certain number in humanity to have a higher humanity cost when doing business with the token bank system. Humanity has long been a useless number after 5000, this will hopefully bring back some use for humanity.

note2:

Due to the concern from the Epoch dev team about the whole donation based reward system, I completely re-hauled the way tokens are given to players. Players can use their in game Zombie kills, Bandit Kills and Player Kills to gain tokens in this system. You will only be able to bank tokens that are in your current ALIVE character, meaning once your character is dead - you will not be able to bank the zombie kills.

Tokens can be used on player rewards such as a backpack with building loot, a base item (like a well with water, a guard tower ),  a vehicle (not keyed), a vault code change and more.


 

How it works:

 After playing the game, I rack up 34 zombie kills, 14 bandit kills and 1 human kill.

 

Depending on the server operator, he may chose to use that 1 human kills against me when calculating the banking.

 

For the sake of this example, lets say the rewards are as follows:

(Server operators can set values )

.03  for zombie kills

.04 for bandits

.05 for humans

 

34 x .03  =  1.02

14 x .04  = .56

1 x .5 = .05

----------------------

Total Banked Tokens  1.53

 

My Zombie kills would be re-set to 0, along with my bandit kills. Human kills would remain as 1 to be used against me again next bank.

 

 

Banking is done manually - introducing a Risk / Reward system -  meaning if I kill 150 zombies, but die before I can get into the system and "bank them" - I lose my zombie kills and will not be able to bank them.
