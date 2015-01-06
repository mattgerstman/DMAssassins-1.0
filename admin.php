<?php

include('checkSuperAdmin.php');
checkSuperAdmin();


?>

<html>
<head>
<meta name = "viewport" content = "width = device-width">

<title>Admin Panel</title>


</head>

<body>


<?php
	$username = $_SESSION['DM1-username'];
	$table = "users";

include("dashboard.php");
printDashboard(4);
include("getTeam.php");


echo($_SESSION['DM1-status']);
unset($_SESSION['DM1-status']);


//get list of all user's with the same team as the overall

echo("<p>Team List</p><br />");

for($i=0; $i<12; $i++)
{
	$outputTeam = getTeam($i);
	echo('<a href =overall.php?team='.$i.'>'.$outputTeam.'</a><br/>');
}

echo('<br /><br />Overall List<br />');

	$result = mysql_query("SELECT * FROM $table where usertype = 1  ORDER BY name");
while ($row = mysql_fetch_array($result))
	{//loop through users

//get user info
		$name = $row["name"];
		$username = $row["username"];
		$facebook = $row["facebook"];
		$team = $row["team"];
		$email = $row["email"];
		$target = $row["target"];

//print user info
		echo("<br />Name: ".$name);
		echo('<br />Facebook: <a href="'.$facebook.'">'.$facebook.'</a>');
		echo('<br />Email: <a href="mailto:'.$email.'">'.$email.'</a>');
		echo('<br /><a href="editUser.php?username='.$username.'"> Edit</a> ');
		if ($target)
		{//check if alive, if they are allow overall to kill them
			echo(' &nbsp; <a href="killUser.php?username='.$username.'" onclick="return confirm('."'Are you sure you want to kill this user? If yes, then click OK.'".')">Kill</a>');
		}
		else
		{//check if dead, if they are allow overall to revive them
			echo(' &nbsp; <a href="reviveUser.php?username='.$username.'" onclick="return confirm('."'Are you sure you want to revive this user? If yes, then click OK.'".')">Revive</a>');
		}
		//allow overall to delete user, include dialog box
		echo(' &nbsp; <a href="deleteUser.php?username='.$username.'" onclick="return confirm('."'Are you sure you want to delete this user? If yes, then click OK.'".')">Delete</a><br /><br />');

	}


?>




</div>
</body>
</html>
