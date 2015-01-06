<?php

include('checkSession.php');
check();

include("dashboard.php");
printDashboard(3);

include_once("connectToServer.php");
connect();

include("getTeam.php");
?>

<html>
<head>
<meta name = "viewport" content = "width = device-width">
<title>Leaderboard</title>
</head>

<body>


<?php
	$username = $_SESSION['DM1-username'];
	$table = "users";

$teamOrder		=	$_GET['teamOrder'];
$teamASC		= 	$_GET['teamASC'];
$standingOrder 	=	$_GET['standingOrder'];
$standingASC	=	$_GET['standingASC'];

if ($teamOrder == NULL)
	$teamOrder = 0;
if ($teamASC)
	$teamASCU="ASC";
else
	{$teamASCU="DESC";	$teamASC=0;}

if ($standingASC)
{	$standingASCU = "ASC";}
else
{	$standingASCU = "DESC"; $standingASC=0;}

if ($standingOrder==NULL)
	$standingOrder=2;


echo($_SESSION['DM1-status']);
unset($_SESSION['DM1-status']);
	echo("<p class='special'>Got an idea for the <a href='http://www.twitter.com/DMAssassins'>DMAssassins</a> feed? Submit tweet ideas here: <a href='http://goo.gl/qxU7L'>goo.gl/qxU7L</a>.</p>");

$result = mysql_query("SELECT * FROM $table WHERE pin > 100 ORDER BY killed DESC LIMIT 5");
	echo('<h2>Top 5 Players Overall</h2>');
	echo('<table border="1">
	<tr>
	<th>Name</th>
	<th>Team</th>
	<th>&nbsp;Alive&nbsp;</th>
	<th>&nbsp;Kills&nbsp;</th>');

while ($row = mysql_fetch_array($result))
	{//loop through users

//get user info
		$name = $row["name"];
		$kills = $row["killed"];
		$team = $row["team"];
		$alive = $row["alive"];
		$outputTeam = getTeam($team);

		if ($alive)
			$aliveText = "Yes";
		else
			$aliveText = "No";

//print user info
		echo('</tr><tr><td align="center">'.$name);
		echo('</td><td align="center">'.$outputTeam);
		echo('</td><td align="center">'.$aliveText);
		echo('</td><td align="center">'.$kills);

	}
	echo('</td></tr></table>');

	switch ($teamOrder)
	{
		case	0	: $order = "(SUM(killed)/COUNT(name))"; break;
		case	1	: $order = "team"; break;
		case	2	: $order = "COUNT(name)"; break;
		case	3	: $order = "SUM(alive)"; break;
		case	4	: $order = "SUM(killed)"; break;
	}

	for ($i=0; $i<5; $i++)
	{
		$teamLink[$i] ="leaderboard.php?standingOrder=$standingOrder&&standingASC=$standingASC&&teamOrder=$i&&teamASC=";
		if ($teamOrder==$i)
			$teamLink[$i] = $teamLink[$i] . !($teamASC);
		else if ($tearmOrder == 1)
			$teamLink[$i] = $teamLink[$i] . "0";
		else
			$teamLink[$i] = $teamLink[$i] . "1";
	}





	$playersLink ="leaderboard.php?standingOrder=$standingOrder&&standingASC=$standingASC&&teamOrder=1&&teamASC=".$teamLink;


	$result = mysql_query("SELECT team, SUM(alive), SUM(killed), COUNT(name) FROM $table GROUP BY team ORDER BY $order $teamASCU");
	echo('<h2>Team Stats</h2>');
	echo('<table border="1">
	<tr>
	<th>&nbsp;<a href="'.$teamLink[1].'">Team</a>&nbsp;</th>
	<th>&nbsp;<a href="'.$teamLink[2].'">Players</a>&nbsp;</th>
	<th>&nbsp;<a href="'.$teamLink[3].'">Alive</a>&nbsp;</th>
	<th>&nbsp;<a href="'.$teamLink[4].'">Kills</a>&nbsp;</th>
	<th>&nbsp;<a href="'.$teamLink[0].'">Kills Per Player</a>&nbsp;</th>');

	while ($row = mysql_fetch_array($result))
	{//loop through teams

//get team
		$team = $row["team"];
		$players = $row ["COUNT(name)"];
		$totalPlayers = $totalPlayers + $players;
		$alive = $row["SUM(alive)"];
		$totalAlive = $totalAlive + $alive;
		$kills = $row["SUM(killed)"];
		$dead = $dead + $kills;
		$outputTeam = getTeam($team);
		if ($kills)
			$killsPerPlayer=$kills/$players;
		else
			$killsPerPlayer=0;


//print user info
		echo('</tr><tr><td align="center">'.$outputTeam);
		echo('</td><td align="center">'.$players);
		echo('</td><td align="center">'.$alive);
		echo('</td><td align="center">'.$kills);
		echo('</td><td align="center">'.round($killsPerPlayer,3));
	}
	$percentAlive = $totalAlive/$totalPlayers * 100;
	if ($dead)
		$killsPerPlayer=$dead/$totalPlayers;
	else
		$killsPerPlayer=0;


	echo('</tr><tr><td align="center"> Total');
	echo('</td><td align="center">'.$totalPlayers);
	echo('</td><td align="center">'.$totalAlive);
	echo('</td><td align="center">'.$dead);
	echo('</td><td align="center">'.round($killsPerPlayer,3));

	echo('</td></tr></table>');

//get list of all user's who are alive

switch ($standingOrder)
{
	case	0	: $order = "name"; break;
	case	1	: $order = "team"; break;
	case	2	: $order = "killed"; break;
}

for ($i=0; $i<3; $i++)
{
	$standingLink[$i] ="leaderboard.php?teamOrder=$teamOrder&&teamASC=$teamASC&&standingOrder=$i&&standingASC=";
	if ($standingOrder==$i)
		$standingLink[$i] = $standingLink[$i] . !($standingASC);
	else if ($i != 2)
		$standingLink[$i] = $standingLink[$i] . "1";
	else
		$standingLink[$i] = $standingLink[$i] . "0";
}


	$result = mysql_query("SELECT * FROM $table where alive!=0 AND pin >100 ORDER BY $order $standingASCU");
	echo('<h2>Players Standing</h2>');
	echo('<table border="1">
	<tr>
	<th><a href="'.$standingLink[0].'">Name</a></th>
	<th><a href="'.$standingLink[1].'">Team</a></th>
	<th>&nbsp;<a href="'.$standingLink[2].'">Kills</a>&nbsp;</th>');
	while ($row = mysql_fetch_array($result))
	{//loop through users

//get user info
		$name = $row["name"];
		$kills = $row["killed"];
		$team = $row["team"];
		$outputTeam = getTeam($team);

//print user info
		echo('</tr><tr><td align="center">'.$name);
		echo('</td><td align="center">'.$outputTeam);
		echo('</td><td align="center">'.$kills);
	}
		echo('</td></tr></table>');




?>

</div>



</div>
</body>
</html>
