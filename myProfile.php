<?php

include('checkSession.php');
check();


include("dashboard.php");
printDashboard(1);


include('getTeam.php');

?>

<html>
<head>
<meta name = "viewport" content = "width = device-width">
<title>My Profile</title>
</head>
<script language="Javascript">//check if password and confirmation are equal

	function validate(form) {
		  var elem = form.elements;

		  if(elem.new.value != elem.confirm.value) {
		    alert('Please check your password; the confirmation entry does not match.');
		    return false;
		  }
		  return true;
		}
</script>
<body>



<?php

	$username = $_SESSION['DM1-username'];
	$usertype = $_SESSION['DM1-usertype'];
	$table = "users";


//standard dashboard output


include_once("connectToServer.php");
connect();

//get personal info
	$result = mysql_query("SELECT * FROM $table where username = '$username'");
	$pin = mysql_result($result,0,"pin");
	$name = mysql_result($result,0,"name");
	$facebook = mysql_result($result,0,"facebook");
	$email = mysql_result($result,0,"email");
	$team = mysql_result($result,0,"team");
	$kills = mysql_result($result,0,"killed");
	$outputTeam = getTeam($team);

//output personal info
	echo('Pin Number: '.$pin);
	echo('<br />Kills: '.$kills);
	echo("<br /><br />Name: ".$name);
	echo('<br />Facebook: <a href="'.$facebook.'">'.$facebook.'</a>');
	echo('<br />Email: <a href="mailto:'.$email.'">'.$email.'</a>');
	echo('<br />Team: '.$outputTeam.'<br />');
	echo("<br /><p class='special'>Got an idea for the <a href='http://www.twitter.com/DMAssassins'>DMAssassins</a> feed? Submit tweet ideas <a href='/waysYouCanDie.php'>here</a>.</p>");
	echo('<br ><br />To prevent cheating, we have disabled profile editing.');
	echo('<br /> If any of the information above is incorrect, please contact your overall.');

?>

<br />
<br />
<br />
Change Password<br/>

<form action="changePassword.php" method="post" onsubmit="return validate(this);">
<br />
<table>
<tr>
<td style="text-align: right">Old Password:</td><td style="text-align: left"> <input type="password" name="old" /></td>
</tr>
<tr>
<td style="text-align: right">New Password:</td><td style="text-align: left"> <input type="password" name="new" /></td>
</tr>
<tr>
<td style="text-align: right">New Password (Confirm):</td><td style="text-align: left"><input type="password" name="confirm" /></td>
</tr>
</table>
<input type="submit" value="Submit" />

<?php

echo($_SESSION['DM1-status']);
unset($_SESSION['DM1-status']);
?>


</div>
</body>
</html>
