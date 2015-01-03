<hr width="250px" style="position: relative; top: 35px;" />
<link href="styles.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Kameron:700,400' rel='stylesheet' type='text/css'>


<?php

function printDashboard($pageid)
{
	
	$usertype = $_SESSION['usertype'];	
	echo('<div align="center">');
	
	if ($pageid!=0)
		echo('<a href="index.php">Target</a>&nbsp;|&nbsp;');

	if  ($pageid!=1)
		echo('<a href="myProfile.php">Profile</a>&nbsp;|&nbsp;');

	if (($_SESSION['team']== -1  || $_SESSION['username'] == "sgiordano" || $_SESSION['username'] == "mgerstman") && $pageid!=4)
	{
		echo('<a href ="admin.php">Admin</a>&nbsp;|&nbsp;');
	}
	else if ($usertype && $pageid!=2 && $pageid!=4)
	{//only give access to the overall panel to overalls
		echo('<a href ="overall.php?team='.$_SESSION['team'].'">Overall Panel</a>&nbsp;|&nbsp;');
	}
	
	if ($pageid!=3)
		echo('<a href ="leaderboard.php">Leaderboard</a> &nbsp;|&nbsp;');

	echo('<a href="logout.php">Logout</a><br /><br />');
	
	if (($_SESSION['username'] == "mgerstman") || ($_SESSION['username'] == "sgiordano"))
	{
		echo('<a href="needsApproval.php">Needs Approval</a>&nbsp;|&nbsp;');
		echo('<a href="listOfWays.php">Tweet List</a>');
		echo('<hr width="200px" style="position: relative; top: 0px;" />');
	}
	
}

?>