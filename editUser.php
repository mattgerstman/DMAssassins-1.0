<?php

include('checkAdmin.php');
checkAdmin();

?>

<html>
<head>
<meta name = "viewport" content = "width = device-width">

<link href="styles.css" rel="stylesheet" type="text/css" />
<title>Edit Captain Information</title>
</head>

<body>
<?php

	$username = $_GET['username'];
	$table = "users";

include("dashboard.php");
printDashboard(10);

include_once("connectToServer.php");
connect();

//Request info about selected captain

		$result = mysql_query("SELECT * FROM $table where username = '$username'");
		$name = mysql_result($result,0,"name");
		$username = mysql_result($result,0,"username");
		$facebook = mysql_result($result,0,"facebook");
		$email = mysql_result($result,0,"email");
		$team =  mysql_result($result,0,"team");
		$admin =  mysql_result($result,0,"usertype");
//code to handle middle names

		$numNames = str_word_count($name,0,'&;') - 1;
		$nameList = str_word_count($name,1,'&;');
		for ($i=0; $i<$numNames; $i++)
		{
			$firstname = $firstname . $nameList[$i] . " ";
		}
		$lastname = $nameList[$numNames];

//set's up form to preselect team name
		for ($i=-1; $i<12; $i++)
		{
			$selectVal[$i]='"' . $i. '"';
			if ($i == $team)
			{
				$selectVal[$i] = $i . ' selected';
			}
		}

//form for editing a user
		echo('<form action="processEditUser.php?username='.$username.'" method="post" onsubmit="return validate(this);">
		First Name: <input type="text" name="firstname" value = "'.$firstname.'" /><br />
		Last Name: <input type="text" name="lastname" value = "'.$lastname.'" /><br />
		<br />
		Facebook Link: <input type="text" name="facebook" value="'.$facebook.'" /><br />
		Email: <input type="text" name="email" value = "'.$email.'" /><br />');
		if (($username!=$_SESSION['DM1-username']) || ($_SESSION['DM1-team']==12))
		{//if statement blocks changing your own team. This prevents cheating.
			echo('Team: <select name="team">
			<option value='.$selectVal[0].'>Community Events</option>
			<option value='.$selectVal[1].'>Dancer Relations</option>
			<option value='.$selectVal[2].'>Entertainment</option>
			<option value='.$selectVal[3].'>Family Relations</option>
			<option value='.$selectVal[4].'>Finance</option>
			<option value='.$selectVal[5].'>Hospitality</option>
			<option value='.$selectVal[6].'>Marketing</option>
			<option value='.$selectVal[7].'>Morale</option>
			<option value='.$selectVal[8].'>Operations</option>
			<option value='.$selectVal[9].'>Public Relations</option>
			<option value='.$selectVal[10].'>Recruitment</option>
			<option value='.$selectVal[11].'>Technology</option>');
			if ($_SESSION['DM1-team']==-1 || $_SESSION['DM1-username'] == "mgerstman" || $_SESSION['DM1-username'] == "sgiordano")
			{
				echo('<option value='.$selectVal[-1].'>Admin</option>');
			}
			echo('</select><br />');

			$adminVal[0] = "0";
			$adminVal[1] = "1";
			$adminVal[$admin] = $adminVal[$admin] . ' selected';

			echo('Usertype: <select name="admin">
			<option value='.$adminVal[0].'>Captain</option>
			<option value='.$adminVal[1].'>Overall</option>');
			echo('</select><br />');
	}

		echo('<input type="submit" value="Submit" />');




?>


<?php

echo($_SESSION['DM1-status']);
unset($_SESSION['DM1-status']);
?>


</div>
</body>
</html>
