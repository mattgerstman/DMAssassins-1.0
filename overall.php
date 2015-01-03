<?php

include('checkAdmin.php');
checkAdmin();
include("dashboard.php");
printDashboard(2);

include_once("connectToServer.php");
connect();



?>

<html>
<head>

<?php
include("getTeam.php");

$myTeam = $_SESSION['team'];
$teamNum = $_GET['team'];
if ($teamNum == NULL)
{//if overall link is wrong default to team from session
	$teamNum = $myTeam;
}

if ($teamNum!=$myTeam && $myTeam!=-1 && $_SESSION['username']!='mgerstman')
{//if user is not an admin and trying to get on another team redirect to their own team
	echo('<SCRIPT LANGUAGE="JavaScript">
	redirURL = "overall.php?team='.$teamNum.'";
	self.location.href = redirURL;
	</script>');
}

$outputTeam=getTeam($teamNum);
echo("<title>Overall Panel: $outputTeam</title>");
?>

<meta name = "viewport" content = "width = device-width">

</head>

<body>
<?php
	$username = $_SESSION['username'];
	$table = "users";



echo($_SESSION['status']);
unset($_SESSION['status']);


	echo('<p>'.getTeam($teamNum).' Team</p><br />');

	$result = mysql_query("SELECT * FROM $table where team = $teamNum ORDER BY name");
	
//get list of all user's with the same team as the overall
while ($row = mysql_fetch_array($result))
	{//loop through users

//get user info	
		$name = $row["name"];
		$username = $row["username"];
		$facebook = $row["facebook"];
		$email = $row["email"];
		$target = $row["target"];
		$alive = $row["alive"];
		
//print user info
		echo("Name: ".$name);	
		echo('<br />Facebook: <a href="'.$facebook.'">'.$facebook.'</a>');
		echo('<br />Email: <a href="mailto:'.$email.'">'.$email.'</a>');
		echo('<br /><a href="editUser.php?username='.$username.'"> Edit</a> ');
		
		if ($alive)
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