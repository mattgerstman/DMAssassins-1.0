<?php

session_start();
?>

<html>
<meta name = "viewport" content = "width = device-width">
<link href="styles.css" rel="stylesheet" type="text/css" />
<title>Ways You Can Die</title>
<body>
<div align="center">

Want to see your idea posted when a player dies? You're in the right place. <br />
<br />
All of the tweets need to include the persons name to be worth it. <br /> When you want to insert someone's full name into the submission include the text: "THEIRNAME" in all caps.<br /> If you want to insert just their first name use "THEIR". <br /> <br /> When a player dies the software will then randomly pick a submission and<br /> replace "THEIR" and "THEIRNAME" with the person's name. <br />I've included a few examples below to help.
<br /><br /> 
THEIRNAME was killed in a tragic segway accident.<br />
THEIRNAME died from video game withdrawal. THEIR is now playing Nintendo in heaven.<br />
King Kong threw THEIRNAME off of a building. THEIR will be missed. <br />
<br />
Also here's some other things to keep in mind:<br />
<br />
1) All submissions need to be under 110 characters so we can include the player's name in the tweet.<br />
2) Keep it PG. This one should be obvious.<br />
3) Since these will be tweeted, feel free to use #hashtags and @'s where appropriate.<br />
4) Spell-check is your friend.<br />
<br /><br /><br />
<form action="processWaysYouCanDie.php" method="post" onsubmit="return validate(this);">
<input type="text" name="way" /><br />
<br /><input type="submit" value="Submit" />
<br />
<br />

<?php

echo($_SESSION['nope']);
unset($_SESSION['nope']);

?>

<!--P.S. The current list is available <a href="listOfWays.php">here.</a>-->

</div>

</form>
</body>
</html>